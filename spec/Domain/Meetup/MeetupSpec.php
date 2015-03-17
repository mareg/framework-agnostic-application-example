<?php

namespace spec\Domain\Meetup;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Attendee\AttendeesList;
use Domain\Attendee\Attendee;
use Domain\Meetup\Observer\AttendeeHasAlreadySignedUp;

class MeetupSpec extends ObjectBehavior
{
    function let(AttendeeHasAlreadySignedUp $observer)
    {
        $this->beConstructedWith('Meetup', $observer);
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

    public function it_notifies_the_AttendeeHasAlreadySignedUp_observer_if_user_tries_to_re_sign_up(
        AttendeeHasAlreadySignedUp $observer
    ) {
        $attendee = Attendee::fromEmail('email@example.com');

        $this->signUp($attendee);

        $observer->attendeeHasAlreadySignedUp($attendee, $this)->shouldBeCalled();

        $this->signUp($attendee);
    }
}
