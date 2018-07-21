var testeAdmin = false;
//Pegar usuário atual e testar imobiliaria
firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    //Pegar usuário no firestore
    firebase.firestore().collection("usuarios").doc(user.uid).get().then((doc) => {
        //Pegar imobiliaria do usuário
        if (doc.data().imobiliaria == "Qualitas Imobiliária e Construtora LTDA") {
          testeAdmin = true;
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
  hideLoader(1);
  limpaForm();
})

//Button Salvar
$("#btnSalvar").click(() => {
  //Iniciar loader
  showLoader(1);
  //Conferir validade do formulário
  if ($("#cadastrarImovel")[0].checkValidity()) {
    //Cadastrar imagem no storage
    firebase.storage().ref().child("imagensImoveis/" + $("#nomeInput").val() + '/imagemCapa').put(imgBlob)
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
            hideLoader(1);
            mensagemModSuc("Imóvel cadastrado com sucesso!", 1);
            //limpar form
            limpaForm();
            setTimeout(() => {
              window.location.href = "imoveis.php";
            }, 2000);
          })
          .catch((error) => {
            //Erro ao adicionar usuário ao firestore
            hideLoader(1);
            console.log(error);
            mensagemModErr("Erro ao cadastrar imóvel! Tente novamente mais tarde.", 1);
          });
      })
      .catch((error) => {
        //Erro no upload da imagem
        hideLoader(1);
        console.log(error);
        mensagemModErr("Erro ao cadastrar imóvel! Tente novamente mais tarde.", 1);
      })
  } else {
    //Formulario incompleto
    hideLoader(1);
    mensagemModErr("Preencha todos os campos corretamente!", 1);
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
      let imgUrl;
      firebase.storage().ref().child(imovel.data().imagem + '/imagemCapa').getDownloadURL()
        .then(function(url) {
          img.className = "card-img-top";
          img.src = url;
          img.style.width = "100%";
          imgUrl = url;
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
      // Click no card
      $(card).click(() => {
        //Definir atributos do imovel
        $("#DetalheImovel").html(imovel.data().nome + ", " + imovel.data().endereco.complemento);
        $("#imgDetalhado").attr('src', '');
        $("#imgDetalhado").attr('src', imgUrl);
        $('#pRua').html(imovel.data().endereco.rua + ', ' + imovel.data().endereco.numero);
        $('#pComplemento').html(imovel.data().endereco.complemento);
        $('#pBairro').html('Bairro ' + imovel.data().endereco.bairro);
        $('#pCidade').html(imovel.data().endereco.cidade + ' - ' + imovel.data().endereco.estado);
        $('#pPreco').html('Preço do alguel: R$' + imovel.data().preco + ',00');
        $('#pImobiliaria').html('Imobiliária responsável: ' + imovel.data().imobiliaria);
        //Maps
        var map;

        function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
            center: {
              lat: -34.397,
              lng: 150.644
            },
            zoom: 16
          });
          geocoder = new google.maps.Geocoder();
          codeAddress(geocoder, map);
        }

        function codeAddress(geocoder, map) {
          geocoder.geocode({
            'address': imovel.data().endereco.rua + ', ' + imovel.data().endereco.numero
          }, function(results, status) {
            if (status === 'OK') {
              map.setCenter(results[0].geometry.location);
              var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
              });
            } else {
              console.log('Geocode was not successful for the following reason: ' + status);
            }
          });
        }

        initMap();

        $("#modalImovelDetalhado").modal('toggle');
        if (!testeAdmin) {
          $('#modalFooter').hide();
        }
        // Button Alterar
        $('#btnAlterar').click(() => {
          // while ($('#croppieDiv').children().length > 0) {
          //     $('#croppieDiv').children().remove();
          // }
          // let img = document.createElement("img");
          // img.className = "rounded img-fluid mx-auto d-block";
          // $(img).attr('src', imgUrl);
          // $('#croppieDiv').append(img);
          // $('#modalCadastrarImovel').on('show.bs.modal', function() {
          //   $('#modalImovelDetalhado').modal('hide');
          // })
          // $('#modalCadastrarImovel').modal('toggle')
          // $('#modalCadastrarImovel').modal({
          //   focus: true
          // })
        })
        // Button Excluir
        $('#btnExcluir').click(() => {
          showLoader(2);
          //Apagar firestore
          firebase.firestore().collection("imoveis").doc(imovel.data().nome).delete().then(function() {
            //Apagar imagens
            firebase.storage().ref(imovel.data().imagem + '/imagemCapa').delete().then(function() {
              // Imagem apagada
              hideLoader(2);
              mensagemModSuc('Imóvel excluido com sucesso', 2);
              setTimeout(() => {
                window.location.href = "imoveis.php";
              }, 2000);
            }).catch(function(error) {
              // Erro ao apagar imagem
              console.log(error);
            });
          }).catch(function(error) {
            //Erro removendo documento
            console.error("Error ao remover documento: ", error);
          });
        })
      })
    });
  })
  .catch(function(error) {
    //Nenhum imóvel encontrado
    console.log('Nenhum imóvel cadastrado encontrado');
    console.log(error);
  })
