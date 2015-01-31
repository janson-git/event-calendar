<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');


ob_clean();
ob_start();

header('Content-type: text/html; charset=utf-8');


$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 'front';
if (!in_array($page, array('front', 'back'))) {
    $page = 'front';
}

define('BASE_PATH', __DIR__);
define('SERVER_NAME', 'events');
define('SITE_URL', 'http://' . SERVER_NAME);

define('TEMPLATES_DIR', BASE_PATH."/templates");
define('IMAGES_DIR', BASE_PATH."/templates/images");

define('DB_HOST', 'localhost');
define('DB_NAME', 'common');
define('DB_USER', 'root');
define('DB_PASS', '123');

require_once(BASE_PATH . "/lib/DB.php");
require_once(BASE_PATH . "/lib/Utils.php");
require_once(BASE_PATH."/lib/Event/IRepository.php");
require_once(BASE_PATH."/lib/Event/Repository/DB.php");
require_once(BASE_PATH."/lib/Event/Calendar.php");


$repository = new \Event\Repository\DB();
$calendar = new \Event\Calendar($repository);

echo "<div>
<a href=\"" . SITE_URL . "/?page=front\">FRONTEND</a> | <a href=\"" . SITE_URL . "/back/\">BACKEND</a>
</div>";

// parse and prepare dates
$date = Utils::getVar('date', null);
if (!is_null($date)) {
    $timestamp = strtotime($date);
    $date = date('Y-m-d', $timestamp);
    list($year, $month, $today) = explode('-', $date);
} else {
    $month = Utils::getVar('month', null, 'GET');
    $year  = Utils::getVar('year', null, 'GET');
    $today = Utils::getVar('today', null, 'GET');
}

if (!(is_numeric($year) && $year > 1900 && $year < 2100)) {
    $year = date("Y");
}
if (!(is_numeric($month) && $month > 0 && $month < 13)) {
    $month = date("m");
}
if (!(is_numeric($today) && $today > 0 && $today < 32)) {
    $today = date("d");
}

$currentMonth = date("F",mktime(1,1,1,$month,1,$year));

$dayNames = array('Mon','Tue','Wen','Thu','Fri','Sat','Sun');
$monthNames = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

$nextYear = $year + 1;
$lastYear = $year - 1;

$numdays = date("t", mktime(1,1,1,$month,1,$year));
if ($today > $numdays) {
    $today = $numdays;
}

$todayDate = date("Y-m-d");
$stringDate = "$year-$month-$today";

switch ($page) {
    case 'back':
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'backend.php';
        break;
    default:
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'frontend.php';
}