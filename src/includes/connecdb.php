<?php
define('ROOT_DIR', dirname(__DIR__));
require_once ROOT_DIR . '../../config/configdb.php';

try {
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8', $dbuser, $dbpass, [
        PDO::MYSQL_ATTR_LOCAL_INFILE => true
    ]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pr = 0;
} catch (PDOException $e) {
    $pr = 1;
}
?>