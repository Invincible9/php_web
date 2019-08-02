<?php

//require_once "Car.php";

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
            $this->fuelAmount = number_format($this->fuelAmount, 2);
        }else{
            echo "Insufficient fuel for the drive\n";
        }
    }

    public function __toString()
    {
        $fuelAmountResult = number_format($this->fuelAmount, 2, '.', '');

        return "{$this->model} {$fuelAmountResult} {$this->distance}\n";
    }
}

$n = intval(readline());

$cars = [];

while ($n-- > 0) {
    $data = explode(" ", readline());

    $model = $data[0];
    $fuelAmount = floatval($data[1]);
    $fuelCostPerKm = floatval($data[2]);

    $car = new Car($model, $fuelAmount, $fuelCostPerKm);

    $cars[$model] = $car;
}

while (1){
    $input = explode(" ", readline());

    if($input[0] == "End"){
        break;
    }

    $model = $input[1];
    $amountOfKm = floatval($input[2]);

    $cars[$model]->drive($amountOfKm);
}

foreach($cars as $car){
    echo $car;
}
