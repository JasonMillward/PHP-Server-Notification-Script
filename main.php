<?php

	if ( todayIsTheFirst() ) {
		$uptime = getUptime();
		notify($uptime.SIGNATURE,false);
	}

	
