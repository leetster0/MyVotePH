<?

//this file was downloaded from http://mikepultz.com/2013/06/mining-twitter-api-v1-1-streams-from-php-with-oauth/
//it's purpose is to run continuously and interact with the twitter streaming api.
//When I call this program, I will pass filter keywords to it. Twitter api will search from these keywords, and send me
//a stream of related tweets, for as long as this program runs.
//I will have to write the process_tweet function, to specify what I want the program to do with each tweet that it harvests

//
// A simple class to access the Twitter streaming API, with OAuth authentication
//
//	Mike (mike@mikepultz.com)
//
// Simple Example:
//
//	require 'ctwitter_stream.php';
//
//	$t = new ctwitter_stream();
//
//	$t->login('consumer_key', 'consumer secret', 'access token', 'access secret');
//
//	$t->start(array('facebook', 'fbook', 'fb'))
//

// configuration
    require("../includes/config.php"); 


class ctwitter_stream
{
    private $m_oauth_consumer_key;
    private $m_oauth_consumer_secret;
    private $m_oauth_token;
    private $m_oauth_token_secret;

    private $m_oauth_nonce;
    private $m_oauth_signature;
    private $m_oauth_signature_method = 'HMAC-SHA1';
    private $m_oauth_timestamp;
    private $m_oauth_version = '1.0';

    public function __construct()
    {
        //
        // set a time limit to unlimited
        //
        set_time_limit(0);
    }

    //
    // set the login details
    //
    public function login($_consumer_key, $_consumer_secret, $_token, $_token_secret)
    {
        $this->m_oauth_consumer_key     = $_consumer_key;
        $this->m_oauth_consumer_secret  = $_consumer_secret;
        $this->m_oauth_token            = $_token;
        $this->m_oauth_token_secret     = $_token_secret;

        //
        // generate a nonce; we're just using a random md5() hash here.
        //
        $this->m_oauth_nonce = md5(mt_rand());

        return true;
    }

    //
    // process a tweet object from the stream
    //
    private function process_tweet($_data)
    {
        
        if(empty($_data['text']) || $_data['id'] < 673579893234401281)
        {
            
            return false;
        }
        
        
        $mroxas = false;
        $gpoe = false;
        $jbinay = false;
        $rduterte = false;
        $msantiago = false;
        
            
            
        if( strpos( strtolower($_data['text']), 'roxas') !== false) //note the !== operator 'not identical'. this is because strpos returns 0 if occurence is on the 0th char. (different from false!!!)
            {
                
                $mroxas =true;
               
            }
        if( strpos( strtolower($_data['text']), 'mar ') !== false) //note the space after mar to avoide Marcos, etc
            {
                $mroxas=true;
                
            }
            
            if( strpos( strtolower($_data['text']), 'grace') !== false)
            {
                $gpoe=true;
                
            }
            
            if( strpos( strtolower($_data['text']), 'poe') !== false)
            {
                $gpoe=true;
                
            }
            //binay and duterte's names are more distinctive, their first names are also less used.
            if( strpos( strtolower($_data['text']), 'binay') !== false)
            {
                $jbinay=true;
                
            }
            
            if( strpos( strtolower($_data['text']), 'duterte') !== false)
            {
                $rduterte=true;
                
            }
            
            if( strpos( strtolower($_data['text']), 'miriam') !== false)
            {
                $msantiago=true;
                
            }
            
            if( strpos( strtolower($_data['text']), 'santiago') !== false)
            {
                $msantiago=true;
                
            }
            
            
            $time_raw = explode(' ', $_data['created_at']."\n");
            
            
            $months = array('Jan'=> '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'May' =>'05', 'Jun' =>'06', 'Jul' =>'07', 'Aug'=>'08', 'Sep' =>'09', 'Oct'=>'10', 'Nov'=>'11', 'Dec'=>'12');
            $time = substr($time_raw[5],0,4)."-".$months[$time_raw[1]]."-".$time_raw[2]." ".$time_raw[3];
            
            
            
            
            
            
        CS50::query("INSERT IGNORE INTO tweets (id, time, name, text, followers, friends, mroxas,gpoe,jbinay,rduterte,msantiago)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)",
        $_data['id'],
        $time,
        $_data['user']['name'],
        $_data['text'],
        $_data['user']['followers_count'],
        $_data['user']['friends_count'],
        $mroxas,
        $gpoe,
        $jbinay,
        $rduterte,
        $msantiago
        );
        
        
        return true;
    }

    //
    // the main stream manager
    //
    public function start(array $_keywords)
    {
        
        
        while(1)
        {
            $fp = fsockopen("ssl://stream.twitter.com", 443, $errno, $errstr, 30);
            if (!$fp)
            {
                echo "ERROR: Twitter Stream Error: failed to open socket";
            } else
            {
                //
                // build the data and store it so we can get a length
                //
                $data = 'track=' . rawurlencode(implode($_keywords, ','));

                //
                // store the current timestamp
                //
                $this->m_oauth_timestamp = time();

                //
                // generate the base string based on all the data
                //
                $base_string = 'POST&' .
                    rawurlencode('https://stream.twitter.com/1.1/statuses/filter.json') . '&' .
                    rawurlencode('oauth_consumer_key=' . $this->m_oauth_consumer_key . '&' .
                        'oauth_nonce=' . $this->m_oauth_nonce . '&' .
                        'oauth_signature_method=' . $this->m_oauth_signature_method . '&' .
                        'oauth_timestamp=' . $this->m_oauth_timestamp . '&' .
                        'oauth_token=' . $this->m_oauth_token . '&' .
                        'oauth_version=' . $this->m_oauth_version . '&' .
                        $data);

                //
                // generate the secret key to use to hash
                //
                $secret = rawurlencode($this->m_oauth_consumer_secret) . '&' .
                    rawurlencode($this->m_oauth_token_secret);

                //
                // generate the signature using HMAC-SHA1
                //
                // hash_hmac() requires PHP >= 5.1.2 or PECL hash >= 1.1
                //
                $raw_hash = hash_hmac('sha1', $base_string, $secret, true);

                //
                // base64 then urlencode the raw hash
                //
                $this->m_oauth_signature = rawurlencode(base64_encode($raw_hash));

                //
                // build the OAuth Authorization header
                //
                $oauth = 'OAuth oauth_consumer_key="' . $this->m_oauth_consumer_key . '", ' .
                        'oauth_nonce="' . $this->m_oauth_nonce . '", ' .
                        'oauth_signature="' . $this->m_oauth_signature . '", ' .
                        'oauth_signature_method="' . $this->m_oauth_signature_method . '", ' .
                        'oauth_timestamp="' . $this->m_oauth_timestamp . '", ' .
                        'oauth_token="' . $this->m_oauth_token . '", ' .
                        'oauth_version="' . $this->m_oauth_version . '"';

                //
                // build the request
                //
                $request  = "POST /1.1/statuses/filter.json HTTP/1.1\r\n";
                $request .= "Host: stream.twitter.com\r\n";
                $request .= "Authorization: " . $oauth . "\r\n";
                $request .= "Content-Length: " . strlen($data) . "\r\n";
                $request .= "Content-Type: application/x-www-form-urlencoded\r\n\r\n";
                $request .= $data;

                //
                // write the request
                //
                fwrite($fp, $request);

                //
                // set it to non-blocking
                //
                stream_set_blocking($fp, 0);

                while(!feof($fp))
                {
                    $read   = array($fp);
                    $write  = null;
                    $except = null;

                    //
                    // select, waiting up to 10 minutes for a tweet; if we don't get one, then
                    // then reconnect, because it's possible something went wrong.
                    //
                    $res = stream_select($read, $write, $except, 600, 0);
                    if ( ($res == false) || ($res == 0) )
                    {
                        break;
                    }

                    //
                    // read the JSON object from the socket
                    //
                    $json = fgets($fp);

                    //
                    // look for a HTTP response code
                    //
                    if (strncmp($json, 'HTTP/1.1', 8) == 0)
                    {
                        $json = trim($json);
                        if ($json != 'HTTP/1.1 200 OK')
                        {
                            echo 'ERROR: ' . $json . "\n";
                            return false;
                        }
                    }

                    //
                    // if there is some data, then process it
                    //
                    if ( ($json !== false) && (strlen($json) > 0) )
                    {
                        //
                        // decode the socket to a PHP array
                        //
                        $data = json_decode($json, true);
                        if ($data)
                        {
                            //
                            // process it
                            //
                            $this->process_tweet($data);
                        }
                    }
                }
            }

            fclose($fp);
            sleep(10);
        }

        return;
    }
};