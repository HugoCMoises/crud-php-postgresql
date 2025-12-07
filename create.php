<?php
require_once 'config/db.php';
require_once 'src/Produto.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //faz a requisição via POST
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS); // sanitiza o nome do produto
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);// sanitiza o preço do produto

    if ($nome && $preco) { // verifica se os campos não estão vazios
        $produtoDAO = new Produto($pdo); // instancia a classe Produto com a conex�o PDO
        
        if ($produtoDAO->criar($nome, $preco)) { // chama o método criar da classe Produto
            header('Location: index.php');// redireciona para a página inicial
            exit;
        } else {
            $mensagem = "Erro ao salvar no banco."; // mensagem de erro genérica
        }
    } else {
        $mensagem = "Preencha todos os campos corretamente."; // mensagem de erro para campos vazios
    }
}

include 'includes/header.php'; // inclui o cabeçalho comum
?>

<h2 style="text-align: center;">Novo Produto</h2> <!-- título da página -->
<link rel="stylesheet" href="assets/css/visual.css"> <!-- link para o arquivo CSS -->
<form method="POST"> <!-- formulário para criar um novo produto -->

    <?php if ($mensagem): ?> <!-- exibe a mensagem de erro, se houver -->
        <p style="color: red; text-align: center;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <label>Nome do Produto:</label> <!-- campo para o nome do produto -->
    <input type="text" name="nome" required>

    <label>Preço (R$):</label> <!-- campo para o preço do produto -->
    <input type="number" name="preco" step="0.01" required>

    <button type="submit" class="btn btn-primary">Salvar</button> <!-- botão para enviar o formulário -->
    <a href="index.php" class="btn btn-back">Voltar</a> <!-- botão para voltar a página inicial -->
</form>

<?php include 'includes/footer.php'; ?> <!-- inclui o rodapé comum -->