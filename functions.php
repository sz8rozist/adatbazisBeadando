<?php
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
		<link href="style/main.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Vállalat irányítási rendszer</h1>
            <a href="index.php"><i class="fas fa-building"></i>Osztály</a>
    		<a href="employe.php"><i class="fas fa-users"></i>Dolgozó</a>
    		<a href="projekt.php"><i class="fas fa-project-diagram"></i>Projekt</a>
    	</div>
    </nav>
EOT;
}

function template_footer()
{
    echo <<<EOT
    <script	src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="js/chart.js"></script>
    </body>
</html>
EOT;
}
