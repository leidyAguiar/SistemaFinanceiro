<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-index.css">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<body>
<?php
require("header-inc.php"); ?>
<?php
$nome = 'Evandro';
?>

<h1>Bem vindo <?php echo $nome ?> ao NuAzul!</h1>



<div class='figura'>
    <figure>
    <img src="img/logo.png" class="img-fluid" alt="Responsive image">
    </figure>
</div>

<div> 

    <button type="button" class="btn btn-primary btn-lg" border-radius='20%;'>Large button</button>
</div>

<?php require("footer.inc.php"); ?>
</body>
</html>