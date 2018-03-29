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
?>


<?php
$dbname = '521_rfid_test';

if (!mysql_connect('bernd-mysql.php-friends.de', '521_admin', 'Cb&0fv')) {
    echo 'Konnte nicht zu mysql verbinden';
    exit;
}

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Fehler, konnte Tabellen nicht auflisten\n";
    echo 'MySQL Fehler: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "{$row[0]}\n <br/>";
}

mysql_free_result($result);
?>
