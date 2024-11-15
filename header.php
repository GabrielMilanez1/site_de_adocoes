<?php

$nome_logado = '';
if (isset($_SESSION['nome']) && !empty($_SESSION['nome'])) {
  $nome_logado = explode(' ', $_SESSION['nome'])[0];
  $nome_logado = strtolower($nome_logado);
  $nome_logado = ucfirst($nome_logado);
}
  
?>

<!DOCTYPE html>

<html lang="pt-BR">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  
<link rel="stylesheet" href="../css/style-cabecalho.css">
  
<head>
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
  
<header>

  <div class="header-container esconde-mobile">
    <div class="container">
      <div style="display: flex; flex-direction: column; align-items: center; align-content: center; justify-content: center;">
        <a href="/">
          <img src="../images/amigo_fiel.webp" style="width: 130px">
          <p class="titulo-header">Amigo Fiel</p>
        </a>
        <?php if (isset($_SESSION['nome']) && !empty($_SESSION['nome'])): ?>
          <p>Você está logado como: "<?= $nome_logado ?>"</p>
        <?php endif; ?>
      </div>
      <nav>
        <ul>
          <li><a href="/animais-reportados">Animais cadastrados</a></li>
          <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
            <li><a href="/reportar">Cadastrar um animal</a></li>
            <li><a href="/logout">Sair</a></li>
          <?php else: ?>
            <li><a href="/login">Login</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>

  <div class="topnav esconde-desktop">
    
    <a href="/">
      <img src="../images/amigo_fiel.webp" style="width: 60px">
      <p class="titulo-header">Amigo Fiel</p>
    </a>

    <div id="links_hamburger">
      <?php if (isset($_SESSION['nome']) && !empty($_SESSION['nome'])): ?>
        <p style="text-align: center;">Você está logado como: <strong>"<?= $nome_logado ?>"</strong></p>
      <?php endif; ?>

      <a href="/animais-reportados">Animais cadastrados</a>
      <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
        <a href="/reportar">Cadastrar um animal</a>
      <a href="/logout">Sair</a>
      <?php else: ?>
        <a href="/login">Login</a>
      <?php endif; ?>
      
    </div>

    <a href="javascript:void(0);" class="icon" onclick="abrirHamburger()">
      <i class="fa fa-bars"></i>
    </a>
    
  </div>
  
</header>

<script>
  function abrirHamburger() {
    var x = document.getElementById("links_hamburger");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }
</script>
