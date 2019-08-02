<?php

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