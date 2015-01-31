<?php

namespace Event\Repository;

use Event\IRepository;

class DB implements IRepository {

    public function getEventByDate($date)
    {
        $sql = "SELECT title, event, fixed FROM cal WHERE eventdate = ?";
        $result = \DB::query($sql, array($date))->fetchAll(\PDO::FETCH_ASSOC);
        return array_pop( $result );
    }

    public function getEventsInDateRange( $startDate, $endDate )
    {
        $sql = "SELECT `title`, `event`, `eventdate`, `fixed` FROM `cal`
                    WHERE `eventdate`>= ? AND `eventdate`<= ? ORDER BY `eventdate`";
        $allEvents = \DB::query($sql, array($startDate, $endDate))->fetchAll(\PDO::FETCH_ASSOC);

        $eventTitles = array();
        foreach ($allEvents as $elem)  {
            $eventdate = $elem['eventdate'];
            $eventTitles[$eventdate]['title'] = $elem['title'];
            $eventTitles[$eventdate]['event'] = $elem['event'];
            $eventTitles[$eventdate]['fixed'] = $elem['fixed'];
        }
        return $eventTitles;
    }

    public function setEvent( $title, $desc, $date, $fixed = 0 )
    {
        $isEvent = $this->getEventByDate($date);

        if ( $isEvent ) {
            //UPDATE
            $res = \DB::query("UPDATE `cal` SET `title` = ?, `event` = ?, `fixed` = ? WHERE `eventdate` = ?",
                array($title, $desc, $fixed, $date));
        }
        else {
            //INSERT
            $res = \DB::query("INSERT INTO `cal` (`title`,`event`,`eventdate`, `fixed`) VALUES (?,?,?,?)",
                array($title, $desc, $date, $fixed));
        }

        return ($res->errorCode() === \PDO::ERR_NONE);
    }

    public function deleteEventByDate( $date )
    {
        $res = \DB::query("DELETE FROM `cal` WHERE `eventdate` = ?", array($date));
        return ($res->errorCode() === \PDO::ERR_NONE);
    }
} 