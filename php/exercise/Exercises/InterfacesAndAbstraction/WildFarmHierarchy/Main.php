<?php

//spl_autoload_register();

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