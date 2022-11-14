<?php
include ('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM dolgozo');
$stmt->execute();
$dolgozok = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
    if(empty($_POST["osztaly_nev"])){
        $msg .= "Minden mező kitöltése kötelező!";
    }else{
        $check_stmt = $pdo->prepare('SELECT * FROM osztaly WHERE nev=?');
        $check_stmt->bindParam(1, $_POST['osztaly_nev'], PDO::PARAM_STR);
        $check_stmt->execute();
        $row = $check_stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row)
        {
            $stmt = $pdo->prepare('INSERT INTO osztaly (nev) VALUES (?)');
            $stmt->bindParam(1, $_POST['osztaly_nev'], PDO::PARAM_STR);
            $stmt->execute();
            header("Location: department.php");

        }else{
            $msg = 'Az osztálynév foglalt!';
        }
    }

}
?>

<?=template_header('Új osztály')?>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Osztály hozzáadása</h2>
            <hr>
        </div>
    </div>
    <div class="row mt-3">
        <?php if ($msg): ?>
            <div class="alert alert-danger mb-3"><?=$msg?></div>
        <?php endif; ?>
        <div class="col-lg-4">
            <form method="post" action="new_department.php">
                <div class="mb-3">
                    <label for="nev" class="form-label">Név</label>
                    <input type="text" class="form-control" name="osztaly_nev" id="nev">
                </div>
                <button type="submit" class="btn btn-success">Mentés</button>
            </form>
        </div>
    </div>
</div>

<?=template_footer()?>


