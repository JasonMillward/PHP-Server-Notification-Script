<?php

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
