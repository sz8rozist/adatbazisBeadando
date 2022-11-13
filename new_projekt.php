<?php
include('functions.php');
$msg = "";
$pdo = pdo_connect_mysql();

if (!empty($_POST)) {
    if(empty($_POST["nev"]) && empty($_POST["ar"])){
        $msg .= "Minden mező kitöltése kötelező!";
    }else{
        $stmt = $pdo->prepare('INSERT INTO projekt (nev, ar) VALUES (?, ?)');
        if ($stmt->execute([$_POST["nev"], $_POST["ar"]])) {
            header("Location: projekt.php");
        } else {
            $msg = 'Sikertelen beszúrás!';
        }
    }
}
?>
<?= template_header('Új projekt') ?>
<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-lg-12">
            <h2>Projekt hozzáadása</h2>
            <hr>
        </div>
    </div>
    <div class="row mt-3">
        <?php if ($msg): ?>
            <div class="alert alert-danger mb-3"><?= $msg ?></div>
        <?php endif; ?>
        <div class="col-lg-4">
            <form action="new_projekt.php" method="post">
                <div class="mb-3">
                    <label for="nev" class="form-label">Név</label>
                    <input type="text" name="nev" class="form-control" id="nev">
                </div>
                <div class="mb-3">
                    <label for="ar" class="form-label">Ár</label>
                    <input type="text" class="form-control" name="ar" id="ar">
                </div>
                <button class="btn btn-success" type="submit">Mentés</button>
            </form>
        </div>
    </div>
</div>

<?= template_footer() ?>


