<?php

use Domain\Meetup\Meetup;

trait Transformations
{
    /**
     * @var Meetup[]
     */
    protected $meetups = [];

    /**
     * @Transform :meetup
     *
     * @param string $meetup
     *
     * @return Meetup
     */
    public function transformMeetupNameToMeetup($meetup)
    {
        if (!array_key_exists($meetup, $this->meetups)) {
            $this->meetups[$meetup] = new Meetup($meetup, $this);;
        }

        return $this->meetups[$meetup];
    }
}