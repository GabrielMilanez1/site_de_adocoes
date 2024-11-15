<?php

require_once '../session/session_start.php';
require_once '../services/LoginService.php';
require_once '../class/MysqliClass.php';

$db = new MysqliClass();

if ($_POST) {

    if (
      (!$_POST['especie'] || empty($_POST['especie']))
      || (!$_POST['caracteristicas'] || empty($_POST['caracteristicas']))
      || (!$_POST['idade-estimada'] || empty($_POST['idade-estimada']))
      || (!$_POST['peso'] || empty($_POST['peso']))
      || (!$_FILES['imagem'] || empty($_FILES['imagem']))
    ) {
      erro();
    } else {
        $especie = $_POST['especie'];
        $caracteristicas = $_POST['caracteristicas'];
        $idade = $_POST['idade-estimada'];
        $peso = $_POST['peso'];
    }

    $fileName = $_FILES['imagem']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $allowedExts = ['jpg', 'jpeg', 'png'];

    if (!in_array($fileExtension, $allowedExts)) {
      erro();
    }
  
    $novo_nome_arquivo = gerarStringAleatoria();
    $targetDir = "../uploads/";
    $targetFile = $targetDir . $novo_nome_arquivo . '.' . $fileExtension;

    while (true) {
        if (file_exists($targetFile)) {
            $novo_nome_arquivo = gerarStringAleatoria();
            $targetFile = $targetDir . $novo_nome_arquivo . '.' .$fileExtension;
        } else {
            break;
        }
    };

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFile) == false) {
      erro();
    }

    if ($db->gravaAnimal($especie, $caracteristicas, $idade, $peso, $novo_nome_arquivo . '.' . $fileExtension, $_SESSION['id_usuario'])) {
        sucesso();
    } else {
        erro();
    }

} else {
    erro();
}

function gerarStringAleatoria($tamanho = 20)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $resultado = '';

    for ($i = 0; $i < $tamanho; $i++) {
        $resultado .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $resultado;
}

function erro()
{
    header('Location: /reportar?erro=1');
    exit();
}

function sucesso()
{
    header('Location: /');
    exit();
}
