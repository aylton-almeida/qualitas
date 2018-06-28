// Botao de cadastro
$("#btnCadastro").click(() => {
  //Validação do formulário
  if ($("#form")[0].checkValidity()) {
    //Validação da igualdade das senhas
    if ($("#confPassInput").val() == $("#passInput").val()) {
      //Método de criação de função
      firebase.auth().createUserWithEmailAndPassword($("#emailInput").val(), $("#passInput").val())
        .then(function(user) {
          //Alteração do nome do usuário recem criado
          user.updateProfile({
            displayName: $("#nomeInput").val(),
          }).then(function() {
            //Salvar imobiliaria no firestore
            firebase.firestore().collection("usuarios").doc(user.uid).set({
              sobrenome: $("#sobrenomeInput").val(),
              imobiliaria: $("#imobiliariaInput").val()
              })
              .then(function() {
                //Sucesso ao adicionar usuário ao firestore
                window.location.href = "../index.php";
              })
              .catch(function(error) {
                //Erro ao adicionar usuário ao firestore
                console.log(error);
                mensagemErr("Erro ao cadastrar usuário! Tente novamente mais tarde.");
              });
          }).catch(function(error) {
            //Erro ao alterar nome do usuário
            console.log(error.message);
            mensagemErr("Erro ao cadastrar usuário! Tente novamente mais tarde.")
          });
        })
        .catch(function(error) {
          //Erro caso a senha seja pequena
          if (error.code == "auth/weak-password") {
            mensagemErr("Sua senha deve ter ao menos 6 caracteres!");
          } else {
            //Erro caso o email ja tenha sido cadastrado
            if (error.code == "auth/email-already-in-use") {
              mensagemErr("Esse email já foi cadastrado!");
            } else {
              //Erro geral
              mensagemErr("Erro ao cadastrar usuário! Tente novamente mais tarde.");
            }
          }
        });
    } else {
      //Erro caso senhas não coincidam
      mensagemErr("As senhas não coincidem!");
    }
  } else {
    //Erro caso campos estiverem vazios/preenchidos incorretamente
    mensagemErr("Preencha todos os campos corretamente!");
  }
})

//Confirmação de senha
$("#confPassInput").change(() => {
  if ($("#confPassInput").val() != $("#passInput").val()) {
    //Caso senhas coincidam
    $("#smallConfsenha").html("Senhas não coincidem!");
    $("#smallConfsenha").attr("class", "text-danger");
  } else {
    //Caso senhas não coincidam
    $("#smallConfsenha").html("Senhas coincidem!");
    $("#smallConfsenha").attr("class", "text-success");
  }
})
