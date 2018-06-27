// Button login
$("#btnLogin").click(() => {
  if ($("#form")[0].checkValidity()) {
    if($("#checkInput").prop("checked")) {
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
    alert("Preencha todos os campos corretamente");
  }
})

function login(){
  firebase.auth().signInWithEmailAndPassword($("#emailInput").val(), $("#passInput").val())
  .then(()=>{
    window.location.href = "../index.php"
  })
  .catch((error)=>{
    console.log(error.message);
    alert("Email ou senha incorretos");
  })
}
