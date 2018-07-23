<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>Qualitas</title>
    <!--Add icon-->
    <link rel="icon" type="image/png" href="https://firebasestorage.googleapis.com/v0/b/qualitas-24b79.appspot.com/o/Logo%2Ficon.png?alt=media&token=8884afeb-1c37-49e1-95bd-84d8c9d35f0a" sizes="32X32">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
    <!--Add Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- Add cropie -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css"/>
    <!--Add css-->
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    session_start();
    $_SESSION['page']="home";
    include("pageParts/nav.php");
    ?>
</nav>
    <main>
      <div class="container-fluid bg-dark">
        <div id="msg1" role="alert">
        </div>
      </div>
      <!--Bloco 1: Logo/Pesquisa-->
      <div class="block1 bg-dark">
          <img id="img" class="img-fluid" width="100%" src="imagens/logo_texto.png" alt="Qualitas Imobiliária e Construtora">
      </div>
      <!--Bloco 2: Acesso Rápido-->
      <div class="block2 bg-light">
        <div class="container">
          <div class="row acesso">
              <h1>Acesso rápido</h1>
          </div>
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  Imóveis
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Imóvel 1</li>
                    <li class="list-group-item">Imóvel 2</li>
                    <li class="list-group-item">Imóvel 3</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-header">
                  Imóveis
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Imóvel 1</li>
                    <li class="list-group-item">Imóvel 2</li>
                    <li class="list-group-item">Imóvel 3</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-header">
                  Imóveis
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Imóvel 1</li>
                    <li class="list-group-item">Imóvel 2</li>
                    <li class="list-group-item">Imóvel 3</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Bloco 3: Imóveis recentes -->
      <!--Bloco 4: Imobiliárias primárias -->
      <!--Bloco 5: Contato -->
    </main>
    <footer>
      <?php
      include("pageParts/footer.php");
      ?>
    </footer>
</body>

</html>
