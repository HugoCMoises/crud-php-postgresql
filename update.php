<?php
require_once 'config/db.php';
require_once 'src/Produto.php';

// Recebe ID via POST (ao enviar form) ou GET (ao abrir a página)
$id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);

if ($id <= 0) { // ID inválido, redireciona para a lista
    header("Location: index.php");
    exit;
}

$produtoDAO = new Produto($pdo); // instancia a classe Produto com a conexão PDO
$produtoAtual = $produtoDAO->buscarPorId($id); // busca o produto pelo ID

if (!$produtoAtual) { // Se o produto não existir, exibe mensagem de erro e termina
    die("Produto n�o encontrado.");
}

// Faz um request do envio do formul�rio
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

<h2 style="text-align: center;">Editar Produto</h2> <!-- título da página -->
<link rel="stylesheet" href="assets/css/visual.css"> <!-- link para o arquivo CSS -->

<form method="POST"> <!-- formulário para editar o produto --> 

    
    <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- campo oculto para o ID do produto -->

    <label>Nome:</label> <!-- campo para o nome do produto -->
    <input type="text" name="nome" 
        value="<?php echo htmlspecialchars($produtoAtual['nome']); ?>" required> <!-- proteção contra XSS -->

    <label>Pre�o:</label> <!-- campo para o pre�o do produto -->
    <input type="number" name="preco" step="0.01" 
        value="<?php echo $produtoAtual['preco']; ?>" required> <!-- valor atual do preço -->

    <button type="submit" class="btn btn-primary">Atualizar</button> <!-- bot�o para enviar o formulário -->
    <a href="index.php" class="btn btn-back">Cancelar</a> <!-- botão para voltar a página inicial -->
</form>
<?php include 'includes/footer.php'; ?> <!-- inclui o rodapé comum -->