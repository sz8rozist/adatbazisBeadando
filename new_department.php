<?php
include ('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM dolgozo');
$stmt->execute();
$dolgozok = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
    $osztaly_nev = $_POST['osztaly_nev'];
    $manager_id = $_POST['manager_id'];
    $check_stmt = $pdo->prepare('SELECT * FROM osztaly WHERE nev=?');
    $check_stmt->bindParam(1, $osztaly_nev, PDO::PARAM_STR);
    $check_stmt->execute();
    $row = $check_stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row)
    {
        if($manager_id != 0){
            $stmt = $pdo->prepare('INSERT INTO osztaly (nev, manager_azonosito) VALUES (?, ?)');
            $stmt->bindParam(1, $osztaly_nev, PDO::PARAM_STR);
            $stmt ->bindParam(2, $manager_id,PDO::PARAM_INT);
            if($stmt->execute()){
                header("Location: index.php");
            }else{
                $msg = 'Sikertelen létrehozás!';
            }
        }else{
            $msg = 'Válassz managert!!';
        }
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
            <?php if(!empty($dolgozok)): ?>
            <label for="manager">Manager</label>
            <?php endif; ?>
            <input type="text" name="osztaly_nev" placeholder="Osztály neve" id="osztaly_nev">
            <?php if(!empty($dolgozok)): ?>
            <select name="manager_id">
                <option value="0">Válasszon managert!</option>
                <?php foreach($dolgozok as $dolgozo): ?>
                <option value="<?=$dolgozo['id']?>"><?=$dolgozo['veznev']." ".$dolgozo['kernev']?></option>
                <?php endforeach ?>
            </select>
            <?php else: ?>
            <p>Nincs dolgozó a rendszerben.</p>
            <?php endif; ?>
            <input type="submit" value="Mentés">
        </form>
        <?php if ($msg): ?>
            <p class="error"><?=$msg?></p>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>

