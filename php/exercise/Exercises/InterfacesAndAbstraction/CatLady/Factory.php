<?php

class Factory
{
    public static function getCat(array $data) : Cat
    {
        $catBreed = $data[0];
        $catName = $data[1];
        $param = $data[2];

        if(class_exists($catBreed)){
            return new $catBreed($catBreed, $catName, $param);
        }
    }


}