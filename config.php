<?php
// Define vars

define( 'CONKEY',           'FvkOr4qe8OIMLCtDbC1dw' );
define( 'CONSECRET',        'G3WITn5GcXs5OON7ayw49yK3z8W1TStodQS2gYsyFsU' );
define( 'OATOKEN',          '472469758-NT2a47OYvtMWxcR8ih4y5MBzSCc0AKwVUqPdydbG' );
define( 'OASECRET',         'vrwKBehlIFb4mLk3trZdxTbTUvSUPTloClJx0tcT8c' );
define( 'DATE',             date( "F j, Y, g:i a" ) );

define( 'DB_DSN',           'mysql:dbname=serverstatus;host=;port=;' );
define( 'DB_USER',          'statususer' );
define( 'DB_PASS',          '' );
define( 'DB_HOST',          'localhost' );

define( 'SERVERHASHTAG',    'PartyCatServer' );
define( 'ADMINNAME',        'Jason_Millward' );

define( 'ADMINNAME',        'Jason_Millward' );
define( 'APIKEY',           'Jason_Millward' );

$config['errorLogs'][] = array(
    "path"        => "/srv/d_PartyCat/www/bittenbythetravelbug.com/logs/bittenbythetravelbug.com-error.log",
    "twitterName" => "NicoleTravelBug"
);



try {
    $dbh = new PDO( DB_DSN, DB_USER, DB_PASS );
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

} catch ( PDOException $e ) {
    printf( 'Database Error: %s<br />', $e->getMessage( ) );
}