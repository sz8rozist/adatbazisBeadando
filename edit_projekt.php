<?php
include ('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
$nem = array("0" => "Nő", "1" => "Férfi");

if(isset($_GET['id'])){
    $stmt = $pdo->prepare("SELECT * FROM projekt WhERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $projekt = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty($_POST)){
        if(empty($_POST["nev"]) && empty($_POST["ar"])){
            $msg .= "Minden mező kitöltése kötelező!";
        }else{
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
}
?>
<?=template_header('Projekt szerkesztés')?>
<<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Projekt szerkesztése</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <?php if ($msg): ?>
            <div class="alert alert-danger mb-3"><?= $msg ?></div>
        <?php endif; ?>
        <div class="col-lg-4">
            <form action="edit_projekt.php?id=<?= $_GET['id'] ?>" method="post">
                <div class="mb-3">
                    <label for="nev" class="form-label">Név</label>
                    <input type="text" name="nev" class="form-control" value="<?= $projekt['nev'] ?>" id="nev">
                </div>
                <div class="mb-3">
                    <label for="ar" class="form-label">Név</label>
                    <input type="text" name="ar" class="form-control" value="<?= $projekt['ar'] ?>" id="ar">
                </div>
                <button type="submit" class="btn btn-success">Mentés</button>
            </form>
        </div>
    </div>
</div>

<?=template_footer()?>


