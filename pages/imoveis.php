<!DOCTYPE html>
<html lang="pt_br">

<head>
  <title>Imóveis</title>
  <!--Add icon-->
  <link rel="icon" type="image/png" href="../imagens/icon.png" sizes="32X32">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
  <!--Add Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <!-- Add cropie -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css"/>
  <!--Add css-->
  <link rel="stylesheet" href="../css/imoveis.css">
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
    <div class="container-fluid msg">
      <div class="row">
        <div class="col" id="msg" role="alert">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row menu">
        <!-- Cadastrar imóvel -->
        <button type="button" class="btn btn-dark col-md-3 offset-md-9" name="Cadastro" data-toggle="modal" data-target="#modalCadastrarImovel">Cadastrar Imóvel</button>
        <!-- Modal -->
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
                <div class="loaderDiv">
                  <div class="loader" id="loader"></div>
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
                    <input id="nomeInput" class="form-control" placeholder="Digite um nome..." type="text" aria-describedby="nomeSpan" name="nome" required>
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
                      <option selected>Estado...</option>
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
                    <input id="cidadeInput" class="form-control" placeholder="Digite uma cidade..." type="text" name="cidade" required>
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
                  <!-- Imobiliária -->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="imobiliariaSpan">Imobiliária</span>
                    </div>
                    <select class="custom-select" id="imobiliariaInput" aria-describedby="imobiliariaSpan" name="imobiliaria">
                      <option selected>Escolha uma imobiliária...</option>
                      <option value="Conceito Empreendimentos Imobiliarias LTDA">Conceito Empreendimentos Imobiliarias LTDA</option>
                      <option value="FAI Consultoria de imoveis LTDA">FAI Consultoria de imoveis LTDA</option>
                      <option value="Invest Administradiora e Corretora de Imóveis LTDA">Invest Administradiora e Corretora de Imóveis LTDA</option>
                      <option value="J. Fróes Imóveis LTDA">J. Fróes Imóveis LTDA</option>
                      <option value="Qualitas Imobiliária e Construtora LTDA">Qualitas Imobiliária e Construtora LTDA</option>
                      <option value="União Corretora de Imóvel LTDA">União Corretora de Imóvel LTDA</option>
                      <option value="Vivar Imóveis LTDA">Vivar Imóveis LTDA</option>
                    </select>
                  </div>
                  <!-- <input type="submit" id="jorge"> -->
                </form>
                </div>
                <div id="msgMod" class="col-sm-10 offset-sm-1" role="alert"></div>
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
      <div class="row" id="corpo">

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
