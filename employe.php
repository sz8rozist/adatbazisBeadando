<?php
include ('functions.php');
$pdo = pdo_connect_mysql();
$perPage = 15;

$total_row = $pdo->query('SELECT dolgozo.*, osztaly.nev FROM dolgozo INNER JOIN osztaly ON dolgozo.osztaly_id = osztaly.id')->rowCount();
$pages = ceil($total_row / $perPage);

$page = isset($_GET['page']) ? $_GET["page"] : 1;
$start = ($page - 1) * $perPage;

$query = "SELECT dolgozo.*, osztaly.nev as osztaly FROM dolgozo INNER JOIN osztaly ON dolgozo.osztaly_id = osztaly.id LIMIT $start,$perPage";
$dolgozok = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

?>
<?=template_header('Dolgozók')?>
    <div class="content read">
        <h2>Dolgozók</h2>
        <a href="new_employe.php" class="create-contact">Új dolgozó</a>
        <table>
            <thead>
            <tr>
                <td>Vezetéknév</td>
                <td>Keresztnév</td>
                <td>Nem</td>
                <td>Születési idő</td>
                <td>Fizetés</td>
                <td>Osztály</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($dolgozok)): ?>
                <?php foreach ($dolgozok as $dolgozo): ?>
                    <tr>
                        <td><?=$dolgozo['veznev']?></td>
                        <td><?=$dolgozo['kernev']?></td>
                        <td><?=($dolgozo['nem'] == 0) ? "Nő" : "Férfi"?></td>
                        <td><?=$dolgozo['szulido']?></td>
                        <td><?=$dolgozo['fizetes']?></td>
                        <td><?=$dolgozo['osztaly']?></td>
                        <td class="actions">
                            <a href="edit_employe.php?id=<?=$dolgozo['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                            <a href="delete.php?dolgozo_id=<?=$dolgozo['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
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
        <div class="pagination">
                <?php for ($i = 1; $i <= $pages ; $i++):?>
                    <a <?php echo ($i == $page) ? "class='active'" : "" ?> href='<?php echo "?page=$i"; ?>'>
                        <?php  echo $i; ?>
                    </a>
                <?php endfor; ?>
        </div>
    </div>

<?=template_footer()?>
