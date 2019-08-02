<?php

//require_once "Engine.php";
//require_once "Cargo.php";
//require_once "Tire.php";
//require_once "Car.php";

class Car {
    /**
     * @var string
     */
    private $model;

    /**
     * @var Cargo
     */
    private $cargo;

    /**
     * @var Engine
     */
    private $engine;

    /**
     * @var array
     */
    private $tires;

    /**
     * Car constructor.
     * @param string $model
     * @param Engine $engine
     * @param Cargo $cargo
     */
    public function __construct(string $model, Engine $engine, Cargo $cargo)
    {
        $this->model = $model;
        $this->engine = $engine;
        $this->cargo = $cargo;
        $this->tires = [];
    }

    /**
     * @param Tire $tire
     */
    public function addTire(Tire $tire){
        $this->tires[] = $tire;
    }

    /**
     * @return array
     */
    public function getTires(): array
    {
        return $this->tires;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }



    /**
     * @return Cargo
     */
    public function getCargo(): Cargo
    {
        return $this->cargo;
    }

    /**
     * @return Engine
     */
    public function getEngine(): Engine
    {
        return $this->engine;
    }
}

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

class Cargo {

    /**
     * @var int
     */
    private $weight;

    /**
     * @var string
     */
    private $type;

    /**
     * Cargo constructor.
     * @param int $weight
     * @param string $type
     */
    public function __construct(int $weight, string $type)
    {
        $this->setWeight($weight);
        $this->setType($type);
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    private function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    private function setType(string $type)
    {
        $this->type = $type;
    }
}

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

$n = intval(readline());

$cars = [];

for($i = 0; $i < $n; $i++) {
    $input = explode(" ", readline());

    list($model, $engineSpeed, $enginePower, $cargoWeight,
        $cargoType, $tire1Pressure, $tire1Age,
        $tire2Pressure, $tire2Age,
        $tire3Pressure, $tire3Age,
        $tire4Pressure, $tire4Age) = $input;

    $engine = new Engine(intval($engineSpeed), intval($enginePower));
    $cargo = new Cargo(intval($cargoWeight), $cargoType);

    $tire1 = new Tire(floatval($tire1Pressure), intval($tire1Age));
    $tire2 = new Tire(floatval($tire2Pressure), intval($tire2Age));
    $tire3 = new Tire(floatval($tire3Pressure), intval($tire3Age));
    $tire4 = new Tire(floatval($tire4Pressure), intval($tire4Age));

    $car = new Car($model, $engine, $cargo);

    $car->addTire($tire1);
    $car->addTire($tire2);
    $car->addTire($tire3);
    $car->addTire($tire4);

    $cars[] = $car;

}

$command = readline();

switch ($command){
    case "fragile":
        foreach($cars as $car){
            if($car->getCargo()->getType() == "fragile"){
                foreach($car->getTires() as $tire){
                    if($tire->getPressure() < 1){
                        echo $car->getModel() . PHP_EOL;
                        break;
                    }
                }
            }
        }
        break;
    case "flamable":
            array_filter($cars, function (Car $car){
                if($car->getCargo()->getType() == "flamable" &&
                $car->getEngine()->getPower() > 250){
                    echo $car->getModel() . PHP_EOL;
                }
            });
        break;


}