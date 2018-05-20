<?php
include("credentials.php")
include("time.php");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully" . "<br/>";

//Values getting send to server
$id = $_POST["value1"];
$date = serverTime(date);
$time = serverTime(time);

//Variables
$firstName = "";
$lastName = "";

//Retrieve First and Last Name from DB depending on ID
$query = "SELECT * FROM `acc_information` WHERE id = '$id';";
$result = mysqli_query($conn, $query);
if (!$result) exit("The query did not succeded");
else {
    while ($row = mysqli_fetch_assoc($result)) {
        $firstName = $row['firstName'];
				$lastName = $row['lastName'];
    }
}

// Insert Values into MySQL Database
$query = "INSERT INTO `logins` (`id`,`firstName`, `lastName` , `date` , `time`)
VALUES ('".$id."','".$firstName."','".$lastName."','".$date."','".$time."')";

// Debugging Feedback
if (mysqli_query($conn, $query)) {
	echo "New record created successfully" . "<br />";
} else {
	echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

//Close connection when done
mysqli_close($conn);
?>
