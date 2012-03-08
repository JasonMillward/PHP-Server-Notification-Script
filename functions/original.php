<?php

function notify($message, $sendEmail = false, $subject = NULL) {
    if (!empty($message)) {
        $tweet = new TwitterOAuth( CONKEY, CONSECRET, OATOKEN, OASECRET );
        $tweet->post( 'statuses/update', array( 'status' => $msg ) );

        if ($sendEmail) {
            $request = new RestClient( 'https://api.mailgun.net/v2/' );
            
            $params = array(
                'from'           => FROM_EMAIL,
                'to'             => TO_EMAIL,
                'subject'        => $subject,
                'text'           => 'Hello',
            );
            
            $response = $request->execute(
                RestClient::REQUEST_TYPE_POST,
                '/messages',
                $params,
                array(
                    sprintf( 'Authorization: Basic %s', base64_encode( APIKEY ) ),
                )
            );

        }
    }
}

function loadtoString( $load ) {
    if($load > 10 ) {
        return "universe ending";
    } else if($load > 8 ) {
        return "catastrophic";
    } else if($load > 6 ) {
        return "insainly-high";
    } else if($load > 4 ) {
        return "high";
    } else if($load > 3 ) {
        return "moderately-high";
    } else if($load > 2 ) {
        return "moderate";
    } else if($load > 1 ) {
        return "some";
    } else {
        return NULL;
    }
}

function formatUptime( $seconds ) {
    $secs = $mins = $hours = $days = 0;
    $uptimeString = "";
    $secs  = intval( $seconds % 60 );
    $mins  = intval( $seconds / 60 % 60 );
    $hours = intval( $seconds / 3600 % 24 );
    $days  = intval( $seconds / 86400 );

    $uptime = $days . (($days == 1) ? " Day," : " Days,");

    if($hours > 0 ) {
        $uptimeString .= $hours;
        $uptimeString .= (($hours == 1) ? " Hour" : " Hours");
    }
    
    if($mins > 0 ) {
        $uptimeString .= (($days > 0 || $hours > 0) ? ", " : "") . $mins;
        $uptimeString .= (($mins == 1) ? " Minute" : " Minutes");
    }
    
    if($secs > 0 ) {
        $uptimeString .= (($days > 0 || $hours > 0 || $mins > 0) ? " and " : "") . $secs;
        $uptimeString .= (($secs == 1) ? " Sec" : " Secs");
    }

    $uptimeString = $uptime . ' ' . $uptimeString;

    return $uptimeString;
}

function sayUptime( ) {
    $uptime = format_uptime( getUptime() );

    $msg = sprintf("Currently been up for %s - #%s",
                    $uptime,
                    SERVERHASHTAG
                  );
    notify( $msg );    
}

function getUptime( ) {
    $data = explode( " ", file_get_contents( "/proc/uptime" ) );
    return $data[0];
}

function checkLoad( ) {
    $load   = sys_getloadavg();
    $load   = number_format($load[0],2);
    $degree = loadtoString($load);
       
    if(!empty( $degree ) ) {

        if($load > 4 ) {
            $alert = sprintf("@%s please investigate ", ADMINNAME);
        } else {
            $alert = "";
        }
        
        $msg = sprintf("Currently experiencing %s server load %s - %s #%s",
                        $degree,
                        $alert,
                        DATE,
                        SERVERHASHTAG
                      );
        
        notify( $msg );  
    }
}

function checkDisks() {
    global $config;
    
    foreach ($config['drives'] as $key) {
        $dir  = $key['path'];
        $name = $key['name'];
        
        $max  = disk_total_space($dir);
        $size = disk_total_space($dir) - disk_free_space($dir);
        
        $perc = round(($size / $max) * 100, 2);
        if ($perc > 70) {
            $msg = sprintf("HDD %s is getting rather full... - %s #%s",
                            $name,
                            DATE,
                            SERVERHASHTAG
            );
            notify( $msg );
        }        
    }
}

function checkErrorLogs( ) {
    foreach($config['errorLogs'] as $conf) {        
        $lines = 0;        
        $lines = @count( file( $conf['path'] ) );
    
        if($lines > 0 ) {
            $msg = sprintf("Hello @%s, your wordpress site had %d errors in the past 24 hours. - %s #%s",
                            $conf['twitterName'],
                            $lines,
                            DATE,
                            SERVERHASHTAG
            );
            $tweet->post( 'statuses/update', array( 'status' => $msg ) );
        }
    }
}