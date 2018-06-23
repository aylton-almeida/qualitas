<?php
//Criar Conexão
$conn = new mysqli('localhost', 'root', '');

//Testar Conexão
if($conn->connect_error){
  die('Falha na conexão: '.$conn->connect_error);
}

//Testar conexão com um database
if(!mysqli_select_db($conn, 'qualitas')){
  $sql = 'CREATE DATABASE qualitas';
  if($conn->query($sql)){
    echo "Servidor criado com sucesso";
    mysqli_select_db($conn, 'qualitas');
  }else{
    die('Erro ao criar servidor: '. $conn->error);
  }
}

//Testar conexão com uma table
$sql = 'DESCRIBE imoveis';
if(!$conn->query($sql)){
  $table = 'CREATE TABLE imoveis(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    rua VARCHAR(50) NOT NULL,
    numero VARCHAR(50) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    complemento VARCHAR(30) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    preco FLOAT NOT NULL,
    imobiliaria VARCHAR(50) DEFAULT "unset",
    imagem BLOB
    )';
  if($conn->query($table)){
    echo 'Table criada com sucesso';
  }else{
    die('Erro ao criar table: '.$conn->error);
  }
}

//Inserir imóvel
$nome = $_POST["nome"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$complemento = $_POST["complemento"];
$estado = $_POST["estado"];
$cidade = $_POST["cidade"];
$preco = $_POST["preco"];
$imobiliaria = $_POST["imobiliaria"];
$imagem = $_POST["imagem"];

$imovel = "INSERT INTO imoveis (nome,rua,numero,bairro,complemento,estado,cidade,preco, imobiliaria, imagem) VALUES (?,?,?,?,?,?,?,?,?,?)";
$stmt = mysqli_prepare($conn, $imovel);
if (!$stmt) {
  die('mysqli error: '.mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "sssssssdsb", $nome, $rua, $numero, $bairro, $complemento, $estado, $cidade, $preco, $imobiliaria, $imagem);

if(!mysqli_stmt_execute($stmt)){
  die('Erro ao inserir imovel: '.$conn->error);
}

//Fechar conexão
$conn->close();
?>
