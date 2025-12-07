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

<div class="card">
    <h2 class="card-title">Novo Produto</h2>

    <form method="POST">
        <?php if ($mensagem): ?>
            <div class="alert alert-error">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label class="form-label">Nome do Produto:</label>
            <input type="text" name="nome" required class="form-input">
        </div>

        <div class="form-group">
            <label class="form-label">Preço (R$):</label>
            <div class="input-icon-wrapper">
                <span class="input-icon">R$</span>
                <input type="number" name="preco" step="0.01" required class="form-input has-icon">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?> <!-- inclui o rodapé comum -->