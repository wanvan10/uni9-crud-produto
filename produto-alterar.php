<?php
require_once 'produto.php';

$produto = new Produto();

// Verificar se o ID foi enviado e se o formulário foi submetido
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produtos = $produto->listarProdutos();
    $produtoAlvo = null;

    foreach ($produtos as $p) {
        if ($p['id'] == $id) {
            $produtoAlvo = $p;
            break;
        }
    }

    if (!$produtoAlvo) {
        echo "Produto não encontrado!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    
    $produto->alterarProduto($id, $nome, $descricao, $preco, $quantidade);
    header("Location: listar_produtos.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Produto</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Alterar Produto</h1>

    <form method="POST" class="row g-3">
        <input type="hidden" name="id" value="<?php echo $produtoAlvo['id']; ?>">

        <div class="col-md-6">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($produtoAlvo['nome']); ?>" required>
        </div>

        <div class="col-md-6">
            <label for="descricao" class="form-label">Descrição:</label>
            <input type="text" name="descricao" class="form-control" value="<?php echo htmlspecialchars($produtoAlvo['descricao']); ?>" required>
        </div>

        <div class="col-md-6">
            <label for="preco" class="form-label">Preço:</label>
            <input type="number" step="0.01" name="preco" class="form-control" value="<?php echo htmlspecialchars($produtoAlvo['preco']); ?>" required>
        </div>

        <div class="col-md-6">
            <label for="quantidade" class="form-label">Quantidade:</label>
            <input type="number" name="quantidade" class="form-control" value="<?php echo htmlspecialchars($produtoAlvo['quantidade']); ?>" required>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
        </div>

        <div class="col-12 text-center">
            <a href="listar_produtos.php" class="btn btn-secondary mt-3">Voltar à Lista</a>
        </div>
    </form>
</div>

<!-- Incluir Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>