<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display:flex;
            justify-content:center; 
            align-items:center;
            height: 97.5vh;
            background-image: url("bg.png");
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
            height: 70%;
            width: 100%;
        }
        .coisa {
            height: 25%;
            width: 100%;
        }
        .profilegames{
            height: 73%;
            width: 100%;
            border: 3px orange dotted;
            background-color: rgb(21, 21, 21,0.8);
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
                    <div class="photo"></div>
                    <div class="name"> </div>
                </div>
                <div class="coisa">

                </div>
            </div>
            <div class="profilegames">

            </div>
        </div>
        <div class="content">
            <div class="news">
                
            </div>
            <div class="play">
                <button class="search"><b>SEARCH MATCH</b></button>
            </div>
        </div>
    </div>
</body>
</html>
