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
    <!--Icon-->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
        <label class="logo"><img src="./img/logoBrancopequeno.png" alt=""></label>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href=""><span class="las la-home"></span>
                    <span>Dashboard</span>
                </li>
                <li>
                    <a href=""><span class="las la-donate"></span>
                    <span>Despesas</span>
                </li>
                <li>
                    <a href=""><span class="las la-times"></span>
                    <span>Logout</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
            
                <label for="">
                    <span class="las la-bars"></span>
                </label>
                Dashboard
            </h2>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Pesquisar"/>
            </div>

            <div class="user-wrapper">
                <img scr="./img/user.png" width="40px" height="40px" alt="">
                <small>Administrador</small>
            </div>
        </header>

        <div class="cards">
            <div class="card-single">
                <div>
                    <h1>1000</h1>
                    <span>Saldo atual</span>
                </div>
                <div>
                    <span class="las la-wallet"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1>300</h1>
                    <span>Despesas</span>
                </div>
                <div>
                    <span class="las la-hand-holding-usd"></span>
                </div>
            </div>

        </div>


    </div>
</body>
</html>