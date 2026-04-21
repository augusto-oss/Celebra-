<?php

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {

    $arquivo = $_FILES['imagem'];

    $nomeOriginal = $arquivo['name'];
    $tmp = $arquivo['tmp_name'];

    //  Evita nomes duplicados
    $novoNome = uniqid() . "_" . $nomeOriginal;

    //  Pasta de destino
    $pasta = "img/";

    // Cria a pasta se não existir
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $caminho = $pasta . $novoNome;

    // 🚀 Move o arquivo
    if (move_uploaded_file($tmp, $caminho)) {
        echo "Imagem enviada com sucesso!";
        echo "<br><img src='$caminho' width='200'>";
    } else {
        echo "Erro ao mover a imagem.";
    }

} else {
    echo "Erro no upload:";
    print_r($_FILES['imagem']);
}