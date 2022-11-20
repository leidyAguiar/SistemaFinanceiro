<?php

// Include config file
require_once("connection.php");
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, digite o usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Usuário pode conter apenas letras, números e underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT uso_id FROM usuario WHERE uso_nome = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Esse usuário já está sendo usado.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["senha"]))){
        $password_err = "Por favor, digite a senha.";     
    } elseif(strlen(trim($_POST["senha"])) < 6){
        $password_err = "A senha deve possuir ao menos 6 caracteres.";
    } else{
        $password = trim($_POST["senha"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirma_senha"]))){
        $confirm_password_err = "Por favor, digite a confirmação da senha.";     
    } else{
        $confirm_password = trim($_POST["confirma_senha"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "As senhas digitadas não conferem.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO usuario (uso_nome, uso_senha) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<?php
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
    <!--CSS-->
    <link href="./css/style.css" rel="stylesheet">
    <!--Icon-->
    <link href="./img/dolar.png" rel="shortcut icon" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img src="./img/imgRegister2.png" class="img-fluid" alt="image">
            </div>
            <div class="col-md-6">
                <h3 class="signin-text mb-3"> Criar Conta</h3>
                <br>
                <form method="post">
                    <div>
                        <label for="login">Usuário</label>
                        <input type="text" name="username" class="form-control" id="login">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <br></br>
                    <div>
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" class="form-control" id="senha">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <br></br>
                    <div>
                        <label for="senha">Confirme sua senha</label>
                        <input type="password" name="confirma_senha" class="form-control" id="senha">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <br></br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <input type="reset" class="btn btn-secondary" value="Limpar">
                    </div>
                    <br></br>
                    <p>Possui uma conta? <a href="login.php">Fazer login</a></p>
                </form>
</body>

</html>