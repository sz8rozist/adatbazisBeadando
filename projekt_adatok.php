<?php
include('functions.php');
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])) {
    $msg = "";
    $query = $pdo->prepare("SELECT nev FROM projekt WHERE id = ?");
    $query->execute([$_GET['id']]);
    $projekt_nev = $query->fetch(PDO::FETCH_COLUMN);

    $stmt = $pdo->prepare("SELECT dolgozik.munkakor, COUNT(dolgozo.id) as dolgozok_szama FROM dolgozo, dolgozik, projekt WHERE dolgozo.id = dolgozik.dolgozo_id AND dolgozik.projekt_id = projekt.id AND projekt.id = ? GROUP BY dolgozik.munkakor ORDER BY dolgozik.kezdes_datum");
    $stmt->execute([$_GET["id"]]);
    $projekt_adatok = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dolg_query = $pdo->query("SELECT * FROM dolgozo");
    $dolg_query->execute();
    $dolgozok = $dolg_query->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST["newDolgozo"])) {
        $check_stmt = $pdo->prepare('SELECT * FROM dolgozik WHERE dolgozo_id = ?');
        $check_stmt->bindParam(1, $_POST['dolgozo_id'], PDO::PARAM_INT);
        $check_stmt->execute();
        $row = $check_stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            $stmt = $pdo->prepare('INSERT INTO dolgozik (dolgozo_id, projekt_id, munkakor, kezdes_datum) VALUES (?,?,?,?)');
            $stmt->bindParam(1, $_POST['dolgozo_id'], PDO::PARAM_INT);
            $stmt->bindParam(2, $_GET['id'], PDO::PARAM_INT);
            $stmt->bindParam(3, $_POST['munkakor'], PDO::PARAM_STR);
            $stmt->bindParam(4, $_POST['kezdes_datum'], PDO::PARAM_STR);

            $stmt->execute();
            header("Location: projekt_adatok.php?id=".$_GET['id']);

        } else {
            $msg = 'Ez a dolgozó már dolgozik a projekten!';
        }
    }
} else {
    die("Nincs projekt azonosító!");
}

?>
<?= template_header('Projekt') ?>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2><?= $projekt_nev ?> projekt adatai</h2>
            <hr>
        </div>
    </div>
    <?php if (!empty($projekt_adatok)): ?>
        <div class="accordion" id="accordionExample">
            <?php foreach ($projekt_adatok as $key => $adat): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header <?= $key ?>" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse<?= $key ?>" aria-expanded="true" aria-controls="collapseOne">
                            <?php echo $adat["munkakor"] . " - " . $adat["dolgozok_szama"] . " db"; ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $key ?>" class="accordion-collapse collapse" aria-labelledby="headingOne"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Dolgozó vezetékneve</th>
                                    <th>Dolgozó keresztneve</th>
                                    <th>Mióta dolgozik a projekten</th>
                                    <th>Művelet</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = $pdo->prepare("SELECT dolgozo.veznev, dolgozo.kernev, dolgozik.kezdes_datum, dolgozik.id as dolgozik_id FROM dolgozo, dolgozik WHERE dolgozo.id = dolgozik.dolgozo_id AND munkakor = ?");
                                $query->execute([$adat["munkakor"]]);
                                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <?php foreach ($data as $d): ?>
                                    <tr>
                                        <td><?= $d["veznev"] ?></td>
                                        <td><?= $d["kernev"] ?></td>
                                        <td><?= $d["kezdes_datum"] ?></td>
                                        <td class="text-center" style="font-size: 20px"><a href="delete.php?dolgozik_id=<?=$d['dolgozik_id']?>" class="text-danger"><i class="fas fa-trash fa-xs"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Ezen a projekten még nem dolgozik senki.</div>
    <?php endif; ?>

        <div class="card mt-5">
            <h5 class="card-header">Dolgozó hozzáadása projekthez</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <?php if (!empty($dolgozok)): ?>
                            <form action="projekt_adatok.php?id=<?= $_GET['id'] ?>" method="post">
                                <div class="mb-3">
                                    <label for="nev" class="form-label">Név</label>
                                    <select class="form-select" name="dolgozo_id" id="nev">
                                        <option value="0">Válassz dolgozót!</option>
                                        <?php foreach ($dolgozok as $dolgozo): ?>
                                            <option value="<?= $dolgozo['id'] ?>"><?= $dolgozo["veznev"] . " " . $dolgozo["kernev"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="munkakor" class="form-label">Munkakör</label>
                                    <input class="form-control" type="text" name="munkakor" id="munkakor">
                                </div>
                                <div class="mb-3">
                                    <label for="nev" class="form-label">Kezdesi dátum</label>
                                    <input class="form-control" type="date" name="kezdes_datum" id="munkakor">
                                </div>
                                <input type="submit" class="btn btn-success" name="newDolgozo" value="Mentés">
                            </form>
                            <?php if ($msg): ?>
                                <div class="alert alert-danger mt-3"><?= $msg ?></div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="alert alert-warning">Nincs dolgozó a rendszerben.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
</div>
<?= template_footer() ?>


