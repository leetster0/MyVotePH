<?php

 // configuration
    require("../includes/config.php"); 

$candidate = $_GET["candidate"];





 $now=strtotime('now');
    
    
    for ($hrs = 168; $hrs>0; $hrs--)
    {
        $a = strtotime("-{$hrs} hours");
        $b = strtotime("-".($hrs - 1)." hours");
        $af = date('Y-m-d H:i:s', $a);
        $bf = date('Y-m-d H:i:s', $b); 
        
        
        $rows = CS50::query("SELECT COUNT(*) FROM tweets WHERE time >= \"{$af}\" AND time <= \"{$bf}\" AND {$candidate} = 1");
        $tweets[168-$hrs] = $rows[0]['COUNT(*)'];
        
        $date = new DateTime("@".$b);  

        $date->setTimezone(new DateTimeZone('Asia/Manila'));   
        
        $times[168-$hrs] = $date->format('D, M j, ga');


       
        
        
    }
    
    
    $stuff['tweets'] = $tweets;
    $stuff['times'] = $times;
    
    
    
     print(json_encode($stuff));
     
?>