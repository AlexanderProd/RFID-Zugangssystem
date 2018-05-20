<?php
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

session_start();
if(!isset($_SESSION['userid'])) {
  echo '<script type="text/javascript">window.open("login.php","_self")</script>';
  die();
}?>

<!doctype html>
<html lang="de">
<head>
<meta charset="utf-8">
<title>Angemeldete Personen</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="css/dashboard.css" rel="stylesheet">
<link href="css/datepicker.css" rel="stylesheet">

<script src="js/datepicker.js"></script>
<script>
$(function() {
  $('[data-toggle="datepicker"]').datepicker({
    autoHide: true,
    zIndex: 2048,
    format: 'dd.mm.yyyy',
    language: 'de-DE',
  });
});
</script>
<script>
  function myFunction() {
    var y = $('[data-toggle="datepicker"]').datepicker('getDate', true);
    console.log(y);
  }
</script>
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">RFID Logins</a>
  <input class="form-control form-control-dark w-100" id="searchBar" type="text" placeholder="Nach Tag Suchen" aria-label="Suchen" onblur="searchBar()">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Abmelden</a>
    </li>
  </ul>
</nav>

<div class="container" style="margin-top: 75px;">
<input type="text" id="myText" class="form-control" data-toggle="datepicker" onblur="myFunction()">

<?php
echo "<p>";
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
echo "</p><br/>";

$sql = "SELECT id, firstName, lastName, date, time FROM logins WHERE date = '$dateTransferred'";
$result = mysqli_query($conn, $sql);

echo "<h4>Logins für $dateTransferred</h4>";

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo '<div class="table-responsive"><table class="table table-striped table-sm">';
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
    echo "</table></div>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
</div>

<!-- Bootstrap JS and JQuery-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

<script>
const node = document.getElementById('searchBar');
node.addEventListener('keydown', function onEvent(event) {
  if (event.key === "Enter"){
    searchBar();
  }
});

function searchBar(){
  var input = document.getElementById('searchBar').value;
  if (input != ""){
    input = encodeURIComponent(input);
    window.location.href = "index.php?date=" + input;
    console.log(input);
  }
}
</script>
</body>
</html>
