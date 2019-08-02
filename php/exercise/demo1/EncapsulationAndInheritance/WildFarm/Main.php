<?php

spl_autoload_register();

session_start();

class Main {

    const INPUT_END_COMMAND = "End";

    public function run(){
        $this->readData();
    }

    private function readData(){
        $input = readline();

        while ($input !== self::INPUT_END_COMMAND){
            $animalData = explode(" ", $input);
            $animal = AnimalFactory::create($animalData);

            $foodData = explode(" ", readline());
            $foodType = $foodData[0];
            $foodQuantity = intval($foodData[1]);
            $food = FoodFactory::create($foodType, $foodQuantity);

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

$main = new Main();
$main->run();