<?php
include('functions.php');
$pdo = pdo_connect_mysql();

$legtobb_fizetes_query = $pdo->query("SELECT dolgozo.veznev, dolgozo.kernev, MAX(dolgozo.fizetes) AS max_fizetes, osztaly.nev as osztaly FROM dolgozo, osztaly WHERE dolgozo.osztaly_id = osztaly.id AND dolgozo.fizetes IN (SELECT MAX(dolgozo.fizetes) FROM dolgozo GROUP BY dolgozo.osztaly_id) GROUP BY osztaly.id");
$legtobb_fizetes_query->execute();
$legtobb_fizetes_result = $legtobb_fizetes_query->fetchAll(PDO::FETCH_ASSOC);

$atlag_fizetes_query = $pdo->query("SELECT osztaly.nev AS osztaly , ROUND(AVG(dolgozo.fizetes), 0) AS atlag_fizetes FROM dolgozo, osztaly WHERE dolgozo.osztaly_id = osztaly.id GROUP BY osztaly.id");
$atlag_fizetes_query->execute();
$atlag_fizetes_result = $atlag_fizetes_query->fetchAll(PDO::FETCH_ASSOC);

?>
<?= template_header('Kezdőlap') ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card">
                <h5 class="card-header">Dolgozók száma</h5>
                <div class="card-body text-center">
                    <div class="chart-container pie-chart-container">
                        <canvas id="pie_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <h5 class="card-header">Legtöbbet kereső dolgozók</h5>
                <div class="card-body text-center">
                    <?php if (!empty($legtobb_fizetes_result)): ?>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Osztály</th>
                                <th>Vezetéknév</th>
                                <th>Keresztnév</th>
                                <th>Fizetés</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($legtobb_fizetes_result as $row): ?>
                                <tr>
                                    <td><?= $row["osztaly"] ?></td>
                                    <td><?= $row["veznev"] ?></td>
                                    <td><?= $row["kernev"] ?></td>
                                    <td><?= $row["max_fizetes"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning">Nem található adat.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-8">
                <div class="card">
                    <h5 class="card-header">Osztályok átlagfizetése</h5>
                    <div class="card-body text-center">
                        <?php if (!empty($atlag_fizetes_result)): ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Osztály</th>
                                    <th>Átlagfizetés</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($atlag_fizetes_result as $row): ?>
                                    <tr>
                                        <td><?= $row["osztaly"] ?></td>
                                        <td><?= $row["atlag_fizetes"] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="alert alert-warning">Nem található adat.</div>
                        <?php endif; ?>
                    </div>
                </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <h5 class="card-header">Projektekből befolyt összegek</h5>
                <div class="card-body text-center">
                    <div class="chart-container bar-chart-container">
                        <canvas id="bar_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<?= template_footer() ?>


