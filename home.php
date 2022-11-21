<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style-home.css">
</head>

<body>
  <div class="header">
    <div>
      <figure>
        <img src="img/logo.png" class="img-fluid" alt="Responsive image">
      </figure>

      <div class="topnav">
        <a href="#">Link</a>
        <a href="#">Link</a>
        <a href="#">Link</a>
        <a href="logout.php" style="float:right;">SAIR</a>
      </div>

      <div class="row">
        <div class="leftcolumn">
          <div class="card">
            <h2>Minhas Despesas</h2>
            <form>
              <div class="data">
                <label for="diaa">Data inicial</label>
                <input type="date" id="diaa" name="diaa">
                <label for="diaa">Data final</label>
                <input type="date" id="diaa" name="diaa">
              </div>
            </form>

            <div class="fakeimg" style="height:200px;">Image</div>

          </div>
          <div class="card">
            <h2>TITLE HEADING</h2>

            <div class="fakeimg" style="height:200px;">Image</div>

          </div>
        </div>
        <?php
        $valor = 100;
        ?>
        </php>
        <div class="rightcolumn">
          <div class="card">
            <h2>Total Despesas</h2>
            <div class="fakeimg" style="height:100px; border-radius:10px;"><?php echo $valor ?></div>

          </div>
          <div class="card">
            <h3>Meu Saldo</h3>
            <div class="fakeimg">
              <p>Renda</p>
            </div>
            <div class="fakeimg">
              <p>Despesas</p>
            </div>
            <div class="fakeimg">
              <p>Saldo</p>
            </div>
          </div>
          <div class="card">
            <h3>Contato</h3>
            <p>nuazul.financas@gmail.com</p>
          </div>
        </div>
      </div>

</body>

</html>