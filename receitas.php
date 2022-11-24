<?php

session_start();

require_once("enum.php");

require_once("config.php");

?>

<?php


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}


require_once('connection.php');

$mysql_query = "SELECT tran_id, tran_data, tran_valor, tran_descricao, tipo_id FROM transacao WHERE uso_id = {$_SESSION['uso_id']} AND tipo_id = " . TipoTransacao::RECEITA->value;
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
    <!--Icon-->
    <link href="./img/dolar.png" rel="shortcut icon" type="image/x-icon">
    <!--CSS-->
    <link href="./css/style.despesas.css" rel="stylesheet">
    <!--Icones da tela-->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <?php require("menu_lateral.php"); ?>
    <div class="container">
  <h2>Receitas</h2>
  <p>Listagem do receitas cadastradas.</p>
  <hr>
  <div class="float-right p-1">
    <a href="./insert_receita.php"><button type="button" class="btn btn-primary">+ Novo</button></a>
  </div>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-info" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col">Descrição</th>
        <th scope="col" style="width: 20%;">Data Transação</th>
        <th scope="col" style="width: 15%;">Valor Transação</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td style="text-align:center"><?php echo $row['tran_id']; ?></td>
            <td><?php echo $row['tran_descricao']; ?></td>
            <td style="text-align:center"><?php echo (new DateTime($row['tran_data']))->format('Y-m-d'); ?></td>
            <td style="text-align:center"><?php echo $row['tran_valor']; ?></td>
            <td style="text-align:center">
                <a href="edit_receita.php?tran_id=<?php echo $row['tran_id']; ?>"><button type="button" class="btn btn-primary">Editar</button></a>
                <a href="delete_receita.php?tran_id=<?php echo $row['tran_id']; ?>"><button type="button" class="btn btn-danger">Excluir</button></a>
            </td>
        </tr>
        <?php } ?>    
    </tbody>
  </table>
</div>
</body>