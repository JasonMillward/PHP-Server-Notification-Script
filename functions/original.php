<?php

//$tweet = new TwitterOAuth( $consumerKey, $consumerSecret, $oAuthToken,
// $oAuthSecret );


function notify($message, $sendEmail = false, $subject = NULL) {
    if (!empty($message)) {
        $tweet = new TwitterOAuth( CONKEY, CONSECRET, OATOKEN, OASECRET );
        $tweet->post( 'statuses/update', array( 'status' => $msg ) );
        
        
        if ($sendEmail) {
            $request = new RestClient( 'https://api.mailgun.net/v2/jcode.mailgun.org' );
            
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
                    sprintf( 'Authorization: Basic %s', base64_encode( 'api:key-7cl2z16z75gnvecupmphjfnr0o9qyto8' ) ),
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
    $data   = explode( " ", file_get_contents( "/proc/uptime" ) );
    $uptime = format_uptime( $data[0] );

    $msg  = sprintf("Currently been up for %s - #%s",
                    $uptime,
                    SERVERHASHTAG
                   );
    notify( $msg );    
}



function checkServerLoad( ) {


    if(!empty( $degree ) ) {
        $msg = sprintf( "Currently experiencing %s server load ", $degree );
        if($load > 4 ) {
            $msg .= "@Jason_Millward please investigate ";
        }
        $msg .= "- " . $date . " #partycatsrv";
        $tweet->post( 'statuses/update', array( 'status' => $msg ) );
    }
}
