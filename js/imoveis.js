//Pegar usuário atual e testar imobiliaria
firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    //Pegar usuário no firestore
    firebase.firestore().collection("usuarios").doc(user.uid).get().then((doc) => {
        //Pegar imobiliaria do usuário
        if (doc.data().imobiliaria == "Qualitas Imobiliária e Construtora LTDA") {
          $("#btnCadastrar").show();
        } else {
          //Caso a imobiliaria não seja qualitas
          $("#btnCadastrar").hide();
        }
      })
      .catch((error) => {
        //Caso não encontre um usuario no firestore
        $("#btnCadastrar").hide();
      })
  } else {
    //Caso não tenha usuario cadastrado
    $("#btnCadastrar").hide();
  }
});

// Pegar imagem
$("#inputImagem").change(() => {
  //Conferir existencia de uma imagem
  if (inputImagem.files[0]) {
    //Definir tamanho do croppie
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
          imgBlob = blob;
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
    //Conferir existencia de uma imagem
    if (inputImagem.files[0]) {
      //Definir tamanho do croppie
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
            imgBlob = blob;
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
  //Iniciar loader
  showLoader();
  //Conferir validade do formulário
  if ($("#cadastrarImovel")[0].checkValidity()) {
    //Cadastrar imagem no storage
    firebase.storage().ref().child("imagensImoveis/" + $("#nomeInput").val()).put(imgBlob)
      .then((snapshot) => {
        //Cadastrar imovel no db
        firebase.firestore().collection("imoveis").doc($("#nomeInput").val()).set({
            nome: $('#nomeInput').val(),
            endereco: {
              rua: $('#ruaInput').val(),
              numero: $('#numeroInput').val(),
              bairro: $('#bairroInput').val(),
              complemento: $('#complementoInput').val(),
              estado: $('#estadoInput').val(),
              cidade: $('#cidadeInput').val()
            },
            preco: $('#precoInput').val(),
            imobiliaria: $('#imobiliariaInput').val(),
            imagem: "imagensImoveis/" + $("#nomeInput").val()
          })
          .then(() => {
            //Sucesso ao adicionar imovel ao firestore
            hideLoader();
            mensagemModSuc("Imóvel cadastrado com sucesso!");
            //limpar form
            limpaForm();
            setTimeout(() => {
              window.location.href = "imoveis.php";
            }, 2000);
          })
          .catch((error) => {
            //Erro ao adicionar usuário ao firestore
            hideLoader();
            console.log(error);
            mensagemModErr("Erro ao cadastrar imóvel! Tente novamente mais tarde.");
          });
      })
      .catch((error) => {
        //Erro no upload da imagem
        hideLoader();
        console.log(error);
        mensagemModErr("Erro ao cadastrar imóvel! Tente novamente mais tarde.");
      })
  } else {
    //Formulario incompleto
    hideLoader();
    mensagemModErr("Preencha todos os campos corretamente!");
  }
})

//Pegar imóveis
firebase.firestore().collection("imoveis").get()
  .then(function(querySnapshot) {
    querySnapshot.forEach(function(imovel) {
      //Para cada imóvel recuperado
      let col = document.createElement("div");
      col.className = "col-md-4 d-flex align-items-stretch";
      let card = document.createElement("div");
      card.className = "card bg-dark text-light";
      let img = document.createElement("img");
      firebase.storage().ref().child(imovel.data().imagem).getDownloadURL()
        .then(function(url) {
          img.className = "card-img-top";
          img.src = url;
          img.style.width = "100%"
        })
        .catch(function(error) {
          console.log(error);
        })
      let cardBody = document.createElement("div");
      cardBody.className = "card-body";
      let title = document.createElement("h5");
      title.className = "card-title";
      title.innerHTML = imovel.data().nome;
      let endereco = document.createElement("p");
      endereco.className = "card-text";
      endereco.innerHTML = imovel.data().endereco.rua + ", " + imovel.data().endereco.numero + "<br>" + imovel.data().endereco.complemento;
      let imobiliaria = document.createElement("p");
      imobiliaria.className = "card-text";
      imobiliaria.innerHTML = imovel.data().imobiliaria;
      let preco = document.createElement("p");
      preco.className = "card-text";
      preco.innerHTML = "R$" + imovel.data().preco + ",00";
      $("#modalImovelDetalhado").before(col);
      col.appendChild(card)
      card.appendChild(img);
      card.appendChild(cardBody);
      cardBody.appendChild(title);
      cardBody.appendChild(endereco);
      cardBody.appendChild(imobiliaria);
      cardBody.appendChild(preco);
      $(card).click(()=>{
        //Definir titulo
        $("#DetalheImovel").html(imovel.data().nome + ", " + imovel.data().endereco.complemento);
        //Definir img
        $("#imgDetalhado").attr('src', '');
        firebase.storage().ref().child(imovel.data().imagem).getDownloadURL()
          .then(function(url) {
            $("#imgDetalhado").attr('src', url);
          })
          .catch(function(error) {
            console.log(error);
          })
        $('#pRua').html(imovel.data().endereco.rua + ', ' + imovel.data().endereco.numero);
        $('#pComplemento').html(imovel.data().endereco.complemento);
        $('#pBairro').html('Bairro ' + imovel.data().endereco.bairro);
        $('#pCidade').html(imovel.data().endereco.cidade + ' - ' + imovel.data().endereco.estado);
        $('#pPreco').html('Preço do alguel: R$' + imovel.data().preco + ',00');
        $('#pImobiliaria').html('Imobiliária responsável: ' + imovel.data().imobiliaria);
        $("#modalImovelDetalhado").modal('toggle');
      })
    });
  })
  .catch(function(error) {
    console.log(error);
    mensagemErr("Nenhum imóvel cadastrado encontrado!");
  })
