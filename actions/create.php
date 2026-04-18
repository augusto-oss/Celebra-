<?php
// Conexão com o banco
require __DIR__ . '/../config/config.php';

// Se enviou o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recebe os dados
    $titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $local = $_POST['local_evento'];
    $convidados = $_POST['numero_convidados'];

    $nomeImagem = null;

    // Upload da imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {

        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = time() . '.' . $ext;

        move_uploaded_file(
            $_FILES['imagem']['tmp_name'],
            __DIR__ . '/../img/' . $nomeImagem
        );
    }

    // Inserção no banco
    $sql = $db->prepare("
        INSERT INTO eventos
        (titulo, categoria, descricao, imagem, data_evento, local_evento, numero_convidados)
        VALUES
        (:titulo, :categoria, :descricao, :imagem, NOW(), :local, :convidados)
    ");

    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':categoria', $categoria);
    $sql->bindValue(':descricao', $descricao);
    $sql->bindValue(':imagem', $nomeImagem);
    $sql->bindValue(':local', $local);
    $sql->bindValue(':convidados', $convidados);

    $sql->execute();

    // Volta pro index
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Evento</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">

        <h2>Cadastrar Novo Evento</h2>

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Categoria</label>
                <input type="text" name="categoria" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Local</label>
                <input type="text" name="local_evento" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Convidados</label>
                <input type="number" name="numero_convidados" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Imagem</label>
                <input type="file" name="imagem" class="form-control">
            </div>

            <button class="btn btn-primary">Cadastrar</button>
            <a href="../index.php" class="btn btn-secondary">Voltar</a>

        </form>

    </div>

</body>

</html>