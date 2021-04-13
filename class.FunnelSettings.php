<?php
if (!class_exists('FunnelSettings')) {

    class FunnelSettings {

        public $earnware;
        public $konnektive;
        public $endpoints;
        public $debug;
        public $upsell_order;
        private $page_flow;
        public $last_konnektive_message;

        public function __construct() {
            add_action('admin_menu', array($this, 'funnel_admin_menu'));
            add_action('admin_enqueue_scripts', array($this, 'funnel_enqueue_scrpts'));
            add_action('wp_enqueue_scripts', array($this, 'frontend_scripts'));
            add_action('add_meta_boxes', array($this, 'funnel_page_meta_boxes'));
            add_action('save_post_page', array($this, 'save_page_variation_postdata'));

            add_shortcode('checkout_page', array($this, 'checkout_page'));
            add_shortcode('order_confirmation', array($this, 'order_confirmation'));
            add_shortcode('second_checkout_page', array($this, 'second_checkout_page'));
            add_shortcode('opt_in_form', array($this, 'opt_in_form'));
            add_shortcode('next_step', array($this, 'next_step_post_parameters'));

            $this->init();
        }

        public function init() {
            $this->earnware = json_decode(json_encode(maybe_unserialize($this->maybe_get_value($this->get_funnel_data('earnware')))));
            $this->konnektive = json_decode(json_encode(maybe_unserialize($this->maybe_get_value($this->get_funnel_data('konnektive')))));
            $this->endpoints = json_decode(json_encode(maybe_unserialize($this->maybe_get_value($this->get_funnel_data('endpoints')))));
            $this->debug = json_decode(json_encode(maybe_unserialize($this->maybe_get_value($this->get_funnel_data('debug')))));
            $this->funnel_steps = json_decode(json_encode(maybe_unserialize($this->maybe_get_value($this->get_funnel_data('funnel_steps')))));

            $this->page_flow = [
                "oto",
                "tacticalpen",
                "master-tool-kit",
                "flashlight",
                "bug-out-bag",
                "personalwaterbottle",
                "orderconfirmation"
            ];
        }

        public static function funnel_plugin_activation() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'st_funnels';
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name ( "
                    . "id mediumint(9) NOT NULL AUTO_INCREMENT,"
                    . "name varchar(191) NOT NULL,"
                    . "value text NOT NULL,"
                    . "PRIMARY KEY(id), "
                    . "UNIQUE KEY(name)"
                    . ")$charset_collate;  ";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta($sql);
        }

        public function funnel_enqueue_scrpts() {
            wp_register_script('funnel-settings-script', plugin_dir_url(__FILE__) . 'assets/funnel_settings.script.js');
            wp_enqueue_script('funnel-settings-script');
            wp_enqueue_script('jquery-validator', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js', array('jquery'));
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_style('funnel-settings-style', plugin_dir_url(__FILE__) . 'assets/funnel_settings.style.css', array(), '1.0.1');


            wp_localize_script('funnel-settings-script', 'st_page_drop_down', wp_dropdown_pages(['echo' => 0, "show_option_none" => "Select a Page", "class" => "%s%", "hierarchical" => 0]));
        }

        public function frontend_scripts() {
            wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'assets/custom.style.css', array(), '1.0.1');
            wp_enqueue_script('shortcode-checkout-js', plugin_dir_url(__FILE__) . 'assets/shortcode.checkout.script.js', array('jquery'));
            wp_enqueue_script('sweetalert-js', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js', array('jquery'));
            wp_enqueue_style('shortcode-checkout-style', plugin_dir_url(__FILE__) . 'assets/shortcode.checkout.style.css', array(), '1.0.2');
            wp_enqueue_style('shortcode-orderconfirmation-style', plugin_dir_url(__FILE__) . 'assets/shortcode.orderconfirmation.style.css', array(), '1.0.2');
            wp_enqueue_style('Font-Awesome4-7', plugin_dir_url(__FILE__) . 'assets/font-awesome.min.css', array(), '4.7');
            wp_enqueue_script('funnel-upsells-script', plugin_dir_url(__FILE__) . 'assets/funnel.upsells.script.js', array('jquery'));
        }

        public function funnel_admin_menu() {
            add_menu_page(__('Funnel Settings', 'funnel-settings'), __('Funnel Settings', 'funnel-settings'), 'manage_options', 'funnel-settings', array($this, 'main_page_render'), 'dashicons-admin-generic');
            add_submenu_page('funnel-settings', __("General Settings", 'funnel-settings'), __('General Settings', 'funnel-settings'), 'manage_options', 'funnel-settings', array($this, 'main_page_render'));
            add_submenu_page('funnel-settings', __("API Logs", 'funnel-settings'), __('API Logs', "funnel-settings"), 'manage_options', 'api-logs', array($this, 'api_log_page_render'));
        }

        public function main_page_render() {
            $this->save_funnel_data();
            $data['earnware'] = maybe_unserialize($this->maybe_get_value($this->get_funnel_data('earnware')));
            $data['konnektive'] = maybe_unserialize($this->maybe_get_value($this->get_funnel_data('konnektive')));
            $data['endpoints'] = maybe_unserialize($this->maybe_get_value($this->get_funnel_data('endpoints')));
            $data['debug'] = maybe_unserialize($this->maybe_get_value($this->get_funnel_data('debug')));
            $data['funnel_steps'] = maybe_unserialize($this->maybe_get_value($this->get_funnel_data('funnel_steps')));
            $this->get_page_template('main', $data);
        }

        public function api_log_page_render() {
            $e_log = new FunnelLog('earnware');
            $data['earnware_log'] = $e_log->read_log();

            $k_log = new FunnelLog('konnektive');
            $data['konnektive_log'] = $k_log->read_log();

            $this->get_page_template('api_logs', $data);
        }

        private function get_page_template($template, $data = NULL, $echo = true) {
            ob_start();
            if ($data) {
                extract($data);
            }
            include(FUNNELS_PLUGIN_TEMPLATE_DIR . DIRECTORY_SEPARATOR . $template . '.php');
            $html = ob_get_clean();
            if ($echo) {
                echo $html;
            } else {
                return $html;
            }
        }

        private function save_funnel_data() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'st_funnels';
            if (isset($_POST['submit'])) {
                $post_data = filter_input_array(INPUT_POST);
                $funnel_data['earnware'] = array_filter($post_data['funnel_earnware']);
                $funnel_data['konnektive'] = array_filter($post_data['funnel_konnektive_api']);
                $funnel_data['endpoints'] = array_filter($post_data['funnel_api_endpoints']);
                $funnel_data['debug'] = array_filter(isset($post_data['funnel_debug']) ? $post_data['funnel_debug'] : []);
                $funnel_data['funnel_steps'] = array_filter(isset($post_data['funnel_steps']) ? array_map(function($v) {
                            return json_decode(stripcslashes($v));
                        }, $post_data['funnel_steps']) : []);
                $save_status = TRUE;
                foreach ($funnel_data as $key => $value) {
                    $data = maybe_serialize($value);
                    $sql = $wpdb->prepare("INSERT INTO `$table_name` (`name`, `value`) VALUES("
                            . "%s, %s ) ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `value` = VALUES(`value`)", $key, $data);
                    $wpdb->query($sql);
                    if ($wpdb->last_error) {
                        $save_status = FALSE;
                        break;
                    }
                }
                ($save_status) ? $this->set_message_for_user('success', 'Settings Saved Successfully!') : $this->set_message_for_user('error', 'Sorry, unable to save settings. Please try again later');
                return;
            }
        }

        private function get_funnel_data($key) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'st_funnels';
            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
                return $wpdb->get_row($wpdb->prepare("SELECT `value` FROM $table_name WHERE `name` = %s LIMIT 1", $key));
            } else {
                return array();
            }
        }

        private function set_message_for_user($type, $message) {
            $_SESSION['funnel']['user_message'] = [
                'message' => $message,
                'type' => $type
            ];
        }

        public function checkout_page() {
            ob_start();
            include_once(FUNNELS_PLUGIN_TEMPLATE_DIR . '/shortcodes/checkout_page.php');
            return ob_get_clean();
        }

        public function order_confirmation() {
            ob_start();
            include_once(FUNNELS_PLUGIN_TEMPLATE_DIR . '/shortcodes/order_confirmation.php');
            return ob_get_clean();
        }

        public function second_checkout_page() {
            ob_start();
            include_once(FUNNELS_PLUGIN_TEMPLATE_DIR . '/shortcodes/second_checkout_page.php');
            return ob_get_clean();
        }

        public function opt_in_form() {
            ob_start();
            include_once(FUNNELS_PLUGIN_TEMPLATE_DIR . '/shortcodes/opt_in_form.php');
            return ob_get_clean();
        }

        public function next_step_post_parameters() {
            $page_id = get_queried_object_id();
            $current_page = get_post_field('post_name', $page_id);
            $next_page = $this->get_next_funnel_step($current_page);
            $page_meta = $this->get_funnel_page_meta($next_page['slug']);

            return $this->get_page_template('/shortcodes/next_step_post_parameters', [
                        "step_count" => $next_page['step'],
                        'current_page' => $current_page,
                        "funnel_meta" => $page_meta
                            ], false);
        }

        private function maybe_get_value($objt) {
            if (!empty($objt) && is_object($objt)) {
                return $objt->value;
            }
            return array();
        }

        //Sample usage funnelRedirect('/checkout/', ['para1' => 'Para 1 value', 'para2' => 'Para 2 value']);
        public function funnelRedirect($url, $params = array()) {
            $query['affId'] = isset($_SESSION['affId']) ? $_SESSION['affId'] : '';
            $query['email'] = filter_has_var(INPUT_POST, 'email') ? filter_input(INPUT_POST, 'email') : $_SESSION['email'];
            $query['var'] = filter_has_var(INPUT_POST, 'var') ? filter_input(INPUT_POST, 'var') : '';
            $query['c1'] = isset($_SESSION['c1']) ? $_SESSION['c1'] : '';
            $query['c2'] = isset($_SESSION['c2']) ? $_SESSION['c2'] : '';
            $query['c3'] = isset($_SESSION['c3']) ? $_SESSION['c3'] : '';

            if (filter_has_var(INPUT_GET, 'fname')) {
                $query['fname'] = filter_input(INPUT_GET, 'fname');
            }

            $query_merged = array_merge($query, $params);
            header('Location: ' . home_url($url) . '?' . http_build_query($query_merged)); //Redirect user to next step with query parameters
            exit;
        }

        public function funnel_page_meta_boxes() {
            add_meta_box(
                    'st_funnel_page_meta_id', 'Funnel Page Meta', array($this, 'funnel_page_meta_box_html'), 'page', 'side'
            );
        }

        public function funnel_page_meta_box_html($page) {
            $value = get_post_meta($page->ID, 'st_page_variation', true);
            $prod_1 = get_post_meta($page->ID, 'st_page_product_id_1', true);
            $prod_2 = get_post_meta($page->ID, 'st_page_product_id_2', true);
            ?>
            <div class="components-base-control funnel-page-meta__variation_id">
                <div class="components-base-control__field">
                    <label class="components-base-control__label" for="page_variation_field">Variation ID:</label>
                    <input type="text" name="page_variation_field" id="page_variation_field" class="components-text-control__input" value="<?php echo $value; ?>">
                </div>
            </div>
            <?php //if($page->ID === 2697) :  ?> <!-- only for home page --> 
            <div class="components-base-control funnel-page-meta__product_id_1">
                <div class="components-base-control__field">
                    <label class="components-base-control__label" for="page_product_field_#1">Product ID #1:</label>
                    <input type="text" name="page_product_field_1" id="page_product_field_#1" class="components-text-control__input" value="<?php echo $prod_1; ?>">
                </div>
            </div>
            <div class="components-base-control funnel-page-meta__product_id_2">
                <div class="components-base-control__field">
                    <label class="components-base-control__label" for="page_product_field_#2">Product ID #2:</label>
                    <input type="text" name="page_product_field_2" id="page_product_field_#2" class="components-text-control__input" value="<?php echo $prod_2; ?>">
                </div>
            </div>
            <?php //endif; ?>
            <?php
        }

        public function save_page_variation_postdata($post_id) {
            $post_data = filter_input_array(INPUT_POST);

            $funnel_meta = [
                "page_variation_field" => 'st_page_variation',
                "page_product_field_1" => 'st_page_product_id_1',
                "page_product_field_2" => 'st_page_product_id_2'
            ];
            foreach ($funnel_meta as $field_name => $mata_name) {
                if (isset($post_data[$field_name])) {
                    update_post_meta(
                            $post_id, $mata_name, $post_data[$field_name]
                    );
                }
            }
        }

        public function get_next_funnel_step($current_page) {
            $index = (array_search($current_page, $this->page_flow) !== false ) ? array_search($current_page, $this->page_flow) : -1;
            $next_page_index = $index + 1;

            return ['step' => $next_page_index,
                'slug' => $this->page_flow[$next_page_index]
            ];
        }

        public function get_funnel_page_meta($slug) {
            $args = array(
                'name' => $slug,
                'post_type' => 'page',
                'post_status' => 'publish',
                'numberposts' => 1
            );
            $page_obj = get_posts($args);
            $page_meta = get_post_meta($page_obj[0]->ID);

            return [
                'page_variation' => $page_meta['st_page_variation'][0],
                'product_id1' => $page_meta['st_page_product_id_1'][0],
                'product_id2' => $page_meta['st_page_product_id_2'][0]
            ];
        }

    }

    $FunnelSettings = new FunnelSettings(); //create $FunnelData global variable to access plugin data externally
}
