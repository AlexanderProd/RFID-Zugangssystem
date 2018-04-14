<?php
include("time.php");

$servername = "bernd-mysql.php-friends.de";
$username = "521_admin";
$password = "Cb&0fv";
$dbname = "521_rfid_test";
$today = "13.04.2018";

$dateTransferred = htmlspecialchars($_GET["date"]);
if (empty($dateTransferred)){
  $dateTransferred = serverTime(date);
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
echo "<br/>";

$sql = "SELECT id, firstName, lastName, date, time FROM logins WHERE date = '$dateTransferred'";
#$sql = "SELECT id, firstName, lastName, date, time FROM logins WHERE date = '13.04.2018'";
#$sql = "SELECT id, firstName, lastName, date, time FROM logins";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstName"]. " " . $row["lastName"]. " " . $row["date"]. " " . $row["time"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
