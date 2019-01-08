<!DOCTYPE html>
<html lang="pt_br">

<head>
  <title>Imóveis</title>
  <!--Add icon-->
  <link rel="icon" type="image/png" href="https://firebasestorage.googleapis.com/v0/b/qualitas-24b79.appspot.com/o/Logo%2Ficon.png?alt=media&token=8884afeb-1c37-49e1-95bd-84d8c9d35f0a" sizes="32X32">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
  <!--Add css-->
  <link rel="stylesheet" href="../css/imoveis.css">
  <link rel="stylesheet" href="../css/master.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php
    session_start();
    $_SESSION['page'] = "imoveis";
    include("../pageParts/nav.php")
     ?>
  </nav>
  <main>
    <!-- Alerta -->
    <div id="msg1" role="alert"></div>
    <div class="loaderDiv" id="loaderDiv">
      <div class="loader" id="loader"></div>
    </div>
    <!-- TItulo da pagina -->
    <div class="container-fluid bg-dark menu">
      <div class="py-3 px-3 row">
        <h3 id="bemVindoAdmin" class="col-lg-4 col-md-5 text-light">Imóveis</h3>
        <button id="btnCadastrar" class="offset-lg-6 col-lg-2 offset-md-4 col-md-3 btn btn-outline-secondary" name="Cadastro" data-toggle="modal" data-target="#modalCadastrarImovel">Cadastrar Imóvel</button>
      </div>
    </div>
    <!-- Pagina -->
    <div class="container">
      <div class="row menu mt-sm-3">
        <!-- Modal cadastro imovel -->
        <div class="modal fade" id="modalCadastrarImovel" tabindex="-1" role="dialog" aria-labelledby="CadastrarImovelLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- Modal header -->
              <div class="modal-header">
                <h5 class="modal-title" id="CadastrarImovelLabel">Cadastre um imóvel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="modal-body" id="modalBody">
                <form id="cadastrarImovel">
                  <!-- Form imagem -->
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
                    <input id="complementoInput" class="form-control" placeholder="Complemento" type="text" name="complemento">
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
                  <!-- Valor aluguel -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="precoSpan">R$</span>
                    </div>
                    <input id="precoInput" class="form-control" placeholder="Preço aluguel" type="number" aria-describedby="precoSpan" name="preco" required>
                    <div class="input-group-append">
                      <span class="input-group-text" id="precoSpan">,00</span>
                    </div>
                  </div>
                  <!-- Estado de aluguel -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="isAlugadoSpan">Está Alugado?</span>
                    </div>
                    <select class="custom-select" id="isAlugadoInput" aria-describedby="isAlugadoSpan" name="isAlugado">
                      <option selected>Escolha o estado do imóvel</option>
                      <option value="Alugado">Alugado</option>
                      <option value="Vago">Vago</option>
                      <option value="Vendendo">Vendendo</option>
                      <option value="Vendido">Vendido</option>
                    </select>
                  </div>
                  <!-- Imobiliária -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="imobiliariaSpan">Imobiliária</span>
                    </div>
                    <select class="custom-select" id="imobiliariaInput" aria-describedby="imobiliariaSpan" name="imobiliaria">
                      <option selected>Escolha uma imobiliária</option>
                    </select>
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
        <!-- Imóvel detalhado modal -->
        <div class="modal fade" id="modalImovelDetalhado" tabindex="-1" role="dialog" aria-labelledby="DetalheImovel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- Modal header -->
              <div class="modal-header">
                <h5 class="modal-title" id="DetalheImovel">Nome imóvel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="modal-body" id="modalBody">
                <img id="imgDetalhado" class="rounded img-fluid mx-auto d-block">
                <!-- Carossel -->
                <!-- Endereço -->
                <div class="titulo-interno">
                  <div class="titulo-interno-texto">
                    <h5>Endereço</h5>
                  </div>
                  <hr>
                </div>
                <p id="pRua">Rua, Número</p>
                <p id="pBairro">Bairro</p>
                <p id="pCidade">Cidade - Estado</p>
                <div class="titulo-interno">
                  <div class="titulo-interno-texto">
                    <h5>Informações adicionais</h5>
                  </div>
                  <hr>
                </div>
                <p id="pPreco">Preço do aluguel: R$2000,00</p>
                <p id="pIsAlugado">Vago</p>
                <p id="pImobiliaria">Imobiliaria responsável: Imobiliaria</p>
                <div class="titulo-interno">
                  <div class="titulo-interno-texto">
                    <h5>Localização</h5>
                  </div>
                  <hr>
                </div>
                <!-- Mapa com local -->
                <div id="map"></div>
                <div id="msgMod2" role="alert"></div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer" id="modalFooter">
                <button type="button" id="btnAlterar" class="btn btn-warning" disabled>Alterar</button>
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
  <script type="text/javascript" src="../js/imoveis.js"></script>
</body>

</html>
