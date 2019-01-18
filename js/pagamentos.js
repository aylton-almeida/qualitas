//Configurar input de data
$('#datepicker').datepicker({
  uiLibrary: 'bootstrap4'
});

//Determinar imobiliaria da conta
var imobiliaria;
//Pegar usuário e imobiliaria
firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    //Pegar usuário no firestore
    firebase.firestore().collection("usuarios").doc(user.uid).get().then((doc) => {
        //Pegar imobiliaria do usuário
        imobiliaria = doc.data().imobiliaria;
        //Pegar imoveis e coloca-las nas opções
        firebase.firestore().collection("imoveis").orderBy('nome').get()
          .then(function(querySnapshot) {
            querySnapshot.forEach(function(imovel) {
              if (imovel.data().imobiliaria == imobiliaria) {
                option = document.createElement('option');
                $(option).val(imovel.data().nome + ',' + imovel.data().endereco.complemento);
                $(option).html(imovel.data().nome + ',' + imovel.data().endereco.complemento);
                $('#imoveisInput').append(option);
              }
            });
          });
      })
      .catch((error) => {
        //Caso não encontre um usuario no firestore
        console.log("Imobiliaria não identificada");
      })
  } else {
    //Caso não tenha usuario cadastrado
    sessionStorage.setItem("msg", "Ops... Parece que você foi para uma pagina que não deveria. Por isso te redirecionamos para a pagina incial!");
    window.sessionStorage.setItem('msgType', 'err');
    window.location.href = "../index.php";
  }
});

// Pegar comprovante
$("#inputComprovante").change(() => {
  //Conferir existencia de um comprovante
  if (inputComprovante.files[0]) {
    //Ler upload
    let reader = new FileReader();
    reader.onload = () => {
      filePronta = reader.result;
      $('#labelComprovante').html(inputComprovante.files[0].name);
    }
    reader.readAsArrayBuffer(inputComprovante.files[0]);
  }
})

//Limpa form
function limpaForm() {
  $('#formFazerPagamento')[0].reset();
  $('#labelComprovante').html("Envie seu comprovante");
}

//Button Cancelar
$('#btnCancelar').click(() => {
  limpaForm();
})

//Button Salvar
$("#btnSalvar").click(() => {
  //Iniciar loader
  showLoader();
  //Conferir validade do formulário
  if ($("#formFazerPagamento")[0].checkValidity()) {
    //Cadastrar comprovante no storage
    firebase.storage().ref().child("imoveis/" + $('#imoveisInput').val() + '/comprovantes/' + dataRevert($("#datepicker").val())).put(filePronta)
      .then((snapshot) => {
        //Cadastrar pagamento no db
        firebase.firestore().collection("pagamentos").add({
            comprovante: "imoveis/" + $('#imoveisInput').val() + '/comprovantes',
            imovel: $('#imoveisInput').val(),
            valor: $('#valorPago').val(),
            data: dataRevert($("#datepicker").val())
          })
          .then(() => {
            //Sucesso ao adicionar pagamento ao firestore
            hideLoader();
            mensagemModSuc("Pagamento realizado com sucesso!", 1);
            //limpar form
            limpaForm();
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          })
          .catch((error) => {
            //Erro ao adicionar pagamento ao firestore
            hideLoader();
            console.log(error);
            mensagemModErr("Erro ao realizar pagamento! Tente novamente mais tarde.", 1);
          });
      })
      .catch((error) => {
        //Erro no upload do comprovante
        hideLoader();
        console.log(error);
        mensagemModErr("Erro ao realizar pagamento! Tente novamente mais tarde.", 1);
      })
  } else {
    //Formulario incompleto
    hideLoader();
    mensagemModErr("Preencha todos os campos corretamente!", 1);
  }
})

//Recuperar pagamentos
firebase.firestore().collection("pagamentos").orderBy('data', 'desc').get()
  .then(function(querySnapshot) {
    querySnapshot.forEach(function(pagamento) {
      //Para cada pagamento recuperado
      let tr = document.createElement('tr');
      $(tr).attr('data-toggle', 'modal');
      $(tr).attr('data-target', '#modalPagamentoDetalhado');
      let th = document.createElement('th');
      $(th).attr('scope', 'row');
      th.innerHTML = dataRerevert(pagamento.data().data);
      let rua = document.createElement('td');
      firebase.firestore.collection("pagamentos").doc(pagamento.data().imovel)
      .then((imovel)=>{
        rua.innerHTML = imovel.data().endereco.rua + ', ' + imovel.data().endereco.numero + '/' + imovel.data().endereco.complemento;
      })
      let col = document.createElement("div");
      col.className = "col-md-4 col-sm-6 d-flex align-items-stretch";
      let card = document.createElement("div");
      card.className = "card bg-dark text-light";
      let img = document.createElement("img");
      let imgUrl;
      firebase.storage().ref().child(imovel.data().imagem + '/imagemCapa').getDownloadURL()
        .then(function(url) {
          img.className = "card-img";
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
      title.innerHTML = imovel.data().nome + ', ' + imovel.data().endereco.complemento + ' - ' + imovel.data().isAlugado;
      let endereco = document.createElement("p");
      endereco.className = "card-text";
      endereco.innerHTML = imovel.data().endereco.rua + ", " + imovel.data().endereco.numero;
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
        $('#pBairro').html('Bairro ' + imovel.data().endereco.bairro);
        $('#pCidade').html(imovel.data().endereco.cidade + ' - ' + imovel.data().endereco.estado);
        $('#pPreco').html('Preço do alguel: R$' + imovel.data().preco + ',00');
        $('#pImobiliaria').html('Imobiliária responsável: ' + imovel.data().imobiliaria);
        $('#pIsAlugado').html('Estado do imóvel: ' + imovel.data().isAlugado);
        //Maps
        let map;

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
            'address': imovel.data().endereco.rua + ', ' + imovel.data().endereco.numero + ', ' + imovel.data().endereco.cidade
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
          showLoader();
          //Apagar firestore
          firebase.firestore().collection("imoveis").doc(imovel.data().nome + "," + imovel.data().endereco.complemento).delete().then(function() {
            //Apagar imagens
            firebase.storage().ref(imovel.data().imagem + '/imagemCapa').delete().then(function() {
              // Imagem apagada
              hideLoader();
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
