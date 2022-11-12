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
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Dolgozó szerkesztése</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <form action="edit_employe.php?id=<?=$_GET['id']?>" method="post">
                <div class="mb-3">
                    <label class="form-label" for="veznev">Vezetéknév</label>
                    <input type="text" class="form-control" name="veznev" value="<?=$dolgozo->veznev?>" id="veznev">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kernev">Keresztnév</label>
                    <input type="text" class="form-control" name="kernev" value="<?=$dolgozo->kernev?>" id="kernev">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="szulido">Születési idő</label>
                    <input type="date" class="form-control" name="szulido" value="<?=$dolgozo->szulido?>"  id="szulido">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="fizetes">Fizetés</label>
                    <input type="text" class="form-control" name="fizetes" value="<?=$dolgozo->fizetes?>" id="fizetes">
                </div>
                <div class="mb-3">
                    <Label class="form-label" for="neme">Neme</Label>
                    <select id="neme" class="form-select" name="nem">
                        <?php for($i = 0; $i<=count($nem); $i++): ?>
                            <option <?=($i == $dolgozo->nem)?"selected":""?> value="<?=$i?>"><?=$nem[$i]?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <?php if(!empty($osztalyok)): ?>
                    <div class="mb-3">
                        <label for="osztaly" class="form-label">Osztály</label>
                        <select class="form-select" id="neme" name="osztaly_id">
                            <option value="0">Nincs osztály</option>
                            <?php foreach($osztalyok as $osztaly): ?>
                                <option <?=($osztaly['id'] == $dolgozo->osztaly_id)?"selected":""?> value="<?=$osztaly['id']?>"><?=$osztaly['nev']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <button class="btn btn-success" type="submit">Mentés</button>
            </form>
        </div>
    </div>
        <?php if ($msg): ?>
            <div class="alert alert-danger"><?=$msg?></div>
        <?php endif; ?>
</div>

<?=template_footer()?>


