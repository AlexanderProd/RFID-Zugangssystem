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


$insert = "INSERT INTO accounts (id, firstName, lastName)
VALUES ('3', 'John', 'Doe')";

if (mysqli_query($conn, $insert)) {
    echo "New record created successfully" . "<br />";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


$sql = "SELECT id, firstName, lastName FROM accounts";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstName"]. " " . $row["lastName"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
