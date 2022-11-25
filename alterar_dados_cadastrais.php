<?php
session_start();

require_once("connection.php");

require_once("config.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}


$new_password = $new_email = $confirm_password =  "";
$cep = $logradouro = $numero = $bairro = $cidade = $estado = "";

$email_err = "";
$new_password_err = $confirm_password_err = "";

$username = $_SESSION["uso_nome"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    $new_email = trim($_POST["email"]);
    $cep = trim($_POST['cep']);
    $logradouro = trim($_POST['logradouro']);
    $numero = trim($_POST['numero']);
    $bairro = trim($_POST['bairro']);
    $cidade = trim($_POST['cidade']);
    $estado = trim($_POST['estado']);

    if (empty($new_password)) {
        $new_password_err = "Por favor, digite a nova senha.";
    } elseif (strlen($new_password) < 6) {
        $new_password_err = "A senha deve possuir ao menos 6 caracteres.";
    }
    if (empty($confirm_password)) {
        $confirm_password_err = "Por favor, confirme a senha.";
    } elseif (empty($new_password_err) && ($new_password != $confirm_password)) {
        $confirm_password_err = "A senha não confere.";
    }
    if (empty($new_email)) {
        $email_err = "Por favor, digite o novo e-mail.";
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "O e-mail informado não é válido.";
    }
    if (empty($new_password_err) && empty($confirm_password_err) && empty($email_err)) {
        $sql = "UPDATE usuario SET uso_senha = ?, uso_email = ? WHERE uso_id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssi", $param_password, $param_email, $param_id);
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_email = $new_email;
            $param_id = $_SESSION["uso_id"];
            if (mysqli_stmt_execute($stmt)) {
                $sql = "UPDATE endereco SET end_cep = ?, end_logradouro = ?, end_num = ?, end_bairro = ?, end_cidade = ?, end_uf = ? WHERE end_id = ?";
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ssssssi", $param_cep, $param_logradouro, $param_numero, $param_bairro, $param_cidade, $param_estado, $param_id);
                    $param_cep = $cep;
                    $param_logradouro = $logradouro;
                    $param_numero = $numero;
                    $param_bairro = $bairro;
                    $param_cidade = $cidade;
                    $param_estado = $estado;
                    $param_id = $_SESSION["end_id"];
                    if (mysqli_stmt_execute($stmt)) {
                        session_destroy();
                        header("location: login.php");
                        exit();
                    } else {
                        echo "Algo deu errado. Por favor, tente novamente mais tarde.";
                    }
                }
            } else {
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
        mysqli_stmt_close($stmt);
    }
} else {
    $sql = "SELECT end_id, end_num, end_bairro, end_logradouro, end_cep, end_cidade, end_uf FROM endereco WHERE uso_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = $_SESSION["uso_id"];


        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $end_id, $numero, $bairro, $logradouro, $cep, $cidade, $estado);
                if (mysqli_stmt_fetch($stmt)) {
                    $numero = $numero;
                    $bairro = $bairro;
                    $logradouro = $logradouro;
                    $cep = $cep;
                    $cidade = $cidade;
                    $estado = $estado;
                    $_SESSION["end_id"] = $end_id;
                }
            } else {
                echo "Oops! VEIO MAIS DE 1.";
            }
        } else {
            echo "Oops! ERRRRROOOOO MAIOR";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($conn);
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
    <div class="container">
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img src="./img/alterar.png" class="img-fluid" alt="image">
            </div>
            <div class="col-md-6">
                <h2 class="signin-text mb-3"> Alterar Dados Cadastrais</h2>
                <p>Por favor, preencha os campos do formulário para alterar os dados cadastrais</p>
                <div>
                    <form method="post">
                        <div>
                            <label for="login">Usuário*</label>
                            <input type="text" name="username" id="login" class="form-control" readonly value="<?php echo $username; ?>">
                        </div>
                        </br>
                        <div>
                            <label for="login">E-mail*</label>
                            <input type="email" name="email" id="email" class="form-control required <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        </br>
                        <div>
                            <label for="senha">Nova Senha</label>
                            <input type="password" name="new_password" id="senha" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                            <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                        </div>
                        </br>
                        <div>
                            <label for="senha">Confirmação da Senha</label>
                            <input type="password" name="confirm_password" id="senha" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        </br>

                        </br>
                        <div>
                            <label for="estado">Estado</label>
                            <select class="form-select form-control" name="estado" id="estado">
                                <option value="0"> Escolha seu estado</option>
                                <option value="ac" <?= $estado === "ac" ? "selected" : "" ?>>Acre</option>
                                <option value="al" <?= $estado === "al" ? "selected" : "" ?>>Alagoas</option>
                                <option value="am" <?= $estado === "am" ? "selected" : "" ?>>Amazonas</option>
                                <option value="ap" <?= $estado === "ap" ? "selected" : "" ?>>Amapá</option>
                                <option value="ba" <?= $estado === "ba" ? "selected" : "" ?>>Bahia</option>
                                <option value="ce" <?= $estado === "ce" ? "selected" : "" ?>>Ceará</option>
                                <option value="df" <?= $estado === "df" ? "selected" : "" ?>>Distrito Federal</option>
                                <option value="es" <?= $estado === "es" ? "selected" : "" ?>>Espírito Santo</option>
                                <option value="go" <?= $estado === "go" ? "selected" : "" ?>>Goiás</option>
                                <option value="ma" <?= $estado === "ma" ? "selected" : "" ?>>Maranhão</option>
                                <option value="mt" <?= $estado === "mt" ? "selected" : "" ?>>Mato Grosso</option>
                                <option value="ms" <?= $estado === "ms" ? "selected" : "" ?>>Mato Grosso do Sul</option>
                                <option value="mg" <?= $estado === "mg" ? "selected" : "" ?>>Minas Gerais</option>
                                <option value="pa" <?= $estado === "pa" ? "selected" : "" ?>>Pará</option>
                                <option value="pb" <?= $estado === "pb" ? "selected" : "" ?>>Paraíba</option>
                                <option value="pr" <?= $estado === "pr" ? "selected" : "" ?>>Paraná</option>
                                <option value="pe" <?= $estado === "pe" ? "selected" : "" ?>>Pernambuco</option>
                                <option value="pi" <?= $estado === "pi" ? "selected" : "" ?>>Piauí</option>
                                <option value="rj" <?= $estado === "rj" ? "selected" : "" ?>>Rio de Janeiro</option>
                                <option value="rn" <?= $estado === "rn" ? "selected" : "" ?>>Rio Grande do Norte</option>
                                <option value="ro" <?= $estado === "ro" ? "selected" : "" ?>>Rondônia</option>
                                <option value="rs" <?= $estado === "rs" ? "selected" : "" ?>>Rio Grande do Sul</option>
                                <option value="rr" <?= $estado === "rr" ? "selected" : "" ?>>Roraima</option>
                                <option value="sc" <?= $estado === "sc" ? "selected" : "" ?>>Santa Catarina</option>
                                <option value="se" <?= $estado === "se" ? "selected" : "" ?>>Sergipe</option>
                                <option value="sp" <?= $estado === "sp" ? "selected" : "" ?>>São Paulo</option>
                                <option value="to" <?= $estado === "to" ? "selected" : "" ?>>Tocantins</option>
                            </select>
                        </div>
                        </br>
                        <div>
                            <label for="cep">CEP</label>
                            <input type="text" placeholder="87624-457" name="cep" id="cep" class="form-control" value="<?php echo $cep; ?>">
                        </div>
                        </br>
                        <div>
                            <label for="cidade">Cidade</label>
                            <input type="text" placeholder="Cidade" name="cidade" id="cidade" class="form-control" value="<?php echo $cidade; ?>">
                        </div>
                        </br>
                        <div>
                            <label for="logradouro">Logradouro</label>
                            <input type="text" placeholder="Rua Joaquim" name="logradouro" id="logradouro" class="form-control" value="<?php echo $logradouro; ?>">
                        </div>
                        </br>
                        <div>
                            <label for="numero">Número</label>
                            <input type="text" placeholder="102" name="numero" class="form-control" id="numero" value="<?php echo $numero; ?>">
                        </div>
                        </br>
                        <div>
                            <label for="bairro">Bairro</label>
                            <input type="text" placeholder="Bairro" name="bairro" id="bairro" class="form-control" value="<?php echo $bairro; ?>">
                        </div>
                        </br>
                        </br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                            <a class="btn btn-secondary" href="dashboard.php">Cancelar</a>
                        </div>
                    </form>
</body>

</html>