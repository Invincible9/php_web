<?php

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