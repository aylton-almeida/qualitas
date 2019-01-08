//Conferir se existe um usuario logado
firebase.auth().onAuthStateChanged(function(user) {
  if (!user) {
    //Caso não tenha usuario cadastrado
    sessionStorage.setItem("msg", "Ops... Parece que você foi para uma pagina que não deveria. Por isso te redirecionamos para a pagina incial!");
    window.sessionStorage.setItem('msgType', 'err');
    window.location.href = "../index.php";
  }
});
