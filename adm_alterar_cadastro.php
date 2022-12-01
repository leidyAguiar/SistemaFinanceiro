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
    <section id="menu">
        <div class="logo">
            <img src="./img/logoDinheiro.png" alt="">
            <h2>NuAzul<h2>
        </div>
        <div class="itens">
            <li>
                <a href="./administrador.php"><i class="las la-comment"></i>Mensagens</a>
            </li>
            <li>
                <a href="./adm_alterar_cadastro.php"><i class="las la-cog"></i>Configurações</a>
            </li>
            <li>
                <a href="./logout.php"><i class="las la-power-off"></i>Logout</a>
            </li>
        </div>
    </section>

    <body>
        <div class="container" style="margin-left:300px">
            <div class="row content">
                <div class="col-md-6 mb-3">
                    <img src="./img/cadastroAdm.png" class="img-fluid" alt="image">
                </div>
                <div class="col-md-6">
                    <h2 class="signin-text mb-3"> Alterar Dados Cadastrais do Administrador</h2>
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
                                <a class="btn btn-secondary" href="./administrador.php">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>