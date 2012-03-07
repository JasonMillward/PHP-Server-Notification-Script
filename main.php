<?php
	// Time to include our files.
	require_once config.php
	require_once original_functions.php
	require_once custom_functions.php
	
	
	if ( todayIsTheFirst() ) {
		$uptime = getUptime();
		notify($uptime.SIGNATURE,false);
	}

	// Generic
	checkLoad();
	checkErrorLogs();
	checkDisks();
	readNetwork();

	
	// Custom
	readBackupLogs();
	readDB();
	readPartyCat();
