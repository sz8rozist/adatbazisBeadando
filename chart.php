<?php
include ('functions.php');

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('SELECT osztaly.*, (SELECT COUNT(dolgozo.id) FROM dolgozo WHERE dolgozo.osztaly_id = osztaly.id) as dolgozo_count FROM osztaly');
    $stmt->execute();
    $osztalyok = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = array();
    foreach($osztalyok as $osztaly){
        $data[] = array(
            'osztaly' => $osztaly["nev"],
            'dolgozo' => $osztaly["dolgozo_count"],
            'color' => '#' . rand(100000, 999999) . ''
        );
    }
    echo json_encode($data);
}