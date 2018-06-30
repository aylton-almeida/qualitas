var msg = window.sessionStorage.getItem("msg");
if(msg){
  mensagemErr(msg);
  sessionStorage.clear();
}
