<?php
require_once("../../includes/connecdb.php");
session_start();
$id = $_SESSION['user'];

$numlobby = 1;
$lobbyids = json_encode([$id]);
$alllvv = 0;
$lobbylvv = [$id];
//soma todas os levels do pessoal do lobby
foreach($lobbylvv as $l){
    $stmt = $pdo->prepare("SELECT alevel FROM users WHERE id_user = :id"); 
    $stmt->bindValue(':id', $l);
    $stmt->execute();
    $level = $stmt->fetchColumn();
    $alllvv += $level;
}
//divide e faz uma media dos lvv de todo mundo, se só tiver 1, fica msm coisa
$avlevel = intval($alllvv / $numlobby);
//echo($avlevel);


//consulta se o usuario já esta em alguma partida
$stmt = $pdo->prepare("SELECT ac_match FROM users WHERE id_user = :iduser"); 
$stmt->execute([':iduser' => $id]);
$ac_match = $stmt->fetchColumn();
echo($ac_match);
if ($ac_match != 0){
    //se estiver volte aquela partida
    echo("fds");
}else {
    //se nao se junte a outra
    $stmt = $pdo->prepare("SELECT id_match FROM matches WHERE m_state >= :numlobby"); 
    $stmt->execute([':numlobby' => $numlobby]);
    $pass = $stmt->fetchColumn();

    //verifica se existe servidores com as vagas solicitadas
    if($pass == ""){
        $serverPorts = [27015, 27016, 27017, 27018, 27019]; // Lista de portas do servidor
        $portav = null; // Inicialize a variável de porta como null

        // Construa a consulta SQL para verificar se há uma partida em qualquer uma das portas
        $sql = "SELECT serverport FROM matches WHERE (scoreA = 16 OR scoreB = 16 OR scoreA + scoreB = 30) AND serverport IN (";

        // Adicione placeholders para as portas de servidor
        $sql .= implode(',', array_fill(0, count($serverPorts), '?'));
        $sql .= ") LIMIT 1";
        $stmt = $pdo->prepare($sql);

        // Execute a consulta com as portas de servidor como parâmetros
        $stmt->execute($serverPorts);

        // Verifique se uma partida foi encontrada em alguma das portas
        $port = $stmt->fetchColumn();

        if ($port !== false) {
            $portav = $port;
        } else {    
            
        }
        $lobby = 10 - $numlobby; //qnts vagas sao necessarias pra entrar todo mundo
        //se nao existe cria outro servidor novo
        $stmt = $pdo->prepare("INSERT INTO matches(scoreA, scoreB, map, av_level, m_state, players, serverport) VALUES (0, 0, 'vertigo', :avlevel, :vagas, :ids, :portav)"); 
        $stmt->bindValue(':avlevel', $avlevel);
        $stmt->bindValue(':vagas', $lobby);
        $stmt->bindValue(':ids', $lobbyids);
        $stmt->bindValue(':portav', $portav);
        $stmt->execute();

        $matchId = $pdo->lastInsertId();
        echo($matchId);
        updateacmatch($pdo);
    }else {
        //se existe procura algum que tenha o nivel de habilidade mais proximo
        $stmt = $pdo->prepare("SELECT id_match FROM matches WHERE m_state >= :numlobby ORDER BY ABS(av_level - :avlevel) ASC LIMIT 1"); 
        $stmt->execute([':numlobby' => $numlobby, ':avlevel' => $avlevel]);
        $matchId = $stmt->fetchColumn();
     
        //computa nas variaveis de usuario/s que a partida atual dele é a que deu o resultado na pesquisa anterior
        updateacmatch($pdo);

        //update players on matchdb
        $stmt = $pdo->prepare("SELECT players FROM matches WHERE id_match = :matchs"); 
        $stmt->execute([':matchs' => $matchId]);
        $players = $stmt->fetchColumn();

        //coloca o id deles na variavel da db
        $stringSemColchetes = str_replace(["[", "]", "'"], "", $players);
        $arrayNumeros = explode(",", $stringSemColchetes);
        $lobbyidsArray = json_decode($lobbyids, true);
        $arrayFinal = array_merge($arrayNumeros, $lobbyidsArray);
        $updatedplayers = "['" . implode("','", $arrayFinal) . "']";


        $stmt = $pdo->prepare("UPDATE matches SET players = :up_players WHERE id_match = :matchs"); 
        $stmt->bindValue(':up_players', $updatedplayers);
        $stmt->bindValue(':matchs', $matchId);
        $stmt->execute();

        //atualiza o nivel de habilidade de acordo com os novo/s player/s
        $stmt = $pdo->prepare("SELECT av_level FROM matches WHERE id_match = :idmatch"); 
        $stmt->execute([':idmatch' => $matchId]);
        $av_level = $stmt->fetchColumn();
        $lvvs = $av_level + $avlevel;
        $levelav = intval($lvvs / 2);

        $stmt = $pdo->prepare("UPDATE matches SET av_level = :av_level WHERE id_match = :matchs"); 
        $stmt->bindValue(':av_level', $levelav);
        $stmt->bindValue(':matchs', $matchId);
        $stmt->execute();

        //atualiza o state de acordo com as vagas atualizadas restantes
        $stmt = $pdo->prepare("SELECT m_state FROM matches WHERE id_match = :matchs"); 
        $stmt->execute([':matchs' => $matchId]);
        $state = $stmt->fetchColumn();
        //as vagas que tinham - o pessoal que entrou
        $up_state = $state - $numlobby;

        $stmt = $pdo->prepare("UPDATE matches SET m_state = :vagas WHERE id_match = :matchs"); 
        $stmt->bindValue(':vagas', $up_state);
        $stmt->bindValue(':matchs', $matchId);
        $stmt->execute();
    }
}



function updateacmatch($pdo){
    global $lobbyids, $matchId, $lobbylvv;
    foreach($lobbylvv as $l){
        // Atualize a coluna 'ac_match' na tabela 'users' com o ID do jogo
        $stmt = $pdo->prepare("UPDATE users SET ac_match = :matchid WHERE id_user = :id"); 
        $stmt->bindValue(':matchid', $matchId);
        $stmt->bindValue(':id', $l);
        $stmt->execute();
        
        // Atualize a coluna 'matches' na tabela 'users' com o ID do jogo
        $stmt = $pdo->prepare("SELECT matches FROM users WHERE id_user = :id"); 
        $stmt->bindValue(':id', $l);
        $stmt->execute();
        $matches = $stmt->fetchColumn();
        
        // Adicione o ID do jogo à lista de jogos do usuário
        $arrayMatches = json_decode($matches); 
        $arrayMatches[] = $matchId; 
        $updatedMatches = json_encode($arrayMatches);
        
        // Atualize a coluna 'matches' na tabela 'users' com a lista atualizada de jogos do usuário
        $stmt = $pdo->prepare("UPDATE users SET matches = :matches WHERE id_user = :id"); 
        $stmt->bindValue(':matches', $updatedMatches);
        $stmt->bindValue(':id', $l);
        $stmt->execute();
    }
}

