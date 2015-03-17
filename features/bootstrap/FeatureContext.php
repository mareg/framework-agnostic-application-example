<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Domain\Attendee\AttendeesList;
use Domain\Meetup\Meetup;
use Domain\Attendee\Attendee;
use Domain\Meetup\Observer\AttendeeHasAlreadySignedUp;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, AttendeeHasAlreadySignedUp, SnippetAcceptingContext
{
    use Transformations;

    /**
     * @var Attendee
     */
    private $me;

    /**
     * @var Attendee
     */
    private $attendeeAlreadySignedUp = null;

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
     * @BeforeScenario
     */
    public function preScenario()
    {
        $this->meetups = [];
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

    /**
     * @Given I have already signed up for the meetup :meetup
     */
    public function iHaveAlreadySignedUpForTheMeetup(Meetup $meetup)
    {
        $meetup->signUp($this->me);
    }

    /**
     * @Then I should be notified that I am already on the list of :meetup meetup attendees
     */
    public function iShouldBeNotifiedThatIAmAlreadyOnTheListOfMeetupAttendees(Meetup $meetup)
    {
        expect($this->attendeeAlreadySignedUp)->toBe($this->me);
    }

    /**
     * {@inheritdoc}
     */
    public function attendeeHasAlreadySignedUp(Attendee $attendee, Meetup $meetup)
    {
        $this->attendeeAlreadySignedUp = $attendee;
    }
}
