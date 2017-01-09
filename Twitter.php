<?php
require_once 'TwitterApiWrapper.php';
require_once('TwitterAPIExchangeClient.php');
class Twitter
{
    /**
     *
     * @var TwitterApiWrapper 
     */
    private $client = null;
    
    public function __construct(TwitterApiWrapper $client) {
        $this->client = $client;
    }
    
    /**
     * for valid extraParams
     * @see https://dev.twitter.com/rest/reference/get/search/tweets
     * @param string $tag
     * @param array $extraParams
     */
    public function getTweetsWithTag($tag, $extraParams = array()) {
        if ($tag[0] != '#') {
            $q = '#'. trim($q);
        }
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $params = array(
            'q' => $tag,
        );
        if (!empty($extraParams)) {
            $params = array_merge($params, $extraParams);
        }
        $response = $this->client->execute($url, $params, 'GET');
        $data = json_decode($response, true);
        return $this->processSearchResponse($data, true);
    }
    
    /**
     * 
     * @param string $searchParam
     * @param array $extraParams
     * @return type
     */
    public function getRetweetedTweets($searchParam, $extraParams = array()) {
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $params = array(
            'q' => trim($searchParam),
        );
        if (!empty($extraParams)) {
            $params = array_merge($params, $extraParams);
        }
        $response = $this->client->execute($url, $params, 'GET');
        $data = json_decode($response, true);
        return $this->processSearchResponse($data, true);
    }
    
    private function processSearchResponse($response, $onlyRetweets = false) {
        $data = array();
        if (!empty($response['statuses'])) {
            foreach ($response['statuses'] as $status) {
                if ($onlyRetweets && !isset($status['retweeted_status']['text'])) {
                    //not a retweet
                    continue;
                }
                $tweetInfo = array();
                $tweetInfo['tweet_id'] = $status['id_str'];
                $tweetInfo['text'] = $status['text'];
                $tweetInfo['retweet_count'] = $status['retweet_count'];
                $tweetInfo['user'] = $status['user']['name'];
                if (isset($status['retweeted_status']['text'])) {
                    //text for retweets might have been truncated
                    $tweetInfo['text'] =  $status['retweeted_status']['text'] . "</br>";
                }
                $data[] = $tweetInfo;
            }
        }
        return $data;
    }
}

