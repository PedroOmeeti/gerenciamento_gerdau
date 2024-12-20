<?php
$raiz = 'http://' . $_SERVER['SERVER_NAME'] . '/gerenciamento_gerdau/';
$caminho_pagina = $raiz . 'view';

$data_inicial = isset($_POST['data_inicial']) ? $_POST['data_inicial'] : date('Y-m-d');
$data_final = isset($_POST['data_final']) ? $_POST['data_final'] : date('Y-m-d', strtotime('+7 days'));
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary p-3 mb-5">
  <div class="container">
    <div class="col-6">
      <a class="navbar-brand" href="<?= $caminho_pagina; ?>/painel_adm_view.php">
        <img src="<?= $raiz; ?>assets/images/logo_grsa_cortado_preto.png" alt="Logo GRSA">
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fs-5 <?php if (basename($_SERVER['REQUEST_URI']) == 'painel_adm_view.php') echo 'active'; ?>" 
             aria-current="page" 
             href="<?= $caminho_pagina; ?>/painel_adm_view.php">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 <?php if (basename($_SERVER['REQUEST_URI']) == 'cardapio_view.php') echo 'active'; ?>" 
             href="<?= $caminho_pagina; ?>../../model/actions/cardapio_controller.php?data_inicial=<?= $data_inicial ?>&data_final=<?= $data_final ?>">Cardápio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 <?php if (basename($_SERVER['REQUEST_URI']) == 'cozinha_view.php') echo 'active'; ?>"
             href="<?= $caminho_pagina; ?>../../model/actions/cozinha_controller.php">Cozinha</a>
        </li> 
        <li class="nav-item"> 
          <a class="nav-link fs-5 <?php if (basename($_SERVER['REQUEST_URI']) == 'funcionario_view.php') echo 'active'; ?>" 
             href="<?= $caminho_pagina; ?>/usuario/funcionario_view.php">Funcionários</a>
        </li>
        <li class="nav-item dropdown" 
            <?php if (isset($_COOKIE['nome_user'])) echo ' style="display: block;"'; else echo ' style="display: none;"'; ?>>
          <a class="nav-link dropdown-toggle text-decoration-none fs-5 fw-bold <?php if (basename($_SERVER['REQUEST_URI']) == 'editarInfosUsuario_view.php') echo 'active'; ?>" 
             href="#" 
             role="button" 
             data-bs-toggle="dropdown" 
             aria-expanded="false">
            <?php echo $_COOKIE['nome_user']; ?>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item <?php if (basename($_SERVER['REQUEST_URI']) == 'editarInfosUsuario_view.php') echo 'active'; ?>" 
                 href="<?= $caminho_pagina; ?>/usuario/editarInfosUsuario_view.php">Editar Perfil</a>
            </li>
            <li>
              <a class="dropdown-item <?php if (basename($_SERVER['REQUEST_URI']) == 'cadastrarUsuario_view.php') echo 'active'; ?>" 
                 href="<?= $caminho_pagina; ?>/usuario/cadastrarUsuario_view.php">Adicionar Usuário</a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item" href="#">Configurações</a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item" href="<?= $raiz; ?>sair.php">Sair</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
