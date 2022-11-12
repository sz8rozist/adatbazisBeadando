<?php
include('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM dolgozo');
    $stmt->execute();
    $dolgozok = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $osztaly_stmt = $pdo->prepare("SELECT osztaly.id, osztaly.nev FROM osztaly WHERE osztaly.id = ?");
    $osztaly_stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
    $osztaly_stmt->execute();
    $osztaly = $osztaly_stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($_POST)) {
        $stmt = $pdo->prepare('UPDATE `osztaly` SET `nev` = ? WHERE `osztaly`.`id` = ?');
        $stmt->bindParam(1, $_POST["osztaly_nev"], PDO::PARAM_STR);
        $stmt->bindParam(2, $_GET['id'], PDO::PARAM_INT);
        if ($_POST["manager_id"] == 0 && $stmt->execute()) {
            header("Location: index.php");
        } else if ($_POST["manager_id"] != 0 && $stmt->execute()) {
            $update_manager = $pdo->prepare("UPDATE `dolgozo` SET `manager_in_osztaly` = ? WHERE `dolgozo`.`id` = ?");
            $update_manager->bindParam(1, $_GET["id"], PDO::PARAM_INT);
            $update_manager->bindParam(2, $_POST['manager_id'], PDO::PARAM_INT);
            if ($update_manager->execute()) {
                header("Location: index.php");
            }
        }
    }
}
?>
<?= template_header('Osztály szerkesztése') ?>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Osztály szerkesztése</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <form action="edit_department.php?id=<?= $_GET['id'] ?>" method="post">
                <div class="mb-3">
                    <label for="nev" class="form-label">Név</label>
                    <input type="text" name="osztaly_nev" class="form-control" value="<?= $osztaly['nev'] ?>"
                           id="osztaly_nev">
                </div>
                <?php if (!empty($dolgozok)): ?>
                    <div class="mb-3">
                        <label for="manager" class="form-label">Manager</label>
                        <select name="manager_id" class="form-select">
                            <option value="0">Nincs manager</option>
                            <?php foreach ($dolgozok as $dolgozo): ?>
                                <option value="<?= $dolgozo['id'] ?>"><?= $dolgozo['veznev'] . " " . $dolgozo['kernev'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                <?php else: ?>
                    <p>Nincs dolgozó a rendszerben.</p>
                <?php endif; ?>
                <button type="submit" class="btn btn-success">Mentés</button>
            </form>
        </div>
    </div>
    <?php if ($msg): ?>
        <div class="alert alert-danger"><?= $msg ?></div>
    <?php endif; ?>
</div>

<?= template_footer() ?>


