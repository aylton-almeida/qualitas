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

//Confirmação de senha
$("#confPassInput").change(() => {
  if ($("#confPassInput").val() != $("#passInput").val()) {
    //Caso senhas não coincidam
    $("#senhaSpan2").css('background-color', 'red');
    $("#senhaSpan2").html("clear");
  } else {
    //Caso senhas coincidam
    $("#senhaSpan2").css('background-color', 'green');
    $("#senhaSpan2").html("check");
  }
})
//Confirmação de senha
$("#passInput").change(() => {
  if ($("#confPassInput").val() != $("#passInput").val()) {
    //Caso senhas não coincidam
    $("#senhaSpan2").css('background-color', 'red');
    $("#senhaSpan2").html("clear");
  } else {
    //Caso senhas coincidam
    $("#senhaSpan2").css('background-color', 'green');
    $("#senhaSpan2").html("check");
  }
})
