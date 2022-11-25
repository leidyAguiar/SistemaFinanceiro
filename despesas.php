<?php

session_start();

require_once("enum.php");
require_once('connection.php');

require_once("config.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

$mes = $ano = "";
$mes_err = $ano_err = "";

$mysql_query = "SELECT tran_id, tran_data, tran_valor, tran_descricao, tipo_id FROM transacao WHERE uso_id = {$_SESSION['uso_id']} AND tipo_id = " . TipoTransacao::DESPESA->value . " ORDER BY tran_data DESC";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $mes = trim($_POST['mes']);

  if (empty($mes) || $mes == "0") {
    $mes_err = "Por favor, informe o mês.";
  }

  $ano = trim($_POST['ano']);
  if (empty($ano) || $ano == "0") {
    $ano_err = "Por favor, informe o ano.";
  } else {
    $mes = $mes;
  }
  if (empty($mes_err) && empty($ano_err)) {
    $mysql_query = "SELECT tran_id, tran_data, tran_valor, tran_descricao FROM transacao WHERE uso_id = {$_SESSION['uso_id']} AND tipo_id = " . TipoTransacao::DESPESA->value . " AND MONTH(tran_data) = {$mes} AND YEAR(tran_data) = {$ano} ORDER BY tran_data DESC";
  }
}

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
      <br></br>
      <div class="float-right p-1">
        <form method="post">
          <div>
            <label for="mes">Mês</label>
            <select class="form-select form-control required <?php echo (!empty($ano_err)) ? 'is-invalid' : ''; ?>" style="width: 200px;" name="mes" id="mes" required>
              <option value="0"> Escolha o Mês</option>
              <option value="1" <?= $mes === "1" ? "selected" : "" ?>>Janeiro</option>
              <option value="2" <?= $mes === "2" ? "selected" : "" ?>>Fevereiro</option>
              <option value="3" <?= $mes === "3" ? "selected" : "" ?>>Março</option>
              <option value="4" <?= $mes === "4" ? "selected" : "" ?>>Abril</option>
              <option value="5" <?= $mes === "5" ? "selected" : "" ?>>Maio</option>
              <option value="6" <?= $mes === "6" ? "selected" : "" ?>>Junho</option>
              <option value="7" <?= $mes === "7" ? "selected" : "" ?>>Julho</option>
              <option value="8" <?= $mes === "8" ? "selected" : "" ?>>Agosto</option>
              <option value="9" <?= $mes === "9" ? "selected" : "" ?>>Setembro</option>
              <option value="10" <?= $mes === "10" ? "selected" : "" ?>>Outubro</option>
              <option value="11" <?= $mes === "11" ? "selected" : "" ?>>Novembro</option>
              <option value="12" <?= $mes === "12" ? "selected" : "" ?>>Dezembro</option>
            </select>
            <span class="invalid-feedback"><?php echo $mes_err; ?></span>
          </div>
          <div>
            <label for="ano">Ano</label>
            <select class="form-select form-control required <?php echo (!empty($ano_err)) ? 'is-invalid' : ''; ?>" style="width: 200px;" name="ano" id="ano" required>
              <option value="0"> Escolha o Ano</option>
              <option value="2023" <?= $ano === "2023" ? "selected" : "" ?>>2023</option>
              <option value="2022" <?= $ano === "2022" ? "selected" : "" ?>>2022</option>
              <option value="2021" <?= $ano === "2021" ? "selected" : "" ?>>2021</option>
              <option value="2020" <?= $ano === "2020" ? "selected" : "" ?>>2020</option>
              <option value="2019" <?= $ano === "2019" ? "selected" : "" ?>>2019</option>
              <option value="2018" <?= $ano === "2018" ? "selected" : "" ?>>2018</option>
            </select>
            <span class="invalid-feedback"><?php echo $ano_err; ?></span>
          </div>
          </br>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Filtrar">
          </div>
          </br>
        </form>
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