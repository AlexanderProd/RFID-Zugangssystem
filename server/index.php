<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <title>Angemeldete Personen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>

<div class="container">
<input id="input" placeholder="dd.mm.yyyy">
<button onclick="action()">GO</button>
</br>

<?php
include("time.php");

$servername = "bernd-mysql.php-friends.de";
$username = "521_admin";
$password = "Cb&0fv";
$dbname = "521_rfid_test";

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
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo '<table class="u-full-width">';
    echo "<thead><tr><th>ID</th><th>Name</th><th>Datum</th><th>Uhrzeit</th></tr></thead>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tbody><tr><td>";
        echo $row["id"];
        echo "</td><td>";
        echo $row["firstName"] . " " . $row["lastName"];
        echo "</td><td>";
        echo $row["date"];
        echo "</td><td>";
        echo $row["time"];
        echo "</td></tr></tbody>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
</div>

<script>
function action(){
  var input = document.getElementById('input').value;
  input = encodeURIComponent(input);
  window.location.href = "index.php?date=" + input;
  console.log(input);
}
</script>
</body>
</html>
