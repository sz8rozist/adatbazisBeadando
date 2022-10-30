<?php
include ('functions.php');
$pdo = pdo_connect_mysql();
$perPage = 15;

$total_row = $pdo->query('SELECT osztaly.id, osztaly.nev, dolgozo.veznev, dolgozo.kernev, (SELECT COUNT(dolgozo.id) FROM dolgozo WHERE dolgozo.osztaly_id = osztaly.id) as dolgozo_count FROM osztaly INNER JOIN dolgozo ON osztaly.manager_azonosito = dolgozo.id')->rowCount();
$pages = ceil($total_row / $perPage);

$page = isset($_GET['page']) ? $_GET["page"] : 1;
$start = ($page - 1) * $perPage;

$query = "SELECT osztaly.id, osztaly.nev, dolgozo.veznev, dolgozo.kernev, (SELECT COUNT(dolgozo.id) FROM dolgozo WHERE dolgozo.osztaly_id = osztaly.id) as dolgozo_count FROM osztaly INNER JOIN dolgozo ON osztaly.manager_azonosito = dolgozo.id LIMIT $start,$perPage";
$osztalyok = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

?>
<?=template_header('Kezdőlap')?>
    <div class="content read">
        <h2>Osztályok</h2>
        <a href="new_department.php" class="create-contact">Új osztály</a>
        <table>
            <thead>
            <tr>
                <td>Név</td>
                <td>Manager</td>
                <td>Dolgozók száma</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($osztalyok)): ?>
            <?php foreach ($osztalyok as $osztaly): ?>
                <tr>
                    <td><?=$osztaly['nev']?></td>
                    <td><?=$osztaly['veznev']. " ". $osztaly['kernev']?></td>
                    <td><?=$osztaly['dolgozo_count']?></td>
                    <td class="actions">
                        <a href="edit_department.php?id=<?=$osztaly['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete.php?osztaly_id=<?=$osztaly['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
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
        <div class="pagination">
        <?php for ($i = 1; $i <= $pages ; $i++):?>
            <a <?php echo ($i == $page) ? "class='active'" : "" ?> href='<?php echo "?page=$i"; ?>'>
                <?php  echo $i; ?>
            </a>
        <?php endfor; ?>
        </div>
        <div class="chart-container">
            <canvas id="pie_chart"></canvas>
        </div>
    </div>

<?=template_footer()?>


