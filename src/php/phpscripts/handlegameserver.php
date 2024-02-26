<?php
set_time_limit(0);

require __DIR__ . '/Rcon/Rcon.php';

$dbname = 'sourceit';
$host = 'localhost';
$dbuser = 'root'; 
$dbpass = '';

    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8', $dbuser, $dbpass, [
        PDO::MYSQL_ATTR_LOCAL_INFILE => true
    ]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pr = 0;


$idmatch = $_POST['id'];
$stmt = $pdo->prepare("SELECT runningserverhandle FROM matches WHERE id_match = :id");
$stmt->execute([':id' => $idmatch]);
$running = $stmt->fetchColumn();

function runcommand($command){
    $ip = '199.195.250.174';
    $port = $_POST['port'];
    $password = "counterstrike";
    $respostaJson = null;

    if ($command == "status"){
        $rcon = new Rcon("$ip", $port, "$password");
        $rcon->connect();

        $rcon->setTimeout(2);

        $rcon->exec("$command");
        
        $resposta = $rcon->read();
        $respostaJson = json_encode($resposta);
    } else if ($command == "score"){
        $rcon = new Rcon("$ip", $port, "$password");
        $rcon->connect();

        $rcon->setTimeout(2);

        $rcon->exec("$command");
        
        $respostaJson = $rcon->score();
        $startIndex = strpos($respostaJson, '{');
        $respostaJson = substr($respostaJson, $startIndex);
        $arrayData = json_decode($respostaJson, true);
    } else { //arrumar para não poderem executar qualquer comando
        $rcon = new Rcon("$ip", $port, "$password");
        $rcon->connect();

        $rcon->setTimeout(2);

        $rcon->exec("$command");
        $respostaJson = $rcon->score();
    }

    return $respostaJson; // Retorna $respostaJson
}

$running = 0;
if ($running == 0) {
    $stmt = $pdo->prepare("UPDATE matches SET runningserverhandle = 1 WHERE id_match = :id");
    $stmt->execute([':id' => $idmatch]);

    $score = runcommand("score");
    
    if ($score !== null) {
        $scorearray = json_decode($score);
        echo "Valor de CT: " . $scorearray;
    } else {
        echo "O comando 'score' retornou null.";
    }

} else {
    echo "already running";
}


