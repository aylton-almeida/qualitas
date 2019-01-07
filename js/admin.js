var testeAdmin = false;
//Pegar usuário atual e testar imobiliaria
firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    //Pegar usuário no firestore
    firebase.firestore().collection("usuarios").doc(user.uid).get().then((doc) => {
        //Pegar imobiliaria do usuário
        if (doc.data().imobiliaria == "Qualitas Imobiliária e Construtora LTDA") {
          testeAdmin = true;
          $("#btnCadastrarUsuario").show();
        } else {
          //Caso a imobiliaria não seja qualitas
          $("#btnCadastrarUsuario").hide();
        }
      })
      .catch((error) => {
        //Caso não encontre um usuario no firestore
        $("#btnCadastrarUsuario").hide();
      })
  } else {
    //Caso não tenha usuario cadastrado
    $("#btnCadastrarUsuario").hide();
  }
});

//Esconder contato
$('#dropdownNavConta').hide();

//Pegar usuário atual e mensagem bem vindo
firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    //Mensagem de bem vindo
    $('#bemVindoAdmin').html('Bem vindo ' + user.displayName)
  } else {
    //Caso não tenha usuario cadastrado
    sessionStorage.setItem("msg", "Ops... Parece que você foi para uma pagina que não deveria. Por isso te redirecionamos para a pagina incial!");
    window.sessionStorage.setItem('msgType', 'err');
    window.location.href = "../index.php";
  }
});

//Função sair
$('#btnSair').click(() => {
  firebase.auth().signOut();
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

//Pegar imobiliárias e coloca-las nas opções
firebase.firestore().collection("imobiliarias").orderBy('nome').get()
  .then(function(querySnapshot) {
    querySnapshot.forEach(function(imobiliaria) {
      option = document.createElement('option');
      $(option).val(imobiliaria.data().nome);
      $(option).html(imobiliaria.data().nome);
      $('#imobiliariaInput').append(option);
    });
  });

//Limpa form
function limpaForm() {
  $('#cadastrarUsuario')[0].reset();

  $("#senhaSpan2").css('background-color', '#ffc107');
  $("#senhaSpan2").html("remove");
}

//Button Cancelar
$('#btnCancelar').click(() => {
  limpaForm();
})

//Button Salvar
$('#btnSalvar').click(() => {
  //Iniciar loader
  showLoader()
  //Validação do formulário
  if ($('#cadastrarUsuario')[0].checkValidity()) {
    if ($('#confPassInput').val() == $('#passInput').val()) {
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
            displayName: $("#nomeInput").val(),
          }).then(function() {
            //Salvar imobiliaria no firestore
            firebase.firestore().collection("usuarios").doc(user.uid).set({
                imobiliaria: $("#imobiliariaInput").val(),
                nome: $('#nomeInput').val()
              })
              .then(function() {
                //Sucesso ao adicionar usuário ao firestore
                user.sendEmailVerification()
                  .then(function() {
                    // Email enviado
                    hideLoader();
                    mensagemModSuc("Usuário criado com sucesso. Um email foi enviado para verificar a conta!", 1);
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
    //Formulario incompleto
    hideLoader();
    mensagemModErr("Preencha todos os campos corretamente!", 1);
  }
})
