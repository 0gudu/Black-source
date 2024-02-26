<?php
    require_once("../includes/connecdb.php");
    session_start();
    $id = $_SESSION['user'];
    //pega o matchid e a porta para o server
    $st = $pdo->prepare("SELECT ac_match FROM users WHERE id_user = :id"); 
    $st->bindValue(':id', $id);
    $st->execute();
    $matchId = $st->fetchColumn();
    $stmt = $pdo->prepare("SELECT serverport FROM matches WHERE id_match = :id"); 
    $stmt->bindValue(':id', $matchId);
    $stmt->execute();
    $serverport = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script>
    //envia o matchid e a porta para comecar o server
    $.ajax({
        url: "phpscripts/handlegameserver.php", 
        type: "POST", 
        data: {
            id: <?=$matchId?>,
            port: <?=$serverport?>
        },
        error: function(xhr, status, error) {
            // Lidar com erros
            console.error("Erro:", status, error);
        },
        success: function(msg) {
            console.log(msg);
        }
    });
</script>
</html>