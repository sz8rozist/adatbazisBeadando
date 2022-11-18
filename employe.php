<?php
include('functions.php');
$pdo = pdo_connect_mysql();
$perPage = 15;

$total_row = $pdo->query('SELECT dolgozo.* FROM dolgozo')->rowCount();
$pages = ceil($total_row / $perPage);

$page = isset($_GET['page']) ? $_GET["page"] : 1;
$start = ($page - 1) * $perPage;

$query = "SELECT dolgozo.* FROM dolgozo LIMIT $start,$perPage";
$dolgozok = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

?>
<?= template_header('Dolgozók') ?>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Dolgozók</h2>
            <hr>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12 text-end">
            <a class="btn btn-primary" href="new_employe.php">Új dolgozó</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Profilkép</th>
            <th>Vezetéknév</th>
            <th>Keresztnév</th>
            <th>Nem</th>
            <th>Születési idő</th>
            <th>Fizetés</th>
            <th>Munkakör</th>
            <th>Osztály</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($dolgozok)): ?>
            <?php foreach ($dolgozok as $dolgozo): ?>
                <tr>
                    <td><img alt="profile" class="profileimg" src="<?php echo (empty($dolgozo["profilkep"])) ? "./img/profileavatar.webp" : "./profileimg/".$dolgozo["profilkep"]; ?>"></td>
                    <td><?= $dolgozo['veznev'] ?></td>
                    <td><?= $dolgozo['kernev'] ?></td>
                    <td><?= ($dolgozo['nem'] == 0) ? "Nő" : "Férfi" ?></td>
                    <td><?= $dolgozo['szulido'] ?></td>
                    <td><?= $dolgozo['fizetes'] ?></td>
                    <td><?= $dolgozo['munkakor'] ?></td>
                    <td>
                        <?php
                        $stmt = $pdo->prepare("SELECT osztaly.nev FROM osztaly WHERE osztaly.id = ?");
                        $stmt->execute([$dolgozo["osztaly_id"]]);
                        $osztaly = $stmt->fetchColumn();
                        if ($osztaly) {
                            echo $osztaly;
                        } else {
                            echo "Nincs megadva osztály";
                        }
                        ?>
                    </td>
                    <td class="actions">
                        <a href="edit_employe.php?id=<?= $dolgozo['id'] ?>" class="edit"><i
                                    class="fas fa-pen fa-xs"></i></a>
                        <a href="delete.php?dolgozo_id=<?= $dolgozo['id'] ?>" class="trash text-danger"><i
                                    class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">Nincs rögzítve dolgozó.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li class="page-item<?php echo ($i == $page) ? " active" : "" ?>"><a class="page-link"
                                                                                 href='<?php echo "?page=$i"; ?>'>
                    <?php echo $i; ?>
                </a></li>
        <?php endfor; ?>
    </ul>
</div>

<?= template_footer() ?>
