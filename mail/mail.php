<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

$nome = $_POST["nome"];
$emailUsuario = $_POST["email"];
$emailPara = $_POST["emailPara"];
$comentario = $_POST["comentario"];

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com;smtp2.example.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'qualitasimobiliaria@outlook.com';                 // SMTP username
    $mail->Password = '4ylt0n4lm3id43!';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom(''.$emailUsuario, ''.$nome);
    $mail->addAddress(''.$emailPara, 'Imobiliaria');     // Add a recipient
    $mail->addReplyTo(''.$emailUsuario, ''.$nome);
    $mail->addCC('');
    $mail->addBCC('');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Comentario';
    $mail->Body    = ''.$comentario;
    $mail->AltBody = ''.$comentario;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
