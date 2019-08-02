<?php

class Tire {
    /**
     * @var float
     */
    private $pressure;

    /**
     * @var int
     */
    private $age;

    /**
     * Tire constructor.
     * @param float $pressure
     * @param int $age
     */
    public function __construct(float $pressure, int $age)
    {
        $this->setPressure($pressure);
        $this->setAge($age);
    }

    /**
     * @return float
     */
    public function getPressure(): float
    {
        return $this->pressure;
    }

    /**
     * @param float $pressure
     */
    private function setPressure(float $pressure)
    {
        $this->pressure = $pressure;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    private function setAge(int $age)
    {
        $this->age = $age;
    }




}