<?php
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
echo "Connected successfully";
echo "<br/>";

$var1=$_POST["value1"];
$var2=$_POST["value2"];
$var3=$_POST["value3"];

echo $var1;
echo "<br/>";
echo $var2;
echo "<br/>";
echo $var3;

$query = "INSERT INTO `accounts` (`id`,`firstName`, `lastName`)
VALUES ('".$var1."','".$var2."','".$var3."')";

if (mysqli_query($conn, $query)) {
	echo "New record created successfully" . "<br />";
} else {
	echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
#mysql_query($query,$conn);
mysqli_close($conn);
?>
