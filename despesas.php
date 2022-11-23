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
    <!--Icon-->
    <link href="./img/dolar.png" rel="shortcut icon" type="image/x-icon">
    <!--CSS-->
    <link href="./css/style-dashboard.css" rel="stylesheet">
    <!--Icones da tela-->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <section id="menu">
        <div class="logo">
            <img src="./img/logoDinheiro.png" alt="">
            <h2>NuAzul<h2>
        </div>
        <div class="itens">
            <li>
                <i class="las la-home"></i>
                <a href="./dashboard.php">Dashboard</a>
            </li>

            <li>
                <i class="las la-donate"></i>
                <a href="./despesas.php">Despesas</a>
            </li>

            <li>
                <i class="las la-cog"></i>
                <a href="./alterar_dados_cadastrais.php">Configurações</a>
                </ul>
            </li>

            <li>
                <i class="las la-power-off"></i>
                <a href="./logout.php">Logout</a>
            </li>
        </div>
    </section>

</body>