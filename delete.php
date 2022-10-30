<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["osztaly_id"])){
    $stmt = $pdo->prepare('DELETE FROM osztaly WHERE id = ?');
    $stmt->execute([$_GET['osztaly_id']]);
    //TODO: updatelni kell a dolgozo táblába az osztály_id mezőt mielőtt kitörlöm az osztályt.
    header("Location: index.php");
}

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["dolgozo_id"])){
    $stmt = $pdo->prepare('DELETE FROM dolgozo WHERE id = ?');
    $stmt->execute([$_GET['dolgozo_id']]);
    header("Location: employe.php");
}
