<?php
include ('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
$osztalyok = $pdo->query("SELECT * FROM osztaly")->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
            $stmt = $pdo->prepare('INSERT INTO dolgozo (veznev, kernev, szulido, fizetes, nem, osztaly_id) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bindParam(1, $_POST["veznev"], PDO::PARAM_STR);
            $stmt->bindParam(2, $_POST["kernev"], PDO::PARAM_STR);
            $stmt->bindParam(3, $_POST["szulido"],PDO::PARAM_STR);
            $stmt->bindParam(4, $_POST["fizetes"],PDO::PARAM_INT);
            $stmt->bindParam(5, $_POST["nem"],PDO::PARAM_INT);
            $stmt->bindParam(6, $_POST["osztaly_id"],PDO::PARAM_INT);
            if($stmt->execute()){
                header("Location: employe.php");
            }else{
                $msg = 'Sikertelen létrehozás!';
            }
}
?>
<?=template_header('Új dolgozó')?>
<div class="content read">
    <div class="content update">
        <h2>Dolgozó hozzáadása</h2>
        <form action="new_employe.php" method="post">
            <label for="veznev">Vezetéknév</label>
            <input type="text" name="veznev" placeholder="Kiss" id="veznev">
            <label for="kernev">Keresztnév</label>
            <input type="text" name="kernev" placeholder="Béla" id="kernev">
            <label for="szulido">Születési idő</label>
            <input type="date" name="szulido"  id="szulido">
            <label for="fizetes">Fizetés</label>
            <input type="text" name="fizetes" placeholder="350000" id="fizetes">
            <Label for="neme">Neme</Label>
            <select id="neme" name="nem">
                <option value="1">Férfi</option>
                <option value="0">Nő</option>
            </select>
            <?php if(!empty($osztalyok)): ?>
            <label for="osztaly">Osztály</label>
                <select id="neme" name="osztaly_id">
                    <?php foreach($osztalyok as $osztaly): ?>
                    <option value="<?=$osztaly['id']?>"><?=$osztaly['nev']?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <input type="submit" value="Mentés">
        </form>
        <?php if ($msg): ?>
            <p class="error"><?=$msg?></p>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>


