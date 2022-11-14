<?php
include('functions.php');
$pdo = pdo_connect_mysql();

$legtobb_fizetes_query = $pdo->query("SELECT dolgozo.veznev, dolgozo.kernev, MAX(dolgozo.fizetes) as max_fizetes, osztaly.nev as osztaly FROM dolgozo, osztaly WHERE dolgozo.osztaly_id = osztaly.id GROUP BY osztaly.id");
$legtobb_fizetes_query->execute();
$legtobb_fizetes_result = $legtobb_fizetes_query->fetchAll(PDO::FETCH_ASSOC);
?>
<?= template_header('Kezdőlap') ?>
<div class="container">
    <!--
    TODO: Első diagram: Osztályonként hányan dolgoznak, Második: Osztályonként a legjobban kereső dolgozók, Harmadik: Osztályonként az átlagfizetés alatt kereső dolgozók, Negyedik: Osztályonként a legfiatalabb dolgozó
     Nem muszáj mindent diagramba.
        Osztályok lekérdezése amelyek átlagon alul/felül teljesítettek a projekt.ar és a projekt.active alapján (ha nem aktív a projekt akkor már fizettek érte ergo a projekt.ar már befolyt az osztálynak.
     -->
    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card">
                <h5 class="card-header">Dolgozók száma</h5>
                <div class="card-body text-center">
                    <div class="chart-container">
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
        <div class="col-lg-12">
                <div class="card">
                    <h5 class="card-header">Header</h5>
                    <div class="card-body text-center">
                        <div class="chart-container">
                            <canvas id="pie_chart"></canvas>
                        </div>
                    </div>
                </div>
        </div>
    </div>


</div>

<?= template_footer() ?>


