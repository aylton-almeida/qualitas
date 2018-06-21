<!DOCTYPE html>
<html lang="en">

<head>
  <title>Imóveis</title>
  <!--Add icon-->
  <link rel="icon" type="image/png" href="../imagens/icon.png" sizes="32X32">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
  <!--Add Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <!--Add jquery-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <!--Add css-->
  <link rel="stylesheet" href="../css/imoveis.css">
  <!-- Add cropie -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
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
              <div class="modal-header">
                <h5 class="modal-title" id="CadastrarImovelLabel">Cadastre um imóvel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <img id="imgUpload" class="img-fluid rounded" width="500px" height="auto" src="">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" accept="image/*" class="custom-file-input" id="inputImagem">
                    <label class="custom-file-label" for="inputImagem">Escolha uma imagem</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" name="button">Cancelar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" name="button">Salvar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script type="text/javascript">
    // Pegar imagem
    let uploadImg = $("#imgUpload").croppie({
      viewport: {
        width: 500,
        height: 300,
        type: 'square'
      };
      boundary: {
        width: 600,
        height: 600
      }
    });

    $("#inputImagem").change(() => {
      let reader = new FileReader();
      reader.onload = (img) => {
        uploadImg.croppie('bind',{
          url: img.target.result
        })
      }
      reader.readAsDataURL(inputImagem.files[0]);
    })
    // $("#inputImagem").change(() => {
    //   let reader = new FileReader();
    //   reader.onload = (img) => {
    //     $("#imgUpload").attr("src", img.target.result);
    //   }
    //   reader.readAsDataURL(inputImagem.files[0]);
    // })
  </script>
</body>

</html>
