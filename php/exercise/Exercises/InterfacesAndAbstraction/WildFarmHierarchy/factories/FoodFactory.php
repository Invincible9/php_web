<?php


class FoodFactory
{
    public static function getFood(array $data)
    {
        $foodType = $data[0];
        $quantity = floatval($data[1]);

        switch (strtolower($foodType)) {
            case "vegetable":
                return new Vegetable($quantity);
            case "meat":
                return new Meat($quantity);
            default:
                return null;
        }
    }


}