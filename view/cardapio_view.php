<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardapio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    require_once('./components/Navbar.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Cardapio</h1>
            </div>
        </div>

        <div class="row">

            <h1 class="text-center mt-4">Gerenciamento do Cardápio Semanal</h1>
            <div class="row mt-4">
                <?php
                $dias = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"];
                foreach ($dias as $dia): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span><?php echo $dia; ?></span>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addRefeicaoModal" data-dia="<?php echo $dia; ?>">Adicionar Refeição</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">almoço</h5>
                                    </div>
                                    <div class="col">
                                        <p>12:00</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <ul>
                                            <li>Arroz</li>
                                            <li>Feijão</li>
                                            <li>Salada</li>
                                            <li>Ovos cozidos</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <!-- Adicione a classe img-fluid e defina o tamanho da imagem -->
                                        <img src="../assets/images/comida.png" class="img-fluid">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">Janta</h5>
                                    </div>
                                    <div class="col">
                                        <p>19:00</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <ul>
                                            <li>Arroz</li>
                                            <li>Feijão</li>
                                            <li>Salada</li>
                                            <li>Ovos cuzidos</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <!-- Adicione a classe img-fluid e defina o tamanho da imagem -->
                                        <img src="../assets/images/comida.png" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>