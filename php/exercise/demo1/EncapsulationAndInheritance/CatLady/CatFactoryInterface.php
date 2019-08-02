<?php

interface CatFactoryInterface
{
    public static function create(string $breed, string $name, int $param) : Cat;

}