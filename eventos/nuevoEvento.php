<?php
global $conn, $con;

require '../config/config.php';

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
//$hora = date("g:i:A");

require("../config/config.php");

$evento            = ucwords($_REQUEST['evento']);
$f_inicio          = $_REQUEST['fecha_inicio'];
$fecha_inicio      = date('Y-m-d', strtotime($f_inicio)); 

$f_fin             = $_REQUEST['fecha_fin']; 
$seteando_f_final  = date('Y-m-d', strtotime($f_fin));  
$fecha_fin1        = strtotime($seteando_f_final."+ 1 days");
$fecha_fin         = date('Y-m-d', ($fecha_fin1));  
$color_evento      = $_REQUEST['color_evento'];


    $InsertNuevoEvento = "INSERT INTO eventoscalendar(
      evento,
      fecha_inicio,
      fecha_fin,
      color_evento
      )
    VALUES (
      '" .$evento. "',
      '". $fecha_inicio."',
      '" .$fecha_fin. "',
      '" .$color_evento. "'
  )";

$resultadoNuevoEvento = mysqli_query($con, $InsertNuevoEvento);

header("Location:index.php?e=1");

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP de Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mfurquina2004@gmail.com'; // Coloca aquí tu dirección de correo de Gmail
    $mail->Password = 'vkes rxfy eyes dihw'; // Coloca aquí la contraseña de tu correo de Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configuración del correo
    $mail->setFrom('mfurquina2004@gmail.com', 'Manuel Urquina');
    $mail->Subject = "Solicitud de Validación para Evento";
    $mail->Body = "Se ha registrado un nuevo evento. Por favor, valide el evento haciendo clic en el siguiente enlace: https://localhost/validar_evento.php?id={$ultimoEventoId['id']}";

    // Enviar el correo
    //$to = 'mfurquina2004@gmail.com';
    //$subject = 'Prueba de correo';
    //$message = 'Este es un mensaje de prueba.';
    //$headers = 'From: tu_correo@gmail.com';

    $mail->send();
    echo 'Correo enviado correctamente';
} catch (Exception $e) {
    echo 'Error al enviar el correo: ', $mail->ErrorInfo;
}