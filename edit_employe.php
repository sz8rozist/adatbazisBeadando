<?php
include('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
$nem = array("0" => "Nő", "1" => "Férfi");

if (isset($_GET['id'])) {
    $osztalyok = $pdo->query("SELECT * FROM osztaly")->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare("SELECT dolgozo.* FROM dolgozo WhERE dolgozo.id = ?");
    $stmt->execute([$_GET["id"]]);
    $dolgozo = $stmt->fetch(PDO::FETCH_OBJ);

    if (!empty($_POST)) {
        if (empty($_POST["veznev"]) && empty($_POST["kernev"]) && empty($_POST['szulido']) && empty($_POST['fizetes']) && empty($_POST['munkakor'])) {
            $msg .= "Minden mező kitöltése kötelező!";
        } else {
            if (isset($_FILES["profilkep"])) {
                $profileImageName = time() . '_' . $_FILES["profilkep"]["name"];
                $target = 'profileimg/' . $profileImageName;
                if (!move_uploaded_file($_FILES["profilkep"]["tmp_name"], $target)) {
                    $msg .= "Hiba történt a képfeltöltés során!";
                    exit;
                } else {
                    unlink("profileimg/" . $dolgozo->profilkep);
                }
            }
            $update_stmt = $pdo->prepare("UPDATE `dolgozo` SET `veznev` = ?, `kernev` = ?, `nem` = ?, `szulido` = ?, `fizetes` = ?, `osztaly_id` = ?, `profilkep` = ?, `munkakor` = ? WHERE `dolgozo`.`id` = ?");
            $update_stmt->bindParam(1, $_POST["veznev"], PDO::PARAM_STR);
            $update_stmt->bindParam(2, $_POST["kernev"], PDO::PARAM_STR);
            $update_stmt->bindParam(4, $_POST["szulido"], PDO::PARAM_STR);
            $update_stmt->bindParam(5, $_POST["fizetes"], PDO::PARAM_INT);
            $update_stmt->bindParam(3, $_POST["nem"], PDO::PARAM_INT);
            $update_stmt->bindParam(6, $_POST["osztaly_id"], PDO::PARAM_INT);
            $update_stmt->bindParam(7, $profileImageName, PDO::PARAM_STR);
            $update_stmt->bindParam(8, $_POST['munkakor'], PDO::PARAM_STR);
            $update_stmt->bindParam(9, $_GET['id'], PDO::PARAM_INT);
            if ($update_stmt->execute()) {
                header("Location: employe.php");
            } else {
                $msg = 'Sikertelen létrehozás!';
            }
        }

    }
}
?>
<?= template_header('Dolgozó szerkesztés') ?>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Dolgozó szerkesztése</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <?php if ($msg): ?>
            <div class="alert alert-danger mb-3"><?= $msg ?></div>
        <?php endif; ?>
        <div class="col-lg-4">
            <form action="edit_employe.php?id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                <img alt="profile" style="width : 50%; border-radius: 50%; text-align: center" class="mb-3"
                     src="<?php echo (empty($dolgozo->profilkep)) ? "./img/profileavatar.webp" : "./profileimg/" . $dolgozo->profilkep; ?>">
                <div class="mb-3">
                    <label class="form-label" for="profilkep">Profilkép</label>
                    <input type="file" name="profilkep" id="profilkep">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="veznev">Vezetéknév</label>
                    <input type="text" class="form-control" name="veznev" value="<?= $dolgozo->veznev ?>" id="veznev">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kernev">Keresztnév</label>
                    <input type="text" class="form-control" name="kernev" value="<?= $dolgozo->kernev ?>" id="kernev">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="szulido">Születési idő</label>
                    <input type="date" class="form-control" name="szulido" value="<?= $dolgozo->szulido ?>"
                           id="szulido">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="fizetes">Fizetés</label>
                    <input type="text" class="form-control" name="fizetes" value="<?= $dolgozo->fizetes ?>"
                           id="fizetes">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="munkakor">Munkakör</label>
                    <input type="text" class="form-control" name="munkakor" value="<?= $dolgozo->munkakor ?>"
                           id="munkakor">
                </div>
                <div class="mb-3">
                    <Label class="form-label" for="neme">Neme</Label>
                    <select id="neme" class="form-select" name="nem">
                        <?php for ($i = 0; $i <= count($nem); $i++): ?>
                            <option <?= ($i == $dolgozo->nem) ? "selected" : "" ?>
                                    value="<?= $i ?>"><?= $nem[$i] ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <?php if (!empty($osztalyok)): ?>
                    <div class="mb-3">
                        <label for="osztaly" class="form-label">Osztály</label>
                        <select class="form-select" id="neme" name="osztaly_id">
                            <option value="0">Nincs osztály</option>
                            <?php foreach ($osztalyok as $osztaly): ?>
                                <option <?= ($osztaly['id'] == $dolgozo->osztaly_id) ? "selected" : "" ?>
                                        value="<?= $osztaly['id'] ?>"><?= $osztaly['nev'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <button class="btn btn-success" type="submit">Mentés</button>
            </form>
        </div>
    </div>
</div>

<?= template_footer() ?>


