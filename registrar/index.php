<?php

require_once '../session/session_start.php';
require_once '../services/LoginService.php';
require_once '../class/MysqliClass.php';

$db = new MysqliClass();

$falha_registro = false;

if ($_POST) {

  $existe_nome = array_key_exists("nome", $_POST);
  $existe_username = array_key_exists("username", $_POST) && !str_contains($_POST['username'], ' ');
  $existe_email = array_key_exists("email", $_POST) && !str_contains($_POST['email'], ' ') && str_contains($_POST['email'], '@');;
  $existe_senha = array_key_exists("password", $_POST);
  $existe_genero = array_key_exists("genero", $_POST);

  $pode_registrar = $existe_nome && $existe_username && $existe_email && $existe_senha && $existe_genero;
  
    if ($pode_registrar) {

      $nome = $_POST['nome'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $senha = $_POST['password'];
      $genero = $_POST['genero'];

      $registro = false;

      try {
        $registro = $db->gravaUsuario($nome, $username, $email, $senha, $genero);
      } catch (Exception $e) {
        $falha_registro = true;
      }

      if($registro){
        header('location: /login');
      }
      
    } else {
      $falha_registro = true;
    }

}

?>

  <?php if(!$falha_registro): ?>
    <style>
      .erro-registro {
        display: none;
        visibility: hidden;
      }
    </style>
  <?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

  <link rel="stylesheet" href="../css/login-style.css">
  <meta charset="UTF-8">

  <title>Registro | Amigo Fiel</title>

  <link rel="icon" type="image/x-icon" href="../images/favicon.ico">

</head>
<body>

<div class="container">
    <h2>Registre-se</h2>

    <div class="erro-registro">
      <h4 style="text-align: center; color:red">Ocorreu um erro no seu registro!</h4>
      <h5 style="text-align: center; color:red">Verifique os dados informados e tente novamente</h4>
    </div>

    <form id="form-registro" method="post">
        <input type="text" name="nome" placeholder="Nome completo" required>
        <input type="text" id="username" name="username" placeholder="Apelido" required>
        <input type="text" id="email" class="sem-espaco" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Senha" required>
        <select name="genero">
          <option value="M">Masculino</option>
          <option value="F">Feminino</option>
          <option value="O">Outro</option>
        </select>
        <input id="submit" type="submit" value="Registrar">
    </form>

</div>

</body>

</html>

