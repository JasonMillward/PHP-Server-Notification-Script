<?php

function todayIsTheFirst() {    
    if (date("j" == "1")) {
        return true;
    } else {
        return false;
    }
}
function isMidnight() {    
    if (date("G" == "0")) {
        return true;
    } else {
        return false;
    }
}

/*
sleep(10);
// Require!
require_once '/srv/d_PartyCat/scripts/php/twitteroauth.php';

// Define vars
$consumerKey    = 'FvkOr4qe8OIMLCtDbC1dw';
$consumerSecret = 'G3WITn5GcXs5OON7ayw49yK3z8W1TStodQS2gYsyFsU';
$oAuthToken     = '472469758-NT2a47OYvtMWxcR8ih4y5MBzSCc0AKwVUqPdydbG';
$oAuthSecret    = 'vrwKBehlIFb4mLk3trZdxTbTUvSUPTloClJx0tcT8c';
$date           = date("F j, Y, g:i a");
$tweet          = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
$degree         = "";
$user           = 'remoteUpdate';
$pass           = 'PsCRHjpNWXKRPX9p';
$dsnn           = 'mysql:dbname=serverstatus;host=;port=;';
$tableHTML      = "";
$fiveAgo        = time() - (05 * 60);

$sql = "SELECT      `serverTwitter`,
`serverLoad`,
`serverName`,
`lastUpdate`
FROM        `remoteDevices`
ORDER BY    `ID` ASC
Limit 5";

try {
$dbh = new PDO($dsnn, $user, $pass);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$result = $dbh -> query($sql);
$result = $result -> fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
$load    = $row['serverLoad'];
$hashTag = $row['serverTwitter'];
$name    = $row['serverName'];
$degree  = "";
if ($row['lastUpdate'] > $fiveAgo) {

if ($load > 10) {
$degree = "universe ending";
} else if ($load > 8) {
$degree = "catastrophic";
} else if ($load > 6) {
$degree = "insainly-high";
} else if ($load > 4) {
$degree = "high";
} else if ($load > 3) {
$degree = "moderately-high";
} else if ($load > 2) {
$degree = "moderate";
} else if ($load > 1) {
$degree = "some";
}

if (!empty($degree)) {
$msg = sprintf("%s is currently experiencing %s server load ",$name, $degree);
if ($load > 4) {
$msg .= "@Jason_Millward please investigate ";
}
$msg .= sprintf("- " . $date . " #%s", $hashTag);
$tweet -> post('statuses/update', array('status' => $msg));
}
}
}
} catch ( PDOException $e ) {
#    printf('Database Error: %s', $e -> getMessage());
}

if (!defined('BASEDIR')) {
define( 'BASEDIR', dirname( __FILE__ ) );
}
// Include oAuth
require_once('/srv/d_PartyCat/scripts/php/twitteroauth.php');

$consumerKey    = 'FvkOr4qe8OIMLCtDbC1dw';
$consumerSecret = 'G3WITn5GcXs5OON7ayw49yK3z8W1TStodQS2gYsyFsU';
$oAuthToken     = '472469758-NT2a47OYvtMWxcR8ih4y5MBzSCc0AKwVUqPdydbG';
$oAuthSecret    = 'vrwKBehlIFb4mLk3trZdxTbTUvSUPTloClJx0tcT8c';
$good = 0;
$bad  = 0;
$date = date("F j, Y, g:i a");

$tweet   = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

$content = file_get_contents("/srv/d_PartyCat/output/crondump");

$good    += substr_count($content, "Finished");
$bad     += substr_count($content, "Error");

if ($bad <= $good) {
$msg = "Local SQL and file backups completed successfully. All tables optimised - $date #partycatsrv";
} else {
$msg = "Local SQL and file backups completed unsuccessfully @Jason_Millward please investigate - $date #partycatsrv";
}

$tweet->post('statuses/update', array('status' => $msg ));
 * 
 * */
 */
