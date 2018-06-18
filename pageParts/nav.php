  <a class="navbar-brand" href="#"><img src="imagens/logo_intermedio.png" width="50" height="50"> Qualitas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?php if($_SESSION['page'] == "home"){echo "active";}?>">Home Page</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if($_SESSION['page'] == "imoveis"){echo "active";}?>" href="#" id="navbarDropdownImoveis" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Imóveis</a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownImoveis">
          <a class="dropdown-item badge-dark" href="#">Registrar imóveis</a>
          <a class="dropdown-item badge-dark" href="#">Alterar imóveis</a>
          <a class="dropdown-item badge-dark" href="#">Excluir imóveis</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if($_SESSION['page'] == "imobiliarias"){echo "active";}?>" href="#" id="navbarDropdownImobiliarias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Imobiliárias</a>
      <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownImobiliarias">
        <a class="dropdown-item badge-dark" href="#">Registrar imobiliária</a>
        <a class="dropdown-item badge-dark" href="#">Alterar Imobiliária</a>
        <a class="dropdown-item badge-dark" href="#">Excluir imobiliária</a>
      </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if($_SESSION['page'] == "pagamentos"){echo "active";}?>" href="#" id="navbarDropdownPagamentos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Pagamentos
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownPagamentos">
          <a class="dropdown-item badge-dark" href="#">Registrar pagamentos</a>
          <a class="dropdown-item badge-dark" href="#">Listar pagamentos</a>
        </div>
      </li>
    </ul>
  </div>
