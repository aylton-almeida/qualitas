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
                $(option).val(imovel.data().nome + ', ' + imovel.data().endereco.complemento);
                $(option).html(imovel.data().nome + ', ' + imovel.data().endereco.complemento);
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
      $('#labelComprovante').html(inputComprovante.files[0].name);
    }
    reader.readAsDataURL(inputComprovante.files[0]);
  }
})

//Limpa form
function limpaForm(){
  $('#formFazerPagamento')[0].reset();
  $('#labelComprovante').html("Envie seu comprovante");
}

//Button Canecelar
$('#btnCancelar').click(()=>{
  limpaForm();
})
