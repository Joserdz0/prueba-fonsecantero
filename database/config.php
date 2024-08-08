<?php
$dsn = 'mysql:host=localhost;dbname=prueba_fonsecantero';
$usuario = 'root';
$contraseña = '';

try {
    $pdo = new PDO($dsn, $usuario, $contraseña);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
}