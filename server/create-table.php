<?php
include("time.php");

//MySQL server login credentials
$servername = "bernd-mysql.php-friends.de";
$username = "521_admin";
$password = "Cb&0fv";
$dbname = "521_rfid_test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully" . "<br/>";


$result = mysqli_list_tables($dbname);
$num_rows = mysqli_num_rows($result);
for ($i = 0; $i < $num_rows; $i++) {
    echo "Tabelle: ", mysqli_tablename($result, $i), "\n";
}

mysqli_free_result($result);
?>
