//Determinar masks
$(document).ready(() => {
  $('.cnpj').mask('00.000.000/0000-00', {
    reverse: true
  });
  $('.phone_with_ddd').mask('(00) 0000-0000');
})

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

// Confirmação senha
function confSenha() {
  if ($("#confPassInput").val() != $("#passInput").val()) {
    //Caso senhas não coincidam
    $("#senhaSpan2").css('background-color', 'red');
    $("#senhaSpan2").html("clear");
  } else {
    //Caso senhas coincidam
    if ($("#confPassInput").val() != "" && $("#passInput").val() != "") {
      $("#senhaSpan2").css('background-color', 'green');
      $("#senhaSpan2").html("check");
    } else {
      $("#senhaSpan2").css('background-color', '#ffc107');
      $("#senhaSpan2").html("remove");
    }
  }
}
$("#confPassInput").on("change paste keyup", confSenha)
$("#passInput").on("change paste keyup", confSenha)

// Pegar imagem croppie
$("#inputImagem").change(() => {
  //Conferir existencia de uma imagem
  if (inputImagem.files[0]) {
    //Definir tamanho do croppie
    let uploadImg = $("#croppieDiv").croppie({
      viewport: {
        width: 250,
        height: 250,
        type: 'circle'
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

//Limpar formulário de cadastro de imobiliária
function limpaForm() {
  //Limpar form
  $("#cadastrarImobiliaria")[0].reset();

  //Definir required como falso para criar usuário
  $('#usuarioInput').attr('required', false);
  $('#passInput').attr('required', false);
  $('#confPassInput').attr('required', false);

  //Redefinir senha
  $("#senhaSpan2").css('background-color', '#ffc107');
  $("#senhaSpan2").html("remove");

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
          width: 250,
          height: 250,
          type: 'circle'
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
  hideLoader();
  limpaForm();
})

//Button Salvar
$("#btnSalvar").click(() => {
  //Iniciar loader
  showLoader();
  //Teste criar conta
  let testeConta = false;
  if ($('#usuarioInput').val() != "" || $('#passInput').val() != "" || $('#confPassInput').val() != "") {
    $('#usuarioInput').attr('required', true);
    $('#passInput').attr('required', true);
    $('#confPassInput').attr('required', true);
    testeConta = true;
  }
  //Conferir validade do formulário
  if ($("#cadastrarImobiliaria")[0].checkValidity()) {
    //Cadastrar imagem no storage
    firebase.storage().ref().child("imagensImobiliarias/" + $("#nomeInput").val() + '/Logo').put(imgBlob)
      .then((snapshot) => {
        //Cadastrar imobiliaria no db
        firebase.firestore().collection("imobiliarias").doc($("#nomeInput").val()).set({
            nome: $('#nomeInput').val(),
            email: $('#emailInput').val(),
            endereco: {
              rua: $('#ruaInput').val(),
              numero: $('#numeroInput').val(),
              bairro: $('#bairroInput').val(),
              complemento: $('#complementoInput').val(),
              estado: $('#estadoInput').val(),
              cidade: $('#cidadeInput').val()
            },
            imagem: "imagensImobiliarias/" + $("#nomeInput").val(),
            telefone: $('#telInput').val(),
            cnpj: $('#cnpjInput').val()
          })
          .then(() => {
            if (testeConta) {
              if ($("#confPassInput").val() == $("#passInput").val()) {
                //Método de criação de função
                var config = {
                  apiKey: "AIzaSyD_XmxvW05XB7WrV_lwhfYn-fzTAgfAYZ4",
                  authDomain: "qualitas-24b79.firebaseapp.com",
                  databaseURL: "https://qualitas-24b79.firebaseio.com"
                };
                var secondaryApp = firebase.initializeApp(config, "Secondary");
                secondaryApp.auth().createUserWithEmailAndPassword($("#emailInput").val(), $("#passInput").val())
                  .then(function(user) {
                    //Alteração do nome do usuário recem criado
                    user.updateProfile({
                      displayName: $("#usuarioInput").val(),
                    }).then(function() {
                      //Salvar imobiliaria no firestore
                      firebase.firestore().collection("usuarios").doc(user.uid).set({
                          imobiliaria: $("#nomeInput").val()
                        })
                        .then(function() {
                          //Sucesso ao adicionar usuário ao firestore
                          user.sendEmailVerification()
                            .then(function() {
                              // Email enviado
                              hideLoader();
                              mensagemModSuc("Usuário criado e Imobiliária cadastrada com sucesso. Um email foi enviado para verificar a conta!", 1);
                              //limpar form
                              limpaForm();
                              setTimeout(() => {
                                secondaryApp.auth().signOut();
                                window.location.reload();
                              }, 2000);
                            }).catch(function(error) {
                              //Erro no envio
                              hideLoader();
                              mensagemModErr("Erro ao criar usuário", 1)
                            });
                        })
                        .catch(function(error) {
                          //Erro ao adicionar usuário ao firestore
                          hideLoader();
                          console.log(error);
                          mensagemModErr("Erro ao cadastrar usuário! Tente novamente mais tarde.", 1);
                        });
                    }).catch(function(error) {
                      //Erro ao alterar nome do usuário
                      hideLoader();
                      console.log(error.message);
                      mensagemModErr("Erro ao cadastrar usuário! Tente novamente mais tarde.", 1)
                    });
                  })
                  .catch(function(error) {
                    //Erro caso a senha seja pequena
                    if (error.code == "auth/weak-password") {
                      hideLoader();
                      mensagemModErr("Sua senha deve ter ao menos 6 caracteres!", 1);
                    } else {
                      //Erro caso o email ja tenha sido cadastrado
                      if (error.code == "auth/email-already-in-use") {
                        hideLoader();
                        mensagemModErr("Esse email já foi cadastrado!", 1);
                      } else {
                        //Erro geral
                        hideLoader();
                        mensagemModErr("Erro ao cadastrar usuário! Tente novamente mais tarde.", 1);
                      }
                    }
                  });
              } else {
                //Erro caso senhas não coincidam
                hideLoader();
                mensagemModErr("As senhas não coincidem!", 1);
              }
            } else {
              //Sucesso ao adicionar imobiliaria ao firestore
              hideLoader();
              mensagemModSuc("imobiliária cadastrado com sucesso!", 1);
              //limpar form
              limpaForm();
              setTimeout(() => {
                window.location.reload();
              }, 2000);
            }
          })
          .catch((error) => {
            //Erro ao adicionar usuário ao firestore
            hideLoader();
            console.log(error);
            mensagemModErr("Erro ao cadastrar imobiliária! Tente novamente mais tarde.", 1);
          });
      })
      .catch((error) => {
        //Erro no upload da imagem
        hideLoader();
        console.log(error);
        mensagemModErr("Erro ao cadastrar imobiliária! Tente novamente mais tarde.", 1);
      })
  } else {
    //Formulario incompleto
    hideLoader();
    mensagemModErr("Preencha todos os campos corretamente!", 1);
  }
})

//Pegar imobiliarias
firebase.firestore().collection("imobiliarias").orderBy('nome').get()
  .then(function(querySnapshot) {
    querySnapshot.forEach(function(imobiliaria) {
      //Para cada imobiliaria recuperado
      let col = document.createElement("div");
      col.className = "col-md-4 col-xl-3 col-sm-6 d-flex align-items-stretch";
      let card = document.createElement("div");
      card.className = "card bg-dark text-light w-100";
      let cardHead = document.createElement('div');
      cardHead.className = "card-header";
      let img = document.createElement("img");
      let imgUrl;
      firebase.storage().ref().child(imobiliaria.data().imagem + '/Logo').getDownloadURL()
        .then(function(url) {
          img.className = "card-img-top";
          img.src = url;
          imgUrl = url;
        })
        .catch(function(error) {
          console.log(error);
        })
      let cardBody = document.createElement("div");
      cardBody.className = "card-body";
      let title = document.createElement("h5");
      title.className = "card-title";
      title.innerHTML = imobiliaria.data().nome;
      let email = document.createElement('p');
      email.className = "card-text";
      email.innerHTML = imobiliaria.data().email;
      let tel = document.createElement('p');
      tel.className = "card-text";
      tel.innerHTML = imobiliaria.data().telefone;
      let endereco = document.createElement("p");
      endereco.className = "card-text";
      endereco.innerHTML = imobiliaria.data().endereco.rua + ", " + imobiliaria.data().endereco.numero + "<br>" + imobiliaria.data().endereco.complemento;
      $("#modalimobiliariaDetalhada").before(col);
      col.appendChild(card)
      card.appendChild(cardHead);
      cardHead.appendChild(img);
      card.appendChild(cardBody);
      cardBody.appendChild(title);
      cardBody.appendChild(email);
      cardBody.appendChild(tel);
      cardBody.appendChild(endereco);

      // Click no card
      $(card).click(() => {
        //Definir atributos do imobiliaria
        $("#Detalheimobiliaria").html(imobiliaria.data().nome);
        $("#imgDetalhado").attr('src', '');
        $("#imgDetalhado").attr('src', imgUrl);
        $('#pEmail').html("Email " + imobiliaria.data().email);
        $('#pTelefone').html("Telefone " + imobiliaria.data().telefone);
        $('#pRua').html(imobiliaria.data().endereco.rua + ', ' + imobiliaria.data().endereco.numero);
        $('#pComplemento').html(imobiliaria.data().endereco.complemento);
        $('#pBairro').html('Bairro ' + imobiliaria.data().endereco.bairro);
        $('#pCidade').html(imobiliaria.data().endereco.cidade + ' - ' + imobiliaria.data().endereco.estado);
        $('#pCnpj').html("CNPJ " + imobiliaria.data().cnpj);

        // Pegar imóveis
        let testeActive = 0;
        $('#carouselInner').empty();
        firebase.firestore().collection("imoveis").orderBy('nome').get()
          .then(function(querySnapshot) {
            querySnapshot.forEach(function(imovel) {
              if (imovel.data().imobiliaria == imobiliaria.data().nome) {
                //Criar item
                let divCarousel = document.createElement('div');
                if (!testeActive) {
                  divCarousel.className = "carousel-item active";
                  testeActive = 1;
                } else {
                  divCarousel.className = "carousel-item";
                }
                //Criar texto
                let divTitulo = document.createElement('div');
                divTitulo.className = "carousel-caption d-none d-md-block";
                let h5 = document.createElement('h5');
                h5.innerHTML = imovel.data().nome + ", " + imovel.data().endereco.complemento;
                //Criar img
                let imgCarousel = document.createElement('img');
                imgCarousel.className = "d-block w-100";
                firebase.storage().ref().child(imovel.data().imagem + '/imagemCapa').getDownloadURL()
                  .then(function(url) {
                    imgCarousel.src = url;
                    //Colocar objetos na pagina
                    $('#imoveis').css('display', 'inline');
                    $('#carouselInner').append(divCarousel);
                    divCarousel.appendChild(imgCarousel);
                    divCarousel.appendChild(divTitulo);
                    divTitulo.appendChild(h5);
                  })
                  .catch(function(error) {
                    console.log(error);
                  })
              } else {
                $('#carouselInner').empty();
                $('#imoveis').css('display', 'none');
              }
            })
          })
          .catch(function(error) {
            //Nenhum imóvel encontrado
            console.log('Nenhum imóvel cadastrado encontrado');
            console.log(error);
          })

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
            'address': imobiliaria.data().endereco.rua + ', ' + imobiliaria.data().endereco.numero
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

        //Enviar email
        $('#btnEnviarEmail').click(()=>{
          if ($("#enviarEmailImobiliaria")[0].checkValidity()) {
            showLoader();
            $.ajax({
                url: '../mail/mail.php',
                type: "POST",
                data: ({
                    nome: $('#inputNomeEmail').val(),
                    email: $('#inputEmailEmail').val(),
                    emailPara: imobiliaria.data().email,
                    comentario: $('#inputTextEmail').val()
                }),
                success: function () {
                  window.sessionStorage.setItem('msg', 'Email enviado com sucesso');
                  window.sessionStorage.setItem('msgType', 'suc');
                  hideLoader();
                  window.location.reload()
                },
                error: function (event) {
                  window.sessionStorage.setItem('msg', 'Erro ao enviar email');
                  window.sessionStorage.setItem('msgType', 'err');
                  console.log(event);
                  hideLoader();
                  window.location.reload();
                }
            })
          }else{
            mensagemModErr('Preencha o formulário corretamente', 2);
          }
        })

        $("#modalimobiliariaDetalhada").modal('toggle');

        if (!testeAdmin) {
          $('#modalFooter').hide();
        }
        // // Button Alterar
        $('#btnAlterar').click(() => {
          while ($('#croppieDiv').children().length > 0) {
              $('#croppieDiv').children().remove();
          }
          let img = document.createElement("img");
          img.className = "rounded img-fluid mx-auto d-block";
          $(img).attr('src', imgUrl);
          $('#croppieDiv').append(img);
          $('#modalimobiliariaDetalhada').modal('toggle');
          $('#modalCadastrarImobiliaria').modal('toggle');
        })
        // Button Excluir
        $('#btnExcluir').click(() => {
          showLoader();
          //Apagar firestore
          firebase.firestore().collection("imobiliarias").doc(imobiliaria.data().nome).delete().then(function() {
            //Apagar imagens
            firebase.storage().ref(imobiliaria.data().imagem + '/Logo').delete().then(function() {
              // Imagem apagada
              hideLoader();
              mensagemModSuc('Imobiliária excluida com sucesso', 2);
              setTimeout(() => {
                window.location.href = "imobiliarias.php";
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
    //Nenhuma imobiliária encontrada
    console.log('Nenhuma imobiliária cadastrada encontrada');
    console.log(error);
  })
