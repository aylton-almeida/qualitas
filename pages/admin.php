<!DOCTYPE html>
<html lang="pt_br">

<head>
  <title>Administrador</title>
  <!--Add icon-->
  <link rel="icon" type="image/png" href="https://firebasestorage.googleapis.com/v0/b/qualitas-24b79.appspot.com/o/Logo%2Ficon.png?alt=media&token=8884afeb-1c37-49e1-95bd-84d8c9d35f0a" sizes="32X32">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
  <!--Add css-->
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="../css/master.css">
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
    <div id="msg1" role="alert"></div>
    <div class="loaderDiv" id="loaderDiv">
      <div class="loader" id="loader"></div>
    </div>
    <div class="container-fluid bg-dark menu">
      <div class="py-3 px-3 row">
        <h3 id="bemVindoAdmin" class="col-lg-4 col-md-5 text-light">Bem vindo</h3>
        <button id="btnSair" class="offset-lg-7 col-lg-1 offset-md-5 col-md-2 btn btn-outline-secondary" type="button">Sair</button>
      </div>
    </div>
    <div class="container py-3">
      <div class="row">
        <div class="col-4">
          <div class="card text-white">
            <img class="img-fluid" src="https://firebasestorage.googleapis.com/v0/b/qualitas-24b79.appspot.com/o/imagens%2Fcontrato.png?alt=media&token=a0b6154a-f6cc-4856-abba-70b5fc6144ed">
            <div class="card-img-overlay">
              <h3>Criar contrato</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="block">
      <div class="card">
        <div class="card-header bg-dark text-light">
          <h1>Administrador</h1>
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <button type="button" class="btn btn-dark col-12" name="Cadastro Usuário" data-toggle="modal" data-target="#modalCadastrarUsuario">Cadastrar usuário</button>

              <div class="modal fade" id="modalCadastrarUsuario" tabindex="-1" role="dialog" aria-labelledby="CadastrarUsuarioLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title" id="CadastrarUsuarioLabel">Cadastre um Usuário</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">

                      <form id="formUsuario">

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="nomeSpan">Nome</span>
                          </div>
                            <input type="text" name="nome" class="form-control" id="nomeInputUsuario" placeholder="Nome" aria-describedby="nomeSpan" required>
                            <input type="text" name="sobrenome" class="form-control" id="sobrenomeInput" placeholder="Sobrenome" aria-describedby="nomeSpan" required>
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="imobiliariaSpan">Imobiliária</span>
                          </div>
                          <select class="custom-select" id="imobiliariaInputUsuario" name="selectImobiliaria" aria-describedby="nomeSpan" required>
                            <option selected>Escolha sua imobiliária</option>
                            <option value="Conceito Empreendimentos Imobiliarias LTDA">Conceito Empreendimentos Imobiliarias LTDA</option>
                            <option value="FAI Consultoria de imoveis LTDA">FAI Consultoria de imoveis LTDA</option>
                            <option value="Invest Administradiora e Corretora de Imóveis LTDA">Invest Administradiora e Corretora de Imóveis LTDA</option>
                            <option value="J. Fróes Imóveis LTDA">J. Fróes Imóveis LTDA</option>
                            <option value="Qualitas Imobiliária e Construtora LTDA">Qualitas Imobiliária e Construtora LTDA</option>
                            <option value="União Corretora de Imóvel LTDA">União Corretora de Imóvel LTDA</option>
                            <option value="Vivar Imóveis LTDA">Vivar Imóveis LTDA</option>
                          </select>
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="emailSpan">Email</span>
                          </div>
                          <input type="email" name="email" class="form-control" id="emailInput" placeholder="Email" aria-describedby="nomeSpan" required>
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="senhaSpan">Senha</span>
                          </div>
                          <input type="password" name="password" class="form-control" id="passInput" placeholder="Senha" aria-describedby="senhaSpan">
                          <input type="password" name="confPassword" class="form-control" id="confPassInput" placeholder="Confirmar senha" aria-describedby="senhaSpan senhaSpan2">
                          <div class="input-group-prepend">
                            <i class="input-group-text material-icons" id="senhaSpan2">remove</i>
                          </div>
                        </div>
                      </form>
                      <div id="msgMod1" role="alert"></div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" id="btnCancelarUsuario" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-success" id="btnCadastro">Concluir</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <button type="button" class="btn btn-dark col-12" name="Cadastro Imóvel" data-toggle="modal" data-target="#modalCadastrarImovel">Cadastrar imóvel</button>

              <div class="modal fade" id="modalCadastrarImovel" tabindex="-1" role="dialog" aria-labelledby="CadastrarImovelLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title" id="CadastrarImovelLabel">Cadastre um imóvel</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body" id="modalBody">
                      <form id="cadastrarImovel">

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

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="nomeSpan">Nome</span>
                          </div>
                          <input id="nomeInput" class="form-control" placeholder="Digite um nome" type="text" aria-describedby="nomeSpan" name="nome" required>
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="endereçoSpan">Endereço</span>
                          </div>
                          <input id="ruaInput" class="form-control" placeholder="Rua" type="text" aria-describedby="endereçoSpan" name="rua" required>
                        </div>

                        <div class="input-group mb-3">
                          <input id="numeroInput" class="form-control" placeholder="Número" type="number" name="numero" required>
                          <input id="bairroInput" class="form-control" placeholder="Bairro" type="text" name="bairro" required>
                          <input id="complementoInput" class="form-control" placeholder="Complemento" type="text" name="complemento">
                        </div>

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

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="precoSpan">R$</span>
                          </div>
                          <input id="precoInput" class="form-control" placeholder="Preço aluguel" type="number" aria-describedby="precoSpan" name="preco" required>
                          <div class="input-group-append">
                            <span class="input-group-text" id="precoSpan">,00</span>
                          </div>
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="imobiliariaSpan">Imobiliária</span>
                          </div>
                          <select class="custom-select" id="imobiliariaInput" aria-describedby="imobiliariaSpan" name="imobiliaria">
                            <option selected>Escolha uma imobiliária</option>
                            <option value="Conceito Empreendimentos Imobiliarias LTDA">Conceito Empreendimentos Imobiliarias LTDA</option>
                            <option value="FAI Consultoria de imoveis LTDA">FAI Consultoria de imoveis LTDA</option>
                            <option value="Invest Administradiora e Corretora de Imóveis LTDA">Invest Administradiora e Corretora de Imóveis LTDA</option>
                            <option value="J. Fróes Imóveis LTDA">J. Fróes Imóveis LTDA</option>
                            <option value="Qualitas Imobiliária e Construtora LTDA">Qualitas Imobiliária e Construtora LTDA</option>
                            <option value="União Corretora de Imóvel LTDA">União Corretora de Imóvel LTDA</option>
                            <option value="Vivar Imóveis LTDA">Vivar Imóveis LTDA</option>
                          </select>
                        </div>
                      </form>
                      <div id="msgMod2" role="alert"></div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" id="btnCancelar" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-success" id="btnSalvar">Salvar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </main>
  <footer>
    <?php
    include("../pageParts/footer.php");
    ?>
  </footer>
  <script type="text/javascript" src="../js/admin.js"></script>
</body>

</html>
