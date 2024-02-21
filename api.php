<?php
header("Access-Control-Allow-Origin: *");

require __DIR__ . '/Rcon/Rcon.php';

$ip = $_POST['ip'];
$port = $_POST['port'];
$password = $_POST['password'];
$command = $_POST['command'];

$rcon = new Rcon("$ip", $port, "$password");
$rcon->connect();

$rcon->setTimeout(2);

$rcon->exec("$command");
$resposta = $rcon->read();

$respostaJson = json_encode($resposta);
echo ("$respostaJson");
?>

