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

<div class="w-full max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8 my-auto">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Novo Produto</h2>

    <form method="POST">
        <?php if ($mensagem): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $mensagem; ?></span>
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nome do Produto:</label>
            <input type="text" name="nome" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Preço (R$):</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">R$</span>
                </div>
                <input type="number" name="preco" step="0.01" required
                    class="shadow appearance-none border rounded w-full py-2 pl-10 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
            </div>
        </div>

        <div class="flex items-center justify-between gap-4">
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition">
                Salvar
            </button>
            <a href="index.php"
                class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-center focus:outline-none focus:shadow-outline transition">
                Voltar
            </a>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?> <!-- inclui o rodapé comum -->