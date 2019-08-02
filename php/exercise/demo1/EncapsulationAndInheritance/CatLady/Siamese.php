<?php

class Siamese extends Cat
{
    private $earSize;

    public function __construct(
        string $breed,
        string $name,
        int $earSize)
    {
        parent::__construct($breed, $name);
        $this->setEarSize($earSize);
    }

    /**
     * @return mixed
     */
    public function getEarSize()
    {
        return $this->earSize;
    }

    /**
     * @param mixed $earSize
     */
    private function setEarSize($earSize): void
    {
        $this->earSize = $earSize;
    }

    public function __toString()
    {
        return parent::__toString() . " " . $this->getEarSize() . PHP_EOL;
    }

}