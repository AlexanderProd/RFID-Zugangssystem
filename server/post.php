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

//Values getting send to server
$var1=$_POST["value1"];
$var2=$_POST["value2"];
$var3=$_POST["value3"];
$var4=serverTime(date);
$var5=serverTime(time);

// Insert Values into MySQL Database
$query = "INSERT INTO `logins` (`id`,`firstName`, `lastName` , `date` , `time`)
VALUES ('".$var1."','".$var2."','".$var3."','".$var4."','".$var5."')";

// Debugging Feedback
if (mysqli_query($conn, $query)) {
	echo "New record created successfully" . "<br />";
} else {
	echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

//Close connection when done
mysqli_close($conn);
?>
