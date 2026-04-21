<?php
require __DIR__ . '/../config/config.php';

$id = $_GET['id'] ?? null;

if ($id) {

    // pega imagem
    $sql = $db->prepare("SELECT imagem FROM eventos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    $evento = $sql->fetch();

    // apaga imagem
    if ($evento && $evento['imagem']) {
        $caminho = __DIR__ . '/../img/' . $evento['imagem'];
        if (file_exists($caminho)) {
            unlink($caminho);
        }
    }

    // deleta
    $sql = $db->prepare("DELETE FROM eventos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
}

header("Location: /festa_cia/index.php");
exit;