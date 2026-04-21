<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/config/config.php';

// Eventos + categoria
$sql = $db->query("
    SELECT eventos.*, categorias.nome as categoria_nome 
    FROM eventos 
    LEFT JOIN categorias ON eventos.categoria_id = categorias.id
    ORDER BY eventos.id DESC
");
$eventos = $sql->fetchAll();


// Destaques
$banners = $db->query("
    SELECT * FROM eventos 
    WHERE destaque = 1 
    LIMIT 3
")->fetchAll();

// Config
$config = $db->query("SELECT * FROM config LIMIT 1")->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Festa & Cia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/festa_cia/assets/css/style.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4"
        style="background: linear-gradient(90deg,#4f46e5,#7c3aed);">
        <div class="container">
            <span class="navbar-brand fw-bold">
                <i class="bi bi-balloon-fill me-2"></i>
                Celebra+
            </span>
        </div>
    </nav>

    <div class="container">

        <!-- BANNERS -->
        <?php if (count($banners) > 0): ?>
            <div class="mb-5">
                <h3 class="mb-3">Destaques</h3>

                <div class="row">
                    <?php foreach ($banners as $b): ?>
                        <div class="col-md-4 mb-3">

                            <div class="position-relative">

                                <?php if ($b['imagem']): ?>
                                    <img src="/festa_cia/img/<?= $b['imagem'] ?>"
                                        class="w-100 rounded"
                                        style="height:220px; object-fit:cover;">
                                <?php endif; ?>

                                <div class="position-absolute bottom-0 start-0 p-3 text-white"
                                    style="background: linear-gradient(transparent, rgba(0,0,0,0.7)); width:100%; border-radius:0 0 10px 10px;">

                                    <h5><?= $b['titulo'] ?></h5>

                                </div>

                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0">Portfólio</h2>
                <small class="text-muted">Eventos realizados</small>
            </div>

            <a href="/festa_cia/actions/create.php" class="btn btn-primary">
                Novo Evento
            </a>
        </div>

        <!-- EVENTOS -->
        <div class="row">

            <?php foreach ($eventos as $evento): ?>

                <div class="col-md-4 mb-4">

                    <div class="card h-100 shadow-sm border-0 rounded-4">

                        <?php if (!empty($evento['imagem'])): ?>
                            <img src="/festa_cia/img/<?= $evento['imagem'] ?>"
                                class="card-img-top"
                                style="height:200px; object-fit:cover;">
                        <?php endif; ?>

                        <div class="card-body">

                            <span class="badge mb-2"
                                style="background: linear-gradient(90deg,#6366f1,#a855f7);">
                                <?= $evento['categoria_nome'] ?? 'Sem categoria' ?>
                            </span>

                            <h5 class="fw-bold">
                                <?= $evento['titulo'] ?>
                            </h5>

                            <p class="text-muted small">
                                <?= substr($evento['descricao'] ?? '', 0, 80) ?>...
                            </p>

                            <p class="mb-1 small">
                                📍 <?= $evento['local_evento'] ?>
                            </p>

                            <p class="small">
                                👥 <?= $evento['numero_convidados'] ?> convidados
                            </p>

                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between">

                            <a href="/festa_cia/actions/edit.php?id=<?= $evento['id'] ?>"
                                class="btn btn-outline-primary btn-sm">
                                Editar
                            </a>

                            <a href="/festa_cia/actions/delete.php?id=<?= $evento['id'] ?>"
                                class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Deseja excluir?')">
                                Excluir
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-white mt-5 p-4">
        <div class="container text-center">

            <h5 class="mb-3">Contate-nos</h5>

            <p>Transformando momentos em experiências inesquecíveis ✨</p>

            <p>📞 <?= $config['telefone'] ?? 'Não informado' ?></p>
            <p>📍 <?= $config['endereco'] ?? 'Não informado' ?></p>

            <?php if (!empty($config['instagram'])): ?>
                <a href="<?= $config['instagram'] ?>" target="_blank" class="text-white">
                    Instagram
                </a>
            <?php endif; ?>

        </div>
    </footer>

</body>

</html>