<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['cegjegyzekszam'])) {
    $stmt = $pdo->prepare('SELECT * FROM vallalat WHERE cegjegyzekszam = ?');
    $stmt->execute([$_GET['cegjegyzekszam']]);
    $vallalat = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$vallalat) {
        exit('Vállalat nem található ezzel a cégjegyzékszámmal!');
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM vallalat WHERE cegjegyzekszam = ?');
            $stmt->execute([$_GET['cegjegyzekszam']]);
            $msg = 'Sikeresen törölted a vállalatot!';
        } else {
            header('Location: index.php');
            exit;
        }
    }
} else {
    exit('Nincs megadva cégjegyzékszám!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
    <h2>Vállalat törlés  #<?=$vallalat['nev']?></h2>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php else: ?>
        <p>Biztos benne hogy törli a vállalatot #<?=$vallalat['nev']?>?</p>
        <div class="yesno">
            <a href="delete_vallalat.php?cegjegyzekszam=<?=$vallalat['cegjegyzekszam']?>&confirm=yes">Yes</a>
            <a href="delete_vallalat.php?cegjegyzekszam=<?=$vallalat['cegjegyzekszam']?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?=template_footer()?>


