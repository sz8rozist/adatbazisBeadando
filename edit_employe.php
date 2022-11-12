<?php
include ('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
$nem = array("0" => "Nő", "1" => "Férfi");

if(isset($_GET['id'])){
    $osztalyok = $pdo->query("SELECT * FROM osztaly")->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare("SELECT dolgozo.* FROM dolgozo WhERE dolgozo.id = ?");
    $stmt->execute([$_GET["id"]]);
    $dolgozo = $stmt->fetch(PDO::FETCH_OBJ);
    if(!empty($_POST)){
        $update_stmt = $pdo->prepare("UPDATE `dolgozo` SET `veznev` = ?, `kernev` = ?, `nem` = ?, `szulido` = ?, `fizetes` = ?, `osztaly_id` = ? WHERE `dolgozo`.`id` = ?");
        $update_stmt->bindParam(1, $_POST["veznev"], PDO::PARAM_STR);
        $update_stmt->bindParam(2, $_POST["kernev"], PDO::PARAM_STR);
        $update_stmt ->bindParam(4, $_POST["szulido"],PDO::PARAM_STR);
        $update_stmt ->bindParam(5, $_POST["fizetes"],PDO::PARAM_INT);
        $update_stmt ->bindParam(3, $_POST["nem"],PDO::PARAM_INT);
        $update_stmt ->bindParam(6, $_POST["osztaly_id"],PDO::PARAM_INT);
        $update_stmt->bindParam(7,$_GET['id'],PDO::PARAM_INT);
        if($update_stmt->execute()){
            header("Location: employe.php");
        }else{
            $msg = 'Sikertelen létrehozás!';
        }
    }
}
?>
<?=template_header('Dolgozó szerkesztés')?>
<div class="content read">
    <div class="content update">
        <h2>Dolgozó szerkesztése</h2>
        <form action="edit_employe.php?id=<?=$_GET['id']?>" method="post">
            <label for="veznev">Vezetéknév</label>
            <input type="text" name="veznev" value="<?=$dolgozo->veznev?>" id="veznev">
            <label for="kernev">Keresztnév</label>
            <input type="text" name="kernev" value="<?=$dolgozo->kernev?>" id="kernev">
            <label for="szulido">Születési idő</label>
            <input type="date" name="szulido" value="<?=$dolgozo->szulido?>"  id="szulido">
            <label for="fizetes">Fizetés</label>
            <input type="text" name="fizetes" value="<?=$dolgozo->fizetes?>" id="fizetes">
            <Label for="neme">Neme</Label>
            <select id="neme" name="nem">
                <?php for($i = 0; $i<=count($nem); $i++): ?>
                    <option <?=($i == $dolgozo->nem)?"selected":""?> value="<?=$i?>"><?=$nem[$i]?></option>
                <?php endfor; ?>
            </select>
            <?php if(!empty($osztalyok)): ?>
                <label for="osztaly">Osztály</label>
                <select id="neme" name="osztaly_id">
                    <option value="0">Nincs osztály</option>
                    <?php foreach($osztalyok as $osztaly): ?>
                        <option <?=($osztaly['id'] == $dolgozo->osztaly_id)?"selected":""?> value="<?=$osztaly['id']?>"><?=$osztaly['nev']?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <input type="submit" value="Mentés">
        </form>
        <?php if ($msg): ?>
            <p class="error"><?=$msg?></p>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>


