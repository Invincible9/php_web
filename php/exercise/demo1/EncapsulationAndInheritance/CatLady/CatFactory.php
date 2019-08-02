<?php

class CatFactory implements CatFactoryInterface
{

    /**
     * @param string $breed
     * @param string $name
     * @param int $param
     * @return Cat
     * @throws Exception
     */
    public static function create(string $breed, string $name, int $param): Cat
    {
        if(!class_exists($breed)){
           throw new Exception("");
        }

        return new $breed($breed, $name, $param);
    }
}