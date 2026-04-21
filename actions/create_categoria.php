<?php
require __DIR__ . '/../config/config.php';

// Se enviou o form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome']);

    if (!empty($nome)) {

        $sql = $db->prepare("INSERT INTO categorias (nome) VALUES (:nome)");
        $sql->bindValue(':nome', $nome);
        $sql->execute();

        header("Location: /festa_cia/actions/create.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Nova Categoria</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h2>Nova Categoria</h2>

    <form method="POST">

        <div class="mb-3">
            <label>Nome da Categoria</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="/festa_cia/actions/create.php" class="btn btn-secondary">Voltar</a>

    </form>

</div>

</body>

</html>