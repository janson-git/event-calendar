<?php

$event = $calendar->getEventByDate( $stringDate );


$eventTitle = htmlspecialchars($event['title']);
$eventDesc  = htmlspecialchars($event['event']);
$eventDesc  = str_replace("\n", "<br>\n", $eventDesc);

$current_month = date("F",mktime(1,1,1,$month,1,$year));


$startDate = "$year-$month-01";
$endDate   = "$year-$month-$numdays";

$eventTitles = $calendar->getAllEventsInPeriod($startDate, $endDate);

$daysArray = Utils::makeDaysOfMonthArray($year, $month);

include_once TEMPLATES_DIR . "/frontend.phtml";
