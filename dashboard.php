<?php

session_start();
require_once('connection.php');
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
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }
    $dataCompleta = date("Y-m");
    $data = [date("Y"), date("m")];
    if (isset($_POST['mes_ano'])) {
        $dataCompleta  = $_POST['mes_ano'];
        $data = explode('-', $_POST['mes_ano']);
    }
    $mysql_query = "SELECT  tran_valor FROM transacao WHERE uso_id = {$_SESSION['uso_id']} AND tipo_id = 1 AND YEAR(tran_data) = {$data[0]} AND MONTH(tran_data) = {$data[1]}";
    $result = $conn->query($mysql_query);

    $mysql_query = "SELECT  tran_valor FROM transacao WHERE uso_id = {$_SESSION['uso_id']} AND tipo_id = 2 AND YEAR(tran_data) = {$data[0]} AND MONTH(tran_data) = {$data[1]}";
    $result2 = $conn->query($mysql_query);

    mysqli_close($conn);
    ?>

    <?php
    $data_hoje = date("Y-m");

    $total_despesa = 0;
    while ($row = $result->fetch_assoc()) {
        $total_despesa = $total_despesa + $row['tran_valor'];
    }

    $total_receita = 0;
    while ($row = $result2->fetch_assoc()) {
        $total_receita = $total_receita + $row['tran_valor'];
    }

    $saldo_atual = $total_receita - $total_despesa;

    ?>
    <section id="interface" style="margin-left:300px">
        <div class="navigation">
            <div class="profile">
                <img src="./img/usuario.png" alt="">
                <p><?php echo "Olá, ", $_SESSION['uso_nome'] ?></p>
            </div>
        </div>

        <h3 class="i-name">
            Dashboard
        </h3>

        <form class="data" method="post">
            <h4 class="tituloData">Selecione uma data</h4>
            <input type="month" id="mes_ano" name="mes_ano" value="<?= $dataCompleta ?>">
            <input type="submit" value="buscar">
        </form>
        <br></br>
        <div class="values">
            <div class="row">
                <div class="col mb-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="las la-long-arrow-alt-up"></i>
                            <span>Receita</span>
                            <h3>R$ <?= number_format($total_receita, 2, ',', '.'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="las la-arrow-down"></i>
                            <span>Despesas</span>
                            <h3>R$ <?= number_format($total_despesa, 2, ',', '.'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col mb-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="las la-wallet"></i>
                            <span>Saldo atual</span>
                            <h3>R$ <?= number_format($saldo_atual, 2, ',', '.'); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>