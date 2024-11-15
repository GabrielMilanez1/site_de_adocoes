<?php
require_once 'session/session_start.php';
require_once 'header.php';

require_once 'services/LoginService.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <link rel="stylesheet" href="css/home-page-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial | Amigo Fiel</title>
  </head>
  
  <body>

    <main>
        <section class="intro">
            <h1>Bem Vindo ao Amigo Fiel</h1>
            <p>Dedicado aos nossos amigos de quatro patas, em situação de rua</p>
        </section>

        <section class="banner">
            <img src="images/imagem_pagina1.png" alt="Cachorro para adoção">
            <p>Adoção e posse responsável podem reduzir a população de animais de rua</p>
        </section>

        <section class="banner">
            <img src="images/imagem_pagina2.jpeg" alt="Cachorro em preto e branco">
            <p>Segundo a OMS, existem mais de 30 milhões de animais em situação de rua no Brasil</p>
        </section>

        <section class="how-to-participate">
            <h3>Sobre o Amigo Fiel</h3>
        </section>

        <section class="banner flex-column">
            <div class="narrowbody">
                <p>
                    O Amigo Fiel é um projeto universitário desenvolvido por estudantes de Ciência da Computação da <strong>Universidade Nove de Julho - Campus Memorial</strong> com o objetivo de criar uma plataforma para facilitar a adoção de animais em situação de vulnerabilidade. Esse site é uma iniciativa sem fins lucrativos, com foco em conectar pessoas interessadas em adotar animais com aqueles que estão em busca de um lar acolhedor e responsável.
                </p>
    
                <p>
                    Como parte do nosso projeto acadêmico, reservamos este espaço online para operar por um ano. Durante esse período, esperamos ajudar o máximo de animais e pessoas possível, proporcionando uma experiência segura e confiável para todos.
                </p>
    
                <p>
                    Se você acredita no impacto desse projeto e deseja colaborar para mantê-lo ativo após o período inicial, entre em contato conosco pelo email <a style="text-decoration: none; color: #000; font-weight: 800"href="mailto:projeto@amigofiel.online">projeto@amigofiel.online</a>. Sua contribuição pode fazer a diferença para muitos animais e suas futuras famílias.
                </p>
            </div>
        </section>
    </main>
    
  </body>

</html>

<?php require_once 'footer.php';