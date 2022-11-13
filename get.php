<?php
include ("functions.php");
$pdo = pdo_connect_mysql();
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $dolgozik_id = $_GET['id'];
    $projektek = $pdo->query("SELECT * FROM projekt")->fetchAll(PDO::FETCH_ASSOC);
    $query = $pdo->prepare("SELECT * FROM dolgozik WHERE id = ?");
    $query->execute([$dolgozik_id]);
    $dolgozik_adatok = $query->fetchObject();
    $response = [
        "dolgozik_adatok" => $dolgozik_adatok,
        "projektek" => $projektek
    ];
    die(json_encode($response));
}