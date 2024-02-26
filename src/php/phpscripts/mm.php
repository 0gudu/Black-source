<?php
require_once("../../includes/connecdb.php");
session_start();
$id = $_SESSION['user'];

$numlobby = 1;
$lobbyids = ['1'];
$alllvv = 0;

//soma todas os levels do pessoal do lobby
foreach($lobbyids as $l){
    $stmt = $pdo->prepare("SELECT alevel FROM users WHERE id_user = :id"); 
    $stmt->bindValue(':id', $l);
    $stmt->execute();
    $level = $stmt->fetchColumn();
    $alllvv += $level;
}
//divide e faz uma media dos lvv de todo mundo, se só tiver 1, fica msm coisa
$avlevel = intval($alllvv / $numlobby);
echo($avlevel);
$lobby = 10 - $numlobby; //qnts vagas sao necessarias pra entrar todo mundo

//consulta se o usuario já esta em alguma partida
$stmt = $pdo->prepare("SELECT ac_match FROM users WHERE id_user = :iduser"); 
$stmt->execute([':iduser' => $numlobby]);
$ac_match = $stmt->fetchColumn();
if ($ac_match != 0){
    //se estiver volte aquela partida
    echo("fds");
}else {
    //se nao se junte a outra
    $stmt = $pdo->prepare("SELECT id_match FROM matches WHERE m_state >= :numlobby"); 
    $stmt->execute([':numlobby' => $id]);
    $ac_match = $stmt->fetchColumn();
    echo($pass);
    //verifica se existe servidores com as vagas solicitadas
    if($pass == ""){
        //se nao existe cria outro servidor novo
        $stmt = $pdo->prepare("INSERT INTO matches(score, map, av_level, m_state, players, serverport) VALUES (0, 'vertigo', :avlevel, :vagas, :ids, 27015)"); 
        $stmt->bindValue(':avlevel', $avlevel);
        $stmt->bindValue(':vagas', $lobby);
        $stmt->bindValue(':ids', $lobbyids);
        $stmt->execute();
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
        $arrayFinal = array_merge($arrayNumeros, $lobbyids);
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
    }
}



function updateacmatch($pdo){
    global $lobbyids, $matchId;
    foreach($lobbyids as $l){
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

