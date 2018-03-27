<?php
   	include("connect.php");

   	$link=Connection();

	$var1=$_POST["value1"];
	$var2=$_POST["value2"];

	$query = "INSERT INTO `accounts` (`id`, `firstName`)
		VALUES ('".$var1."','".$var2."')";

   	mysql_query($query,$link);
	mysql_close($link);

   	header("Location: index.php");
?>
