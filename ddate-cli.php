<?php

include("ddatelibrary.php");

$ddate = new PHPDiscordianDate();

//echo $ddate->MakeDay(5, 6, 2012)->year;
//echo "\n";
//echo $ddate->MakeDay(5, 6, 2012)->day;
//echo "\n";
//echo $ddate->MakeDay(5, 6, 2012)->yday;
//echo "\n";
echo $ddate->MakeDay(5, 6, 2012);
echo "\n";
?>