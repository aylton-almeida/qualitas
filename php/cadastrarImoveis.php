<?php
echo $_POST['nomeImovel']."<br />";
echo $_POST['ruaImovel']."<br />";
echo $_POST['numeroImovel']."<br />";
echo $_POST['bairroImovel']."<br />";
echo $_POST['complementoImovel']."<br />";
echo $_POST['estadoImovel']."<br />";
echo $_POST['cidadeImovel']."<br />";
echo $_POST['precoImovel']."<br />";
$imobiliaria = $_POST['imobiliariaImovel'];
if($imobiliaria == 6){
  echo "Qualitas Imobiliaria e Contrutora LTDA";
}
?>
