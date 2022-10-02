<?php
include ('functions.php');
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM vallalat');
$stmt->execute();
$vallalat = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?=template_header('Kezdőlap')?>

    <div class="content read">
        <h2>Vállalatok</h2>
        <a href="create_vallalat.php" class="create-contact">Új vállalat</a>
        <table>
            <thead>
            <tr>
                <td>Cégjegyzékszám</td>
                <td>Név</td>
                <td>Alapítás</td>
                <td>Ország</td>
                <td>Irányítószám</td>
                <td>Város</td>
                <td>Utca</td>
                <td>Házszám</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($vallalat)): ?>
            <?php foreach ($vallalat as $vallalat): ?>
                <tr data-id="<?=$vallalat["cegjegyzekszam"]?>" onclick="vallalat_detail(this)">
                    <td><?=$vallalat['cegjegyzekszam']?></td>
                    <td><?=$vallalat['nev']?></td>
                    <td><?=$vallalat['alapitasi_datum']?></td>
                    <td><?=$vallalat['orszag']?></td>
                    <td><?=$vallalat['iranyitoszam']?></td>
                    <td><?=$vallalat['varos']?></td>
                    <td><?=$vallalat['utca']?></td>
                    <td><?=$vallalat['hazszam']?></td>
                    <td class="actions">
                        <a href="edit_vallalat.php?cegjegyzekszam=<?=$vallalat['cegjegyzekszam']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete_vallalat.php?cegjegyzekszam=<?=$vallalat['cegjegyzekszam']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
<?php else: ?>
            <tr>
                <td colspan="9">Nincs rögzítve vállalat.</td>
            </tr>
<?php endif; ?>
            </tbody>
        </table>
    </div>

<?=template_footer()?>