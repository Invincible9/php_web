<?php

spl_autoload_register();

class Main
{
    private $cats;
    private const END = "END";

    public function __construct()
    {
        $this->cats = [];
    }

    public function run(){
        $this->readData();
    }

    public function readData(){


        while (true){
            $input = explode(" ", readline());

            if($input[0] == self::END){
                break;
            }

            $catName = $input[1];

            $cat = Factory::getCat($input);
            $this->cats[$catName] = $cat;
        }

        $searchingName = readline();
        $this->printCat($searchingName);
    }

    private function printCat($searchingName){
        if(array_key_exists($searchingName, $this->cats)) {
            echo $this->cats[$searchingName];
        }
    }
}

$main = new Main();
$main->run();