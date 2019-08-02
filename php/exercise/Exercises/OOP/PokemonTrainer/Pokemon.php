<?php

class Pokemon
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $element;

    /**
     * @var int
     */
    private $health;

    /**
     * Pokemon constructor.
     * @param string $name
     * @param string $element
     * @param int $health
     */
    public function __construct(string $name, string $element, int $health)
    {
        $this->name = $name;
        $this->element = $element;
        $this->health = $health;
    }

    public function loseHealth()
    {
        return $this->health -= 10;
    }

    public function isAlive()
    {
        return $this->health > 0;
    }

    /**
     * @return string
     */
    public function getElement(): string
    {
        return $this->element;
    }



}