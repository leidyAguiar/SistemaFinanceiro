<?php
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Include config file
require_once("connection.php");
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, digite o usuário.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["senha"]))){
        $password_err = "Por favor, digite a senha.";
    } else{
        $password = trim($_POST["senha"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT uso_id, uso_nome, uso_senha  FROM usuario WHERE uso_nome = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["uso_id"] = $id;
                            $_SESSION["uso_nome"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: home.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Usuário ou senha incorretos.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Usuário ou senha incorretos.";
                }
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
    <title> <?php echo $nomeSistema ?> </title>
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
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
            <div class="col-md-6 mb-3">
                <img src="./img/LogoNuAzulMaior.png" class="img-fluid" alt="image">
            </div>
            <div class="col-md-6">
                <h3 class="signin-text mb-3" style="padding: 5px;"> Login </h3>
                <br>
                <form method="post">
                    <div>
                        <label for="login">Usuário</label>
                        <input type="text" name="username" class="form-control" id="login">
                    </div>
                    <br></br>
                    <div>
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" class="form-control" id="senha">
                    </div>
                    <br></br>
                    <div class="form-group from-check">
                        <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
                        <label class="form-check-label" for="checkbox">Lembrar-me</label>
                    </div>
                    <br></br>
                    <button class="btn btn-class">Entrar</button>
                    <br></br>
                    <p>Não possui uma conta? <a href="register.php">Criar conta</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>