<?php
require_once("../../includes/connecdb.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT passwords FROM users WHERE username = :username"); 
$stmt->execute([':username' => $username]);
$pass = $stmt->fetchColumn();

if (password_verify($password, $pass)) {
    $stmt = $pdo->prepare("SELECT id_user FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $id = $stmt->fetchColumn();
    $_SESSION['user'] = $id;
    header("location: ../../../index.html");
    exit();
} else {
    header("location: ../login.php");
    exit();
}
