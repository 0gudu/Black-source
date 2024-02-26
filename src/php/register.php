<?php 
$error = "";
if(isset($_GET['error'])){
    $error = "username already taken";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="display:flex; justify-content:center;">
    <form action="phpscripts/registerfunc.php" method="POST">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required><span style="color:red;"><?=$error?></span>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required> 
        </div>
        <div>
            <label for="gamename">In game name</label>
            <input type="text" name="gamename" id="gamename" placeholder="your in game-name"required> 
        </div>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
