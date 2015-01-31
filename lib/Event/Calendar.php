<?php

namespace Event;

class Calendar {
	
	/**
	 * Calendar error text
	 * @var array
	 */
	private $error = array();

    /** @var  IRepository */
    protected $repo;

	public function __construct(IRepository $repo)
    {
        $this->repo = $repo;
    }

	/**
	 * get one calendar event by date ("Y-m-d")
	 * Return array of two elements:
	 * 'title' and 'event'
	 *
	 * @param string $date
	 * @return array
	 */
	public function getEventByDate( $date ) 
	{
		if ( $this->checkDate($date) ) {
            return $this->repo->getEventByDate($date);
		}
		return false;
	}
	
	
	/**
	 * Get all calendar events between $start_date and $end_date
	 * input date format - "Y-m-d"
	 * Return array with dates as array keys, and event titles as elements
	 *
	 * @param string $startDate
	 * @param string $endDate
	 * @return array
	 */
	public function getAllEventsInPeriod( $startDate, $endDate )
	{
		if ( $this->checkDate($startDate) && $this->checkDate($endDate) ) {
            return $this->repo->getEventsInDateRange($startDate, $endDate);
		}
		return null;
	}
	
	
	/**
	 * Insert new event (or replace old event) in calendar
	 *
	 * @param string $title
	 * @param string $desc
	 * @param string $date
	 * @return boolean
	 */
	public function setEvent( $title, $desc, $date, $fixed = 0 )
    {
		return $this->repo->setEvent($title, $desc, $date, $fixed);
	}
	
	
	/**
	 * Delete event by date
	 * Date format - "Y-m-d"
	 *
	 * @param string $date
	 */
	public function deleteEventByDate( $date )
	{
        $this->repo->deleteEventByDate($date);
	}


    /**
     * Check date for correct.
     * Date format - "Y-m-d"
     *
     * @param string $date
     * @return bool
     */
	private function checkDate( $date )
	{
		$parts = explode("-", $date);
		if ( count($parts) != 3) {
			$this->setError("Incorrect date format. Expecting format 'Y-m-d'");
			return false;
		}
		
		$check = checkdate($parts[1], $parts[2], $parts[0]);
		if ($check === false) {
			$this->setError("Incorrect date '{$date}'");
			return false;
		}
		
		return true;
	}
	
	
	/**
	 * Set error text
	 *
	 * @param string $message
	 */
	public function setError($message)
	{
		$this->error[] = $message;
	}
	
	
	/**
	 * Get error text
	 *
	 * @return array
	 */
	public function getError()
	{
		return $this->error;
	}
}