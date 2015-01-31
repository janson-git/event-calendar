<?php

class Utils
{
    public static function getVar($name, $default = null, $hash = '')
    {
        switch ($hash) {
            case 'GET':
                $hash = $_GET;
                break;
            case 'POST':
                $hash = $_POST;
                break;
            case 'SESSION':
                $hash = $_SESSION;
                break;
            case 'SERVER':
                $hash = $_SERVER;
                break;
            case 'COOKIE':
                $hash = $_COOKIE;
                break;
            case 'ENV':
                $hash = $_ENV;
                break;
            default:
                $hash = $_REQUEST;
        }

        if ( isset($hash[$name]) ) {
            return $hash[$name];
        }
        return $default;
    }

    /**
     * Create array of months days to output in days grid.
     * @param integer $year
     * @param integer $month
     * @return array
     */
    public static function makeDaysOfMonthArray($year, $month)
    {
        // make start from Monday, not Sunday
        $dayone = date("w", mktime(1,1,1,$month,1,$year));
        $dayone == 0 ? $dayone = 6 : $dayone--;

        $numdays = date("t", mktime(1,1,1,$month,1,$year));

        // empties days on end of month
        $createEmpties = 7 - (($dayone + $numdays) % 7);
        if ($createEmpties == 7) {
            $createEmpties = 0;
        }
        $daysArray = array();
        // add empty pre-days
        for ($i = 0; $i < $dayone; $i++) {
            array_push($daysArray, null);
        }
        // add real days
        for ($i = 1; $i <= $numdays; $i++) {
            array_push($daysArray, sprintf("%02d", $i));
        }
        // add empty post-days
        for ($i = 0; $i < $createEmpties; $i++) {
            array_push($daysArray, null);
        }

        return $daysArray;
    }
} 