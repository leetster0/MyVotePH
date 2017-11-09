<?php

//the following code was adapted from: http://iag.me/socialmedia/build-your-first-twitter-app-using-php-in-8-easy-steps/
//by author Ian Anderson Gray.
//the purpose is to send requests to the twitter API, using the api library in vendor/twitter-api-php-master. This library
//was taken from https://github.com/abraham/twitteroauth and was created by author abraham.
//In this code, I merely have to input my authentication details to access the twitter api, and then fill in the type of request I wish to send,
//as well as which GET queries I want to include.
//this code returns a JSON file containing the tweets pertinent to the request.

require_once('../vendor/twitter-api-php-master/twitter-api-php-master/TwitterAPIExchange.php');

$candidate = $_GET['candidate'];
//$candidate = 'mar roxas';
 
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "4212027881-2KXctdEjon3oNaQ1g5n5RjRT6NNBwhIhrFpEi4I",
    'oauth_access_token_secret' => "6q36xXENIGoflHfq0bgY3aRlgCwF4U2WxMy1afv3aUiRG",
    'consumer_key' => "US7hCUXUelZmh11YliRkvbxNG",
    'consumer_secret' => "GSBhrk8A8YHWGcs7DozI5UFyYN0ztSCO1e5s2ZbkjzkPjB3rwH"
);

$url = "https://api.twitter.com/1.1/search/tweets.json";
 
$requestMethod = "GET";
 
$getfield = "?q={$candidate}&count=10&result_type=popular";
 
$twitter_p = new TwitterAPIExchange($settings);
$twitter_p = json_decode($twitter_p->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(), $assoc = true);
if($twitter_p["errors"][0]["message"] != "") 
{
    echo "Sorry, there was a problem. Twitter returned the following error message:  ".$string[errors][0]["message"];
    exit();
    
}
$getfield = "?q={$candidate}&count=10&result_type=recent";
 
$twitter_r = new TwitterAPIExchange($settings);
$twitter_r= json_decode($twitter_r->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc=true);
if($twitter_r["errors"][0]["message"] != "") 
{
    echo "Sorry, there was a problem. Twitter returned the following error message:  ".$string[errors][0]["message"];
    exit();
    
}

//end of adapted code from iag.me

$twitter['popular'] = $twitter_p;
$twitter['recent'] = $twitter_r;

print(json_encode($twitter));



