<!-- Add Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Add bootstrap scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<!-- Add croppie script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<!-- Add funções do firebase -->
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-functions.js"></script>
<!-- Iniciar Firebase -->
<script>
  var config = {
    apiKey: "AIzaSyD_XmxvW05XB7WrV_lwhfYn-fzTAgfAYZ4",
    authDomain: "qualitas-24b79.firebaseapp.com",
    databaseURL: "https://qualitas-24b79.firebaseio.com",
    projectId: "qualitas-24b79",
    storageBucket: "qualitas-24b79.appspot.com",
    messagingSenderId: "347582656373"
  };
  firebase.initializeApp(config);
</script>
<!-- Login navbar -->
<script type="text/javascript">
$("#formNav").hide();
  //Button cadastro navBar
  $("#btnCadastroNav").click(() => {
    window.location.href = "<?php if($_SESSION['page'] == "home"){echo "pages/cadastro.php";}else{echo "../pages/cadastro.php";}?>";
  })
  // Button login navBar
  $("#btnLoginNav").click(() => {
    if ($("#formNav")[0].checkValidity()) {
      firebase.auth().signInWithEmailAndPassword($("#emailInputNav").val(), $("#passInputNav").val())
      .then(()=>{
        window.location.href = "<?php if($_SESSION['page'] == "home"){echo "index.php";}else{echo "../index.php";}?>"
      })
      .catch(function(error) {
        console.log(error.message);
        mensagemErr("Email ou senha incorretos!");
        $("#msgCross").click(()=>{
          window.location.href = "<?php if($_SESSION['page'] == "home"){echo "pages/login.php";}else{echo "../pages/login.php";}?>";
        })
      });
    } else {
      mensagemErr("Preencha todos os campos corretamente!");
      $("#msgCross").click(()=>{
        window.location.href = "<?php if($_SESSION['page'] == "home"){echo "pages/login.php";}else{echo "../pages/login.php";}?>";
      })
    }
  })
  firebase.auth().onAuthStateChanged(function(user) {
    if(user){
      console.log("Logged in");
      $("#bemVindo").html("Bem vindo " + user.displayName);
    }else{
      console.log("Not logged in");
      $("#formNav").show();
    }
  })

  function mensagemErr(msg){
    $('#msg').html('<div class="alert alert-danger fade show">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="msgCross"><span aria-hidden="true">&times;</span></button></div>');
  }
  function mensagemSuc(msg){
    $('#msg').html('<div class="alert alert-success fade show">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="msgCross"><span aria-hidden="true">&times;</span></button></div>');
  }

</script>
