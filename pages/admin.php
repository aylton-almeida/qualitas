<!DOCTYPE html>
<html lang="pt_br">

<head>
  <title>Administrador</title>
  <!--Add icon-->
  <link rel="icon" type="image/png" href="../imagens/icon.png" sizes="32X32">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
  <!--Add Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <!-- Add cropie -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css" />
  <!--Add css-->
  <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    session_start();
    $_SESSION['page']="admin";
    include("../pageParts/nav.php");
    ?>
  </nav>
  <main>
    <div id="msg" role="alert">
    </div>
    <div class="block">
      <div class="card">
        <div class="card-header bg-dark text-light">
          <h1>Administrador</h1>
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <button class="col-12 btn btn-dark">Cadastrar usuário</button>
            </div>
            <div class="row">
              <button class="col-12 btn btn-dark">Cadastrar imóvel</button>
            </div>
          </div>
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
  <script type="text/javascript" src="../js/admin.js"></script>
</body>

</html>
