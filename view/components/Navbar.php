<?php
$raiz = 'http://'.$_SERVER['SERVER_NAME'].'/gerenciamento_gerdau/';
$caminho_pagina = $raiz.'view';

?>
<nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
  <div class="container">
    <div class="col-6">
      <a class="navbar-brand" href="<?=$caminho_pagina;?>/painel_adm_view.php"><img src="<?=$raiz;?>assets/images/logo_grsa_cortado_preto.png" alt="Logo GRSA"></a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active fs-5" aria-current="page" href="<?=$caminho_pagina;?>/painel_adm_view.php">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5" href="<?=$caminho_pagina;?>/cardapio/cardapio_view.php">Cardápio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5" href="#">Estástisticas</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-decoration-none fs-5 fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_COOKIE['nome']; ?></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Editar Perfil</a></li>
            <li><a class="dropdown-item" href="./usuario/cadastrarUsuario_view.php">Adicionar Usuário</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Configurações</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="../index.php">Sair</a></li>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</nav>


