<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="display:flex; justify-content:center;">
    <form action="phpscripts/loginfunc.php" method="POST">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required> 
        </div>
        
        <input type="submit" value="Login">
        <br>
        <a href="register.php">Register</a>
    </form>
</body>
</html>
