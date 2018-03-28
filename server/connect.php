<?php
	function Connection(){
		$servername = "bernd-mysql.php-friends.de";
		$username = "521_admin";
		$password = "Cb&0fv";
		$dbname = "521_rfid_test";

		// Create connection
		$connection = mysqli_connect($servername, $username, $password, $dbname);

		if (!$connection) {
				echo "1";
	    	die('MySQL ERROR: ' . mysql_error());
		}

		mysql_select_db($dbname) or die( 'MySQL ERROR: '. mysql_error() );

		return $connection;
	}
?>
