<?php
include ('functions.php');
$pdo = pdo_connect_mysql();
$msg = '';

if(isset($_GET["cegjegyzekszam"])){
    if (!empty($_POST)) {
        var_dump($_POST);
            $cegjegyzekszam = $_POST["cegjegyzekszam"];
            $nev = $_POST["nev"];
            $alapitas_datum = $_POST["alapitas"];
            $orszag = $_POST["orszag"];
            $iranyitoszam = $_POST["iranyitoszam"];
            $varos = $_POST["varos"];
            $utca = $_POST["utca"];
            $hazszam = $_POST["hazszam"];
            $stmt = $pdo->prepare('UPDATE `vallalat` SET `cegjegyzekszam` = ?, `nev` = ?, `alapitasi_datum` = ?, `orszag` = ?, `iranyitoszam` = ?, `varos` = ?, `utca` = ?, `hazszam` = ? WHERE `vallalat`.`cegjegyzekszam` = ?');
            if($stmt->execute([$cegjegyzekszam, $nev, $alapitas_datum, $orszag, $iranyitoszam, $varos, $utca, $hazszam, $_GET["cegjegyzekszam"]])){
                header("Location: index.php");
            }else{
                $msg = 'Sikertelen szerkesztés!';
            }
    }

    $stmt = $pdo->prepare('SELECT * FROM vallalat WHERE cegjegyzekszam = ?');
    $stmt->execute([$_GET['cegjegyzekszam']]);
    $vallalat = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$vallalat) {
        exit('Vállalat nem található ezzel a cégjegyzékszámmal!');
    }
}
?>

<?=template_header('Kezdőlap')?>

    <div class="content update">
        <h2>Vállalat szerkesztése</h2>
        <form action="edit_vallalat.php?cegjegyzekszam=<?php echo $vallalat["cegjegyzekszam"] ?>" method="post">
            <label for="cegjegyzekszam">Cégjegyzékszám</label>
            <label for="nev">Név</label>
            <input type="text" name="cegjegyzekszam" placeholder="265454654" value="<?php echo $vallalat["cegjegyzekszam"]; ?>" id="cegjegyzekszam">
            <input type="text" name="nev" placeholder="Új Kft" value="<?php echo $vallalat["nev"]; ?>" id="nev">
            <label for="alapitas">ALapitási dátum</label>
            <label for="orszag">Ország</label>
            <input type="text" name="alapitas" placeholder="0000-00-00" value="<?php echo $vallalat["alapitasi_datum"]; ?>" id="alapitas">
            <input type="text" name="orszag" placeholder="Magyarország" value="<?php echo $vallalat["orszag"]; ?>" id="orszag">
            <label for="iranyitoszam">Irányítószám</label>
            <label for="varos">Város</label>
            <input type="text" name="iranyitoszam" placeholder="6723" value="<?php echo $vallalat["iranyitoszam"]; ?>" id="iranyitoszam">
            <input type="text" name="varos" placeholder="Szeged" value="<?php echo $vallalat["varos"]; ?>" id="varos">
            <label for="utca">Utca</label>
            <label for="hazszam">Házszám</label>
            <input type="text" name="utca" placeholder="Aradi Tér"value="<?php echo $vallalat["utca"]; ?>" id="utca">
            <input type="text" name="hazszam" placeholder="1/A" value="<?php echo $vallalat["hazszam"]; ?>" id="hazszam">
            <input type="submit" value="Mentés">
        </form>
        <?php if ($msg): ?>
            <p class="error"><?=$msg?></p>
        <?php endif; ?>
    </div>

<?=template_footer()?>