<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function pdo_connect_mysql()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'vallalat';
    try {
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $exception) {
        exit('Sikertelen adatbázis csatlakozás!');
    }
}

function template_header($title)
{
    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="css/main.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Vállalatirányítási rendszer</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
         <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php"><i class="fas fa-home"></i>Kezdőlap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="department.php"><i class="fas fa-building"></i>Osztályok</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="employe.php"><i class="fas fa-users"></i>Dolgozók</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="projekt.php"><i class="fas fa-project-diagram"></i>Projektek</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
EOT;
}

function template_footer()
{
    echo <<<EOT
    <script	src="js/Chart.bundle.min.js"></script>
    <script src="js/chart.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    </body>
</html>
EOT;
}

