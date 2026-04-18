<?php
require __DIR__ . '/../config/config.php';

$id = $_GET['id'] ?? null;

if ($id) {

    // 🔥 opcional: apagar imagem também
    $sql = $db->prepare("SELECT imagem FROM eventos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    $evento = $sql->fetch();

    if ($evento && $evento['imagem']) {
        $caminho = __DIR__ . '/../img/' . $evento['imagem'];
        if (file_exists($caminho)) {
            unlink($caminho);
        }
    }

    // Apaga do banco
    $sql = $db->prepare("DELETE FROM eventos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
}

header("Location: ../index.php");
exit;