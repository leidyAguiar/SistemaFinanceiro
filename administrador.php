<?php

session_start();
require_once("enum.php");
require_once("config.php");
require_once('connection.php');

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
if ($_SESSION["tipo_usuario"] != TipoUsuario::ADMIN->value) {
    header("location: dashboard.php");
    exit;
}

$mysql_query = "SELECT con_id, con.uso_id, con_msg, con_titulo, con_lida, uso_nome FROM contatos as con INNER JOIN usuario as uso on uso.uso_id = con.uso_id";

$result = $conn->query($mysql_query);

mysqli_close($conn);
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
                        <th scope="col">Título</th>
                        <th scope="col">Mensagem</th>
                        <th scope="col">Lida</th>
                        <th scope="col" style="width: 25%;">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $row['uso_nome']; ?></td>
                            <td style="text-align:center"><?php echo $row['con_msg']; ?></td>
                            <td style="text-align:center"><?php echo $row['con_titulo']; ?></td>
                            <td style="text-align:center"><?php echo $row['con_lida'] == "1" ? "Sim": "Não"; ?></td>
                            <td style="text-align:center">
                            <?php if ($row['con_lida'] == "0") { ?>
                                <a href="lida_msg.php?con_id=<?php echo $row['con_id']; ?>"><button type="button" class="btn btn-primary-acao">Lida</button></a>
                            <?php } ?>
                                <a href="delete_msg.php?con_id=<?php echo $row['con_id']; ?>"><button type="button" class="btn btn-danger">Excluir</button></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>