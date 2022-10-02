<?php

function pdo_connect_mysql()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'vallalat';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
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
            <a href="index.php"><i class="fas fa-home"></i>Kezdőlap</a>
    		<a href="employe.php"><i class="fas fa-users"></i>Dolgozók</a>
    	</div>
    </nav>
EOT;
}

function template_footer()
{
    echo <<<EOT
    </body>
</html>
EOT;
}
