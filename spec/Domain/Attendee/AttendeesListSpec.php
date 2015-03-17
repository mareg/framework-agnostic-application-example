<?php

namespace spec\Domain\Attendee;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Attendee\Attendee;

class AttendeesListSpec extends ObjectBehavior
{
    function it_is_an_Iterator()
    {
        $this->shouldHaveType(\Iterator::class);
    }

    function it_is_Countable()
    {
        $this->shouldHaveType(\Countable::class);
    }

    function it_can_have_Attendee_added()
    {
        $attendee = Attendee::fromEmail('email@example.com');

        $this->add($attendee);
    }

    public function it_can_tell_if_it_has_the_Attendee()
    {
        $attendee = Attendee::fromEmail('email@example.com');

        $this->add($attendee);

        $this->has($attendee)->shouldReturn(true);
    }

    public function it_can_tell_that_Attendee_is_not_on_the_list()
    {
        $attendee = Attendee::fromEmail('email@example.com');

        $this->has($attendee)->shouldReturn(false);
    }
}
