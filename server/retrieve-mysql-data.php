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

//Variables
$id = "1";
$firstName = "";
$lastName = "";

//Retrieve Data
$query = "SELECT * FROM `acc_information` WHERE id = '$id';";
$result = mysqli_query($conn, $query);
if (!$result) exit("The query did not succeded");
else {
    while ($row = mysqli_fetch_assoc($result)) {
        $firstName = $row['firstName'];
				$lastName = $row['lastName'];
    }
}
echo $lastName;
?>
