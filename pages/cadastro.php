<!DOCTYPE html>
<html lang="pt_br">
<head>
  <title>Cadastro</title>
  <!--Add icon-->
  <link rel="icon" type="image/png" href="../imagens/icon.png" sizes="32X32">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
  <!--Add Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <!-- Add cropie -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css" />
  <!--Add css-->
  <link rel="stylesheet" href="../css/cadastro.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    session_start();
    $_SESSION['page']="cadastro";
    include("../pageParts/nav.php");
    ?>
  </nav>
  <main>
    <div id="msg" role="alert">

    </div>
    <div class="block">
      <div class="card">
        <div class="card-header bg-dark text-light">
          <h1>Cadastro</h1>
        </div>
        <div class="card-body">
          <form id="form">
            <div class="form-group">
              <label for="nomeInput">Nome</label>
              <div class="input-group">
                <input type="text" name="nome" class="form-control" id="nomeInput" placeholder="Nome..." required>
                <input type="text" name="sobrenome" class="form-control" id="sobrenomeInput" placeholder="Sobrenome..." required>
              </div>
            </div>
            <div class="form-group">
              <label for="imobiliariaInput">Imobiliária</label>
              <select class="custom-select" id="imobiliariaInput" name="selectImobiliaria" required>
                <option selected>Escolha sua imobiliária...</option>
                <option value="Conceito Empreendimentos Imobiliarias LTDA">Conceito Empreendimentos Imobiliarias LTDA</option>
                <option value="FAI Consultoria de imoveis LTDA">FAI Consultoria de imoveis LTDA</option>
                <option value="Invest Administradiora e Corretora de Imóveis LTDA">Invest Administradiora e Corretora de Imóveis LTDA</option>
                <option value="J. Fróes Imóveis LTDA">J. Fróes Imóveis LTDA</option>
                <option value="Qualitas Imobiliária e Construtora LTDA">Qualitas Imobiliária e Construtora LTDA</option>
                <option value="União Corretora de Imóvel LTDA">União Corretora de Imóvel LTDA</option>
                <option value="Vivar Imóveis LTDA">Vivar Imóveis LTDA</option>
              </select>
            </div>
            <div class="form-group">
              <label for="emailInput">Email</label>
              <input type="email" name="email" class="form-control" id="emailInput" placeholder="Email..." required>
            </div>
            <div class="form-group">
              <label for="passInput">Senha</label>
              <input type="password" name="password" class="form-control" id="passInput" placeholder="Senha..." required>
            </div>
            <div class="form-group">
              <label for="confPassInput">Confirmar senha</label>
              <input type="password" name="confPassword" class="form-control" id="confPassInput" placeholder="Confirmar senha..." required>
              <small id="smallConfsenha"></small>
            </div>
            <button type="button" class="btn btn-dark" id="btnCadastro">Cadastre-se</button>
          </form>
        </div>
        <div class="card-footer bg-dark">
          <a href="login.php" class="card-link">Ja possui uma conta? Faça seu login</a>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <?php
    include("../pageParts/footer.php");
    ?>
  </footer>
  <script type="text/javascript" src="../js/cadastro.js"></script>
</body>
</html>
