<?php
include('functions.php');
$pdo = pdo_connect_mysql();
if (isset($_GET["projekt_id"])) {
    $msg = "";
    $oszt_stmt = $pdo->prepare("SELECT osztaly_id FROM projekt WHERE id = ?");
    $oszt_stmt->execute([$_GET['projekt_id']]);
    $osztaly_id = $oszt_stmt->fetchColumn();
    $dolgozo_stmt = $pdo->prepare('SELECT * FROM dolgozo WHERE osztaly_id = ?');
    $dolgozo_stmt->execute([$osztaly_id]);
    $dolgozok = $dolgozo_stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($_POST)){
        if(empty($_POST["kezdes_datum"])){
            $msg .= "Minden mező kitöltése kötelező!";
        }else{
            $stmt = $pdo->prepare("SELECT nev FROM projekt WHERE id = ?");
            $stmt->execute([$_GET["projekt_id"]]);
            $projekt_nev = $stmt->fetchColumn();

            $check_stmt = $pdo->prepare('SELECT * FROM dolgozik WHERE projekt_id = ? AND dolgozo_id = ?');
            $check_stmt->bindParam(1, $_GET['projekt_id'], PDO::PARAM_INT);
            $check_stmt->bindParam(2, $_POST['dolgozo_id'], PDO::PARAM_INT);
            $check_stmt->execute();
            $row = $check_stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row){
                $stmt2 = $pdo->prepare('INSERT INTO dolgozik (projekt_id, projekt_nev, dolgozo_id, kezdes_datum) VALUES (?, ?, ?, ?)');
                $stmt2->bindParam(1, $_POST["projekt_id"], PDO::PARAM_INT);
                $stmt2->bindParam(2, $projekt_nev, PDO::PARAM_STR);
                $stmt2->bindParam(3, $_POST["dolgozo_id"], PDO::PARAM_INT);
                $stmt2->bindParam(4, $_POST["kezdes_datum"], PDO::PARAM_STR);
                if($stmt2->execute()){
                    header("location: dolgozo_to_projekt.php?projekt_id=" . $_GET["projekt_id"]);
                }
            }else{
                $msg .= 'Ez a dolgozó már hozzá van rendelve ehhez a projekthez!';
            }

        }
    }
} else {
    header("location: projekt.php");
}
?>
<?= template_header("Dolgozó hozzárendelése projekthez") ?>
    <div class="container">
        <div class="row mt-5 mb-3">
            <div class="col-lg-12">
                <h2>Dolgozó hozzáadása a projekthez</h2>
                <hr>
            </div>
        </div>
        <div class="row mt-3">
            <?php if ($msg): ?>
                <div class="alert alert-danger mb-3"><?= $msg ?></div>
            <?php endif; ?>
            <div class="col-lg-4">
                <form method="post" action="new_dolgozo_to_projekt.php?projekt_id=<?= $_GET['projekt_id'] ?>">
                    <div class="mb-3">
                        <label class="form-label" for="kezdes_datum">Kezdés dátuma</label>
                        <input type="date" class="form-control" name="kezdes_datum" id="kezdes_datum">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kezdes_datum">Dolgozó</label>
                        <select class="form-select" name="dolgozo_id">
                            <?php foreach ($dolgozok as $dolgozo): ?>
                            <option value="<?=$dolgozo["id"]?>"><?=$dolgozo["veznev"] . " ". $dolgozo["kernev"]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="projekt_id" value="<?=$_GET['projekt_id']?>">
                    <button type="submit" class="btn btn-success">Mentés</button>
                </form>
            </div>
        </div>
    </div>

<?= template_footer() ?>