<?php

namespace Domain\Meetup\Observer;

use Domain\Attendee\Attendee;
use Domain\Meetup\Meetup;

interface AttendeeHasAlreadySignedUp
{
    public function attendeeHasAlreadySignedUp(Attendee $attendee, Meetup $meetup);
}