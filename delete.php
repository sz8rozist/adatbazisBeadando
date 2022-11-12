<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["osztaly_id"])){
    $stmt = $pdo->prepare('DELETE FROM osztaly WHERE id = ?');
    $stmt->execute([$_GET['osztaly_id']]);
    $update_stmt = $pdo->prepare('UPDATE `dolgozo` SET `manager_in_osztaly` = ? WHERE `dolgozo`.`manager_in_osztaly` = ?');
    $update_stmt->execute([null,$_GET["osztaly_id"]]);
    header("Location: index.php");
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
