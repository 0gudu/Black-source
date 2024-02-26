<?php
header("Access-Control-Allow-Origin: *");

require __DIR__ . '/Rcon/Rcon.php';

$ip = $_POST['ip'];
$port = $_POST['port'];
$password = "counterstrike";
$command = $_POST['command'];


if ($command == "status"){
    $rcon = new Rcon("$ip", $port, "$password");
    $rcon->connect();

    $rcon->setTimeout(2);

    $rcon->exec("$command");
    
    $resposta = $rcon->read();
    $respostaJson = json_encode($resposta);
}else if ($command == "score"){
    $rcon = new Rcon("$ip", $port, "$password");
    $rcon->connect();

    $rcon->setTimeout(2);

    $rcon->exec("$command");
    
    $respostaJson = $rcon->score();
    $startIndex = strpos($respostaJson, '{');
    $respostaJson = substr($respostaJson, $startIndex);
    $arrayData = json_decode($respostaJson, true);
}



echo ("$respostaJson");


