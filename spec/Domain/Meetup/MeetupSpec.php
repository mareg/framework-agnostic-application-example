<?php

namespace spec\Domain\Meetup;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Attendee\AttendeesList;
use Domain\Attendee\Attendee;

class MeetupSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Meetup\Meetup');
    }

    public function it_has_attendees()
    {
        $this->attendees()->shouldBeAnInstanceOf(AttendeesList::class);
    }

    public function it_allows_Attendee_to_sign_up()
    {
        $attendee = Attendee::fromEmail('email@example.com');

        $this->signUp($attendee);

        $this->attendees()->has($attendee)->shouldReturn(true);
    }
}
