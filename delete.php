<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["osztaly_id"])){
    $stmt = $pdo->prepare('DELETE FROM osztaly WHERE id = ?');
    $stmt->execute([$_GET['osztaly_id']]);
    header("Location: department.php");
}

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["dolgozo_id"])){
    $stmt = $pdo->prepare('DELETE FROM dolgozo WHERE id = ?');
    $stmt->execute([$_GET['dolgozo_id']]);
    header("Location: employe.php");
}

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["projekt_id"])){
    $stmt = $pdo->prepare('DELETE FROM projekt WHERE id = ?');
    $stmt->execute([$_GET['projekt_id']]);
    header("Location: projekt.php");
}

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["dolgozik_id"])){
    $stmt = $pdo->prepare('DELETE FROM dolgozik WHERE id = ?');
    $stmt->execute([$_GET['dolgozik_id']]);
    header("Location: projekt.php");
}

