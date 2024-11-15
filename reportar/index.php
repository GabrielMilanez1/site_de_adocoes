<?php

require_once '../session/session_start.php';
require_once '../services/LoginService.php';
require_once '../class/MysqliClass.php';

if (!LoginService::usuarioLogado()) {
  header('location: /login');
}

require_once '../header.php';

$db = new MysqliClass();
$query = "SELECT id, nome FROM tb_especies";
$especies = $db->getResultsQuery($query);

$erro = false;
if (isset($_GET['erro']) && !empty($_GET['erro'])) {
  if ($_GET['erro'] == 1);
  $erro = true;
}

?>

<style>

  .formulario-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-content: center;
  }

  .formulario-body {
    width: 50%;
    display: flex;
    flex-direction: column;
    gap: 1em;
  }
  
</style>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <link rel="stylesheet" href="../../css/reports-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar um animal para adoção | Amigo Fiel</title>
  </head>
  <body>

    <h1 class="content" style="text-align: center; padding-top: 1em; padding-bottom: 1em;">Cadastrar um animal pra adoção</h1>
  
    <?php if ($erro): ?>
      <p style="text-align: center; padding-top: 1em; padding-bottom: 1em; color: red;">Erro ao cadastrar animal, tente novamente</p>
    <?php endif; ?>

    <div class="formulario-container">
      
      <form class="formulario-body" method="post" enctype="multipart/form-data" action="/reportar/gravar.animal.cadastrado.php">
        
        <div class="form-group">
          <label for="especie">Espécie</label>
          <select required class="form-control" name="especie" id="especie">
            <option value="" data-default disabled selected>Selecione uma espécie</option>
            <?php foreach ($especies as $especie): ?>
              <option value="<?= $especie['id'] ?>">
                <?= $especie['nome'] ?>
              </option>
            <?php endforeach ?>;
          </select>
        </div>

        <div class="form-group">
          <label for="caracteristicas">Características</label>
          <input required type="textarea" maxlength="50" name="caracteristicas" id="caracteristicas" class="form-control" placeholder="Características (cor, tamanho, pelagem, etc.)">
        </div>

        <div class="form-group">
          <label for="idade-estimada">Idade</label>
          <input required type="number" name="idade-estimada" id="idade-estimada" step="0.5" max="150" class="form-control" placeholder="Idade aproximada do animal">
        </div>

        <div class="form-group">
          <label for="peso">Peso</label>
          <input required type="number" name="peso" id="peso" step="0.1" class="form-control" max="150" placeholder="Peso do animal (kg)">
        </div>

        <div class="form-group">
          <label for="imagem">Foto do animal</label>
          <input required class="form-control" type="file" accept=".jpg, .jpeg, .png" name="imagem" id="imagem">
        </div>
        
        <div class="form-group" style="text-align: center; padding-top: 2.5em;">
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>

      </form>

    </div>

  </body>

</html>

<?php require_once '../footer.php'; ?>