<?php
include ('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
$nem = array("0" => "Nő", "1" => "Férfi");

if(isset($_GET['id'])){
    $stmt = $pdo->prepare("SELECT * FROM projekt WhERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $projekt = $stmt->fetch(PDO::FETCH_OBJ);
    if(!empty($_POST)){
        $update_stmt = $pdo->prepare("UPDATE `projekt` SET `nev` = ?, `ar` = ? WHERE `projekt`.`id` = ?");
        $update_stmt->bindParam(1, $_POST["nev"], PDO::PARAM_STR);
        $update_stmt->bindParam(2, $_POST["ar"], PDO::PARAM_STR);
        $update_stmt->bindParam(3,$_GET['id'],PDO::PARAM_INT);
        if($update_stmt->execute()){
            header("Location: projekt.php");
        }else{
            $msg = 'Sikertelen létrehozás!';
        }
    }
}
?>
<?=template_header('Projekt szerkesztés')?>
<div class="content read">
    <div class="content update">
        <h2>Projekt szerkesztése</h2>
        <form action="edit_projekt.php?id=<?=$_GET['id']?>" method="post">
            <label for="nev">Név</label>
            <input type="text" name="nev" value="<?=$projekt->nev?>" id="nev">
            <label for="ar">Ár</label>
            <input type="text" name="ar" value="<?=$projekt->ar?>" id="ar">
            <input type="submit" value="Mentés">
        </form>
        <?php if ($msg): ?>
            <p class="error"><?=$msg?></p>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>


