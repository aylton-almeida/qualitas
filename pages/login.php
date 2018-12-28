<!DOCTYPE html>
<html lang="pt_br">

<head>
  <title>Login</title>
  <!--Add icon-->
  <link rel="icon" type="image/png" href="https://firebasestorage.googleapis.com/v0/b/qualitas-24b79.appspot.com/o/Logo%2Ficon.png?alt=media&token=8884afeb-1c37-49e1-95bd-84d8c9d35f0a" sizes="32X32">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
  <!--Add css-->
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/master.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    session_start();
    $_SESSION['page']="login";
    include("../pageParts/nav.php");
    ?>
  </nav>
  <main>
    <div id="msg1" role="alert">
      <div class="loaderDiv" id="loaderDiv">
        <div class="loader" id="loader"></div>
      </div>
    </div>
    <div class="block">
      <div class="card">
        <div class="card-header bg-dark text-light">
          <h1>Login</h1>
        </div>
        <div class="card-body">
          <form id="form">
            <div class="form-group">
              <label for="emailInput">Email</label>
              <input type="email" name="email" class="form-control" id="emailInput" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="passInput">Senha</label>
              <input type="password" name="password" class="form-control" id="passInput" placeholder="Senha" required>
            </div>
            <div class="form-group form-check">
              <input type="checkbox" name="check" class="form-check-input" id="checkInput">
              <label for="checkInput">Mantenha-me conectado</label>
            </div>
            <button type="button" class="btn btn-dark" id="btnLogin">Login</button>
          </form>
        </div>
        <div class="card-footer bg-dark">
          <a href="#" class="card-link" id="redefSenha">Esqueceu sua senha?</a>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <?php
    include("../pageParts/footer.php");
    ?>
  </footer>
  <script type="text/javascript" src="../js/login.js"></script>
</body>

</html>
