<?php

namespace Domain\Attendee;

class AttendeesList implements \Countable, \Iterator
{
    /**
     * @var integer
     */
    private $position = 0;

    /**
     * @var Attendee[]
     */
    private $attendees = [];

    public function __construct()
    {
        $this->attendees = [];
        $this->position = 0;
    }

    /**
     * @return Attendee
     */
    public function current()
    {
        return $this->attendees[$this->position];
    }

    /**
     * @return integer
     */
    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return boolean
     */
    public function valid()
    {
        return isset($this->attendees[$this->position]);
    }

    /**
     * @param Attendee $attendee
     */
    public function add(Attendee $attendee)
    {
        $this->attendees[] = $attendee;
    }

    /**
     * @return integer
     */
    public function count()
    {
        return count($this->attendees);
    }

    /**
     * @param Attendee $otherAttendee
     *
     * @return boolean
     */
    public function has(Attendee $otherAttendee)
    {
        foreach ($this->attendees as $attendee) {
            if ($attendee->equals($otherAttendee)) {
                return true;
            }
        }

        return false;
    }
}
