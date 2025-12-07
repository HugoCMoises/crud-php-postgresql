<?php
// Configurações de conexão
$host = 'seu_host';
$db   = 'seu_banco_de_dados';
$user = 'seu_usuario';
$pass = 'sua_senha';
$port = '5432'; // porta padrão do PostgreSQL


try { //estabelece a conexão com o banco de dados usando PDO
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    
   $pdo->exec("SET client_encoding = 'UTF8'");
    
    
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage()); // trata erros de conexão
}


?>