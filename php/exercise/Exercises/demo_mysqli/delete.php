<?php

include ("connect-db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $st = $mysqli->prepare("DELETE FROM posts WHERE post_id = ?");
    $st->bind_param("i", $id);
    $st->execute();

    header("Location: index.php");
}

