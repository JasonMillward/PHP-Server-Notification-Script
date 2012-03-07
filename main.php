<?php
	// Time to include our files.
	require_once config.php
	require_once original_functions.php
	require_once custom_functions.php
	
	// Things that only happen on the first of the month	
	if ( todayIsTheFirst() ) {
		checkUptime();
		readNetwork();	
	}
	
	// Things that are being checked every x minutes

	// Generic
	checkLoad();
	checkErrorLogs();
	checkDisks();

	
	// Custom
	readBackupLogs();
	readDB();
	readPartyCat();
