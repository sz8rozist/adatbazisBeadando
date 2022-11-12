<?php
include('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
$osztalyok = $pdo->query("SELECT * FROM osztaly")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST)) {
    $stmt = $pdo->prepare('INSERT INTO dolgozo (veznev, kernev, szulido, fizetes, nem, osztaly_id) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->bindParam(1, $_POST["veznev"], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST["kernev"], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST["szulido"], PDO::PARAM_STR);
    $stmt->bindParam(4, $_POST["fizetes"], PDO::PARAM_INT);
    $stmt->bindParam(5, $_POST["nem"], PDO::PARAM_INT);
    $stmt->bindParam(6, $_POST["osztaly_id"], PDO::PARAM_INT);
    if ($stmt->execute()) {
        header("Location: employe.php");
    } else {
        $msg = 'Sikertelen létrehozás!';
    }
}
?>
<?= template_header('Új dolgozó') ?>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Dolgozó hozzáadása</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <form action="new_employe.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="veznev">Vezetéknév</label>
                    <input type="text" class="form-control" name="veznev" placeholder="Kiss" id="veznev">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kernev">Keresztnév</label>
                    <input type="text" class="form-control" name="kernev" placeholder="Béla" id="kernev">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="szulido">Születési idő</label>
                    <input type="date" class="form-control" name="szulido" id="szulido">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="fizetes">Fizetés</label>
                    <input type="text" class="form-control" name="fizetes" placeholder="350000" id="fizetes">
                </div>
                <div class="mb-3">
                    <Label class="form-label" for="neme">Neme</Label>
                    <select id="neme" class="form-select" name="nem">
                        <option value="1">Férfi</option>
                        <option value="0">Nő</option>
                    </select>
                </div>
                <div class="mb-3">
                    <?php if (!empty($osztalyok)): ?>
                        <label class="form-label" for="osztaly">Osztály</label>
                        <select id="neme" class="form-select" name="osztaly_id">
                            <?php foreach ($osztalyok as $osztaly): ?>
                                <option value="<?= $osztaly['id'] ?>"><?= $osztaly['nev'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
                <button class="btn btn-success" type="submit">Mentés</button>
            </form>
        </div>
    </div>
    <?php if ($msg): ?>
        <div class="alert alert-danger"><?= $msg ?></div>
    <?php endif; ?>
</div>

<?= template_footer() ?>


