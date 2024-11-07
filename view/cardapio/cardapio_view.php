<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="">
    <?php require_once('../components/Navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Cardápio</h1>
            </div>
        </div>


        <div class="row">
            <h1 class="text-center mt-4">Gerenciamento do Cardápio Semanal</h1>
            <div>
                <button class="btn btn-primary" data-toggle="modal" onclick="window.location.href='adicionarRefeicao_view.php'">Adicionar Refeição</button>
            </div>

            <div class="row mt-5">
                <h1>Segunda-feira</h1>
                <div class="row col-12 p-2">
                    <div class="card border border-1 rounded-4 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Dia a Dia</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row col-12 p-2">
                    <div class="card border-1 rounded-4 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Speciale</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-12 p-2">
                    <div class="card border-1 rounded-4 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Clássico</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-12 p-2">
                    <div class="card border-1 rounded-4 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Natural</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <h1>Terça-feira</h1>
                <div class="row col-12 p-2">
                    <div class="card border border-1 rounded-4 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Dia a Dia</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row col-12 p-2">
                    <div class="card border-1 rounded-4 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Speciale</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-12 p-2">
                    <div class="card border-1 rounded-4 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Clássico</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-12 p-2">
                    <div class="card border-1 rounded-4 bg-body-tertiary ">
                        <div class="card-body d-flex flex-row p-0">
                            <div class="col-3 border-end border-2 p-3">
                                <h5 class="card-title">Natural</h5>
                            </div>
                            <div class="col-7 text-center p-3">
                                <p class="fs-5"><b>Almoço</b></p>
                                <p class="card-text f2-4">Descrição da refeição</p>
                            </div>
                            <div class="col-2 text-end border-start border-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" onclick="window.location.href='editarCardapio_view.php'">Editar Refeição</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>