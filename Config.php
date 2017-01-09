<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of configs
 *
 * @author chamoli
 */
class  Config {
    /**
     * Returns hardcoded twitter keys of the app
     * can be modified to fetch keys from any datasource without affecting the app
     * @return array
     */
    public static function getTwitterKeys() {
        $keys = array(
            'consumer_key' => 'hjG7JtKk07DJtqxAKKdhERvO1',
            'consumer_secret' => '5pGEtmU2Elr3JxvRC6FlYRpv8hw80pcxR12Hggq7ckHqps6K1E',
            'oauth_access_token' => '574415368-itynkn1t3L8jzQ7Eu9MhUkqFdmdNpl5EUCWEKw7G',
            'oauth_access_token_secret' => 'Vq0gPEn0BQgDjNvjh6GGC9jChdqmGaj69X214zmw9N244'
        );
        return $keys;
    }
}
