<?php

/**
  Plugin Name: Funnel Settings
  Description: Plugin to manage CSM Education funnel related specific configuration data and API endpoint details. This plugin also contains special shortcodes that are essential to the functionality of the entore funnel (<strong>DO NOT DEACTIVATE</strong>)
  Author: Seneview
  Version: 1.0.0
  Author URI: https://www.seneview.com
  Text Domain: funnel-settings
 */
/* Make sure doesn't expose any data on a direct call */
if (!function_exists('add_action')) {
    echo "I'm Sorry, I have no worth alone.";
}
!session_id() ? session_start() : FALSE;

define('FUNNELS_VERSION', '1.0.0');
define('FUNNELS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FUNNELS_PLUGIN_TEMPLATE_DIR', plugin_dir_path(__FILE__) . 'templates');
define('FUNNELS_PLUGIN_LOG_DIR', plugin_dir_path(__FILE__) . 'logs' . DIRECTORY_SEPARATOR);

register_activation_hook(__FILE__, array('FunnelSettings', 'funnel_plugin_activation'));
require_once( FUNNELS_PLUGIN_DIR . 'class.FunnelSettings.php');
require_once( FUNNELS_PLUGIN_DIR . 'class.Log.php');
require_once( FUNNELS_PLUGIN_DIR . 'class.Konnektive.php' );
require_once( FUNNELS_PLUGIN_DIR . 'class.Earnware.php' );
require_once( FUNNELS_PLUGIN_DIR . 'set-session-data.php' );

$Konnektive = new Konnektive(); //Create Konnective object
$Earnware = new Earnware(); //Create Earnware object
if (filter_has_var(INPUT_POST, 'step')) {
    switch (filter_input(INPUT_POST, 'step')) {
        case 'opt-in': //Send email address to earnware step. This step triggers at homepage when the user submit their email address from the pop-up
            $Earnware->addToEarnware(filter_input(INPUT_POST, 'email')); //Send details to Earnware and redirect to checkout page
            break;

        case 'checkout':
            $Earnware->checkoutUpdate();
            $Konnektive->addOrderToKonnektive();
            break;

        case 'additional_sale':
            $Earnware->upsellUpdate('upsellPage1');
            $Konnektive->addAdditionalSaleToKonnektive();
            break;

        case 'skip_sale':
            $additional_url_parameters = [
                'pageType' => filter_input(INPUT_POST, 'pageType'),
                'orderdetails' => filter_input(INPUT_POST, 'orderdetails'),
                'orderId' => filter_input(INPUT_GET, 'orderId'),
                'var' => filter_input(INPUT_POST, 'var')
            ];
            $next_page = $FunnelSettings->get_next_funnel_step((filter_input(INPUT_POST, 'current_page') ?: "checkout"));
            $FunnelSettings->funnelRedirect('/' . $next_page['slug'] . '/', $additional_url_parameters); //funnelRedirect('Redirect URL', 'Additional Parameters')
            break;

        default:
            break;
    }
}

