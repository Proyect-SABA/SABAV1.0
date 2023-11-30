<?php

global $con;
require '../config/config.php';



require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function obtenerIdUltimoEvento($con): bool|array|null
{
    $query = "SELECT id FROM eventoscalendar ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function enviarCorreoAdministrador($adminEmail, $ultimoEventoId): void
{
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
        $mail->addAddress($adminEmail);
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
}

// Obtener el ID del último evento
$ultimoEvento = obtenerIdUltimoEvento($con);

if ($ultimoEvento !== false) {
    // Obtener la dirección de correo electrónico del administrador desde la base de datos
    $queryAdmin = "SELECT admcorreo FROM tbladministracion WHERE admID = 1"; // Reemplaza '1' con el ID del administrador correspondiente
    $resultAdmin = mysqli_query($con, $queryAdmin);

    if ($resultAdmin) {
        $rowAdmin = mysqli_fetch_assoc($resultAdmin);
        $adminEmail = $rowAdmin['admcorreo'];

        // Enviar el correo al administrador para validar
        enviarCorreoAdministrador($adminEmail, $ultimoEvento);

        // Devolver el resultado como JSON
        header('Content-Type: application/json');
        echo json_encode($ultimoEvento);
    } else {
        // Manejar el caso en el que no se pudo obtener la dirección de correo del administrador
        header('HTTP/1.1 500 Internal Server Error');
        echo "Error al obtener la dirección de correo del administrador.";
    }
} else {
    // Manejar el caso en el que no se pudo obtener el ID del último evento
    header('HTTP/1.1 500 Internal Server Error');
    echo "Error al obtener el ID del último evento o no hay eventos registrados.";
}
