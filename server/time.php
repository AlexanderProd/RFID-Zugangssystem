<?php
function serverTime($string = null){
  $timezone = date_default_timezone_get();
  echo "The current server timezone is: " . $timezone . "<br/>";
  $date = date('d.m.Y');
  $time = date('H:i:s', time());
  $dateTime = date('d.m.Y H:i:s', time());

  if ($string == "date"){
    return $date;
  } elseif ($string == "time") {
    return $time;
  } else {
    return $dateTime;
  }
}

$date = serverTime(time);
echo $date . "<br/>";
?>
