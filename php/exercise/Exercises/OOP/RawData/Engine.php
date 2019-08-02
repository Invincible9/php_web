<?php


class Engine {
    /**
     * @var integer
     */
    private $speed;

    /**
     * @var integer
     */
    private $power;

    /**
     * Engine constructor.
     * @param int $speed
     * @param int $power
     */
    public function __construct(int $speed, int $power)
    {
        $this->setSpeed($speed);
        $this->setPower($power);
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     */
    private function setSpeed(int $speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return int
     */
    public function getPower(): int
    {
        return $this->power;
    }

    /**
     * @param int $power
     */
    private function setPower(int $power)
    {
        $this->power = $power;
    }




}