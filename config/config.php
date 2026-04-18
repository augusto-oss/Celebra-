<?php

$dbname = 'db_festa_cia';
$host = 'localhost:4306';
$dbuser = 'root';
$dbpass = '';


try {
    $db = new PDO("mysql:dbname=" . $dbname . ";host=" . $host. ";port=4306", $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Erro" . $e->getMessage();
    exit();
}
define('BASE_URL', 'http://localhost/Locadora De Bikes/');
?>