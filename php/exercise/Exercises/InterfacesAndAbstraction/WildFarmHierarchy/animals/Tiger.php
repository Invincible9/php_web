<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.10.2018 г.
 * Time: 15:46
 */

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
            throw new Exception( $className . "s are not eating that type of food\n");
        }
    }
}