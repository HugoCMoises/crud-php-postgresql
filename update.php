<?php
require_once 'config/db.php';
require_once 'src/Produto.php';

// Recebe ID via POST (ao enviar form) ou GET (ao abrir a página)
$id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);

if ($id <= 0) { // ID inválido, redireciona para a lista
    header("Location: index.php");
    exit;
}

$produtoDAO = new Produto($pdo); // instancia a classe Produto com a conexão PDO
$produtoAtual = $produtoDAO->buscarPorId($id); // busca o produto pelo ID

if (!$produtoAtual) { // Se o produto não existir, exibe mensagem de erro e termina
    die("Produto não encontrado.");
}

// Faz um request do envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS); // sanitiza o nome do produto
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // sanitiza o preço do produto

    if ($nome && $preco) { // verifica se os campos não estão vazios
        if ($produtoDAO->atualizar($id, $nome, $preco)) { // chama o método atualizar da classe Produto
            header('Location: index.php'); // redireciona para a página inicial
            exit;
        } else {
            echo "Falha ao atualizar o produto."; // mensagem de erro genérica
        }
    }
}

include 'includes/header.php';
?>

<div class="card">
    <h2 class="card-title">Editar Produto</h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
            <label class="form-label">Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($produtoAtual['nome']); ?>" required
                class="form-input">
        </div>

        <div class="form-group">
            <label class="form-label">Preço:</label>
            <div class="input-icon-wrapper">
                <span class="input-icon">R$</span>
                <input type="number" name="preco" step="0.01" value="<?php echo $produtoAtual['preco']; ?>" required
                    class="form-input has-icon">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>