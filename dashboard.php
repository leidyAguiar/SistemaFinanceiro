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
    <!--Icon-->
    <link href="./img/dolar.png" rel="shortcut icon" type="image/x-icon">
    <!--CSS-->
    <link href="./css/style-dashboard.css" rel="stylesheet">
    <!--Icones da tela-->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <section id="menu">
        <div class="logo">
            <img src="./img/logoDinheiro.png" alt="">
            <h2>NuAzul<h2>
        </div>
        <div class="itens">
            <li>
                <a href="./dashboard.php"><i class="las la-home"></i>Dashboard</a>
            </li>

            <li>
                <a href="./despesas.php"><i class="las la-donate"></i>Despesas</a>
            </li>
            <li>
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="las la-cog"></i>Configurações
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="dropdownMenu">
                    <li>
                        <a href="./alterar_dados_cadastrais.php">Alterar Dados</a>
                    </li>
                    <li>
                        <a href="#">Excluir Conta</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="./logout.php"><i class="las la-power-off"></i>Logout</a>
            </li>
        </div>
    </section>

    <section id="interface">
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

        <div class="values">
        <div class="row">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                    <i class="las la-wallet"></i>
                        <span>Saldo atual</span>
                        <h3>R$ 1000</h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <i class="las la-long-arrow-alt-up"></i>
                        <span>Receita</span>
                        <h3>R$ 300</h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <i class="las la-arrow-down"></i> 
                        <span>Despesas</span>
                        <h3>R$ 300</h3>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


</body>

</html>