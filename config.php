<?php
session_start();

$host = 'localhost';
$db = 'loan_system';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Database connection failed. Import database.sql in phpMyAdmin first.');
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function require_login() {
    if (empty($_SESSION['user'])) {
        header('Location: index.php');
        exit;
    }
}

function require_role($role) {
    require_login();
    if ($_SESSION['user']['role'] !== $role) {
        header('Location: index.php');
        exit;
    }
}

function redirect_to_dashboard() {
    if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
        header('Location: admin.php');
    } else {
        header('Location: borrower.php');
    }
    exit;
}
?>
