<?php

class Cymric extends Cat
{
    private $furLength;

    public function __construct(string $breed, string $name, $furLength)
    {
        parent::__construct($breed, $name);
        $this->setFurLength($furLength);
    }

    /**
     * @return mixed
     */
    public function getFurLength()
    {
        return $this->furLength;
    }

    /**
     * @param mixed $furLength
     */
    private function setFurLength($furLength): void
    {
        $this->furLength = $furLength;
    }

    public function __toString()
    {
        return parent::__toString() . $this->furLength . PHP_EOL;
    }

}