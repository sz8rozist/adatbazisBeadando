<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
if(isset($_GET['osztaly_id'])){
    $stmt = $pdo->prepare('DELETE FROM osztaly WHERE id = ?');
    $stmt->execute([$_GET['osztaly_id']]);
    //TODO: updatelni kell a dolgozo táblába az osztály_id mezőt.
    header("Location: index.php");
}else{
    exit("Nincs megadva osztály azonosito!");
}
