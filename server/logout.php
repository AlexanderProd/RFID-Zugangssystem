<?php
session_start();
session_destroy();

echo '<script type="text/javascript">window.open("login.php","_self")</script>';
die();
#echo "Logout erfolgreich";
#echo '<br/><a href="login.php">Login</a>';
?>
