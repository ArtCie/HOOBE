<?php

class Settings
{
    private $email;
    private $birthday;

    public function __construct(string $email, $birthday)
    {
        $this->email = $email;
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }


}