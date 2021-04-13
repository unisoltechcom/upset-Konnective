<?php

/**
 * Log class
 */
if (!class_exists('FunnelLog')) {

    class FunnelLog {

        private $file_name;
        private $file_path;
        private $file_handle;
        private $log_format;

        public function __construct($file_name) {
            $this->file_name = $file_name . '.log';
            $this->file_path = FUNNELS_PLUGIN_LOG_DIR . $this->file_name;
        }

        private function load_file($type) {
            if ($type !== 'r') {
                $this->file_handle = @fopen($this->file_path, $type) or die('Cannot open file:  ' . $this->file_path);
            } else {
                if (is_file($this->file_path)) {
                    $this->file_handle = @fopen($this->file_path, $type) or die('Cannot open file:  ' . $this->file_path);
                } else {
                    file_put_contents($this->file_path, '');
                    $this->file_handle = @fopen($this->file_path, $type) or die('Cannot open file:  ' . $this->file_path);
                }
            }
        }

        public function write_log($data) {
            $this->load_file('a');
            fwrite($this->file_handle, $data);
            fclose($this->file_handle);
        }

        public function read_log() {
            $this->load_file('r');
            $file_size = filesize($this->file_path);
            $file_content = ($file_size > 0) ? fread($this->file_handle, $file_size) : '';
            fclose($this->file_handle);

            return $file_content;
        }

    }

}