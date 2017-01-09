<?php
require_once('TwitterApiWrapper.php');
require_once('library/TwitterAPIExchange.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TwitterClient
 *
 * @author chamoli
 */
class TwitterAPIExchangeClient implements TwitterApiWrapper {
    /**
     *
     * @var TwitterAPIExchange 
     */
    private $client = null;
    
    public function __construct($config) {
        $this->init($config);
    }
    /**
     * 
     * @param array $config twitter credentials of app
     * keys => consumer_key,consumer_secret,oauth_access_token, oauth_access_token_secret
     */
    public function init($config) {
        $this->client = new TwitterAPIExchange($config);
    }
    
    /**
     * executes the request using TwitterAPIExchange
     * 
     * @param string $url
     * @param array $data
     * @param string $method
     * @param array $headers
     * @return type
     * @throws Exception
     */
    public function execute($url, $data = array(), $method = 'GET', $headers = array()) {
        if (empty($url)) {
            throw new Exception('Invalid url');
        }
        
        if ($method !== 'GET' && $method !== 'POST') {
            throw new Exception("Method not supported");
        }
        
        if ($method == 'GET') {
            $str = '';
            if (!empty($data)) {
                foreach($data as $k => $v) {
                   $str = $str . '&' . $k . '=' . $v;
                }
                $str = trim($str, '&');
                $this->client->setGetfield($str);
                $this->client->buildOauth($url, $method);
            }
        } else {
            $this->client->buildOauth($str, $method);
            if(!empty($data)) {
                $this->client->setPostfields($data);
            }
        }
        return $this->client->performRequest();
    }
    
    /**
     * http response code for last request
     * 
     * @return int
     */
    public function getResponseCode() {
        return $this->client->getHttpStatusCode();
    }
}
