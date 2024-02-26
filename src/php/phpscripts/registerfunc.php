<?php
require_once("../../includes/connecdb.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$gamename = $_POST['gamename'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
$stmt->execute([':username' => $username]);
$ver = $stmt->fetchColumn();

if ($ver == 0) {
    $stmt = $pdo->prepare("INSERT INTO users(username,passwords,gamename,alevel,matches,ac_match) VALUES (:username, :passwords, :gamename, 0,'[]',0) ");
    $stmt->execute([':username' => $username, ':passwords' => $hashedPassword, ':gamename' => $gamename]);
    $ver = $stmt->fetchColumn();
    header("location: ../login.php");
}else {
    header("location: ../register.php?error=taken");
}
