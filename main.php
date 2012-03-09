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
                
        // Notify the wold to how long we've been up and running for
        sayUptime();
        
        // Notify the world how much data we've sent and recived 
        //sayNetwork();  
    }

    // Things that run once a day, at midnight
    if ( isMidnight() && lastRun('daily','22 Hours') ) {
        
        // Check backup logs to see if everything was completed successfully
        readBackupLogs();
        
        // Read error logs, notify owner to make them stop being silly
        checkErrorLogs();
    
        // Read HDD free space, notify admin if they're too full
        checkDisks();
    }
    
    
    // Things that are being checked every x minutes

    // Check server load, if it's too high, notify everyone
    checkLoad();

    // Check database load, buffer and general databasey things
    //readDB();
    
    // Custom network load checker
    //readPartyCat();
     