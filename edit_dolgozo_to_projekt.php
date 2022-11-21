<?php
include('functions.php');
$pdo = pdo_connect_mysql();
if (isset($_GET["id"])) {
    $msg = "";
    $stmt = $pdo->prepare('SELECT * FROM dolgozik WHERE id = ?');
    $stmt->execute([$_GET["id"]]);
    $dolgozik = $stmt->fetchObject();
    if(!empty($_POST)){
        if(empty($_POST["kezdes_datum"])){
            $msg .= "Minden mező kitöltése kötelező!";
        }else{
            $stmt2 = $pdo->prepare("UPDATE `dolgozik` SET `kezdes_datum`= ? WHERE dolgozik.id = ?");
            $stmt2->bindParam(1, $_POST["kezdes_datum"], PDO::PARAM_STR);
            $stmt2->bindParam(2, $_GET["id"], PDO::PARAM_INT);
            if($stmt2->execute()){
                header("location: dolgozo_to_projekt.php?projekt_id=" . $dolgozik->projekt_id);
            }
        }
    }
} else {
    header("location: projekt.php");
}
?>
<?= template_header("Dolgozó hozzárendelése projekthez") ?>
    <div class="container">
        <div class="row mt-5 mb-3">
            <div class="col-lg-12">
                <h2>Szerkesztés</h2>
                <hr>
            </div>
        </div>
        <div class="row mt-3">
            <?php if ($msg): ?>
                <div class="alert alert-danger mb-3"><?= $msg ?></div>
            <?php endif; ?>
            <div class="col-lg-4">
                <form method="post" action="edit_dolgozo_to_projekt.php?id=<?= $_GET['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label" for="kezdes_datum">Kezdés dátuma</label>
                        <input type="date" value="<?=$dolgozik->kezdes_datum?>" class="form-control" name="kezdes_datum" id="kezdes_datum">
                    </div>
                    <button type="submit" class="btn btn-success">Mentés</button>
                </form>
            </div>
        </div>
    </div>

<?= template_footer() ?>