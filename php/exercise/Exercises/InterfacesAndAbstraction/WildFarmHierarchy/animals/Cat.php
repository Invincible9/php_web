<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.10.2018 г.
 * Time: 15:43
 */

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
        return sprintf("%s [%s, %s, %s, %s, %s]\n",
            $this->getAnimalName(),
            $this->getAnimalType(),
            $this->getBreed(),
            $this->getAnimalWeight(),
            $this->getLivingRegion(),
            $this->getFoodEaten());
    }
}