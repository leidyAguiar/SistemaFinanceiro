<?php
session_start();
require_once("connection.php");
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
    ?>
    <section id="interface" style="margin-left:300px">
        <div class="navigation">
            <div class="profile">
                <img src="./img/usuario.png" alt="">
                <p><?php echo "Olá, ", $_SESSION['uso_nome'] ?></p>
            </div>
    </section>

    <div class="container" style="margin-left:300px">
        <div class="row content">
            <h2 class="signin-text mb-3" style="margin-top: 50px;">Mensagens</h2>
            <p>Mensagens enviadas pelos usuários</p>
            <hr>
            <br></br>
            <br></br>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="table-info" style="text-align:center">
                        <th scope="col" style="width: 25%;">Usuário</th>
                        <th scope="col">Mensagem</th>
                        <th scope="col" style="width: 25%;">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center">
                            <a href="#"><button type="button" class="btn btn-danger">Excluir</button></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>