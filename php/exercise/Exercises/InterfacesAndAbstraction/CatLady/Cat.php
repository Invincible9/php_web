<?php

abstract class Cat
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $breed;

    protected function __construct(string $breed, string $name)
    {
        $this->setBreed($breed);
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBreed(): string
    {
        return $this->breed;
    }

    /**
     * @param string $breed
     */
    private function setBreed(string $breed): void
    {
        $this->breed = $breed;
    }

    public function __toString()
    {
       return "{$this->getBreed()} {$this->getName()} ";
    }


}