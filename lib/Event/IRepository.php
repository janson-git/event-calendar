<?php

namespace Event;

interface IRepository {
    /**
     * @param string $date  Date in YYYY-MM-DD format
     * @return array
     */
    public function getEventByDate($date);

    /**
     * @param string $startDate  Date in YYYY-MM-DD format
     * @param string $endDate    Date in YYYY-MM-DD format
     * @return array
     */
    public function getEventsInDateRange($startDate, $endDate);

    /**
     * @param string $title
     * @param string $desc
     * @param string $date   Date in YYYY-MM-DD format
     * @param integer $fixed
     * @return boolean
     */
    public function setEvent($title, $desc, $date, $fixed = 0);

    /**
     * @param string $date  Date in YYYY-MM-DD format
     * @return boolean
     */
    public function deleteEventByDate($date);
}