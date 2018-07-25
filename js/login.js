// Button login
$("#btnLogin").click(() => {
  showLoader();
  //Conferir validade do formulário
  if ($("#form")[0].checkValidity()) {
    //Conferir se o checkbox está ou não marcado
    if ($("#checkInput").prop("checked")) {
      //Caso sim definir persistencia do login para local
      firebase.auth().setPersistence(firebase.auth.Auth.Persistence.LOCAL)
        .then(function() {
          return login();
        })
        .catch(function(error) {
          hideLoader();
          console.log(error.code);
          console.log(error.message);
        });
    } else {
      //Caso não definir persistencia do login para seção
      firebase.auth().setPersistence(firebase.auth.Auth.Persistence.SESSION)
        .then(function() {
          return login();
        })
        .catch(function(error) {
          hideLoader();
          console.log(error.code);
          console.log(error.message);
        });
    }
  } else {
    //Caso o formulário esteja preenchido incorretamente
    mensagemErr("Preencha todos os campos correntamente!", 1)
  }
})

//Efetuar login
function login() {
  firebase.auth().signInWithEmailAndPassword($("#emailInput").val(), $("#passInput").val())
    .then(() => {
      //Sucesso
      firebase.auth().onAuthStateChanged(function(user) {
        if(user){
          if(user.emailVerified){
            //Caso o email tenha sido verificado
            hideLoader();
            $("#formNav").hide();
            window.location.href = "../index.php";
          }else{
            //Caso o email não esteja verificado
            user.sendEmailVerification().then(()=>{
              hideLoader();
              mensagemErr("Seu email ainda não foi verificado! Um email foi enviado para verifica-lo.", 1);
            })
          }
        }
      })
    })
    .catch((error) => {
      //Erros
      console.log(error.code);
      console.log(error.message);
      if (error.code == "auth/wrong-password") {
        //Erro caso a senha esteja incorreta
        mensagemErr("Senha incorreta!", 1);
      } else {
        if (error.code == "auth/user-not-found") {
          //Erro caso o usuário não tenha sido encontrado
          mensagemErr("Usuário não encontrado!", 1);
        } else {
          if (error.code == "auth/user-disabled") {
            //Erro caso o usuário tenha sido desabilitado
            mensagemErr("Usuário desabilitado pelo administrador!", 1);
          } else {
            //Erro geral
            mensagemErr("Erro ao fazer login! Tente novamente mais tarde.", 1);
          }
        }
      }
    })
}

//Email de redefinição de Senha
$("#redefSenha").click(()=>{
  //Validar campo de email
  if($("#emailInput")[0].checkValidity()){
    //Enviar email
    firebase.auth().sendPasswordResetEmail($("#emailInput").val())
    .then(function() {
      mensagemSuc("Email enviado com sucesso!", 1);
    }).catch(function(error) {
      mensagemErr("Erro ao enviar email!", 1);
    });
  }else{
    mensagemErr("Digite seu email!", 1);
  }
})
