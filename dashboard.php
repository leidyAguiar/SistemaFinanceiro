<?php
session_start();
?>

<?php
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nomeSistema ?></title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--CSS-->
    <link href="./css/style-dashboard.css" rel="stylesheet">
    <!--Icon-->
    <link href="./img/dolar.png" rel="shortcut icon" type="image/x-icon">
    <!--Icones da tela-->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    <?php require("menu_lateral.php"); 
    require_once('connection.php');

// Mysql query to select data from table
$mysql_query = "SELECT  tran_valor FROM transacao WHERE uso_id = {$_SESSION['uso_id']} AND tipo_id = 1" ;
$result = $conn->query($mysql_query);

$mysql_query = "SELECT  tran_valor FROM transacao WHERE uso_id = {$_SESSION['uso_id']} AND tipo_id = 2" ;
$result2 = $conn->query($mysql_query);



//Connection Close
mysqli_close($conn);
?>

<?php 
    $total_despesa = 0;
    while ($row = $result->fetch_assoc()) { 
      $total_despesa= $total_despesa + $row['tran_valor'];
    }

    $total_receita = 0;
    while ($row = $result2->fetch_assoc()) { 
      $total_receita = $total_receita + $row['tran_valor'];
    }

    $saldo_atual = $total_receita - $total_despesa;

    ?>
    <section id="interface" style="margin-left:300px">
        <div class="navigation">
            <div class="n1">
                <div class="search">
                    <i class="las la-search"></i>
                    <input type="text" placeholder="Pesquisar">
                </div>
            </div>

            <div class="profile">
                <img src="./img/man.png" alt="">
            </div>
        </div>

        <h3 class="i-name">
            Dashboard
        </h3>

        <div class="data">
                <h4> Data</h4>
            <input type="month" id="diaa" name="diaa">

        </div>


        <div class="values">
        <div class="row">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                    <i class="las la-wallet"></i>
                        <span>Saldo atual</span>
                        <h3><?php echo $saldo_atual?></h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <i class="las la-long-arrow-alt-up"></i>
                        <span>Receita</span>
                        <h3><?php echo $total_receita ?></h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <i class="las la-arrow-down"></i> 
                        <span>Despesas</span>
                        <h3><?php echo $total_despesa ?></h3>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


</body>

</html>