Feature: Attendee can sign up for the meetup
  In order to attend the meetup
  As Attendee
  I should be able to sign up for the meetup
  
  Scenario: Attendee can sign up for the meetup with email
    Given I have not signed up for the meetup "Laravel" yet
    When I sign up for the "Laravel" meetup
    Then I should be on the attendees list of the "Laravel" meetup
