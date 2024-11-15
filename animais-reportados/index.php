<?php
require_once '../session/session_start.php';
require_once '../services/LoginService.php';
require_once '../class/MysqliClass.php';

require_once '../header.php';

const POR_PAGINA = 10;
const COLUNAS = 2;

$pagina_atual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

$db = new MysqliClass();
$query = 'SELECT * FROM tb_animais WHERE ativo = 1';
$animais = $db->getResultsQuery($query);
$animais_paginado = array_chunk($animais, POR_PAGINA);

if (isset($animais_paginado[$pagina_atual-1])) {
  $linhas_de_animais_pagina_atual = array_chunk($animais_paginado[$pagina_atual-1], COLUNAS);
} else {
  exit();
}

?>

<style>
  
  .card-image {
    width: 400px;
    height: 400px;
    object-fit: cover;
  }

  .card-image-container {
    display: flex;
    justify-content: center;
  }

  .linha-de-animais-tabela {
    display: flex;
    flex-direction: row;
    justify-content: center;
    gap: 15%;
  }

  .linhas-e-colunas-animais-tabela {
    display: flex;
    flex-direction: column;
    gap: 3em;
  }

  div.paginate-container {
      display: flex;
      flex-direction: row;
      justify-content: center;
      margin-top: 4rem;
  }

  .paginate-container .paginate {
      display: flex;
      flex-direction: row;
      list-style-type: none;
      padding-left: 0;
      gap: 1%;
  }

  .paginate-container .paginate button {
      color: #000;
  }

  .paginate-container .paginate .prev-button {
      border-radius: 20px 0 0 20px;
      background-color: #e0e0e0;
      border: solid 1px #000;
  }

  .paginate-container .paginate .page-button {
      background-color: #fff;
      border: solid 1px #000;
  }
  .paginate-container .paginate .page-button:hover,
  .paginate-container .paginate .prev-button:hover,
  .paginate-container .paginate .next-button:hover {
      background-color: #7a242d;
      transition: background-color 500ms;
  }

  .paginate-container .paginate .page-button.active {
      background-color: #000;
      color: #fff;
  }
  .paginate-container .paginate .page-button.active:hover {
      background-color: #000;
  }

  .paginate-container .paginate .next-button {
      border-radius: 0 20px 20px 0;
      background-color: #e0e0e0;
      border: solid 1px #000;
  }

  .isDisabled {
      color: currentColor !important;
      cursor: not-allowed !important;
      opacity: 0.5 !important;
      text-decoration: none !important;
  }

  .paginate-container > li {
    width: 100%;
  }

  .card {
    display: flex;
    flex-direction: column;
    border-radius: 20px;
    max-width: 400px;
  }

  .card-content-container {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    font-family: 'Montserrat';
    margin: 10px;
  }

  .card-content-container .caracteristicas {
    font-weight: 700;
  }

  .card-contact-infos-container {
    display: none;
  }

  .card-contact-info {
    text-align: center;
    font-weight: 700;
  }

  @media (max-width: 1024px) {
    .linha-de-animais-tabela {
      flex-direction: column;
      gap: 3em;
      align-items: center;
    }
  }
  
</style>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <link rel="stylesheet" href="../css/animais-reportados.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animais cadastrados | Amigo Fiel</title>
  </head>
  <body>

    <h1 class="content" style="text-align: center; padding-top: 1em; padding-bottom: 1em;">Lista de animais pra adoção</h1>

    <div class="linhas-e-colunas-animais-tabela">
      <?php foreach ($linhas_de_animais_pagina_atual as $linha_de_animais): ?>

        <div class="linha-de-animais-tabela">      
          <?php foreach ($linha_de_animais as $animal): ?>
            <?php 
              $responsavel = $db->getUserById($animal['usuario_responsavel']);
              $nome_responsavel = explode(' ', $responsavel['nome'])[0];
              $nome_responsavel = strtolower($nome_responsavel);
              $nome_responsavel = ucfirst($nome_responsavel);
            ?>
  
            <div class="card">
              <div class="card-image-container">
                <img loading="lazy" class="card-image" src="/uploads/<?= $animal['imagem']?>">
              </div>
              <div class="card-content-container">
                <p class="card-text caracteristicas"><?= $animal['caracteristicas'] ?></p>
                <p class="card-text caracteristicas"><?= $db->getEspecie($animal['especie'])['nome'] ?></p>
                <p class="card-text">Idade estimada: <?= $animal['idade'] ?> anos</p>
                <p class="card-text">Peso: <?= $animal['peso'] ?> kg</p>
                <a href="#" data-id_animal="<?= $animal['id']; ?>" class="btn btn-warning btn-contato">Informações de contato</a>
              </div>
              <div class="card-contact-infos-container" id="infos-contato-<?= $animal['id'] ?>">
                <p class="card-contact-info"><?= $nome_responsavel ?></p>
                <p class="card-contact-info"><?= $responsavel['email'] ?></p>
              </div>
            </div>
  
          <?php endforeach; ?>
        </div>
    
      <?php endforeach; ?>
    </div>

    <?php if (count($animais) >= POR_PAGINA): ?>
        <div class="paginate-container">

            <?php
                $proxima_pagina = $pagina_atual + 1;
                $pagina_anterior = $pagina_atual - 1;
            ?>

            <ul class="paginate">
                <li>
                    <a <?= $pagina_anterior <= 0 ? 'class="isDisabled"' : 'href="?pagina='. $pagina_anterior . '"' ?>>
                        <button class="prev-button <?= $pagina_anterior <= 0 ? 'isDisabled' : '' ?>">
                            Página anterior
                        </button>
                    </a>
                </li>
                <li>
                    <a <?= $proxima_pagina > count($animais_paginado) ? 'class="isDisabled"' : 'href="?pagina='. $proxima_pagina . '"' ?>>
                        <button class="next-button <?= $proxima_pagina > count($animais_paginado) ? 'isDisabled' : '' ?>">
                            Próxima página
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    <?php endif; ?>

  </body>

</html>

<?php require_once '../footer.php'; ?>

<script>
  $('.btn-contato').on('click', function(e) {
    e.preventDefault();
    const id_animal = $(this).data('id_animal');

    $(`#infos-contato-${id_animal}`).toggle();
  });
</script>