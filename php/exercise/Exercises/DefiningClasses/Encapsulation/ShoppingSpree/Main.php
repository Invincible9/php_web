<?php

spl_autoload_register();

$personsData = preg_split("/[=;]/", readline());

$people = [];

for ($i = 0; $i < count($personsData) - 1; $i += 2) {
    try{
        $name = $personsData[$i];
        $money = floatval($personsData[$i + 1]);

        $people[$name] = new Person($name, $money);
    }catch (Exception $ex){
        echo $ex->getMessage();
        return;
    }
}

$productsData = preg_split("/[=;]/", readline(),
            -1, PREG_SPLIT_NO_EMPTY);

$products = [];
for ($i = 0; $i < count($productsData) - 1; $i += 2) {
    $name = $productsData[$i];
    $cost = floatval($productsData[$i + 1]);
    $products[$name] = new Product($name, $cost);
}

$input = readline();

while ($input != "END"){
    $data = explode(" ", $input);

    $personName = $data[0];
    $productName = $data[1];

    try {
        if(array_key_exists($personName, $people) &&
            array_key_exists($productName, $products)) {
            $people[$personName]->buyProduct($products[$productName]);
        }
    }catch (Exception $ex){
        echo $ex->getMessage();
    }

    $input = readline();
}

foreach ($people as $person){
    echo $person;
}