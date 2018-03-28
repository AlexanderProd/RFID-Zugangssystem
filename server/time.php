<?php
function serverTime(){
  $timezone = date_default_timezone_get();
  echo "The current server timezone is: " . $timezone . "<br/>";
  $date = date('d/m/Y H:i:s', time());
  return $date;
}

$date = serverTime();
echo $date;
?>
