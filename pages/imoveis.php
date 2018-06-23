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
    <div class="container">
      <div class="row menu">
        <!-- Cadastrar imóvel -->
        <button type="button" class="btn btn-dark col-md-3 offset-sm-9" name="Cadastro" data-toggle="modal" data-target="#modalCadastrarImovel">Cadastrar Imóvel</button>
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
                      <option value="1">AC</option>
                      <option value="2">AL</option>
                      <option value="3">AP</option>
                      <option value="4">AM</option>
                      <option value="5">BA</option>
                      <option value="6">CE</option>
                      <option value="7">DF</option>
                      <option value="8">ES</option>
                      <option value="9">GO</option>
                      <option value="10">MA</option>
                      <option value="11">MT</option>
                      <option value="12">MS</option>
                      <option value="13">MG</option>
                      <option value="14">PA</option>
                      <option value="15">PB</option>
                      <option value="16">PR</option>
                      <option value="17">PE</option>
                      <option value="18">PI</option>
                      <option value="19">RJ</option>
                      <option value="20">RN</option>
                      <option value="21">RS</option>
                      <option value="22">RO</option>
                      <option value="23">RR</option>
                      <option value="24">SC</option>
                      <option value="25">SP</option>
                      <option value="26">SE</option>
                      <option value="27">TO</option>
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
                      <option value="1">Conceito Empreendimentos Imobiliarias LTDA</option>
                      <option value="2">J. Fróes Imóveis LTDA</option>
                      <option value="3">Vivar Imóveis LTDA</option>
                      <option value="4">Invest Administradiora e Corretora de Imóveis LTDA</option>
                      <option value="5">União Corretora de Imóvel LTDA</option>
                      <option value="6">Qualitas Imobiliária e Construtora LTDA</option>
                      <option value="7">Imobiliária Lopes LTDA</option>
                    </select>
                  </div>
                  <!-- <input type="submit" id="jorge"> -->
                </form>
                <div id="msg" class="col-sm-10 offset-sm-1" role="alert"></div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnCancelar" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnSalvar" >Salvar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
  <script type="text/javascript">
    // Pegar imagem
    $("#inputImagem").change(() => {
      if(inputImagem.files[0]){
        let uploadImg = $("#croppieDiv").croppie({
          viewport: {
            width: 400,
            height: 250,
            type: 'square'
          },
          boundary: {
            width: 500,
            height: 500
          }
        });
        //Ler upload
        let reader = new FileReader();
        reader.onload = (img) => {
          uploadImg.croppie('bind',{
            url: img.target.result
          })
          //Criar button
          let btnResult = document.createElement("button");
          btnResult.className = "btn btn-dark col-12 btnresult";
          btnResult.innerHTML = "Concluir";
          $("#croppieDiv").append(btnResult);
          //Função do botão
          $(btnResult).click(()=>{
            uploadImg.croppie('result', 'blob').then((blob)=>{
              imgBlob = blob;
            })
            uploadImg.croppie('result', 'base64').then((base64)=>{
              //Limpar div e mostrar imagem
              let divCroppie = document.getElementById("croppieDiv");
              while (divCroppie.hasChildNodes()) {
                  divCroppie.removeChild(divCroppie.lastChild);
              }
              let img = document.createElement("img");
              img.className = "rounded img-fluid mx-auto d-block"
              img.src = base64;
              divCroppie.appendChild(img);
            })
          })
        }
        reader.readAsDataURL(inputImagem.files[0]);
      }
    })

    //Limpar formulário de cadastro de imóvel
    function limpaForm(){
      //Limpar form
      $("#cadastrarImovel")[0].reset();

      //Limpar div
      let divCroppie = document.getElementById("croppieDiv");
      while (divCroppie.hasChildNodes()) {
          divCroppie.removeChild(divCroppie.lastChild);
      }

      //Criar elementos
      divCroppie.className = "row";
      let divGroup = document.createElement("div");
      divGroup.className = "input-group mb-3";
      let divCustomFile = document.createElement("div");
      divCustomFile.className = "custom-file";
      let inputImg = document.createElement("input");
      inputImg.setAttribute('type', 'file');
      inputImg.setAttribute ('accept', "image/*");
      inputImg.className = "custom-file-input";
      inputImg.id = "inputImagem";
      let labelImg = document.createElement("label");
      labelImg.className = "custom-file-label";
      labelImg.setAttribute('for',"inputImagem");
      labelImg.innerHTML = "Escolha uma imagem";

      //Colocar elementos na pagina
      divCroppie.appendChild(divGroup);
      divGroup.appendChild(divCustomFile);
      divCustomFile.appendChild(inputImg);
      divCustomFile.appendChild(labelImg);

      // Pegar imagem
      $("#inputImagem").change(() => {
        if(inputImagem.files[0]){
          let uploadImg = $("#croppieDiv").croppie({
            viewport: {
              width: 400,
              height: 250,
              type: 'square'
            },
            boundary: {
              width: 500,
              height: 500
            }
          });
          //Ler upload
          let reader = new FileReader();
          reader.onload = (img) => {
            uploadImg.croppie('bind',{
              url: img.target.result
            })
            //Criar button
            let btnResult = document.createElement("button");
            btnResult.className = "btn btn-dark col-12 btnresult";
            btnResult.innerHTML = "Concluir";
            $("#croppieDiv").append(btnResult);
            //Função do botão
            $(btnResult).click(()=>{
              uploadImg.croppie('result', 'blob').then((blob)=>{
                imgBlob = blob;
              })
              uploadImg.croppie('result', 'base64').then((base64)=>{
                //Limpar div e mostrar imagem
                let divCroppie = document.getElementById("croppieDiv");
                while (divCroppie.hasChildNodes()) {
                    divCroppie.removeChild(divCroppie.lastChild);
                }
                let img = document.createElement("img");
                img.className = "rounded img-fluid mx-auto d-block"
                img.src = base64;
                divCroppie.appendChild(img);
              })
            })
          }
          reader.readAsDataURL(inputImagem.files[0]);
        }
      })
    }
    //Button Cancelar
    $("#btnCancelar").click(()=>{
      limpaForm();
    })

    //Button Salvar
      $("#btnSalvar").click(()=>{
      if($("#cadastrarImovel")[0].checkValidity()){
        //Fechar modalBody
        $('#modalCadastrarImovel').modal('hide');
        //limpar form
        limpaForm();
        //Criar objeto
        let data = {
        nome: $('#nomeInput').val(),
        rua: $('#ruaInput').val(),
        numero: $('#numeroInput').val(),
        bairro: $('#bairroInput').val(),
        complemento: $('#complementoInput').val(),
        estado: $('#estadoInput').val(),
        cidade: $('#cidadeInput').val(),
        preco: $('#precoInput').val(),
        imobiliaria: $('#imobiliariaInput').val(),
        imagem: imgBlob
      };
      let json = JSON.stringify(data);
        //Enviar form por ajax
        $.ajax({
          url: '../php/cadastrarImoveis.php',
          type: "POST",
          data: json,
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          processData: false,
          contentType: false,
          success: function (){
            console.log("Cadastro efetuado com sucesso");
          },
          error: function (error){
            console.log("Erro ao cadastrar imóvel");
          }
        })
      }else{
        $('#msg').html('<div class="alert alert-danger fade show">Preencha todos os campos corretamente!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      }
    })
  </script>
</body>

</html>
