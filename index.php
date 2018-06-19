<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>Qualitas</title>
    <!--Add icon-->
    <link rel="icon" type="image/png" href="imagens/logo_pequena.png" sizes="32X32">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
    <!--Add Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
    <!--Add jquery-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
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
      <!--Bloco 1-->
      <div class="block1 bg-dark">
          <img id="img" class="img-fluid" width="100%" src="imagens/logo_texto.png" alt="Qualitas Imobiliária e Construtora">
      </div>
      <!--Bloco 2-->
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
    </main>
</body>

</html>
