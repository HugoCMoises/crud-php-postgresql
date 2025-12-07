<?php
require_once 'config/db.php';
require_once 'src/Produto.php';

if (isset($_GET['id'])) {  // verifica se o ID foi passado via GET
    $id = (int)$_GET['id']; // sanitiza o ID como inteiro
    
    $produtoDAO = new Produto($pdo);
    
    // Opcional: Verificar se o ID existe antes de deletar
    if ($produtoDAO->buscarPorId($id)) {
        $produtoDAO->deletar($id);
    }
}

header('Location: index.php');// redireciona para a p�gina inicial
exit;
?>