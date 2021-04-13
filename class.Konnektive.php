<?php

/**
 * Konnective object
 */
if (!class_exists('Konnektive')) {

    class Konnektive extends FunnelSettings {

        private $log;

        public function __construct() {
            // parent::__construct(); /** Calling the construct will create a duplicate menu item and other constructional functions on parent class */
            $this->init();           
            $this->log = new FunnelLog('konnektive');
        }

        public function addOrderToKonnektive() {
            $konnektive = array();
            $konnektive['affId'] = filter_input(INPUT_POST, 'affId');
            $konnektive['sourceValue1'] = filter_input(INPUT_POST, 'sourceValue1');
            $konnektive['sourceValue2'] = filter_input(INPUT_POST, 'sourceValue2');
            $konnektive['sourceValue3'] = filter_input(INPUT_POST, 'sourceValue3');
            $konnektive['firstName'] = filter_input(INPUT_POST, 'firstName');
            $konnektive['lastName'] = filter_input(INPUT_POST, 'lastName');
            $konnektive['phoneNumber'] = filter_input(INPUT_POST, 'phoneNumber');
            $konnektive['emailAddress'] = filter_input(INPUT_POST, 'emailAddress');
            $konnektive['address1'] = filter_input(INPUT_POST, 'address1');
            $konnektive['city'] = filter_input(INPUT_POST, 'city');
            $konnektive['state'] = filter_input(INPUT_POST, 'state');
            $konnektive['postalCode'] = filter_input(INPUT_POST, 'postalCode');
            $konnektive['country'] = filter_input(INPUT_POST, 'country');
            $konnektive['cardNumber'] = filter_input(INPUT_POST, 'cardNumber');
            $konnektive['cardSecurityCode'] = filter_input(INPUT_POST, 'cardSecurityCode');
            $konnektive['cardMonth'] = filter_input(INPUT_POST, 'cardMonth');
            $konnektive['cardYear'] = filter_input(INPUT_POST, 'cardYear');
            $konnektive['product1_id'] = filter_input(INPUT_POST, 'product1_id');
            $konnektive['product2_id'] = filter_input(INPUT_POST, 'product2_id');
            $konnektive['ipAddress'] = filter_input(INPUT_SERVER, 'REMOTE_ADDR');

            $konnektive['shipAddress1'] = filter_input(INPUT_POST, 'address1');
            $konnektive['shipCity'] = filter_input(INPUT_POST, 'city');
            $konnektive['shipState'] = filter_input(INPUT_POST, 'state');
            $konnektive['shipPostalCode'] = filter_input(INPUT_POST, 'postalCode');
            $konnektive['shipCountry'] = filter_input(INPUT_POST, 'country');

            $konnektive['paySource'] = $this->konnektive->paySource;
            $konnektive['loginId'] = $this->konnektive->loginId;
            $konnektive['password'] = $this->konnektive->password;
            $konnektive['campaignId'] = $this->konnektive->campaignId;


            $konnektive_cleaned = array_filter($konnektive, function($value) {
                return !is_null($value) && $value !== '';
            }); //Remove empty array values (if any)

            $response = wp_remote_post($this->endpoints->order, array(
                'body' => $konnektive_cleaned,
                'method' => 'POST',
                'data_format' => 'body'
            ));


            if (isset($this->debug->konnektive) && $this->debug->konnektive->log === 'active') {
                $this->log->write_log($this->build_log($response, $konnektive));
            }

            $decoded_response = json_decode($response['body']);

            if (strtoupper($decoded_response->result) == 'SUCCESS') {

                $additional_url_parameters = [
                    'pageType' => 'upsellPage1',
                    'orderdetails' => filter_input(INPUT_POST, 'product1_id'),
                    'purchase' => filter_input(INPUT_POST, 'purchase'),
                    'fname' => filter_input(INPUT_POST, 'firstName'),
                    'orderId' => $decoded_response->message->orderId
                ];
                $next_page = $this->get_next_funnel_step((filter_input(INPUT_POST, 'current_page')?: "checkout"));

                $this->funnelRedirect('/'.$next_page['slug'].'/', $additional_url_parameters); //funnelRedirect('Redirect URL', 'Additional Parameters')
                
            } else {

                $_SESSION['display_message'] = 1;
                $_SESSION['trn_status'] = 0;
                $_SESSION['trn_error_message'] = $decoded_response->message;
                $this->funnelRedirect('/securecheckout/');
            }
        }
        
        public function addAdditionalSaleToKonnektive() {  
     
            $konnektive = array();
            $konnektive['orderId'] = filter_input(INPUT_GET, 'orderId');
            $konnektive['quantity'] = '1';
            $konnektive['productId'] = filter_input(INPUT_POST, 'orderdetails');
            $konnektive['var'] = filter_input(INPUT_POST, 'var');

            $konnektive['loginId'] = $this->konnektive->loginId;
            $konnektive['password'] = $this->konnektive->password;
            $konnektive['campaignId'] = $this->konnektive->campaignId;


            $konnektive_cleaned = array_filter($konnektive, function($value) {
                return !is_null($value) && $value !== '';
            }); //Remove empty array values (if any)

            $response = wp_remote_post($this->endpoints->upsell, array(
                'body' => $konnektive_cleaned,
                'method' => 'POST',
                'data_format' => 'body'
            ));


            if (isset($this->debug->konnektive) && $this->debug->konnektive->log === 'active') {
                $this->log->write_log($this->build_log($response, $konnektive));
            }

            $decoded_response = json_decode($response['body']);
            $next_page = $this->get_next_funnel_step((filter_input(INPUT_POST, 'current_page')?: ['step' => 0, 'slug' => 'oto']));

             
            $additional_url_parameters = [
                'pageType' => filter_input(INPUT_POST, 'pageType'),
                'orderdetails' => filter_input(INPUT_POST, 'orderdetails'),
                'orderId' => filter_input(INPUT_GET, 'orderId'),
                'var' => filter_input(INPUT_POST, 'var')
            ];  

            if (strtoupper($decoded_response->result) == 'SUCCESS') {
                $this->funnelRedirect('/oto/'.$next_page['slug'].'/', $additional_url_parameters); //funnelRedirect('Redirect URL', 'Additional Parameters')
            } else {

                $_SESSION['display_message'] = 1;
                $_SESSION['trn_status'] = 0;
                $_SESSION['trn_error_message'] = $decoded_response->message;
                $this->funnelRedirect('/oto/flashlight/', $additional_url_parameters); //funnelRedirect('Redirect URL', 'Additional Parameters')
            }
        }
        
        public function queryOrder($orderId) {
            $konnektive = array();
            $konnektive['orderId'] = $orderId;

            $konnektive['loginId'] = $this->konnektive->loginId;
            $konnektive['password'] = $this->konnektive->password;
            $konnektive['campaignId'] = $this->konnektive->campaignId;


            $konnektive_cleaned = array_filter($konnektive, function($value) {
                return !is_null($value) && $value !== '';
            }); //Remove empty array values (if any)

            $response = wp_remote_post($this->endpoints->queryOrder, array(
                'body' => $konnektive_cleaned,
                'method' => 'POST',
                'data_format' => 'body'
            ));
            
            $decoded_response = json_decode($response['body']);
            
            return $decoded_response->message;
        }

        private function build_log($response, $data_sent) {
            $status = wp_remote_retrieve_response_code($response);
            $message = wp_remote_retrieve_response_message($response);
            $body = wp_remote_retrieve_body($response);
            $decoded_response = json_decode($body);

            $log = "-----------------------------------------------------------------" . PHP_EOL;
            $log .= "Data Sent:" . PHP_EOL;
            $log .= var_export($data_sent, TRUE);
            $log .= PHP_EOL;

            $log .= PHP_EOL;
            $log .= "Response:" . PHP_EOL;
            $log .= "Date: \t " . date('F j, Y, g:i a') . PHP_EOL;
            $log .= "Status: \t" . $status . PHP_EOL;
            $log .= "Message: \t" . $message . PHP_EOL;
            $log .= "Result: \t" . $decoded_response->result . PHP_EOL;
            $log .= "Body: \t" . $body . PHP_EOL;
            $log .= PHP_EOL;
            $log .= "-----------------------------------------------------------------" . PHP_EOL;

            return $log;
        }

    }

}