<?php
require_once 'config/db.php';
require_once 'src/Produto.php';

$produtoDAO = new Produto($pdo); // instancia a classe Produto com a conexão PDO
$listaProdutos = $produtoDAO->listarTodos(); // obtém a lista de todos os produtos

include 'includes/header.php'; // inclui o cabeçalho comum

?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Lista de Produtos</h2>
        <a href="create.php" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Novo Produto
        </a>
    </div>

    <div class="table-container">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaProdutos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td class="text-price">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td class="text-center">
                            <a href="update.php?id=<?php echo $produto['id']; ?>" class="btn btn-warning btn-sm"
                                title="Editar">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="delete.php?id=<?php echo $produto['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir este produto?');" title="Excluir">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($listaProdutos)): ?>
                    <tr>
                        <td colspan="4" class="text-center" style="padding: 3rem;">
                            <i class="fa-solid fa-box-open"
                                style="font-size: 3rem; color: var(--text-muted); display: block; margin-bottom: 1rem; margin-left: auto; margin-right: auto;"></i>
                            <span style="color: var(--text-muted);">Nenhum produto encontrado.</span>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?> <!-- inclui o rodapé comum -->