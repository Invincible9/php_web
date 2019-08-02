<?php

class Zebra extends Mammal
{
    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        parent::__construct($name, $type, $weight, $livingRegion);
    }

    public function makeSound(): void
    {
       echo "Zs" . PHP_EOL;
    }

    /**
     * @param Food $food
     * @throws Exception
     */
    public function eat(Food $food): void
    {
        if("Vegetable" !== $food->getClassName()){
            throw new Exception(get_class() . "s are not eating that type of food!\n");
        }

        $this->setFoodEaten($food->getQuantity());
    }
}