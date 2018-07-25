//Pegar usuário atual e testar imobiliaria
firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    //Pegar usuário no firestore
    firebase.firestore().collection("usuarios").doc(user.uid).get().then((doc) => {
        //Pegar imobiliaria do usuário
        if (doc.data().imobiliaria != "Qualitas Imobiliária e Construtora LTDA") {
          sessionStorage.setItem("msg", "Ops... Parece que você foi para uma pagina que não deveria! Por isso te redirecionamos para a pagina incial");
          window.sessionStorage.setItem('msgType', 'err');
          window.location.href = "../index.php";
        }
      })
      .catch((error) => {
        //Caso não encontre um usuario no firestore
        sessionStorage.setItem("msg", "Ops... Parece que você foi para uma pagina que não deveria. Por isso te redirecionamos para a pagina incial!");
        window.sessionStorage.setItem('msgType', 'err');
        window.location.href = "../index.php";
      })
  } else {
    //Caso não tenha usuario cadastrado
    sessionStorage.setItem("msg", "Ops... Parece que você foi para uma pagina que não deveria. Por isso te redirecionamos para a pagina incial!");
    window.sessionStorage.setItem('msgType', 'err');
    window.location.href = "../index.php";
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

//Button Salvar imóvel
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
            mensagemModSuc("Imóvel cadastrado com sucesso!", 2);
            //limpar form
            limpaForm();
            //Fechar modal
            $('#modalCadastrarImovel').modal('hide');
          })
          .catch((error) => {
            //Erro ao adicionar usuário ao firestore
            hideLoader(1);
            console.log(error);
            mensagemModErr("Erro ao cadastrar imóvel! Tente novamente mais tarde.", 2);
          });
      })
      .catch((error) => {
        //Erro no upload da imagem
        hideLoader(1);
        console.log(error);
        mensagemModErr("Erro ao cadastrar imóvel! Tente novamente mais tarde.", 2);
      })
  } else {
    //Formulario incompleto
    hideLoader(1);
    mensagemModErr("Preencha todos os campos corretamente!", 2);
  }
})

//Cancelar modal usuario
$("#btnCancelarUsuario").click(() => {
  $("#formUsuario")[0].reset();
  $("#senhaSpan2").css('background-color', '#ffc107');
  $("#senhaSpan2").html("remove");
})

// Botao de cadastro usuário
$("#btnCadastro").click(() => {
  showLoader(2);
  //Validação do formulário
  if ($("#formUsuario")[0].checkValidity()) {
    //Validação da igualdade das senhas
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
            displayName: $("#nomeInputUsuario").val(),
          }).then(function() {
            //Salvar imobiliaria no firestore
            firebase.firestore().collection("usuarios").doc(user.uid).set({
                sobrenome: $("#sobrenomeInput").val(),
                imobiliaria: $("#imobiliariaInputUsuario").val()
              })
              .then(function() {
                //Sucesso ao adicionar usuário ao firestore
                user.sendEmailVerification()
                  .then(function() {
                    // Email enviado
                    hideLoader(2);
                    secondaryApp.auth().signOut();
                    //Limpar form
                    $("#formUsuario")[0].reset();
                    $("#senhaSpan2").html("clear");
                    //Fechar modal
                    $('#modalCadastrarUsuario').modal('hide');
                    mensagemSuc("Usuário criado. Um email foi enviado para verificar a conta!", 1);
                  }).catch(function(error) {
                    //Erro no envio
                    hideLoader(2);
                    mensagemModErr("Erro ao criar usuário", 1)
                  });
              })
              .catch(function(error) {
                //Erro ao adicionar usuário ao firestore
                hideLoader(2);
                console.log(error);
                mensagemModErr("Erro ao cadastrar usuário! Tente novamente mais tarde.", 1);
              });
          }).catch(function(error) {
            //Erro ao alterar nome do usuário
            hideLoader(2);
            console.log(error.message);
            mensagemModErr("Erro ao cadastrar usuário! Tente novamente mais tarde.", 1)
          });
        })
        .catch(function(error) {
          //Erro caso a senha seja pequena
          if (error.code == "auth/weak-password") {
            hideLoader(2);
            mensagemModErr("Sua senha deve ter ao menos 6 caracteres!", 1);
          } else {
            //Erro caso o email ja tenha sido cadastrado
            if (error.code == "auth/email-already-in-use") {
              hideLoader(2);
              mensagemModErr("Esse email já foi cadastrado!", 1);
            } else {
              //Erro geral
              hideLoader(2);
              mensagemModErr("Erro ao cadastrar usuário! Tente novamente mais tarde.", 1);
            }
          }
        });
    } else {
      //Erro caso senhas não coincidam
      hideLoader(2);
      mensagemModErr("As senhas não coincidem!", 1);
    }
  } else {
    //Erro caso campos estiverem vazios/preenchidos incorretamente
    hideLoader(2);
    mensagemModErr("Preencha todos os campos corretamente!", 1);
  }
})

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
