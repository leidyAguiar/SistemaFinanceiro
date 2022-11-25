<?php
session_start();

require_once("connection.php");

require_once("config.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$new_tran_data = $new_tran_valor = $new_tran_descricao = "";
$new_tran_data_err = $new_tran_valor_err = $new_tran_descricao_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['enviar'])) {

        $tran_id = $_POST['tran_id'];
        $new_tran_data = $_POST['new_tran_data'];
        $new_tran_valor = $_POST['new_tran_valor'];
        $new_tran_descricao = $_POST['new_tran_descricao'];
        echo $tran_id . " " . $new_tran_data . " " . $new_tran_valor . " " . $new_tran_descricao;
        if (empty($new_tran_data) || empty($new_tran_valor) || empty($new_tran_descricao)) {
            $msg =  "update error";
            $msgerror = "Preencha todos os campos";
            header("Location: receitas.php?msg={$msg}&msgerror={$msgerror}");
        } else {

            $sql = "UPDATE transacao SET tran_data = ?, tran_valor = ?, tran_descricao = ? WHERE tran_id = ?";
            if ($stm = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stm, "ssss", $param_tran_data, $param_tran_valor, $param_tran_descricao, $param_tran_id);
                $param_tran_id = $tran_id;
                $param_tran_data = $new_tran_data;
                $param_tran_valor = $new_tran_valor;
                $param_tran_descricao = $new_tran_descricao;

                if (mysqli_stmt_execute($stm)) {

                    

                    header("Location: receitas.php?msg={$msg}&msgerror={$msgerror}");
                    exit();
                } else {
                    echo "Algo deu errado. Por favor, tente novamente mais tarde.";
                }
            } else {
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            mysqli_stmt_close($stm);
        }
    }
} else {
    $tran_id = $_GET['tran_id'];
    $sql = "SELECT tran_data, tran_valor, tran_descricao FROM transacao WHERE tran_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_tran_id);
        $param_tran_id = $tran_id;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $tran_data, $tran_valor, $tran_descricao);
                if (mysqli_stmt_fetch($stmt)) {
                    $new_tran_data = $tran_data;
                    $new_tran_valor = $tran_valor;
                    $new_tran_descricao = $tran_descricao;
                }
            } else {
                echo "Oops! VEIO MAIS DE 1.";
            }
        } else {
            echo "Oops! ERRRRROOOOO MAIOR";
        }
    }
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
    <?php require("menu_lateral.php"); ?>
    <div class="container" style="margin-left:300px">
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img src="./img/receita.png" class="img-fluid" alt="image">
            </div>
            <div class="col-md-6">
                <h2 class="signin-text mb-3" style="margin-top:100px;" > Alterar Receitas</h2>
                <p>Por favor, preencha os campos para serem alterados</p>
                <div>
                    <form method="post">
                        <input type="hidden" name="tran_id" value="<?php echo $tran_id; ?>">
                        <div>
                            <label for="new_tran_data">Data</label>
                            <input type="date" name="new_tran_data" id="new_tran_data" class="form-control" value="<?php echo (new DateTime($new_tran_data))->format('Y-m-d'); ?>">
                        </div>
                        </br>
                        <div>
                            <label for="new_tran_valor">Valor</label>
                            <input type="number" name="new_tran_valor" id="new_tran_valor" class="form-control" value="<?php echo $new_tran_valor; ?>">
                        </div>
                        </br>
                        <div>
                            <label for="new_tran_descricao">Descrição</label>
                            <input type="text" name="new_tran_descricao" id="new_tran_descricao" class="form-control" value="<?php echo $new_tran_descricao; ?>">
                        </div>
                        </br>
                        <div>
                            <input type="submit" class="btn btn-primary" name="enviar" value="Alterar">
                            <a href="receitas.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>