<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        :root {
            --cor-fundo: #f0f0f0; /* Definindo a cor de fundo */
            --border-pp: #f0f0f0; /* Definindo a largura da imagem */
        }

        .profilegames::-webkit-scrollbar {
            width: 10px; /* Largura da barra de rolagem */
            background-color: transparent; /* Cor de fundo da barra de rolagem */
            border-radius: 0px;
        }

        /* Estilo do botão na barra de rolagem */
        .profilegames::-webkit-scrollbar-thumb {
            background-color: #888; /* Cor do botão da barra de rolagem */
            border-radius: 5px; /* Raio da borda do botão da barra de rolagem */
            border-radius: 0px;        
        }

        /* Estilo do fundo da barra de rolagem ao passar o mouse */
        .profilegames::-webkit-scrollbar-thumb:hover {
            background-color: #555; /* Cor do botão da barra de rolagem ao passar o mouse */
        }
        body {
            display:flex;
            justify-content:center; 
            align-items:center;
            height: 97.5vh;
            background-image: url("src/images/bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            flex-direction: column;
            justify-content: space-between;
            font-family: "Arial", sans-serif;
        }
        header {
            display: flex;
            height: 5%;
            width: 100%;
            color: white;
            justify-content: left;
            align-items: center;
            border-top: 3px orange solid;
            border-bottom: 3px orange solid;
        }
        h2 {
            padding-left: 1rem;
        }
        .main {
            height: 90%;
            width: 70%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .profile {
            height: 100%;
            width: 25%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            
        }
        .profifename {
            height: 20%;
            width: 100%;
            border: 3px orange dotted;
            background-color: rgb(21, 21, 21,0.8);
        }
        .photoename {
            display: flex;
            flex-direction: row;
            height: 70%;
            width: 100%;
            justify-content: space-around;
            align-content: center;
            align-items: center;
        }
        .photo {
            width: 3vw;
            background-color: var(--cor-fundo); /* Personalizavel com pontos? */
            display: inline-block;
            padding: 10px;
            border: 3px gray solid;/* Personalizavel com pontos? */
        }
        .photo img {
            display: block; 
            width: 3vw;
            
        }
        .nameebadge {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 50%;
            height: 60%;
            color: white;
            font-family: Arial, Helvetica, sans-serif;
        }
        .name {
            width: 100%;
            height: 50%;
        }
        .badge {
            width: 100%;
            height: 50%;
        }
        .level {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30%;
            width: 100%;
        }
        .progress{
            display: flex;
            align-items: center;
            justify-content: left;
            width: 60%;
            height: 20%;
            background-color: gray;
            border: 2px black solid;
        }
        .bar{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 20%;/*progresso no nivel */
            height: 100%;
            background-color: red;
            border-right: 1px black solid;
            font-size: 0.6rem;

        }
        .profilegames {
            display: block;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 73%; /* Altura relativa à janela de visualização */
            width: 100%;
            border: 3px orange dotted;
            background-color: rgba(21, 21, 21, 0.8);
            overflow-y: auto;
            min-height: 10rem;
        }

        .game {
            width: 80%; /* Largura relativa à largura da .profilegames */
            height: 100px; /* Altura fixa de 100px */
            background-color: black;
            margin: 1.7rem;
        }
        .gameresult {
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            align-items: center;
            color: white;
            margin-top: 2rem;
        }
        .gameresult div{
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: space-around;
            color: white;
        }
        .content {
            height: 100%;
            width: 70%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }
        .news {
            display: flex;
            width: 100%;
            height: 20%;
            border: 3px orange dotted;  
            background-color: rgb(21, 21, 21,0.8);
            color: orange;
            flex-direction: row;
        }
        .bugs{
            display: flex;
            width: 50%;
            height: 100%;
            margin-left: 1rem;
            flex-direction: column;
        }
        .newthings{
            display: flex;
            width: 50%;
            height: 100%;
            margin-left: 1rem;
            flex-direction: column;
        }
        .play {
            display: flex;
            width: 100%;
            height: 80%;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .search {
            width: 50%;
            height: 20%;
            background: none;
            border: 3px orange dotted;
            color: white;
            font-size: 1.5rem;
            background-color: rgb(21, 21, 21,0.8);
            font-size: 2.2rem;
        }
        .search:hover{
            cursor: pointer;
            background-color: darkred;
            background-color: rgb(21, 21, 21);
            
        }
        @media (min-aspect-ratio: 2/1) {
            .main {
                width: 50%;
            }
        }

    </style>
</head>
<body>
    <header>
        <h2>black:source</h2>
       
    </header>
    <div class="main">
        <div class="profile">
            <div class="profifename">
                <div class="photoename">
                    <div class="photo"><img src="src/images/agent.png" ></div>
                    <div class="nameebadge">
                        <div class="name">
                            USERNAME
                        </div>
                        <div class="badge">
                            :badge:
                        </div>
                    </div>
                </div>
                <div class="level">
                    <img src="src/images/level1.png" style="width: 2.5vw;"alt="">
                    <div class="progress">
                        <div class="bar">
                            <b>x xp</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profilegames">
                <div class="game">
                    <div class="gameresult" style="background-color: rgba(0, 21, 0, 0.9);">
                        won
                        <div>
                            <span>2</span><span>16</span>
                        </div>
                    </div>
                    <div class="gameresult" style="background-color: rgba(21, 0, 0, 0.9);">
                        lost
                        <div>
                            <span>2</span><span>16</span>
                        </div>
                    </div>
                    <div class="gameresult" style="background-color: rgba(21, 21, 21, 0.9);">
                        draw
                        <div>
                            <span>2</span><span>16</span>
                        </div>
                    </div>
                    <div class="gameresult" style="background-color: rgba(0, 21, 0, 0.9);">
                        won
                        <div>
                            <span>2</span><span>16</span>
                        </div>
                    </div>
                    <div class="gameresult" style="background-color: rgba(0, 21, 0, 0.9);">
                        won
                        <div>
                            <span>2</span><span>16</span>
                        </div>
                    </div>
                    <div class="gameresult" style="background-color: rgba(0, 21, 0, 0.9);">
                        won
                        <div>
                            <span>2</span><span>16</span>
                        </div>
                    </div>
                    <div class="gameresult" style="background-color: rgba(0, 21, 0, 0.9);">
                        won
                        <div>
                            <span>2</span><span>16</span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="content">
            <div class="news">
                <div class="bugs">
                    <h3>News:</h3>
                    <span>bugs bugs fixed</span>
                    <span>bugs bugs fixed</span>
                    <span>bugs bugs fixed</span>
                </div>
                <div class="newthings">
                <h3>Upcoming features:</h3>
                    <span>sjoas implementation</span>
                    <span>sjoas implementation</span>
                    <span>sjoas implementation</span>
                </div>
                
                
            </div>
            <div class="play">
                <button class="search"><b>SEARCH MATCH</b></button>
            </div>
        </div>
    </div>
</body>
</html>
