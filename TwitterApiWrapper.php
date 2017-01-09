<?php
/**
 *
 * @author chamoli
 */
interface TwitterApiWrapper {
    public function init($config);
    public function execute($url, $data, $method, $headers = null);
    public function getResponseCode();
}
