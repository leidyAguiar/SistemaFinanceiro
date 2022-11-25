<?php

session_start();

require_once("enum.php");

require_once("config.php");

?>

<?php


// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

/**
 * Select Table Data
 * Fectching aata from database using mysqli_fetch_array() function and without table tag
 */

require_once('connection.php');

// Mysql query to select data from table
$mysql_query = "SELECT tran_id, tran_data, tran_valor, tran_descricao, tipo_id FROM transacao WHERE uso_id = {$_SESSION['uso_id']} AND tipo_id = " . TipoTransacao::DESPESA->value;
$result = $conn->query($mysql_query);

//Connection Close
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
  <div class="container">
    <div class="row content">
      <h2 class="signin-text mb-3">Despesas</h2>
      <p>Listagem do despesas cadastradas.</p>
      <hr>
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
              <td style="text-align:center"><?php echo $row['tran_descricao']; ?></td>
              <td style="text-align:center"><?php echo (new DateTime($row['tran_data']))->format('Y-m-d'); ?></td>
              <td style="text-align:center"><?php echo $row['tran_valor']; ?></td>
              <td style="display:flex;">
                <a href="edit_despesa.php?tran_id=<?php echo $row['tran_id']; ?>"><button type="button" class="btn btn-primary-acao">Editar</button></a>
                <a href="delete_despesa.php?tran_id=<?php echo $row['tran_id']; ?>"><button type="button" class="btn btn-danger">Excluir</button></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
</body>