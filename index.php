<?php
require_once 'config/db.php';
require_once 'src/Produto.php';

$produtoDAO = new Produto($pdo); // instancia a classe Produto com a conexão PDO
$listaProdutos = $produtoDAO->listarTodos(); // obtém a lista de todos os produtos

include 'includes/header.php'; // inclui o cabeçalho comum

?>

<div class="w-full bg-white rounded-lg shadow-md p-6 my-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Lista de Produtos</h2>
        <a href="create.php"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Novo Produto
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Nome</th>
                    <th class="py-3 px-6 text-left">Preço</th>
                    <th class="py-3 px-6 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($listaProdutos as $produto): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-medium"><?php echo $produto['id']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td class="py-3 px-6 text-left font-bold text-green-600">R$
                            <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center gap-2">
                                <a href="update.php?id=<?php echo $produto['id']; ?>"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-3 rounded text-xs transition"
                                    title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="delete.php?id=<?php echo $produto['id']; ?>"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs transition"
                                    onclick="return confirm('Tem certeza que deseja excluir este produto?');"
                                    title="Excluir">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($listaProdutos)): ?>
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">
                            <i class="fa-solid fa-box-open text-4xl mb-2 block text-gray-300"></i>
                            Nenhum produto encontrado.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?> <!-- inclui o rodapé comum -->