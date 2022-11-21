<?php
include ('functions.php');
$pdo = pdo_connect_mysql();
if(isset($_GET["projekt_id"])){
    $stmt = $pdo->prepare("SELECT projekt.nev, projekt.id FROM projekt WHERE projekt.id = ?");
    $stmt->execute([$_GET["projekt_id"]]);
    $projekt = $stmt->fetchObject();

    $dolgozok_stmt = $pdo->prepare("SELECT dolgozo.veznev, dolgozo.kernev, dolgozik.kezdes_datum, dolgozik.projekt_id as projektid, dolgozik.id as dolgozikid FROM dolgozo, dolgozik WHERE dolgozo.id = dolgozik.dolgozo_id AND dolgozik.projekt_id = ?");
    $dolgozok_stmt->execute([$_GET["projekt_id"]]);
    $dolgozok = $dolgozok_stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
    header("location: projekt.php");
}
?>

<?=template_header("Dolgozó hozzárendelése projekthez")?>
<div class="container">
<div class="row mt-5 mb-3">
    <div class="col-lg-12">
        <h2><?=$projekt->nev?> dolgozói</h2>
        <hr>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-12 text-end">
        <a class="btn btn-primary" href="new_dolgozo_to_projekt.php?projekt_id=<?=$projekt->id?>">Dolgozó hozzárendelése</a>
    </div>
</div>
<table id="projekt_table" class="table table-bordered">
    <thead>
    <tr>
        <th>Vezetéknév</th>
        <th>Keresztnév</th>
        <th>Mióta</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($dolgozok)): ?>
        <?php foreach ($dolgozok as $projekt): ?>
            <tr">
                <td><?=$projekt['veznev']?></td>
            <td><?=$projekt['kernev']?></td>
                <td><?=$projekt['kezdes_datum']?></td>
                <td class="actions">
                    <a href="edit_dolgozo_to_projekt.php?id=<?=$projekt['dolgozikid']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?dolgozik_id=<?=$projekt['dolgozikid']?>" class="trash text-danger"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="9">Nincs rögzítve dolgozó ehhez a projekthez.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</div>

<?=template_footer()?>
