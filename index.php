<?php

require_once('library/TwitterAPIExchange.php');
require_once('Config.php');
require_once('Twitter.php');
require_once('TwitterAPIExchangeClient.php');
require_once('TwitterApiWrapper.php');
require_once('View.php');

$tweets = array();
$view = new View();

if (isset($_POST['posted_form'])) {
    try {
        $searchType = $_POST['search_type'];
        $q = $_POST['q'];
        $client = new TwitterAPIExchangeClient(Config::getTwitterKeys());
        $tm = new Twitter($client);
        if ($searchType == 'tag') {
            $tweets = $tm->getRetweetedTweets($q, array('count' => 20));
            $view->setData($tweets);
        } else {
            $tweets = $tm->getRetweetedTweets($q, array('count' => 30));
            $view->setData($tweets);
        }
    } catch (Exception $ex) {
        echo 'Error :' . $ex->getMessage();
    }
}

echo $view->render();
