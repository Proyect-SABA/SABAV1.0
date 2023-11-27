<?php
global $conn;
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

$resultadoNuevoEvento = mysqli_query($conn, $InsertNuevoEvento);

header("Location:index.php?e=1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $evento = $_POST['evento'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $colorEvento = $_POST['color_evento'];
    $adminEmail = $_POST['adminEmail'];

    // Insertar el evento en la base de datos (tu código existente)

    // Enviar correo al administrador
    $toAdmin = $adminEmail;
    $subjectAdmin = "Nuevo Evento Pendiente de Validación";
    $messageAdmin = "Se ha registrado un nuevo evento que requiere validación. Por favor, valida el evento.";
    mail($toAdmin, $subjectAdmin, $messageAdmin);

}