<?php
require __DIR__ . '/../config/config.php';

$id = $_POST['id'];

$titulo = $_POST['titulo'];
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];
$local = $_POST['local_evento'];
$convidados = $_POST['numero_convidados'];

// pega imagem antiga
$sql = $db->prepare("SELECT imagem FROM eventos WHERE id = :id");
$sql->bindValue(':id', $id);
$sql->execute();
$evento = $sql->fetch();

$nomeImagem = $evento['imagem'];

// se enviou nova imagem
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {

    // apaga antiga
    if ($nomeImagem) {
        $caminho = __DIR__ . '/../img/' . $nomeImagem;
        if (file_exists($caminho)) {
            unlink($caminho);
        }
    }

    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $nomeImagem = time() . '.' . $ext;

    move_uploaded_file(
        $_FILES['imagem']['tmp_name'],
        __DIR__ . '/../img/' . $nomeImagem
    );
}

// update
$sql = $db->prepare("
    UPDATE eventos SET
        titulo = :titulo,
        categoria = :categoria,
        descricao = :descricao,
        imagem = :imagem,
        local_evento = :local,
        numero_convidados = :convidados
    WHERE id = :id
");

$sql->bindValue(':titulo', $titulo);
$sql->bindValue(':categoria', $categoria);
$sql->bindValue(':descricao', $descricao);
$sql->bindValue(':imagem', $nomeImagem);
$sql->bindValue(':local', $local);
$sql->bindValue(':convidados', $convidados);
$sql->bindValue(':id', $id);

$sql->execute();

header("Location: ../index.php");
exit;