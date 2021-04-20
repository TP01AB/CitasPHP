<?php
include_once '../Auxiliar/constantes.php';
include_once '../Auxiliar/gestionDatos.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once '../phpmailer/src/Exception.php';
require_once '../phpmailer/src/PHPMailer.php';
require_once '../phpmailer/src/SMTP.php';
require_once '../Auxiliar/gestionDatos.php';
include_once '../Modelo/Usuario.php';
if (isset($_REQUEST['iniciarBD'])) {
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LdU7-QZAAAAAChZ7pnDbgTL--nSmYG6aJxTMj2f';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    if ($recaptcha->score >= 0.5) {
        $emailDestino = $_REQUEST['email'];

        $mail = new PHPMailer();
        try {
            $mail->isSMTP();
            $mail->Host = constantes::$smtpMail;  // Host de conexión SMTP
            $mail->SMTPAuth = true;
            $mail->Username = constantes::$usuarioMail;
            $mail->Password = constantes::$passMail;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom(constantes::$usuarioMail);
            $mail->addAddress($emailDestino);

            $mail->isHTML(true);
            $mail->Subject = 'Recupera tu cuenta';

            $az = rand(1, 999999999);

            $mail->Body = 'Nueva contraseña:<b>' . $az . '</b>';
            $mail->AltBody = 'Contraseña olvidada';

            $mail->send();

            if (gestionDatos::setPassword($emailDestino, $az)) {
                $_SESSION['mensaje'] = 'Correo enviado';
            } else {
                $_SESSION['mensaje'] = 'No se ha podido establecer la contraseña';
            }
            header('Location: ../Vistas/login.php');
        } catch (Exception $e) {
            $_SESSION['mensaje'] = 'No se ha podido enviar el correo';
        }
    } else {
        $mensaje = 'Error captcha no superado.';
        $_SESSION['mensaje'] = $mensaje;
        header('Location: ../Vistas/olvidado.php');
    }
}
if (isset($_REQUEST['mensajeBD'])) {

    $user = $_SESSION['usuarioActual'];
    $emailDestino = $_SESSION['emailAmigo'];
    $asunto = $_REQUEST['asunto'];
    $cuerpo = $_REQUEST['cuerpo'];
    $mail = new PHPMailer();
    try {
        $mail->isSMTP();
        $mail->Host = constantes::$smtpMail;  // Host de conexión SMTP
        $mail->SMTPAuth = true;
        $mail->Username = constantes::$usuarioMail;
        $mail->Password = constantes::$passMail;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom(constantes::$usuarioMail);
        $mail->addAddress($emailDestino);

        $mail->isHTML(true);
        $mail->Subject = 'Mensaje de: '.$user->get_nick().' con el asunto '. $asunto;


        $mail->Body = $cuerpo;
        $mail->AltBody = '';

        $mail->send();
        $_SESSION['mensaje'] = 'Correo enviado a ' . $emailDestino;
        header('Location: ../Vistas/inicio.php');
    } catch (Exception $e) {
        $_SESSION['mensaje'] = 'No se ha podido enviar el correo';
        header('Location: ../Vistas/inicio.php');
    }
}
