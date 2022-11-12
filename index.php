<?php
include('functions.php');
$pdo = pdo_connect_mysql();
$perPage = 15;

$total_row = $pdo->query('SELECT osztaly.*, (SELECT COUNT(dolgozo.id) FROM dolgozo WHERE dolgozo.osztaly_id = osztaly.id) as dolgozo_count FROM osztaly')->rowCount();
$pages = ceil($total_row / $perPage);

$page = isset($_GET['page']) ? $_GET["page"] : 1;
$start = ($page - 1) * $perPage;

$query = "SELECT osztaly.*, (SELECT COUNT(dolgozo.id) FROM dolgozo WHERE dolgozo.osztaly_id = osztaly.id) as dolgozo_count FROM osztaly LIMIT $start, $perPage";
$osztalyok = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>
<?= template_header('Kezdőlap') ?>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Osztályok</h2>
            <hr>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12 text-end">
            <a class="btn btn-primary" href="new_department.php">Új osztály</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <td>Név</td>
            <td>Manager</td>
            <td>Dolgozók száma</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($osztalyok)): ?>
            <?php foreach ($osztalyok as $osztaly): ?>
                <tr>
                    <td><?= $osztaly['nev'] ?></td>
                    <td>
                        <?php
                        $manager_stmt = $pdo->prepare("SELECT dolgozo.veznev, dolgozo.kernev FROM dolgozo WHERE manager_in_osztaly = ?");
                        $manager_stmt->execute([$osztaly["id"]]);
                        $manager = $manager_stmt->fetchAll(PDO::FETCH_OBJ);
                        if ($manager) {
                            echo $manager[0]->veznev . " " . $manager[0]->kernev;
                        } else {
                            echo "Nincs manager";
                        }
                        ?>
                    </td>
                    <td><?= $osztaly['dolgozo_count'] ?></td>
                    <td class="actions">
                        <a href="edit_department.php?id=<?= $osztaly['id'] ?>" class="edit"><i
                                    class="fas fa-pen fa-xs"></i></a>
                        <a href="delete.php?osztaly_id=<?= $osztaly['id'] ?>" class="trash text-danger"><i
                                    class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">Nincs rögzítve osztály.</td>
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
    <div class="chart-container mt-5">
        <canvas id="pie_chart"></canvas>
    </div>
</div>

<?= template_footer() ?>


