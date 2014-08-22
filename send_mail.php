<?php
/**
 * Created by PhpStorm.
 * User: rueda
 * Date: 21/08/14
 * Time: 07:10 PM
 */

require_once('class.phpmailer.php');
include("class.smtp.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo json_encode(array('success'=>false, 'msg'=>1));
    return false;
}

if (!isset($_POST['comentario'], $_POST['correo'], $_POST['empresa'], $_POST['apellido'], $_POST['nombre'])) {
    echo json_encode(array('success'=>false, 'msg'=>2));
    return false;
}

$mail = new PHPMailer();

$body = "<table width='100%'>
<tr style='background: #efefef;'><th style='width: 20%;'>Nombre</th><td>" . $_POST['nombre'] . "</td></tr>
<tr><th style='width: 20%;'>Apellido</th><td>" . $_POST['apellido'] . "</td></tr>
<tr style='background: #efefef;'><th style='width: 20%;'>Empresa</th><td>" . $_POST['empresa'] . "</td></tr>
<tr><th style='width: 20%;'>Correo</th><td>" . $_POST['correo'] . "</td></tr>
<tr style='background: #efefef;'><th style='width: 20%;'>Teléfono</th><td>" . $_POST['telefono'] . "</td></tr>
<tr><th style='width: 20%;'>Comentario</th><td>" . $_POST['comentario'] . "</td></tr>
</table>";

$mail->IsSMTP();
$mail->SMTPDebug = 0;
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->Username = "pedidosdispufil@gmail.com";
$mail->Password = "XXX";

$mail->SetFrom('pedidosdispufil@gmail.com', 'Dispufil');

$mail->Subject = "Contacto dispufil";

$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

$mail->MsgHTML($body);

$address = $_POST['correo'];
$mail->AddAddress('pedidosdispufil@gmail.com', 'Dispufil');

if(!$mail->Send()) {
    echo json_encode(array('success'=>false, 'msg'=>3));
} else {
    echo json_encode(array('success'=>true));
}