<?php
/**
 * Server Notification Scripts
 *
 * 
 * @copyright  2012 jCODE
 * @author     Jason Millward <Jason@jCode.me>
 * @package    Utility
 */
    
    // Config
    require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'config.php';
    
    // Classes
    require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'OAuth.php';
    require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'TwitterOAuth.php';
    require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'RestClient.php';
    
    // Functions
    require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'original.php';
    require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'custom.php';


    // Things that only happen on the first of the month    
    if ( todayIsTheFirst() && lastRun('monthly','28 Days') ) {        
        sayUptime();
        sayNetwork();  
    }
    
    // Things that run once a day, at midnight
    if ( isMidnight() && lastRun('daily','22 Hours') ) {
        // Custom log reader
        readBackupLogs();
        
    }
    
    
    // Things that are being checked every x minutes

    // Generic
    checkLoad();
    checkErrorLogs();
    checkDisks();

    
    // Custom functions
    readDB();
    readPartyCat();
