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

<div class="w-full max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8 my-auto">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Editar Produto</h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($produtoAtual['nome']); ?>" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Preço:</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">R$</span>
                </div>
                <input type="number" name="preco" step="0.01" value="<?php echo $produtoAtual['preco']; ?>" required
                    class="shadow appearance-none border rounded w-full py-2 pl-10 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
            </div>
        </div>

        <div class="flex items-center justify-between gap-4">
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition">
                Atualizar
            </button>
            <a href="index.php"
                class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-center focus:outline-none focus:shadow-outline transition">
                Cancelar
            </a>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>