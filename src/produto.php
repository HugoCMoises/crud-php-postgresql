<?php

class Produto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Listar todos os produtos
    public function listarTodos() {
        $sql = "SELECT * FROM public.produtos ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Buscar produto específico pelo ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM public.produtos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Criar novo produto
    public function criar($nome, $preco) {
        $sql = "INSERT INTO public.produtos (nome, preco) VALUES (:nome, :preco)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':preco', $preco);
        return $stmt->execute();
    }

    // Atualizar produto existente
    public function atualizar($id, $nome, $preco) {
        $sql = "UPDATE public.produtos SET nome = :nome, preco = :preco WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Deletar produto
    public function deletar($id) {
        $sql = "DELETE FROM public.produtos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>