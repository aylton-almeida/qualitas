// Pegar imagem
$("#inputImagem").change(() => {
  if (inputImagem.files[0]) {
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
      uploadImg.croppie('bind', {
        url: img.target.result
      })
      //Criar button
      let btnResult = document.createElement("button");
      btnResult.className = "btn btn-dark col-12 btnresult";
      btnResult.innerHTML = "Concluir";
      $("#croppieDiv").append(btnResult);
      //Função do botão
      $(btnResult).click(() => {
        uploadImg.croppie('result', 'blob').then((blob) => {
          var imgBlob = blob;
        })
        uploadImg.croppie('result', 'base64').then((base64) => {
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
function limpaForm() {
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
  inputImg.setAttribute('accept', "image/*");
  inputImg.className = "custom-file-input";
  inputImg.id = "inputImagem";
  let labelImg = document.createElement("label");
  labelImg.className = "custom-file-label";
  labelImg.setAttribute('for', "inputImagem");
  labelImg.innerHTML = "Escolha uma imagem";

  //Colocar elementos na pagina
  divCroppie.appendChild(divGroup);
  divGroup.appendChild(divCustomFile);
  divCustomFile.appendChild(inputImg);
  divCustomFile.appendChild(labelImg);

  // Pegar imagem
  $("#inputImagem").change(() => {
    if (inputImagem.files[0]) {
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
        uploadImg.croppie('bind', {
          url: img.target.result
        })
        //Criar button
        let btnResult = document.createElement("button");
        btnResult.className = "btn btn-dark col-12 btnresult";
        btnResult.innerHTML = "Concluir";
        $("#croppieDiv").append(btnResult);
        //Função do botão
        $(btnResult).click(() => {
          uploadImg.croppie('result', 'blob').then((blob) => {
            var imgBlob = blob;
          })
          uploadImg.croppie('result', 'base64').then((base64) => {
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
$("#btnCancelar").click(() => {
  limpaForm();
})

//Button Salvar
$("#btnSalvar").click(() => {
  if ($("#cadastrarImovel")[0].checkValidity()) {
    //Fechar modalBody
    $('#modalCadastrarImovel').modal('hide');
    //Enviar form por ajax
    var data = JSON.stringify({
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
    });
    $.ajax({
      url: '../php/cadastrarImoveis.php',
      type: "POST",
      data: {
        data: data
      },
      dataType: 'json'
      // error: function (err){
      //   console.log(err);
      // }
    })
    //limpar form
    limpaForm();
  } else {
    $('#msg').html('<div class="alert alert-danger fade show">Preencha todos os campos corretamente!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  }
})
