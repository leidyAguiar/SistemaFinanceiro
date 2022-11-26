<?php

session_start();
require_once("enum.php");
require_once("config.php");
require_once('connection.php');

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
    $mysql_query = "SELECT  tran_id, tran_data, tran_valor, tran_descricao, tipo_id FROM transacao WHERE uso_id = {$_SESSION['uso_id']} AND tipo_id = 1 
    AND YEAR(tran_data) = {$data[0]} AND MONTH(tran_data) = {$data[1]}";
    
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
  <?php require("menu_lateral.php"); ?>
  <div class="container" style="margin-left:300px">
    <div class="row content">
      <h2 class="signin-text mb-3">Despesas</h2>
      <p>Listagem de despesas cadastradas.</p>
      <hr>
          <form class="data" method="post">
            <h4 class="tituloData">Selecione uma data</h4>
            <input type="month" id="mes_ano" name="mes_ano" value="<?= $dataCompleta ?>">
            <input type="submit" value="buscar">
        </form>
        <br></br>
        <div class="float-right p-1">
        <a href="./insert_despesa.php"><button type="button" class="btn btn-primary-acao">+ Novo</button></a>
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
          <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td style="text-align:center"><?php echo $row['tran_id']; ?></td>
              <td><?php echo $row['tran_descricao']; ?></td>
              <td style="text-align:center"><?php echo date("d/m/Y", strtotime($row['tran_data'])); ?></td>
              <td style="text-align:center">R$ <?= number_format($row['tran_valor'], 2, ',', '.' ); ?></td>
              <td>
                <a href="edit_despesa.php?tran_id=<?php echo $row['tran_id']; ?>"><button type="button" class="btn btn-primary-a">Editar</button></a>
                <a href="delete_despesa.php?tran_id=<?php echo $row['tran_id']; ?>"><button type="button" class="btn btn-danger">Excluir</button></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

</body>