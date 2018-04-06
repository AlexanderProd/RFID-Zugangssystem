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

//ID to Check
$id = "000001";

//Retrieve Data
$query = "SELECT * FROM `acc_information` WHERE id = '$id';";
$result = mysql_query($query);
if (!$result) exit("The query did not succeded");
else {
    while ($row = mysql_fetch_array($result)) {
        echo $row['value'];
    }
}
?>
