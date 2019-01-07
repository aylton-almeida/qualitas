<!DOCTYPE html>
<html lang="pt_br">

<head>
  <title>Pagamentos</title>
  <!--Add icon-->
  <link rel="icon" type="image/png" href="https://firebasestorage.googleapis.com/v0/b/qualitas-24b79.appspot.com/o/Logo%2Ficon.png?alt=media&token=8884afeb-1c37-49e1-95bd-84d8c9d35f0a" sizes="32X32">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
  <!--Add css-->
  <link rel="stylesheet" href="../css/pagamentos.css">
  <link rel="stylesheet" href="../css/master.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    session_start();
    $_SESSION['page']="pagamentos";
    include("../pageParts/nav.php");
    ?>
  </nav>
  <main>
    <!-- Alerta -->
    <div id="msg1" role="alert"></div>
    <div class="loaderDiv" id="loaderDiv">
      <div class="loader" id="loader"></div>
    </div>
    <!-- Titulo da pagina -->
    <div class="container-fluid bg-dark menu">
      <div class="py-3 px-3 row">
        <h3 id="bemVindoAdmin" class="col-lg-4 col-md-5 text-light">Pagamentos</h3>
        <!-- <button id="btnSair" class="offset-lg-7 col-lg-1 offset-md-5 col-md-2 btn btn-outline-secondary" type="button">Sair</button> -->
      </div>
    </div>
  </main>
  <footer>
    <?php
    include("../pageParts/footer.php");
    ?>
  </footer>
  <script type="text/javascript" src="../js/pagamentos.js"></script>
</body>

</html>
