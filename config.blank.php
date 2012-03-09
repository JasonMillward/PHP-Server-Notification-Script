<?php
// SET THE TIME ZONE
date_default_timezone_set( "Australia/Adelaide" );

// TWITTER
define( 'SERVERHASHTAG',    '' );
define( 'ADMINNAME',        '' );

// OAUTH KEYS
define( 'CONKEY',           '' );
define( 'CONSECRET',        '' );
define( 'OATOKEN',          '' );
define( 'OASECRET',         '' );

// DATABASE
define( 'DB_DSN',           'mysql:dbname=;host=;port=;' );
define( 'DB_USER',          '' );
define( 'DB_PASS',          '' );
define( 'DB_HOST',          'localhost' );

// EMAIL
define( 'MAILGUN_DOMAIN',   'DOMAIN.mailgun.org');
define( 'FROM_EMAIL',       'SERVER <SERVER@DOMAIN.COM>' );
define( 'TO_EMAIL',         'YOU <YOU@DOMAIN.COM>' );
define( 'APIKEY',           'api:key-' );

// DATE FORMAT
define( 'DATE',             date( "F j, Y, g:i a" ) );


// PATH TO ERROR LOGS 
$config['errorLogs'][] = array(
    "path"        => "/",
    "twitterName" => "/"
);

// DEFINE HARD DRIVES
$config['drives'][] = array(
    "path" => "/",
    "name" => "/"
);

// PATH TO BACKUP LOGS 
$config['backupLogs'][] = array(
    "path" => "/"
);

try {
    $dbh = new PDO( DB_DSN, DB_USER, DB_PASS );
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

} catch ( PDOException $e ) {
    printf( 'Database Error: %s<br />', $e->getMessage( ) );
}
