<?php

namespace Domain\Meetup;

use Domain\Attendee\AttendeesList;
use Domain\Attendee\Attendee;
use Domain\Meetup\Observer\AttendeeHasAlreadySignedUp;

class Meetup
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var AttendeesList
     */
    private $attendees;

    /**
     * @var AttendeeHasAlreadySignedUp
     */
    private $observer;

    public function __construct($name, AttendeeHasAlreadySignedUp $observer)
    {
        $this->name = $name;
        $this->attendees = new AttendeesList();
        $this->observer = $observer;
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
        if (!$this->attendees->has($attendee)) {
            $this->attendees->add($attendee);
        } else {
            $this->observer->attendeeHasAlreadySignedUp($attendee, $this);
        }
    }
}
