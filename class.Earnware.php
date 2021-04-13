<?php

/**
 * Earnware object
 */
if (!class_exists('Earnware')) {

    class Earnware extends FunnelSettings {

        private $log;

        public function __construct() {
            // parent::__construct(); /** Calling the construct will create a duplicate menu item and other constructional functions on parent class */
            $this->init();
            $this->log = new FunnelLog('earnware');
        }

        public function addToEarnware($email_address) {
            $datetime = new \DateTime("now", new \DateTimeZone('UTC')); //Get UTC time
            $datetime->modify('-4 hour'); //Adjust 4 hours to make both added date/time and registered date/time same
            $modifiedTime = $datetime->format('Y-m-d H:i:s');

            $earnware = array();
            $earnware['userId'] = $this->earnware->userId;
            if (!empty($_SESSION['affId'])) {
                $earnware['source'] = $_SESSION['affId'];
            }
            $earnware['email'] = $email_address;
            $earnware['regDate'] = $modifiedTime;
            $earnware['tags'] = $this->earnware->lead->tagLead;
            $earnware['lists'] = array($this->earnware->lead->key);
            $earnware['campaign'] = $this->earnware->lead->campaign;
            $earnware['sourceUrl'] = (filter_has_var(INPUT_SERVER, 'HTTPS') ? 'https://' : 'http://') . filter_input(INPUT_SERVER, 'HTTP_HOST');
            $earnware['ipAddress'] = filter_input(INPUT_SERVER, 'REMOTE_ADDR');


            $arrayCleaned = array_filter($earnware, function($value) {
                return !is_null($value) && $value !== '';
            }); //Remove empty array values (if any)

            $response = wp_remote_post($this->endpoints->EarnApiURL, array(
                'headers' => array('Content-Type' => 'application/json; charset=utf-8'),
                'body' => json_encode($arrayCleaned, JSON_UNESCAPED_SLASHES),
                'method' => 'POST',
                'data_format' => 'body'
            ));

            if (isset($this->debug->earnware) && $this->debug->earnware->log === 'active') {
                $this->log->write_log($this->build_log($response, $earnware));
            }

            //var_dump($response); die(); // <- API response for dubugging purposes only. DO NOT UNCOMMENT ON PRODUCTION
            //return $response; // <- API response can be logged for dubugging purposes

            $this->funnelRedirect('/securecheckout/', ['pageType' => 'checkoutPage']); //funnelRedirect('Redirect URL', 'Additional Parameters')
        }

        public function checkoutUpdate() {
            $earnware = array();
            $earnware['userId'] = $this->earnware->userId;
            $earnware['source'] = filter_input(INPUT_POST, 'affId');
            $earnware['email'] = filter_input(INPUT_POST, 'emailAddress');
            $earnware['firstname'] = filter_input(INPUT_POST, 'firstName');
            $earnware['lastname'] = filter_input(INPUT_POST, 'lastName');
            $earnware['phone'] = filter_input(INPUT_POST, 'phoneNumber');
            $earnware['addressLine1'] = filter_input(INPUT_POST, 'address1');
            $earnware['city'] = filter_input(INPUT_POST, 'city');
            $earnware['state'] = filter_input(INPUT_POST, 'state');
            $earnware['zip'] = filter_input(INPUT_POST, 'postalCode');
            $earnware['country'] = filter_input(INPUT_POST, 'country');

            $earnware['lists'] = array($this->earnware->buyer->key);
            $earnware['tags'][] = $this->earnware->buyer->tagPurchase;
            if (filter_has_var(INPUT_POST, 'product2_id') && filter_input(INPUT_POST, 'product2_id') <> '') {
                $earnware['tags'][] = $this->earnware->buyer->tagOrderBump;
            }
            $earnware['content'] = $this->earnware->buyer->content;

            $arrayCleaned = array_filter($earnware, function($value) {
                return !is_null($value) && $value !== '';
            }); //Remove empty array values (if any)

            $response = wp_remote_post($this->endpoints->EarnApiURL, array(
                'headers' => array('Content-Type' => 'application/json; charset=utf-8'),
                'body' => json_encode($arrayCleaned, JSON_UNESCAPED_SLASHES),
                'method' => 'POST',
                'data_format' => 'body'
            ));

            if (isset($this->debug->earnware) && $this->debug->earnware->log === 'active') {
                $this->log->write_log($this->build_log($response, $earnware));
            }

            return $response;
        }

        public function upsellUpdate($pageType = '') {
            if (filter_has_var(INPUT_POST, 'ongoing') && filter_input(INPUT_POST, 'ongoing') == $pageType) {
            $earnware = array();
            $earnware['userId'] = $this->earnware->userId;
            $earnware['email'] = filter_input(INPUT_GET, 'email');
            $earnware['membership'] = 'active';

            $earnware['lists'] = array($this->earnware->membershipBuyer->key);
            $earnware['tags'][] = $this->earnware->membershipBuyer->tag;

            $arrayCleaned = array_filter($earnware, function($value) {
                return !is_null($value) && $value !== '';
            }); //Remove empty array values (if any)

            $response = wp_remote_post($this->endpoints->EarnApiURL, array(
                'headers' => array('Content-Type' => 'application/json; charset=utf-8'),
                'body' => json_encode($arrayCleaned, JSON_UNESCAPED_SLASHES),
                'method' => 'POST',
                'data_format' => 'body'
            ));

            if (isset($this->debug->earnware) && $this->debug->earnware->log === 'active') {
                $this->log->write_log($this->build_log($response, $earnware));
            }

            return $response;
            } else {
                return;
            }
        }

        private function build_log($response, $data_sent) {
            $status = wp_remote_retrieve_response_code($response);
            $message = wp_remote_retrieve_response_message($response);
            $body = wp_remote_retrieve_body($response);

            $log = "-----------------------------------------------------------------" . PHP_EOL;
            $log .= "Data Sent:" . PHP_EOL;
            $log .= var_export($data_sent, TRUE);
            $log .= PHP_EOL;

            $log .= PHP_EOL;
            $log .= "Response:" . PHP_EOL;
            $log .= "Date: \t " . date('F j, Y, g:i a') . PHP_EOL;
            $log .= "Status: \t" . $status . PHP_EOL;
            $log .= "Message: \t" . $message . PHP_EOL;
            $log .= "Body: \t" . $body . PHP_EOL;
            $log .= PHP_EOL;
            $log .= "-----------------------------------------------------------------" . PHP_EOL;

            return $log;
        }

    }

}