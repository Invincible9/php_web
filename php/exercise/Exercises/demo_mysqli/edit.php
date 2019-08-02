<?php

include ("connect-db.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $st = $mysqli->prepare("");
    $st->bind_param("i", $id);
    $st->execute();

    header("Location: index.php");
}