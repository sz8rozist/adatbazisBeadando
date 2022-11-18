<?php
include ('functions.php');

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('SELECT osztaly.*, (SELECT COUNT(dolgozo.id) FROM dolgozo WHERE dolgozo.osztaly_id = osztaly.id) as dolgozo_count FROM osztaly');
    $stmt->execute();
    $osztalyok = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $projekt_ar = $pdo->query("SELECT osztaly.nev, (SELECT SUM(projekt.ar) FROM projekt WHERE projekt.osztaly_id = osztaly.id AND projekt.aktiv = 0) as osztaly_projekt_ar FROM osztaly;")->fetchAll(PDO::FETCH_ASSOC);

    $data = array();
    $data2 = array();
    foreach($osztalyok as $osztaly){
        $data[] = array(
            'osztaly' => $osztaly["nev"],
            'dolgozo' => $osztaly["dolgozo_count"],
            'color' => '#' . rand(100000, 999999) . ''
        );
    }
    foreach($projekt_ar as $ar){
        $data2[] = array(
            'osztaly' => $ar["nev"],
            'projekt_ar' => $ar["osztaly_projekt_ar"],
            'color' => '#' . rand(100000, 999999) . ''
        );
    }
    $response = [
        "dolgozo_count_osztaly" => $data,
        "projekt_ar_osztaly" => $data2
    ];
    echo json_encode($response);
}