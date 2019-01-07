<!-- Elementros navBar -->
<a class="navbar-brand" href="<?php if($_SESSION['page'] == "home"){echo "index.php";}else{echo "../index.php";}?>"><img src="https://firebasestorage.googleapis.com/v0/b/qualitas-24b79.appspot.com/o/Logo%2Flogo_intermedio.png?alt=media&token=b4bdbd6b-0469-4074-bde3-6aa3ea42407b" width="50" height="50"> Qualitas</a>
<!-- Add hamburguer menu -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<!-- Navbar itens -->
<div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav mr-auto">
    <!-- Home page -->
    <li class="nav-item">
      <a class="nav-link <?php if($_SESSION['page'] == "home"){echo "active";}?>" href="<?php if($_SESSION['page'] == "home"){echo "index.php";}else{echo "../index.php";}?>">Home</a>
    </li>
    <!--Pagina com lista de imoveis -->
    <li class="nav-item">
      <a class="nav-link <?php if($_SESSION['page'] == "imoveis"){echo "active";}?>" href="<?php if($_SESSION['page'] == "home"){echo "pages/imoveis.php";}else{echo "../pages/imoveis.php";}?>">Imóveis</a>
    </li>
    <!--Pagina com lista de imboliárias  -->
    <li class="nav-item">
      <a class="nav-link <?php if($_SESSION['page'] == "imobiliarias"){echo "active";}?>" href="<?php if($_SESSION['page'] == "home"){echo "pages/imobiliarias.php";}else{echo "../pages/imobiliarias.php";}?>">Imobiliárias</a>
    </li>
    <!-- Pagina com documentos -->
    <?php if ($_SESSION['page'] == "documentos") {
      echo
      "<li class='nav-item'>
        <a class='nav-link active' href='#'>Documentos</a>
      </li>";
    }?>
    <!-- Pagina com Pagamentos -->
    <?php if ($_SESSION['page'] == "pagamentos") {
      echo
      "<li class='nav-item'>
        <a class='nav-link active' href='#'>Pagamentos</a>
      </li>";
    }?>
  </ul>
    <!-- Dropdown login/admin -->
  <div class="dropdown">
    <a class="dropdown-toggle" href="#" role="button" id="dropdownNavConta" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conta</a>
    <div class="dropdown-menu dropdown-nav-conta dropdown-menu-right">
      <form id="formNav">
          <div class="form-group">
            <label for="emailInputNav">Endereço de email</label>
            <input id="emailInputNav" type="email" class="form-control" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="passInputNav">Senha</label>
            <input id="passInputNav" type="password" class="form-control" placeholder="Senha">
          </div>
          <button id="btnLoginNav" type="button" class="btn btn-dark">Login</button>
          <div class="dropdown-divider"></div>
          <a href="#" class="card-link" id="redefSenhaNav">Esqueceu sua senha?</a>
      </form>
      <div id="divUsuario">
        <h5 id="bemVindoUsuario" class="dropdown-header">Bem vindo</h5>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php if($_SESSION['page'] == "home"){echo "pages/admin.php";}else{echo "../pages/admin.php";}?>">Gerencie sua conta</a>
        <a id="btnSairNav" class="dropdown-item" href="#">Sair</a>
      </div>
    </div>
  </div>
</div>
