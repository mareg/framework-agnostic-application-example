<?php

namespace Domain\Meetup;

use Domain\Attendee\AttendeesList;
use Domain\Attendee\Attendee;

class Meetup
{
    /**
     * @var AttendeesList
     */
    private $attendees;

    public function __construct()
    {
        $this->attendees = new AttendeesList();
    }

    /**
     * @return AttendeesList
     */
    public function attendees()
    {
        return $this->attendees;
    }

    /**
     * @param Attendee $attendee
     */
    public function signUp(Attendee $attendee)
    {
        $this->attendees->add($attendee);
    }
}
