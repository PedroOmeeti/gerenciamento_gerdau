<?php
$raiz = 'http://'.$_SERVER['SERVER_NAME'].'/gerenciamento_gerdau/';
$caminho_pagina = $raiz.'view';

?>

<link rel="stylesheet" href="./style/rodape.css">
<div class="div">
  <footer class="rodape bg-dark text-center text-white">
    <div class="container p-4 pb-0">
      <section class="mb-4">
        <a class="navbar-brand" href="<?=$caminho_pagina;?>/painel_adm_view.php"><img src="<?=$raiz;?>assets/images/logo_grsa_cortado_branco.png" alt="Logo GRSA"></a>
      </section>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2024 Copyright:
      <a class="text-white" href="#">Show Software</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>