<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.6.2019 г.
 * Time: 16:34
 */

class Tiger extends Felime
{
    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        parent::__construct($name, $type, $weight, $livingRegion);
    }

    public function makeSound(): void
    {
        echo "ROAAR!!!\n";
    }

    /**
     * @param Food $food
     * @throws Exception
     */
    public function eat(Food $food): void
    {
        $class = new \ReflectionClass($this);
        $className = $class->getName();

        if("Meat" !== $food->getClassName()){
            throw new Exception($className . "s are not eating that type of food!\n");
        }
        $this->setFoodEaten($food->getQuantity());
    }
}