<?php

function todayIsTheFirst( ) {
    if(date( "j" == "1" ) ) {
        return true;
    } else {
        return false;
    }
}

function isMidnight( ) {
    if(date( "G" == "0" ) ) {
        return true;
    } else {
        return false;
    }
}

function readBackupLogs( ) {
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


$fiveAgo = time( ) - (05 * 60);

$sql = "SELECT      `serverTwitter`,
                    `serverLoad`,
                    `serverName`,
                    `lastUpdate`
        FROM        `remoteDevices`
        ORDER BY    `ID` ASC
        Limit 5";

try {

    $result = $dbh->query( $sql );
    $result = $result->fetchAll( PDO::FETCH_ASSOC );

    foreach( $result as $row ) {
        $load = $row['serverLoad'];
        $hashTag = $row['serverTwitter'];
        $name = $row['serverName'];
        $degree = "";
        if($row['lastUpdate'] > $fiveAgo ) {

            if(!empty( $degree ) ) {
                $msg = sprintf( "%s is currently experiencing %s server load ", $name, $degree );
                if($load > 4 ) {
                    $msg .= "@Jason_Millward please investigate ";
                }
                $msg .= sprintf( "- " . $date . " #%s", $hashTag );
                $tweet->post( 'statuses/update', array( 'status' => $msg ) );
            }
        }
    }
} catch ( PDOException $e ) {
    #    printf('Database Error: %s', $e -> getMessage());
}

$tweet = new TwitterOAuth( $consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret );

$content = file_get_contents( "/srv/d_PartyCat/output/crondump" );

$good += substr_count( $content, "Finished" );
$bad += substr_count( $content, "Error" );

if($bad <= $good ) {
    $msg = "Local SQL and file backups completed successfully. All tables optimised - $date #partycatsrv";
} else {
    $msg = "Local SQL and file backups completed unsuccessfully @Jason_Millward please investigate - $date #partycatsrv";
}


