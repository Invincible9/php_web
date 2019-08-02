<?php

require_once "Box.php";

$length = floatval(readline());
$width = floatval(readline());
$height = floatval(readline());

try {
    $box = new Box($length, $width, $height);
    echo $box;
}catch (Exception $ex) {
    echo $ex->getMessage();
}
