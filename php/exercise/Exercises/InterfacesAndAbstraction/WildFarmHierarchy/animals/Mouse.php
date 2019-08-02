<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.10.2018 г.
 * Time: 15:41
 */

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