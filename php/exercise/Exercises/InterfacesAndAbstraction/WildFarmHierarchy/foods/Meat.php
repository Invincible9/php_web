<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.10.2018 г.
 * Time: 15:28
 */

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