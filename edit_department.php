<?php
include ('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
if(isset($_GET['id'])){
    $stmt = $pdo->prepare('SELECT * FROM dolgozo');
    $stmt->execute();
    $dolgozok = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $osztaly_stmt = $pdo->prepare("SELECT osztaly.id, osztaly.nev FROM osztaly WHERE osztaly.id = ?");
    $osztaly_stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
    $osztaly_stmt->execute();
    $osztaly = $osztaly_stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($_POST)){
        $stmt = $pdo->prepare('UPDATE `osztaly` SET `nev` = ? WHERE `osztaly`.`id` = ?');
        $stmt->bindParam(1, $_POST["osztaly_nev"], PDO::PARAM_STR);
        $stmt->bindParam(2,$_GET['id'], PDO::PARAM_INT);
        if($_POST["manager_id"] == 0 && $stmt->execute()){
            header("Location: index.php");
        }else if($_POST["manager_id"] != 0 && $stmt->execute()){
            $update_manager = $pdo->prepare("UPDATE `dolgozo` SET `manager_in_osztaly` = ? WHERE `dolgozo`.`id` = ?");
            $update_manager->bindParam(1, $_GET["id"], PDO::PARAM_INT);
            $update_manager->bindParam(2,$_POST['manager_id'], PDO::PARAM_INT);
            if($update_manager->execute()){
                header("Location: index.php");
            }
        }
    }
}
?>
<?=template_header('Osztály szerkesztése')?>
<div class="content read">
    <div class="content update">
        <h2>Osztály szerkesztés</h2>
        <form action="edit_department.php?id=<?=$_GET['id']?>" method="post">
            <label for="nev">Név</label>
            <input type="text" name="osztaly_nev" placeholder="Osztály neve" value="<?=$osztaly['nev']?>" id="osztaly_nev">
            <?php if(!empty($dolgozok)): ?>
                <label for="manager">Manager</label>
            <?php endif; ?>
            <?php if(!empty($dolgozok)): ?>
                <select name="manager_id">
                    <option value="0">Válasszon managert!</option>
                    <?php foreach($dolgozok as $dolgozo): ?>
                        <option value="<?=$dolgozo['id']?>"><?=$dolgozo['veznev']." ".$dolgozo['kernev']?></option>
                    <?php endforeach ?>
                </select>
            <?php else: ?>
                <p>Nincs dolgozó a rendszerben.</p>
            <?php endif; ?>
            <input type="submit" value="Mentés">
        </form>
        <?php if ($msg): ?>
            <p class="error"><?=$msg?></p>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>


