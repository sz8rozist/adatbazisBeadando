<?php
include ('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM dolgozo');
$stmt->execute();
$dolgozok = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
    $check_stmt = $pdo->prepare('SELECT * FROM osztaly WHERE nev=?');
    $check_stmt->bindParam(1, $_POST['osztaly_nev'], PDO::PARAM_STR);
    $check_stmt->execute();
    $row = $check_stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row)
    {
            $stmt = $pdo->prepare('INSERT INTO osztaly (nev) VALUES (?)');
            $stmt->bindParam(1, $_POST['osztaly_nev'], PDO::PARAM_STR);
            $stmt->execute();
            header("Location: index.php");
        
    }else{
        $msg = 'Az osztálynév foglalt!';
    }
}
?>

<?=template_header('Új osztály')?>
<div class="content read">
    <div class="content update">
        <h2>Osztály hozzáadása</h2>
        <form action="new_department.php" method="post">
            <label for="nev">Név</label>
            <input type="text" name="osztaly_nev" placeholder="Osztály neve" id="osztaly_nev">
            <input type="submit" value="Mentés">
        </form>
        <?php if ($msg): ?>
            <p class="error"><?=$msg?></p>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>


