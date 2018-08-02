<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$nome = $_POST["nome"];
$emailUsuario = $_POST["email"];
$emailPara = $_POST["emailPara"];
$comentario = $_POST["comentario"];

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 1;
    $mail->isSMTP();
    $mail->Host = 'smtp.live.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'qualitasimobiliaria@outlook.com';
    $mail->Password = '4ylt0n4lm3id43!';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('qualitasimobiliaria@outlook.com', $nome);
    $mail->addAddress($emailPara, 'Imobiliaria');
    $mail->addReplyTo($emailUsuario, $nome);

    //Content
    // $mail->isHTML(true);
    $mail->Subject = 'Email enviado pela web';
    $mail->Body    = $comentario;
    // $mail->AltBody = $comentario;

    $mail->send();
    echo 'Mensagem enviada com sucesso';
} catch (Exception $e) {
    echo 'Erro ao enviar mensagem';
    echo 'Mailer Error: ' . $e->getMessage();
}
