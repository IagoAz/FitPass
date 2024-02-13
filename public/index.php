<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="View/css/index.css">
</head>
<body>
  <?php
  $pageTitle = "Index";
  include('View/layout/header.php'); // Inclui o header
  ?>
  <br/><br/>
  <div style="text-align: center;">
    <div class="card" style="display: inline-block; width: 200px; margin: 40px;">
      <div class="bg">
        <img src="./imagens/imagem1.jpeg" alt="Academia">
      </div>
      <div class="blob"></div>
    </div>
    <div class="card" style="display: inline-block; width: 200px; margin: 40px;">
      <div class="bg">
        <img src="./imagens/suplementos.jpg" alt="Suplementos">
      </div>
      <div class="blob"></div>
    </div>

    <div class="card" style="display: inline-block; width: 200px; margin: 40px;">
      <div class="bg">
        <img src="./imagens/alimentos.jpg" alt="Alimentos">
      </div>
      <div class="blob"></div>
    </div>
  </div>
  <div class="desc_image">
    <p style="display: inline-block; width: 200px; text-align:justify; margin: 50px;"><b>Como faço esse treino?</b> Podemos responder essas perguntas!</p>
    <p style="display: inline-block; text-align:justify; width: 200px; margin: 40px;"><b>Qual suplemento tomar?</b> Te explicaremos o que ele cada um faz no seu organismo e a maneira correta de ingerir.</p>
    <p style="display: inline-block; width: 200px; text-align:justify ;margin: 40px;"><b>O que devo comer?</b> Mostraremos como os alimentos interferem no seu objetivo.</p>
  </div>
  <br /><br />
  <div class="ajuda_esp">
    <p>Precisa de algum especialista?</p>
    <p>Não sabe onde treinar?</p>
    <p>Contate nosso email que nos responderemos você!</p>
  </div>
  <br /><br />
  <div class="quemsomos">
    <h2 style="text-align: center;">
      Quem somos?
    </h2>
    <p style="width: 600px; text-align:justify; padding-left: 16px; padding-right: 0px;">Somos uma equipe dedicada, formada por Frederico Sousa Ribeiro, Iago Azevedo Lira, Júlio César do Amaral Francisco, Luiz Gustavo Federici, Pedro Henrique Gonçalves Walbon e Vitor Hugo Azevedo de Oliveira Desenvolvemos esta página com o propósito específico de entregar o trabalho final exigido pelas disciplinas AAP 2 e AAP 3 da Fatec Barueri.
    </p>
  </div>
</body>
<br /><br /><br /><br />
<?php
include('View/layout/footer.php'); // Inclui o footer
?>
</html>