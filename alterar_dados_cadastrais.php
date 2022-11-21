<?php
session_start();

require_once("connection.php");

require_once("config.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //TODO: Falta validar senha

} else {
    $sql = "SELECT end_num, end_bairro, end_logradouro, end_cep, end_cidade, end_uf FROM endereco WHERE uso_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = $_SESSION["uso_id"];
        $username = $_SESSION["uso_nome"];

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $numero, $bairro, $logradouro, $cep, $cidade, $uf);
                if (mysqli_stmt_fetch($stmt)) {
                    $numero = $numero;
                    $bairro = $bairro;
                    $logradouro = $logradouro;
                    $cep = $cep;
                    $cidade = $cidade;
                    $uf = $uf;
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
    <!--CSS-->
    <link href="./css/style.css" rel="stylesheet">
    <!--Icon-->
    <link href="./img/dolar.png" rel="shortcut icon" type="image/x-icon">
</head>

<body>

    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"><img src="./img/logoBranca3.png" alt=""></label>
        <ul>
            <li><a href="./index.php">Sair</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img src="./img/imgRegister2.png" class="img-fluid" alt="image">
            </div>
            <div class="col-md-6">
                <h2 class="signin-text mb-3"> Alterar Dados Cadastrais</h2>
                <p>Por favor, preencha os campos do formulário para alterar os dados cadastrais...</p>
                <br>
                <div>
                    <form method="post">
                        <div>
                            <label for="login">Usuário*</label>              
                            <input type="text" name="username" id="login" class="form-control" readonly value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        </br>
                        <div>
                            <label for="senha">Nova Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        </br>
                        <div>
                            <label for="senha">Confirmação da Senha</label>
                            <input type="password" name="confirma_senha" id="senha" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        </br>
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
                            <label for="bairro">Bairro</label>
                            <input type="text" placeholder="Bairro" name="bairro" id="bairro" class="form-control" value="<?php echo $bairro; ?>">
                        </div>
                        </br>
                        <div>
                            <label for="numero">Número</label>
                            <input type="text" placeholder="102" name="numero" class="form-control" id="numero" value="<?php echo $numero; ?>">
                        </div>
                        </br>
                        <div>
                            <label for="uf">Estado</label>
                            <select class="form-select form-control" name="estado" id="uf">
                                <option value="0"> Escolha seu estado</option>
                                <option value="ac" <?= $uf === "ac" ? "selected" : "" ?>>Acre</option>
                                <option value="al" <?= $uf === "al" ? "selected" : "" ?>>Alagoas</option>
                                <option value="am" <?= $uf === "am" ? "selected" : "" ?>>Amazonas</option>
                                <option value="ap" <?= $uf === "ap" ? "selected" : "" ?>>Amapá</option>
                                <option value="ba" <?= $uf === "ba" ? "selected" : "" ?>>Bahia</option>
                                <option value="ce" <?= $uf === "ce" ? "selected" : "" ?>>Ceará</option>
                                <option value="df" <?= $uf === "df" ? "selected" : "" ?>>Distrito Federal</option>
                                <option value="es" <?= $uf === "es" ? "selected" : "" ?>>Espírito Santo</option>
                                <option value="go" <?= $uf === "go" ? "selected" : "" ?>>Goiás</option>
                                <option value="ma" <?= $uf === "ma" ? "selected" : "" ?>>Maranhão</option>
                                <option value="mt" <?= $uf === "mt" ? "selected" : "" ?>>Mato Grosso</option>
                                <option value="ms" <?= $uf === "ms" ? "selected" : "" ?>>Mato Grosso do Sul</option>
                                <option value="mg" <?= $uf === "mg" ? "selected" : "" ?>>Minas Gerais</option>
                                <option value="pa" <?= $uf === "pa" ? "selected" : "" ?>>Pará</option>
                                <option value="pb" <?= $uf === "pb" ? "selected" : "" ?>>Paraíba</option>
                                <option value="pr" <?= $uf === "pr" ? "selected" : "" ?>>Paraná</option>
                                <option value="pe" <?= $uf === "pe" ? "selected" : "" ?>>Pernambuco</option>
                                <option value="pi" <?= $uf === "pi" ? "selected" : "" ?>>Piauí</option>
                                <option value="rj" <?= $uf === "rj" ? "selected" : "" ?>>Rio de Janeiro</option>
                                <option value="rn" <?= $uf === "rn" ? "selected" : "" ?>>Rio Grande do Norte</option>
                                <option value="ro" <?= $uf === "ro" ? "selected" : "" ?>>Rondônia</option>
                                <option value="rs" <?= $uf === "rs" ? "selected" : "" ?>>Rio Grande do Sul</option>
                                <option value="rr" <?= $uf === "rr" ? "selected" : "" ?>>Roraima</option>
                                <option value="sc" <?= $uf === "sc" ? "selected" : "" ?>>Santa Catarina</option>
                                <option value="se" <?= $uf === "se" ? "selected" : "" ?>>Sergipe</option>
                                <option value="sp" <?= $uf === "sp" ? "selected" : "" ?>>São Paulo</option>
                                <option value="to" <?= $uf === "to" ? "selected" : "" ?>>Tocantins</option>
                            </select>
                        </div>
                        </br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                            <a class="btn btn-secondary" href="home.php">Cancelar</a>
                        </div>           
                    </form>
</body>

</html>