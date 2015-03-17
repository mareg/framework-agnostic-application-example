<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Domain\Attendee\AttendeesList;
use Domain\Meetup\Meetup;
use Domain\Attendee\Attendee;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    use Transformations;

    /**
     * @var Attendee
     */
    private $me;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->me = Attendee::fromEmail('email@example.com');
    }

    /**
     * @Given I have not signed up for the meetup :meetup yet
     */
    public function iHaveNotSignedUpForTheMeetupYet(Meetup $meetup)
    {
        expect($meetup->attendees()->count())->toBe(0);
    }

    /**
     * @When I sign up for the :meetup meetup
     */
    public function iSignUpForTheMeetup(Meetup $meetup)
    {
        $meetup->signUp($this->me);
    }

    /**
     * @Then I should be on the attendees list of the :meetup meetup
     */
    public function iShouldBeOnTheAttendeesListOfTheMeetup(Meetup $meetup)
    {
        expect($meetup->attendees()->has($this->me))->toBe(true);
    }
}
