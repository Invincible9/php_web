<?php

class Car {

    /**
     * @var string
     */
    private $model;

    /**
     * @var float
     */
    private $fuelAmount;

    /**
     * @var float
     */
    private $fuelCostPerKm;

    /**
     * @var int
     */
    private $distance;

    /**
     * Car constructor.
     * @param string $model
     * @param float $fuelAmount
     * @param float $fuelCostPerKm
     */
    public function __construct(string $model, float $fuelAmount, float $fuelCostPerKm)
    {
        $this->model = $model;
        $this->fuelAmount = $fuelAmount;
        $this->fuelCostPerKm = $fuelCostPerKm;
        $this->distance = 0;
    }

    public function drive(float $distanceTraveled){
        $fuelNeeded = $this->fuelCostPerKm * $distanceTraveled;

        if($fuelNeeded <= $this->fuelAmount){
            $this->fuelAmount -= $fuelNeeded;
            $this->distance += $distanceTraveled;
        }else{
            echo "Insufficient fuel for the drive\n";
        }
    }

    public function __toString()
    {
        $fuelAmountResult = number_format($this->fuelAmount, 2);

        return "{$this->model} {$fuelAmountResult} {$this->distance}\n";
    }


}

