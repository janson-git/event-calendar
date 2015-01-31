<?php


//**************************** LOOK FOR SOME ACTIONS *************************//
$action	= Utils::getVar('action');

switch ($action) {
    case 'add':
        $dayTitle = Utils::getVar('day_title');
        $dayEvent = Utils::getVar('day_event');
        $isFixed  = Utils::getVar('fixed_event');

        $calendar->setEvent($dayTitle, $dayEvent, $stringDate, $isFixed);
        break;
    case 'delete':
        $calendar->deleteEventByDate($stringDate);
        break;
}


//**************************** LOAD AND DISPLAY *************************//

//load and display day title and content in fields
$event = $calendar->getEventByDate($stringDate);

$eventTitle   = htmlspecialchars($event['title']);
$eventDesc    = htmlspecialchars($event['event']);
$isFixedEvent = $event['fixed'];

$eventDesc = str_replace ("\n", "<br>\n", $eventDesc);

$startDate = "$year-$month-01";
$endDate   = "$year-$month-$numdays";

$eventTitles = $calendar->getAllEventsInPeriod($startDate, $endDate);

$daysArray = Utils::makeDaysOfMonthArray($year, $month);

// usage in display backend
$daylong     = date("l", mktime(1,1,1,$month,$today,$year));
$monthlong   = date("F", mktime(1,1,1,$month,$today,$year));


include_once TEMPLATES_DIR . DIRECTORY_SEPARATOR . "backend.phtml";