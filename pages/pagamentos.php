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
        <button id="btnFazerPagamento" class="offset-lg-6 col-lg-2 offset-md-4 col-md-3 btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#modalFazerPagamento">Fazer Pagamento</button>
      </div>
    </div>
    <!-- Tabela  -->
    <div class="container-fluid">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Data</th>
            <th scope="col">Endereço</th>
            <th scope="col">Valor</th>
            <th scope="col">Upload</th>
          </tr>
        </thead>
        <tbody>
          <tr data-toggle="modal" data-target="#modalPagamentoDetalhado">
            <th scope="row">21/02/2018</th>
            <td>Rua Tavares Bastos, 413/Apto 1001</td>
            <td>R$1800,00</td>
            <td>Sim</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Modal Formulario pagamento -->
    <div class="modal fade" id="modalFazerPagamento" tabindex="-1" role="dialog" aria-labelledby="fazerPagamentoLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- Modal header -->
          <div class="modal-header">
            <h5 class="modal-title" id="fazerPagamentoLabel">Fazer um Pagamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="modal-body" id="modalBody">
            <form id="formFazerPagamento">
              <!-- Imóvel -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="imoveisSpan">Imóveis</span>
                </div>
                <select class="custom-select" id="imoveisInput" aria-describedby="imoveisSpan" name="imoveis">
                  <option selected>Escolha um imóvel</option>
                </select>
              </div>
              <!-- Valor pago -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="valorPagoSpan">R$</span>
                </div>
                <input type="number" name="valorPago" class="form-control" id="valorPago" placeholder="Digite o valor pago" aria-describedby="valorPagoSpan" required>
              </div>
              <!-- Data -->
              <div class="input-group mb-3">
                <input name="data" id="datepicker" class="form-control" placeholder="Escolha a data" type="text" aria-describedby="dataSpan" required>
              </div>
              <!-- Upload comprovante -->
              <div class="container">
                <div class="row" id="comprovanteDiv">
                  <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputComprovante" name="comprovante" required>
                      <label id="labelComprovante" class="custom-file-label" for="inputComprovante">Envie seu comprovante</label>
                    </div>
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
    <!-- Modal Mostrar detalhado -->
    <div class="modal fade" id="modalPagamentoDetalhado" tabindex="-1" role="dialog" aria-labelledby="pagamentoDetalhadoLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- Modal header -->
          <div class="modal-header">
            <h5 class="modal-title" id="pagamentoDetalhadoLabel">Edificio Melbourne, Apto 901</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="modal-body" id="modalBody">

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
  </main>
  <footer>
    <?php
    include("../pageParts/footer.php");
    ?>
  </footer>
  <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="../js/pagamentos.js"></script>
</body>

</html>
