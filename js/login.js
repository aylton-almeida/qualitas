// Button login
$("#btnLogin").click(() => {
  if ($("#form")[0].checkValidity()) {
    if ($("#checkInput").prop("checked")) {
      firebase.auth().setPersistence(firebase.auth.Auth.Persistence.LOCAL)
        .then(function() {
          return login();
        })
        .catch(function(error) {
          console.log(error.code);
          console.log(error.message);
        });
    } else {
      firebase.auth().setPersistence(firebase.auth.Auth.Persistence.SESSION)
        .then(function() {
          return login();
        })
        .catch(function(error) {
          console.log(error.code);
          console.log(error.message);
        });
    }
  } else {
    mensagemErr("Preencha todos os campos correntamente!")
  }
})

function login() {
  firebase.auth().signInWithEmailAndPassword($("#emailInput").val(), $("#passInput").val())
    .then(() => {
      window.location.href = "../index.php"
    })
    .catch((error) => {
      console.log(error.code);
      console.log(error.message);
      if (error.code == "auth/wrong-password") {
        mensagemErr("Senha incorreta!");
      } else {
        if (error.code == "auth/user-not-found") {
          mensagemErr("Usuário não encontrado!");
        } else {
          if (error.code == "auth/user-disabled") {
            mensagemErr("Usuário desabilitado pelo administrador!");
          } else {
            mensagemErr("Erro ao fazer login! Tente novamente mais tarde.");
          }
        }
      }
    })
}
