<?php
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title> <?php echo $nomeSistema ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="./css/style-index.css">
    <!--Icon-->
    <link href="./img/dolar.png" rel="shortcut icon" type="image/x-icon">
</head>

<body >
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"><img src="./img/logoBranca3.png" alt=""></label>
        <ul>
            <li><a href="./login.php">Login</a></li>
        </ul>
    </nav>
    <main class="container align-content-center d-flex justify-content-center p-5">
        <div class="row">
            <aside class="col-xl-6 col-12">
                <h2>Sejam bem-vindos e conheçam NuAzul</h2>
                <p style="margin: 20px 0">NuAzul foi desenvolvido para você, que deseja dar um Up em sua vida financeira, organizando suas contas com um sistema que atende as suas necessidades</p>
            </aside>
            <div class="col-xl-6 col-12">
                <img src="./img/home.png" alt="">
            </div>
        </div>
    </main>

</body>

</html>