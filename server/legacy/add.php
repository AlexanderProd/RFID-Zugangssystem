<?php
  include("connect.php");

  $link=Connection();

	$var1=$_POST["value1"]; //GET or POST
	$var2=$_POST["value2"]; //GET or POST

	$query = "INSERT INTO `accounts` (`id`, `firstName`)
	VALUES ('".$var1."','".$var2."')";

  if (mysqli_query($query, $link)) {
    echo "New record created successfully" . "<br />";
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($link);
  }
  #mysqli_query($query,$link);
	mysqli_close($link);

  header("Location: index.php");
?>
