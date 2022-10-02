<?php
include ('functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    if(!empty($_POST["cegjegyzekszam"]) && !empty($_POST["nev"]) && !empty($_POST["alapitas"]) && !empty($_POST["orszag"]) && !empty($_POST["iranyitoszam"]) && !empty($_POST["varos"]) && !empty($_POST["utca"]) && !empty($_POST["hazszam"])){
        $cegjegyzekszam = $_POST["cegjegyzekszam"];
        $nev = $_POST["nev"];
        $alapitas_datum = $_POST["alapitas"];
        $orszag = $_POST["orszag"];
        $iranyitoszam = $_POST["iranyitoszam"];
        $varos = $_POST["varos"];
        $utca = $_POST["utca"];
        $hazszam = $_POST["hazszam"];
        $stmt = $pdo->prepare('INSERT INTO vallalat VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        if($stmt->execute([$cegjegyzekszam, $nev, $alapitas_datum, $orszag, $iranyitoszam, $varos, $utca, $hazszam])){
            header("Location: index.php");
        }else{
            $msg = 'Sikertelen létrehozás!';
        }
    }else{
        $msg = 'Minden mező kitöltése kötelező!';
    }
}
?>

<?=template_header('Kezdőlap')?>

    <div class="content update">
        <h2>Vállalat hozzáadása</h2>
        <form action="create_vallalat.php" method="post">
            <label for="cegjegyzekszam">Cégjegyzékszám</label>
            <label for="nev">Név</label>
            <input type="text" name="cegjegyzekszam" placeholder="265454654" id="cegjegyzekszam">
            <input type="text" name="nev" placeholder="Új Kft"  id="nev">
            <label for="alapitas">ALapitási dátum</label>
            <label for="orszag">Ország</label>
            <input type="text" name="alapitas" placeholder="0000-00-00"  id="alapitas">
            <input type="text" name="orszag" placeholder="Magyarország"  id="orszag">
            <label for="iranyitoszam">Irányítószám</label>
            <label for="varos">Város</label>
            <input type="text" name="iranyitoszam" placeholder="6723"  id="iranyitoszam">
            <input type="text" name="varos" placeholder="Szeged"  id="varos">
            <label for="utca">Utca</label>
            <label for="hazszam">Házszám</label>
            <input type="text" name="utca" placeholder="Aradi Tér" id="utca">
            <input type="text" name="hazszam" placeholder="1/A" id="hazszam">
            <input type="submit" value="Mentés">
        </form>
        <?php if ($msg): ?>
            <p class="error"><?=$msg?></p>
        <?php endif; ?>
    </div>

<?=template_footer()?>