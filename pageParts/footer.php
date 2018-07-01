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
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-functions.js"></script>
<!-- Add icons -->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

//Esconder formulário
$("#formNav").hide();
  //Button cadastro navBar
  $("#btnCadastroNav").click(() => {
    window.location.href = "<?php if($_SESSION['page'] == "home"){echo "pages/cadastro.php";}else{echo "../pages/cadastro.php";}?>";
  })
  // Button login navBar
  $("#btnLoginNav").click(() => {
    //Validar fomulário
    if ($("#formNav")[0].checkValidity()) {
      //Fazer login
      firebase.auth().signInWithEmailAndPassword($("#emailInputNav").val(), $("#passInputNav").val())
      .then(()=>{
        //Caso o login seja um sucesso
        firebase.auth().onAuthStateChanged(function(user) {
          if(user){
            if(user.emailVerified){
              //Caso o email tenha sido verificado
              $("#formNav").hide();
              mensagemSuc("Bem vindo" + user.displayName);
              window.location.href = "#"
            }else{
              //Caso o email não esteja verificado
              user.sendEmailVerification().then(()=>{
                mensagemErr("Seu email ainda não foi verificado! Um email foi enviado para verifica-lo.");
              })
            }
          }
        })
      })
      .catch(function(error) {
        //Caso ocorra algum erro no login
        console.log(error.message);
        mensagemErr("Email ou senha incorretos!");
        $("#msgCross").click(()=>{
          window.location.href = "<?php if($_SESSION['page'] == "home"){echo "pages/login.php";}else{echo "../pages/login.php";}?>";
        })
      });
    } else {
      //Caso o forulário esteja preenchido incorretamente
      mensagemErr("Preencha todos os campos corretamente!");
      $("#msgCross").click(()=>{
        window.location.href = "<?php if($_SESSION['page'] == "home"){echo "pages/login.php";}else{echo "../pages/login.php";}?>";
      })
    }
  })

  //Conferir se um usuário está logado e caso esteja colocar seu nome na navbar
  firebase.auth().onAuthStateChanged(function(user) {
    if(user){
      firebase.firestore().collection("usuarios").doc(user.uid).get().then((doc) => {
      //Usuário conectado
      console.log("Logged in");
      $("#bemVindo").html("Bem vindo " + user.displayName);
      //over e out span bemvindo
      $("#bemVindo")
      .mouseover(()=>{
            //Pegar imobiliaria do usuário
            if (doc.data().imobiliaria == "Qualitas Imobiliária e Construtora LTDA") {
              if(<?php if($_SESSION['page'] == "admin"){echo "true";}else{echo "false";}?>){
                //Caso o usuário esteja na pagina de admin
                $("#bemVindo").html("Sair");
                //Função do click no sair
                $("#bemVindo").click(()=>{
                  $("#bemVindo").hide();
                  firebase.auth().signOut();
                  window.location.href = "<?php if($_SESSION['page'] == "home"){echo "index.php";}else{echo "../index.php";}?>";
                })
              }else{
                $("#bemVindo").html("Administrador");
                //Função do click no admin
                $("#bemVindo").click(()=>{
                  //Enviar para pagina de administrador
                  window.location.href = "<?php if($_SESSION['page'] == "home"){echo "pages/admin.php";}else{echo "../pages/admin.php";}?>";
                })
              }
            } else {
              $("#bemVindo").html("Sair");
              //Função do click no sair
              $("#bemVindo").click(()=>{
                $("#bemVindo").hide();
                firebase.auth().signOut();
                window.location.href = "<?php if($_SESSION['page'] == "home"){echo "index.php";}else{echo "../index.php";}?>";
              })
            }
          })
      .mouseout(()=>{
        $("#bemVindo").html("Bem vindo " + user.displayName);
      })
    })
    }else{
      //Usuário desconectado
      console.log("Not logged in");
      $("#formNav").show();
    }
  })

  //Funções de mensagem
  function mensagemErr(msg){
    $('#msg').html('<div class="alert alert-danger fade show">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="msgCross"><span aria-hidden="true">&times;</span></button></div>');
  }
  function mensagemSuc(msg){
    $('#msg').html('<div class="alert alert-success fade show">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="msgCross"><span aria-hidden="true">&times;</span></button></div>');
  }
  function mensagemModErr(msg){
    $('#msgMod').html('<div class="alert alert-danger fade show">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="msgCross"><span aria-hidden="true">&times;</span></button></div>');
  }
  function mensagemModSuc(msg){
    $('#msgMod').html('<div class="alert alert-success fade show">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="msgCross"><span aria-hidden="true">&times;</span></button></div>');
  }

  //Loader
  function showLoader(){
    $("#loader").show()
  }
  function hideLoader(){
    $("#loader").hide()
  }

</script>
