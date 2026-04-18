<?php
// Conexão com o banco
require __DIR__ . '/config/config.php';

// Busca eventos
$sql = $db->query("SELECT * FROM eventos ORDER BY id DESC");
$eventos = $sql->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Eventos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS externo -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navbar (Topo do sistema) -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark mb-4">
        <div class="container">

            <!-- Nome + ícone -->
            <span class="navbar-brand">
                <i class="bi bi-stars"></i>
                Celebra+
            </span>

        </div>
    </nav>

    <div class="container mt-4">

        <!-- Cabeçalho -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0">Eventos</h2>
                <small class="text-muted">Lista de eventos cadastrados</small>
            </div>

            <a href="actions/create.php" class="btn btn-primary">
                Novo Evento
            </a>
        </div>

        <div class="row">

            <?php foreach ($eventos as $evento): ?>

                <div class="col-md-4 mb-4">

                    <div class="card h-100">

                        <!-- Imagem -->
                        <?php if ($evento['imagem']): ?>
                            <img src="img/<?= $evento['imagem'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                        <?php endif; ?>

                        <div class="card-body">

                            <!-- ID -->
                            <p class="text-muted mb-1">
                                ID: <?= $evento['id'] ?>
                            </p>

                            <!-- Título -->
                            <h5 class="card-title"><?= $evento['titulo'] ?></h5>

                            <!-- Categoria -->
                            <p class="mb-1">
                                <strong>Categoria:</strong> <?= $evento['categoria'] ?>
                            </p>

                            <!-- Descrição -->
                            <p class="mb-2">
                                <strong>Descrição:</strong><br>
                                <?= $evento['descricao'] ?>
                            </p>

                            <!-- Local -->
                            <p class="mb-1">
                                <strong>Local:</strong> <?= $evento['local_evento'] ?>
                            </p>

                            <!-- Convidados -->
                            <p class="mb-2">
                                <strong>Convidados:</strong> <?= $evento['numero_convidados'] ?>
                            </p>

                        </div>

                        <!-- Rodapé do card -->
                        <div class="card-footer bg-white border-0 d-flex justify-content-between">

                            <a href="actions/edit.php?id=<?= $evento['id'] ?>"
                                class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <a href="actions/delete.php?id=<?= $evento['id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Deseja excluir?')">
                                Excluir
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</body>

</html>