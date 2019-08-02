<?php

abstract class Food
{
    /**
     * @var int
     */
    private $quantity;

    protected function __construct(int $quantity)
    {
        $this->setQuantity($quantity);
    }

    public abstract function getClassName() : string;

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    private function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}


abstract class Animal
{
    /**
     * @var string
     */
    private $animalName;

    /**
     * @var string
     */
    private $animalType;

    /**
     * @var float
     */
    private $animalWeight;

    /**
     * @var float
     */
    private $foodEaten;

    /**
     * Animal constructor.
     * @param string $animalName
     * @param string $animalType
     * @param float $animalWeight
     */
    public function __construct(string $animalName, string $animalType, float $animalWeight)
    {
        $this->setAnimalName($animalName);
        $this->setAnimalType($animalType);
        $this->setAnimalWeight($animalWeight);
        $this->foodEaten = 0;
    }

    /**
     * @return string
     */
    public function getAnimalName(): string
    {
        return $this->animalName;
    }

    /**
     * @param string $animalName
     */
    private function setAnimalName(string $animalName): void
    {
        $this->animalName = $animalName;
    }

    /**
     * @return string
     */
    public function getAnimalType(): string
    {
        return $this->animalType;
    }

    /**
     * @param string $animalType
     */
    private function setAnimalType(string $animalType): void
    {
        $this->animalType = $animalType;
    }

    /**
     * @return float
     */
    public function getAnimalWeight(): float
    {
        return $this->animalWeight;
    }

    /**
     * @param float $animalWeight
     */
    private function setAnimalWeight(float $animalWeight): void
    {
        $this->animalWeight = $animalWeight;
    }

    /**
     * @return float
     */
    public function getFoodEaten(): float
    {
        return $this->foodEaten;
    }

    /**
     * @param float $foodEaten
     */
    protected function setFoodEaten(float $foodEaten): void
    {
        $this->foodEaten += $foodEaten;
    }

    public abstract function makeSound() : void ;
    public abstract function eat(Food $food) : void;

}

abstract class Mammal extends Animal
{
    /**
     * @var string
     */
    private $livingRegion;

    public function __construct(string $animalName, string $animalType, float $animalWeight,
                                string $livingRegion)
    {
        parent::__construct($animalName, $animalType, $animalWeight);
        $this->setLivingRegion($livingRegion);
    }

    /**
     * @return string
     */
    public function getLivingRegion(): string
    {
        return $this->livingRegion;
    }


    /**
     * @param string $livingRegion
     */
    private function setLivingRegion(string $livingRegion): void
    {
        $this->livingRegion = $livingRegion;
    }

    public function __toString()
    {
        return sprintf("%s[%s, %s, %s, %s]\n",
            $this->getAnimalName(),
            $this->getAnimalType(),
            $this->getAnimalWeight(),
            $this->getLivingRegion(),
            $this->getFoodEaten());
    }
}

abstract class Felime extends Mammal
{

}

class Meat extends Food
{
    public function __construct(int $quantity)
    {
        parent::__construct($quantity);
    }

    /**
     * @return string
     * @throws ReflectionException
     */
    public function getClassName(): string
    {
        $func = new \ReflectionClass($this);
        $className = $func->getName();

        return $className;
    }
}

class Vegetable extends Food
{

    public function __construct(int $quantity)
    {
        parent::__construct($quantity);
    }

    /**
     * @return string
     * @throws ReflectionException
     */
    public function getClassName(): string
    {
        $func = new \ReflectionClass($this);
        $className = $func->getName();

        return $className;
    }
}

class Cat extends Felime
{
    /**
     * @var string
     */
    private $breed;

    public function __construct(string $animalName, string $animalType, float $animalWeight, string $livingRegion,
                                string $breed)
    {
        parent::__construct($animalName, $animalType, $animalWeight, $livingRegion);
        $this->setBreed($breed);
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

    public function makeSound(): void
    {
        echo "Meowwww" . PHP_EOL;
    }

    public function eat(Food $food): void
    {
        $this->setFoodEaten($food->getQuantity());
    }

    public function __toString()
    {
        return sprintf("%s[%s, %s, %s, %s, %s]\n",
            $this->getAnimalName(),
            $this->getAnimalType(),
            $this->getBreed(),
            $this->getAnimalWeight(),
            $this->getLivingRegion(),
            $this->getFoodEaten());
    }
}

class Tiger extends Felime
{
    public function makeSound(): void
    {
        echo "ROAAR!!!" . PHP_EOL;
    }

    /**
     * @param Food $food
     * @throws ReflectionException
     * @throws Exception
     */
    public function eat(Food $food): void
    {
        $function = new \ReflectionClass($food);

        $getClassName = new \ReflectionClass($this);
        $className = $getClassName->getName();

        if("Meat" == $function->getName()) {
            $this->setFoodEaten($food->getQuantity());
        }else{
            throw new Exception( $className . "s are not eating that type of food!\n");
        }
    }
}

class Mouse extends Mammal
{

    public function makeSound(): void
    {
        echo "SQUEEEAAAK!" . PHP_EOL;
    }

    /**
     * @param Food $food
     * @throws ReflectionException
     * @throws Exception
     */
    public function eat(Food $food): void
    {
        $func = new \ReflectionClass($this);
        $className = $func->getName();

        if("Vegetable" == $food->getClassName()){
            $this->setFoodEaten($food->getQuantity());
        }else{
            throw new Exception($className . "s are not eating that type of food!\n");
        }
    }
}

class Zebra extends Mammal
{

    public function makeSound(): void
    {
        echo "Zs" . PHP_EOL;
    }

    /**
     * @param Food $food
     * @throws ReflectionException
     * @throws Exception
     */
    public function eat(Food $food): void
    {
        $func = new \ReflectionClass($this);
        $className = $func->getName();

        if("Vegetable" == $food->getClassName()){
            $this->setFoodEaten($food->getQuantity());
        }else{
            throw new Exception($className . "s are not eating that type of food!\n");
        }
    }
}

class AnimalFactory
{
    public static function getAnimal(array $data){
        $animalType = $data[0];
        $animalName = $data[1];
        $animalWeight = floatval($data[2]);
        $livingRegion = $data[3];

        switch (strtolower($animalType)){
            case "cat":
                $catBreed = $data[4];
                return new Cat($animalType, $animalName,
                    $animalWeight, $livingRegion, $catBreed);
            case "tiger":
            case "mouse":
            case "zebra":
                return new $animalType($animalType, $animalName,
                    $animalWeight, $livingRegion);
            default:
                return null;
        }
    }

}

class FoodFactory
{
    public static function getFood(array $data)
    {
        $foodType = $data[0];
        $quantity = floatval($data[1]);

        switch (strtolower($foodType)) {
            case "vegetable":
                return new Vegetable($quantity);
            case "meat":
                return new Meat($quantity);
            default:
                return null;
        }
    }
}

class Main
{
    private const END = "End";

    public static function run(){

        $input = readline();
        while ($input != self::END){
            $animalData = explode(" ", $input);
            $animal = AnimalFactory::getAnimal($animalData);

            $foodData = explode(" ", readline());
            $food = FoodFactory::getFood($foodData);

            $animal->makeSound();

            try {
                $animal->eat($food);

            }catch (Exception $ex){
                echo $ex->getMessage();
            }

            echo $animal;

            $input = readline();
        }
    }

}

Main::run();