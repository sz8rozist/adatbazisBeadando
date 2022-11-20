<?php
include('functions.php');
$pdo = pdo_connect_mysql();
$perPage = 15;

$total_row = $pdo->query('SELECT projekt.* FROM projekt')->rowCount();
$pages = ceil($total_row / $perPage);

$page = isset($_GET['page']) ? $_GET["page"] : 1;
$start = ($page - 1) * $perPage;

$query = "SELECT projekt.* FROM projekt LIMIT $start, $perPage";
$projektek = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

?>
<?= template_header('Projekt') ?>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Projektek</h2>
            <hr>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12 text-end">
            <a class="btn btn-primary" href="new_projekt.php">Új projekt</a>
        </div>
    </div>
    <table id="projekt_table" class="table table-bordered">
        <thead>
        <tr>
            <th>Név</th>
            <th>Ár</th>
            <th>Osztály</th>
            <th>Aktív</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($projektek)): ?>
            <?php foreach ($projektek as $projekt): ?>
                <tr data-id="<?= $projekt['id'] ?>" onclick="selectProjekt(this)">
                    <td><?= $projekt['nev'] ?></td>
                    <td><?= $projekt['ar'] ?></td>
                    <td><?php
                        $stmt = $pdo->prepare("SELECT osztaly.nev FROM osztaly WHERE osztaly.id = ?");
                        $stmt->execute([$projekt["osztaly_id"]]);
                        $osztaly = $stmt->fetchColumn();
                        if ($osztaly) {
                            echo $osztaly;
                        } else {
                            echo "Nincs megadva osztály";
                        }
                        ?></td>
                    <td><?= $projekt['aktiv'] == 1 ? '<i style="color: green" class="fas fa-check-circle"></i>' : '<i style="color: red" class="fas fa-times"></i>' ?></td>
                    <td class="actions">
                        <a href="edit_projekt.php?id=<?= $projekt['id'] ?>" class="edit"><i
                                    class="fas fa-pen fa-xs"></i></a>
                        <a href="delete.php?projekt_id=<?= $projekt['id'] ?>" class="trash text-danger"><i
                                    class="fas fa-trash fa-xs"></i></a>
                        <?php $dolgozo_count = $pdo->query('SELECT * FROM dolgozo')->rowCount();
                        if ($dolgozo_count > 0) {
                            ?>
                            <a href="dolgozo_to_projekt.php?projekt_id=<?= $projekt['id'] ?>"
                               class="trash text-success"><i class="fas fa-user fa-xs"></i></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">Nincs rögzítve projekt.</td>
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


