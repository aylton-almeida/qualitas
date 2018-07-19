var msg = window.sessionStorage.getItem("msg");
if(msg){
  mensagemErr(msg, 1);
  sessionStorage.clear();
}
