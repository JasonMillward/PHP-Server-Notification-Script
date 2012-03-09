<?php

function todayIsTheFirst( ) {
    if( date( "j" ) == "1" ) {
        return true;
    } else {
        return false;
    }
}

function isMidnight( ) {
    if( date( "H" ) == "00" ) {
        return true;
    } else {
        return false;
    }
}

function readPartyCat() {
    global $dbh;
    $fiveAgo = time( ) - (05 * 60);

    $sql = "SELECT      `serverTwitter`,
                        `serverLoad`,
                        `serverName`,
                        `lastUpdate`
            FROM        `remoteDevices`
            ORDER BY    `ID` ASC
            Limit 5";

    $result = $dbh->query( $sql );
    $result = $result->fetchAll( PDO::FETCH_ASSOC );

    foreach( $result as $row ) {
        $load    = $row['serverLoad'];
        $hashTag = $row['serverTwitter'];
        $name    = $row['serverName'];
        
        if($row['lastUpdate'] > $fiveAgo ) {

            $degree = loadtoString($load);
            
            if(!empty( $degree ) ) {

                if($load > 4 ) {
                    $alert = sprintf("@%s please investigate ", ADMINNAME);
                } else {
                    $alert = "";
                }
                
                $msg = sprintf( "%s is currently experiencing %s server load %s - %s #%s", 
                                $name,
                                $degree,
                                $alert,
                                DATE,
                                $hashTag
                              );
                
                notify( $msg ); 
            }
        }
    }
}

function readBackupLogs() {    
    global $config;
    
    foreach ($config['backupLogs'] as $key) {
        $good = 0;
        $bad  = 0;
        
        $content = file_get_contents( $key['path'] );
        
        $good += substr_count( $content, "Finished" );
        $bad  += substr_count( $content, "Error" );

        if($bad <= $good ) {
            $status = "successfully. All tables optimised";
        } else {
            $status = sprintf("unsuccessfully @%s please investigate", ADMINNAME);
        }
        
        $msg = sprintf("Local SQL and file backups completed %s - %s #%s",
                        $status,
                        DATE,
                        SERVERHASHTAG
                      );
        notify( $msg );
    }
}

