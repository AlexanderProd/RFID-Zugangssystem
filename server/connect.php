<?php

	function Connection(){
		$servername = "bernd-mysql.php-friends.de";
		$username = "521_admin";
		$password = "Cb&0fv";
		$dbname = "521_rfid_test";

		$connection = mysql_connect($server, $user, $pass);

		if (!$connection) {
	    	die('MySQL ERROR: ' . mysql_error());
		}

		mysql_select_db($db) or die( 'MySQL ERROR: '. mysql_error() );

		return $connection;
	}
?>
