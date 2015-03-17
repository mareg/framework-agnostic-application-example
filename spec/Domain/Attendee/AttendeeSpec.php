<?php

namespace spec\Domain\Attendee;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Attendee\Attendee;

class AttendeeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromEmail', ['email@example.com']);
    }

    function it_converts_to_string_in_string_context()
    {
        $this->__toString()->shouldReturn('email@example.com');
    }

    function it_can_tell_it_equals_other_Attendee_with_same_email()
    {
        $attendee = Attendee::fromEmail('email@example.com');
        $otherAttendee = Attendee::fromEmail('other@example.com');

        $this->equals($attendee)->shouldReturn(true);
        $this->equals($otherAttendee)->shouldReturn(false);
    }
}
