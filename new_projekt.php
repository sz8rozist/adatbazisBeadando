<?php
include ('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();

if(!empty($_POST)){
    $stmt = $pdo->prepare('INSERT INTO projekt (nev, ar) VALUES (?, ?)');
    if($stmt->execute([$_POST["nev"], $_POST["ar"]])){
        header("Location: projekt.php");
    }else{
        $msg = 'Sikertelen beszúrás!';
    }
}
?>
<?=template_header('Új projekt')?>
<div class="content read">
    <div class="content update">
        <h2>Projekt hozzáadása</h2>
        <form action="new_projekt.php" method="post">
            <label for="nev">Név</label>
            <input type="text" name="nev"  id="nev">
            <label for="ar">Ár</label>
            <input type="text" name="ar" id="ar">
            <input type="submit" value="Mentés">
        </form>
        <?php if ($msg): ?>
            <p class="error"><?=$msg?></p>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>


