<!DOCTYPE html>
<html lang="pt_br">

<head>
  <title>Imobiliárias</title>
  <!--Add icon-->
  <link rel="icon" type="image/png" href="https://firebasestorage.googleapis.com/v0/b/qualitas-24b79.appspot.com/o/Logo%2Ficon.png?alt=media&token=8884afeb-1c37-49e1-95bd-84d8c9d35f0a" sizes="32X32">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
  <!--Add Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <!-- Add cropie -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css"/>
  <!--Add css-->
  <link rel="stylesheet" href="../css/imobiliarias.css">
  <link rel="stylesheet" href="../css/master.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    session_start();
    $_SESSION['page'] = "imobiliarias";
    include("../pageParts/nav.php")
     ?>
  </nav>
  <main>
    <div id="msg1" role="alert"></div>
    <div class="loaderDiv" id="loaderDiv">
      <div class="loader" id="loader"></div>
    </div>
    <div class="container">
      <div class="row menu mt-sm-3">
        <!-- Cadastrar Imobiliária -->
        <button id="btnCadastrar" type="button" class="btn btn-dark col-md-3 offset-md-9" name="Cadastro" data-toggle="modal" data-target="#modalCadastrarImobiliaria">Cadastrar Imobiliária</button>
        <!-- Modal -->
        <div class="modal fade" id="modalCadastrarImobiliaria" tabindex="-1" role="dialog" aria-labelledby="CadastrarImobiliariasLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- Modal header -->
              <div class="modal-header">
                <h5 class="modal-title" id="CadastrarImobiliariasLabel">Cadastre uma Imobiliaria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="modal-body" id="modalBody">
                <form id="cadastrarImobiliaria">
                  <!-- Form Logo -->
                  <div class="container">
                    <div class="row" id="croppieDiv">
                      <div class="input-group mb-3">
                        <div class="custom-file">
                          <input type="file" accept="image/*" class="custom-file-input" id="inputImagem" name="imagem" required>
                          <label class="custom-file-label" for="inputImagem">Escolha uma imagem</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Nome -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="nomeSpan">Nome</span>
                    </div>
                    <input id="nomeInput" class="form-control" placeholder="Digite um nome" type="text" aria-describedby="nomeSpan" name="nome" required>
                  </div>
                  <!-- Email -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="emailSpan">Email</span>
                    </div>
                    <input id="emailInput" class="form-control" placeholder="Email" type="email" required>
                  </div>
                  <!-- Rua -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="endereçoSpan">Endereço</span>
                    </div>
                    <input id="ruaInput" class="form-control" placeholder="Rua" type="text" aria-describedby="endereçoSpan" name="rua" required>
                  </div>
                  <!-- Número, bairro e complemento -->
                  <div class="input-group mb-3">
                    <input id="numeroInput" class="form-control" placeholder="Número" type="number" name="numero" required>
                    <input id="bairroInput" class="form-control" placeholder="Bairro" type="text" name="bairro" required>
                    <input id="complementoInput" class="form-control" placeholder="Complemento" type="text" name="complemento" required>
                  </div>
                  <!-- Estado e cidade -->
                  <div class="input-group mb-3">
                    <select class="custom-select" id="estadoInput" name="estado">
                      <option selected>Estado</option>
                      <option value="AC">AC</option>
                      <option value="AL">AL</option>
                      <option value="AP">AP</option>
                      <option value="AM">AM</option>
                      <option value="BA">BA</option>
                      <option value="CE">CE</option>
                      <option value="DF">DF</option>
                      <option value="ES">ES</option>
                      <option value="GO">GO</option>
                      <option value="MA">MA</option>
                      <option value="MT">MT</option>
                      <option value="MS">MS</option>
                      <option value="MG">MG</option>
                      <option value="PA">PA</option>
                      <option value="PB">PB</option>
                      <option value="PR">PR</option>
                      <option value="PE">PE</option>
                      <option value="PI">PI</option>
                      <option value="RJ">RJ</option>
                      <option value="RN">RN</option>
                      <option value="RS">RS</option>
                      <option value="RO">RO</option>
                      <option value="RR">RR</option>
                      <option value="SC">SC</option>
                      <option value="SP">SP</option>
                      <option value="SE">SE</option>
                      <option value="TO">TO</option>
                    </select>
                    <input id="cidadeInput" class="form-control" placeholder="Digite uma cidade" type="text" name="cidade" required>
                  </div>
                  <!-- Número telefone -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="telSpan">Telefone</span>
                    </div>
                    <input id="telInput" class="form-control phone_with_ddd" placeholder="Telefone" type="tel" aria-describedby="telSpan" name="telefone" size="9" required>
                  </div>
                  <!-- CNPJ -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="cnpjSpan">CNPJ</span>
                    </div>
                    <input id="cnpjInput" class="form-control cnpj" type="text" name="cnpj" placeholder="Insira apenas números" size="14" aria-describedby="cnpjSpan" required>
                  </div>
                  <!-- Criar conta -->
                  <h5 class="mb-3"></h5>
                    <div class="input-group mb-3" id="SenhaForm">
                      <div class="input-group-prepend">
                        <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseSenha">Criar conta?</button>
                      </div>
                      <div id="collapseSenha" class="collapse col">
                        <input type="text" class="form-control" id="usuarioInput" placeholder="Usuário" aria-describedby="senhaSpan">
                        <input type="password" name="password" class="form-control" id="passInput" placeholder="Senha" aria-describedby="senhaSpan">
                        <input type="password" name="confPassword" class="form-control" id="confPassInput" placeholder="Confirmar senha" aria-describedby="senhaSpan senhaSpan2">
                        <div class="input-group-prepend">
                          <i class="input-group-text material-icons col-12" id="senhaSpan2">remove</i>
                        </div>
                      </div>
                    </div>
                </form>
              <div id="msgMod1" role="alert"></div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnCancelar" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnSalvar">Salvar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3" id="corpo">
        <!-- Imobiliária detalhada modal -->
        <div class="modal fade" id="modalimobiliariaDetalhada" tabindex="-1" role="dialog" aria-labelledby="Detalheimobiliaria" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- Modal header -->
              <div class="modal-header">
                <h5 class="modal-title" id="Detalheimobiliaria">Nome imobiliária</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="modal-body" id="modalBody">
                <img id="imgDetalhado" class="rounded img-fluid mx-auto d-block">
                <!-- Informaçòes de contato -->
                <div class="titulo-interno">
                  <div class="titulo-interno-texto">
                    <h5>Informaçòes de contato</h5>
                  </div>
                  <hr>
                </div>
                <p id="pEmail">Email</p>
                <p id="pTelefone">Telefone</p>
                <!-- Endereço -->
                <div class="titulo-interno">
                  <div class="titulo-interno-texto">
                    <h5>Endereço</h5>
                  </div>
                  <hr>
                </div>
                <p id="pRua">Rua, Número</p>
                <p id="pComplemento">Complemento</p>
                <p id="pBairro">Bairro</p>
                <p id="pCidade">Cidade - Estado</p>
                <!-- Informaçòes adicionais -->
                <div class="titulo-interno">
                  <div class="titulo-interno-texto">
                    <h5>Informaçòes adicionais</h5>
                  </div>
                  <hr>
                </div>
                <p id="pCnpj">CNPJ</p>
                <!-- Carossel com imoveis da imobiliaria -->
                <div class="titulo-interno">
                  <div class="titulo-interno-texto">
                    <h5>Imóveis</h5>
                  </div>
                  <hr>
                </div>
                <div class="carousel slide" id="carouselImoveis" data-ride="carousel">
                  <div class="carousel-inner">
                    <a class="carousel-control-prev" href="carouselImoveis" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="carouselImoveis" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
                <!-- Mapa com local -->
                <div class="titulo-interno">
                  <div class="titulo-interno-texto">
                    <h5>Localização</h5>
                  </div>
                  <hr>
                </div>
                <div id="map"></div>
                <!-- Enviar email -->
                <div class="titulo-interno">
                  <div class="titulo-interno-texto">
                    <h5>Envie um email</h5>
                  </div>
                  <hr>
                </div>
                <div id="msgMod2" role="alert"></div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-warning" id="btnAlterar" disabled>Alterar</button>
                <button type="button" class="btn btn-danger" id="btnExcluir">Excluir</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <?php
    include("../pageParts/footer.php")
     ?>
  </footer>
  <script type="text/javascript" src="../js/imobiliarias.js"></script>
</body>

</html>
