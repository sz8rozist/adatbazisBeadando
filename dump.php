<?php
include('functions.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$pdo = pdo_connect_mysql();

$query = $pdo->query("SELECT osztaly.manager_id, osztaly.nev, (SELECT COUNT(dolgozo.id) FROM dolgozo WHERE dolgozo.osztaly_id = osztaly.id) as dolgozo_count FROM osztaly");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $key => $row){
    $q = $pdo->prepare("SELECT dolgozo.veznev, dolgozo.kernev FROM dolgozo WHERE dolgozo.id = ?");
    $q->execute([$row["manager_id"]]);
    $res = $q->fetchObject();
    $result[$key]["manager"] = $res->veznev . " " . $res->kernev;
    unset($result[$key]["manager_id"]);
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->fromArray(array("Osztály", "Dolgozók száma", "Manager"), NULL, 'A1');
$sheet->fromArray($result, NULL, 'A2');
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save("export/export.xlsx");
header("location: department.php");

