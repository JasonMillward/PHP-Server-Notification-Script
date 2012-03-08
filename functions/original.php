<?php

//$tweet = new TwitterOAuth( $consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret );




function format_uptime( $seconds ) {
    $secs = $mins = $hours = $days = 0;
    $uptimeString = "";
    $secs = intval( $seconds % 60 );
    $mins = intval( $seconds / 60 % 60 );
    $hours = intval( $seconds / 3600 % 24 );
    $days = intval( $seconds / 86400 );

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

function tweetUptime( ) {
    $data = explode( " ", file_get_contents( "/proc/uptime" ) );
    $uptime = $data[0];
    $uptime = format_uptime( $uptime );

    $msg = "Currently been up for $uptime - #partycatsrv";
    $tweet->post( 'statuses/update', array( 'status' => $msg ) );
}

function countErrorLogs( ) {
    $lines = 0;
    $file = "/srv/d_PartyCat/www/bittenbythetravelbug.com/logs/bittenbythetravelbug.com-error.log";
    $lines = @count( file( $file ) );

    if($lines > 0 ) {
        $msg = "Hello @NicoleTravelBug, your wordpress site had $lines errors in the past 24 hours. - $date #partycatsrv";
        $tweet->post( 'statuses/update', array( 'status' => $msg ) );
    }
}

function checkServerLoad( ) {
    
    // Get some system load
    $load = sys_getloadavg( );

    // Format our numbers
    $now = number_format( $load[0], 2 );
    $five = number_format( $load[1], 2 );
    $fifteen = number_format( $load[2], 2 );

    //
    $load = $five;

    if($load > 10 ) {
        $degree = "universe ending";
    } else if($load > 8 ) {
        $degree = "catastrophic";
    } else if($load > 6 ) {
        $degree = "insainly-high";
    } else if($load > 4 ) {
        $degree = "high";
    } else if($load > 3 ) {
        $degree = "moderately-high";
    } else if($load > 2 ) {
        $degree = "moderate";
    } else if($load > 1 ) {
        $degree = "some";
    }

    if(!empty( $degree ) ) {
        $msg = sprintf( "Currently experiencing %s server load ", $degree );
        if($load > 4 ) {
            $msg .= "@Jason_Millward please investigate ";
        }
        $msg .= "- " . $date . " #partycatsrv";
        $tweet->post( 'statuses/update', array( 'status' => $msg ) );
    }
}
