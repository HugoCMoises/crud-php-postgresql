<?php
require_once 'config/db.php';
require_once 'src/Produto.php';

$produtoDAO = new Produto($pdo); // instancia a classe Produto com a conexão PDO
$listaProdutos = $produtoDAO->listarTodos(); // obtém a lista de todos os produtos

include 'includes/header.php'; // inclui o cabeçalho comum

?>

<h2 style="text-align: center;">Lista de Produtos</h2> <!-- título da página -->
<link rel="stylesheet" href="assets/css/visual.css"> <!-- link para o arquivo CSS -->

<a href="create.php" class="btn btn-success">Cadastrar Novo Produto</a> <!-- botão para cadastrar novo produto -->

<table>
    <thead>
        <tr> <!-- cabeçalho da tabela -->
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listaProdutos as $produto): ?> <!-- loop para exibir cada produto -->
        <tr>
            <td><?php echo $produto['id']; ?></td> <!-- exibe o ID do produto -->
            <td><?php echo htmlspecialchars($produto['nome']); ?></td> <!-- exibe o nome do produto com proteçãoo contra XSS -->
            <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td> <!-- exibe o preço formatado -->
            <td>
                <a href="update.php?id=<?php echo $produto['id']; ?>" class="btn btn-edit">Editar</a> <!-- botão para editar o produto -->
                <a href="delete.php?id=<?php echo $produto['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?');">Excluir</a> <!-- botão para excluir o produto com confirmação -->
            </td>
        </tr>
        <?php endforeach; ?> <!-- fim do loop -->
        
        <?php if (empty($listaProdutos)): ?> <!-- mensagem caso não haja produtos -->
        <tr>
            <td colspan="4" style="text-align:center;">Nenhum produto encontrado.</td> <!-- célula que ocupa todas as colunas -->
        </tr>
        <?php endif; ?> <!-- fim da verificação -->
    </tbody>
</table>

<?php include 'includes/footer.php'; ?> <!-- inclui o rodapé comum -->

