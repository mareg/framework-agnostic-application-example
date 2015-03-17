<?php

namespace Domain\Attendee;

final class Attendee
{
    /**
     * @var string
     */
    private $email;

    private function __construct()
    {
    }

    /**
     * @param string $email
     *
     * @return Attendee
     */
    public static function fromEmail($email)
    {
        $attendee = new Attendee();

        $attendee->email = $email;

        return $attendee;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->email;
    }

    /**
     * @param Attendee $attendee
     *
     * @return boolean
     */
    public function equals(Attendee $attendee)
    {
        return $attendee->email === $this->email;
    }
}
