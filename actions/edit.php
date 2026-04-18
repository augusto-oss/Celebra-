<?php
// Importa conexão com o banco
require __DIR__ . '/../config/config.php';

// Pega o ID enviado pela URL
$id = $_GET['id'] ?? null;

// Busca o evento no banco
$sql = $db->prepare("SELECT * FROM eventos WHERE id = :id");
$sql->bindValue(':id', $id);
$sql->execute();

// Armazena os dados do evento
$evento = $sql->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">

        <!-- Título -->
        <h2 class="mb-3">Editar Evento</h2>

        <!-- Formulário -->
        <form action="update.php" method="POST" enctype="multipart/form-data">

            <!-- ID escondido -->
            <input type="hidden" name="id" value="<?= $evento['id'] ?>">

            <!-- Título -->
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control"
                    value="<?= $evento['titulo'] ?>" required>
            </div>

            <!-- Categoria -->
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input type="text" name="categoria" class="form-control"
                    value="<?= $evento['categoria'] ?>" required>
            </div>

            <!-- Descrição -->
            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control" required><?= $evento['descricao'] ?></textarea>
            </div>

            <!-- Local -->
            <div class="mb-3">
                <label class="form-label">Local</label>
                <input type="text" name="local_evento" class="form-control"
                    value="<?= $evento['local_evento'] ?>" required>
            </div>

            <!-- Convidados -->
            <div class="mb-3">
                <label class="form-label">Número de Convidados</label>
                <input type="number" name="numero_convidados" class="form-control"
                    value="<?= $evento['numero_convidados'] ?>" required>
            </div>

            <!-- Imagem atual -->
            <?php if ($evento['imagem']): ?>
                <div class="mb-3">
                    <label>Imagem atual:</label><br>
                    <img src="../img/<?= $evento['imagem'] ?>" width="120">
                </div>
            <?php endif; ?>

            <!-- Nova imagem -->
            <div class="mb-3">
                <label class="form-label">Nova imagem (opcional)</label>
                <input type="file" name="imagem" class="form-control">
            </div>

            <!-- Botões -->
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="../index.php" class="btn btn-secondary">Voltar</a>

        </form>

    </div>

</body>

</html>