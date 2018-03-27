<?php
   	include("connect.php");

   	$link=Connection();

	$temp1=$_POST["value1"];
	$hum1=$_POST["value2"];

	$query = "INSERT INTO `accounts` (`id`, `firstName`)
		VALUES ('".$temp1."','".$hum1."')";

   	mysql_query($query,$link);
	mysql_close($link);

   	header("Location: index.php");
?>
