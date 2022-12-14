<?php

session_start();
require_once('connection.php');
require_once("config.php");
require_once("enum.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['enviar'])) {

        $con_msg = $_POST['msg'];
        $con_titulo = $_POST['titulo'];
        $uso_id = $_SESSION['uso_id'];

        $sql = "INSERT INTO contatos (uso_id, con_msg, con_titulo) VALUES ('$uso_id', '$con_msg', '$con_titulo')";

        if (mysqli_query($conn, $sql)) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro ao enviar mensagem: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);

    header("location: dashboard.php");
}
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

    <div class="container" style="margin-left:300px">
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img src="./img/contato.png" class="img-fluid" alt="image">
            </div>
            <div class="col-md-6">
                <h2 class="signin-text mb-3" style="margin-top:100px;">Escreva uma mensagem para o NuAzul</h2>
                <p>Por favor, preencha os campos para que a mensagem seja enviada</p>
                <div>
                    <form method="post">
                        </br>
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input class="form-control" required id="titulo" name="titulo" type="text"/>
                        </div>
                        </br>
                        <div class="mb-3">
                            <label for="msg" class="form-label">Mensagem</label>
                            <textarea class="form-control" required id="msg" name="msg" rows="3"></textarea>
                        </div>
                        <br />
                        <input type="submit" name="enviar" value="Enviar" class="btn btn-primary w100">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>