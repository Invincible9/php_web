<?php

class StreetExtraordinaire extends Cat
{
    private $decibelsOfMeows;

    public function __construct(string $breed, string $name, $decibelsOfMeows)
    {
        parent::__construct($breed, $name);
        $this->setDecibelsOfMeows($decibelsOfMeows);
    }

    /**
     * @return mixed
     */
    public function getDecibelsOfMeows()
    {
        return $this->decibelsOfMeows;
    }

    /**
     * @param mixed $decibelsOfMeows
     */
    private function setDecibelsOfMeows($decibelsOfMeows): void
    {
        $this->decibelsOfMeows = $decibelsOfMeows;
    }

    public function __toString()
    {
        return parent::__toString() . $this->getDecibelsOfMeows() . PHP_EOL;
    }


}