<?php
if(!isset($_GET["cegjegyzekszam"])) header("Location: index.php");
include ('functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
?>

<?=template_header('Vállalat adatok')?>
    <div class="content update">
        <h2>Vállalat adatok</h2>


    </div>

<?=template_footer()?>