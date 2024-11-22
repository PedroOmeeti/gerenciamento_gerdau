<?php
$raiz = 'http://' . $_SERVER['SERVER_NAME'] . '/gerenciamento_gerdau/';
session_start();
if (!isset($_SESSION['token'])) {
  header("location: ../index.php");
  exit();
}

require_once('../model/actions/classes/cardapio_model.php');
$cardapio = new Cardapio();
require_once('../model/actions/classes/pedido_model.php');
$pedido = new Pedido();




// $data_inicial = $_GET['data_inicial'] ?? date('Y-m-d', strtotime('-7 days'));
// $data_final = $_GET['data_final'] ?? date('Y-m-d');

date_default_timezone_set('America/Sao_Paulo');
$data_inicial = isset($_GET['data_inicial']) ? date('d/m/Y', strtotime(str_replace('/', '-', $_GET['data_inicial']))) : str_replace('-', '/', date('d/m/Y', strtotime('-7 days')));
$data_final = isset($_GET['data_final']) ? date('d/m/Y', strtotime(str_replace('/', '-', $_GET['data_final']))) : str_replace('-', '/', date('d/m/Y'));




$totalPessoas = $cardapio->listarTotalPorEstrela(5)['dados'][0]['qtd_pedidos'] + $cardapio->listarTotalPorEstrela(4)['dados'][0]['qtd_pedidos'] + $cardapio->listarTotalPorEstrela(3)['dados'][0]['qtd_pedidos'] + $cardapio->listarTotalPorEstrela(2)['dados'][0]['qtd_pedidos'] + $cardapio->listarTotalPorEstrela(1)['dados'][0]['qtd_pedidos'];

$totalPessoasPrato1 = $pedido->ListarTotalPedidosPratoPorData(1, $data_inicial, $data_final)['dados'][0]['qtd_pedidos'];
print_r($totalPessoasPrato1);
if ($totalPessoasPrato1 == 0) {
  $totalPessoasPrato1 = 1;
}

$totalPessoasPrato2 = $pedido->ListarTotalPedidosPratoPorData(2, $data_inicial, $data_final)['dados'][0]['qtd_pedidos'];
print_r($totalPessoasPrato2);

if ($totalPessoasPrato2 == 0) {
  $totalPessoasPrato2 = 1;
}

$totalPessoasPrato3 = $pedido->ListarTotalPedidosPratoPorData(3, $data_inicial, $data_final)['dados'][0]['qtd_pedidos'];
print_r($totalPessoasPrato3);

if ($totalPessoasPrato3 == 0) {
  $totalPessoasPrato3 = 1;
}

$totalPessoasPrato4 = $pedido->ListarTotalPedidosPratoPorData(4, $data_inicial, $data_final)['dados'][0]['qtd_pedidos'];
print_r($totalPessoasPrato4);

if ($totalPessoasPrato4 == 0) {
  $totalPessoasPrato4 = 1;
}



//qtd_votos * 100  / total_votos


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./components/style/painel_adm.css">
  <title>Painel</title>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {

      var data = new google.visualization.arrayToDataTable([
        ['Avaliações', 'Porcentagem'],
        ["5 Estrelas", <?= $cardapio->listarTotalPorEstrela(5)['dados'][0]['qtd_pedidos'] * 100 / $totalPessoas; ?>],
        ["4 Estrelas", <?= $cardapio->listarTotalPorEstrela(4)['dados'][0]['qtd_pedidos'] * 100 / $totalPessoas; ?>],
        ["3 Estrelas", <?= $cardapio->listarTotalPorEstrela(3)['dados'][0]['qtd_pedidos'] * 100 / $totalPessoas; ?>],
        ["2 Estrelas", <?= $cardapio->listarTotalPorEstrela(2)['dados'][0]['qtd_pedidos'] * 100 / $totalPessoas; ?>],
        ['1 Estrelas', <?= $cardapio->listarTotalPorEstrela(1)['dados'][0]['qtd_pedidos'] * 100 / $totalPessoas; ?>]
      ]);

      var options = {
        title: 'Pesquisa de Satisfação',
        width: 700,
        legend: {
          position: 'none'
        },
        chart: {
          title: 'Pesquisa de Satisfação',
          subtitle: 'Satafisfação a partir de porcentagem'
        },
        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
          x: {
            0: {
              side: 'top',
              label: 'Porcentagem'
            } // Top x-axis.
          }
        },
        bar: {
          groupWidth: "90%"
        }
      };

      var chart1 = new google.charts.Bar(document.getElementById('top_x_div'));
      chart1.draw(data, options);
    };

    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      
      var data = google.visualization.arrayToDataTable([
        
        ['Task', 'Hours per Day'],
        ['Dia-a-Dia', 11],
        ['Speciale', 2],
        ['Classico', 2],
        ['Natural', 2],

      ]);

      var options = {
        title: 'Pratos favoritos',

        bold: true,
        titleTextStyle: {
          color: 'grey',
          fontSize: 16,
          bold: false,
          fontName: 'Roboto',
        },

      };



      var chart2 = new google.visualization.PieChart(document.getElementById('piechart'));

      chart2.draw(data, options);
    }

    // DIA A DIA
    google.charts.setOnLoadCallback(drawStuff2);

    function drawStuff2() {
      <?php
        $listaLegal =  $pedido->listarQtdEstrelaPorPrato(1, $data_inicial, $data_final);
      ?>
      var data = new google.visualization.arrayToDataTable([
        ['Avaliações', 'Quantidade de votos'],
        <?php foreach($listaLegal['dados'] as $dados) { ?>
          <?php if($dados['nota_pedido'] != 0){ ?>
          ["<?= $dados['nota_pedido'] ?> Estrelas", <?= $dados['qtd_votos'] ?>],
          <?php } else { ?>
            ["<?= $dados['nota_pedido'] ?> Estrelas", 0 ]
        <?php } ?>
        <?php } ?>
        
      ]);

      var options = {
        title: 'Pesquisa de Satisfação do Prato Dia-a-Dia',
        width: 700,
        legend: {
          position: 'none'
        },
        chart: {
          title: 'Pesquisa de Satisfação do Prato Dia-a-Dia',
          subtitle: 'Satafisfação a partir de Quantidade de votos'
        },
        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
          x: {
            0: {
              side: 'top',
              label: 'Quantidade de votos'
            } // Top x-axis.
          }
        },
        bar: {
          groupWidth: "90%"
        }
      };

      var chart3 = new google.charts.Bar(document.getElementById('top_x_div2'));
      chart3.draw(data, options);
    };

    // ESPECIALE
    google.charts.setOnLoadCallback(drawStuff3);

    function drawStuff3() {

      <?php
        $listaLegal =  $pedido->listarQtdEstrelaPorPrato(1, $data_inicial, $data_final);
      ?>
      var data = new google.visualization.arrayToDataTable([
        ['Avaliações', 'Quantidade de votos'],
        <?php foreach($listaLegal['dados'] as $dados) { ?>
          <?php if($dados['nota_pedido'] != 0){ ?>
          ["<?= $dados['nota_pedido'] ?> Estrelas", <?= $dados['qtd_votos'] ?>],
          <?php } else { ?>
            ["<?= $dados['nota_pedido'] ?> Estrelas", 0 ]
        <?php } ?>
        <?php } ?>
        
      ]);

      var options = {
        title: 'Pesquisa de Satisfação do Prato Especiale',
        width: 700,
        legend: {
          position: 'none'
        },
        chart: {
          title: 'Pesquisa de Satisfação do Prato Especiale',
          subtitle: 'Satafisfação a partir de Quantidade de votos'
        },
        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
          x: {
            0: {
              side: 'top',
              label: 'Quantidade de votos'
            } // Top x-axis.
          }
        },
        bar: {
          groupWidth: "90%"
        }
      };

      var chart4 = new google.charts.Bar(document.getElementById('top_x_div3'));
      chart4.draw(data, options);
    };

    google.charts.setOnLoadCallback(drawStuff4);

    function drawStuff4() {

      <?php
        $listaLegal =  $pedido->listarQtdEstrelaPorPrato(1, $data_inicial, $data_final);
      ?>
      var data = new google.visualization.arrayToDataTable([
        ['Avaliações', 'Quantidade de votos'],
        <?php foreach($listaLegal['dados'] as $dados) { ?>
          <?php if($dados['nota_pedido'] != 0){ ?>
          ["<?= $dados['nota_pedido'] ?> Estrelas", <?= $dados['qtd_votos'] ?>],
          <?php } else { ?>
            ["<?= $dados['nota_pedido'] ?> Estrelas", 0 ]
        <?php } ?>
        <?php } ?>

        
      ]);

      var options = {
        title: 'Pesquisa de Satisfação do Prato Clássico',
        width: 700,
        legend: {
          position: 'none'
        },
        chart: {
          title: 'Pesquisa de Satisfação do Prato Clássico',
          subtitle: 'Satafisfação a partir de Quantidade de votos'
        },
        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
          x: {
            0: {
              side: 'top',
              label: 'Quantidade de votos'
            } // Top x-axis.
          }
        },
        bar: {
          groupWidth: "90%"
        }
      };

      var chart5 = new google.charts.Bar(document.getElementById('top_x_div4'));
      chart5.draw(data, options);
    };

    google.charts.setOnLoadCallback(drawStuff5);

    function drawStuff5() {
      <?php $lala = '50' ?>
      <?php
        $listaLegal =  $pedido->listarQtdEstrelaPorPrato(4, $data_inicial, $data_final);
      ?>
      
      var data = new google.visualization.arrayToDataTable([
        ['Avaliações', 'Quantidade de votos'],
        <?php foreach($listaLegal['dados'] as $dados) { ?>
          <?php if($dados['nota_pedido'] != 0){ ?>
          ["<?= $dados['nota_pedido'] ?> Estrelas", <?= $dados['qtd_votos'] ?>],
          <?php } else { ?>
            ["<?= $dados['nota_pedido'] ?> Estrelas", 0 ]
        <?php } ?>
        <?php } ?>
      ]);      

      var options = {
        title: 'Pesquisa de Satisfação do Prato Natural',
        width: 700,
        legend: {
          position: 'none'
        },
        chart: {
          title: 'Pesquisa de Satisfação do Prato Natural',
          subtitle: 'Satafisfação a partir de Quantidade de votos'
        },
        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
          x: {
            0: {
              side: 'top',
              label: 'Quantidade de votos'
            } // Top x-axis.
          }
        },
        bar: {
          groupWidth: "90%"
        }
      };

      var chart6 = new google.charts.Bar(document.getElementById('top_x_div5'));
      chart6.draw(data, options);
    };
  </script>

  <script type="text/javascript">

  </script>
</head>

<body class="overflow-auto">
  <!-- Nav -->
  <?php
  require_once('./components/Navbar.php');
  ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <h1 class="text-center pt-4 pb-3">Painel Administrativo</h1>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h3 class="text-center">Análise de dados relacionados ao cardápio</h3>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <p class="text-center fs-5 mt-3">Total de avaliações: <?= $totalPessoas ?></p>
      </div>
    </div>
    <div class="row my-5">
      <div class="col d-flex justify-content-center">
        <div id="top_x_div" style="width: 700px; height: 450px;"></div>
      </div>
      <div class="col d-flex justify-content-center">
        <div id="piechart" style="width: 700px; height: 450px;"></div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h3 class="text-center my-5">Análise de dados relacionados ao cardápio</h3>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="menu border border-2 rounded-4 p-3 bg-body-dark">
            <div class="row d-flex align-items-center justify-content-center">
              <div class="col">

              </div>
              <div class="col">
                <form id="form-cardapio" method="POST" action="../model/actions/listarQtdEstrelaPorPrato.php">
                  <div class="row p-2 d-flex text-center">
                    <div class="col">Data inicial:
                      <input type="date" id="data_inicial" name="data_inicial" value="<?= $data_inicial ?>">
                    </div>
                    <div class="col">Data final:
                      <input type="date" id="data_final" name="data_final" value="<?= $data_final ?>">
                    </div>
                  </div>
                  <div class="row text-center">
                    <div class="col">
                      <button class="btn" style="background-color: #B49C5E; color: white" type="submit" id="exibir-cardapio">Exibir Dados</button>

                    </div>
                  </div>
                </form>
              </div>
              <div class="col"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row my-5">
      <div class="col d-flex justify-content-center">
        <div id="top_x_div2" style="width: 700px; height: 450px;"></div>
      </div>
      <div class="col d-flex justify-content-center">
        <div id="top_x_div3" style="width: 700px; height: 450px;"></div>
      </div>
    </div>
  </div>
  <div class="container">
    <hr>
  </div>
  <div class="container-fluid">
    <div class="row my-5">
      <div class="col d-flex justify-content-center">
        <div id="top_x_div4" style="width: 700px; height: 450px;"></div>
      </div>
      <div class="col d-flex justify-content-center">
        <div id="top_x_div5" style="width: 700px; height: 450px;"></div>
      </div>
    </div>
  </div>

  <?php
  require_once('./components/Rodape.php');
  ?>


</body>

</html>