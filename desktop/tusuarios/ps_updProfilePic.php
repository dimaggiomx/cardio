<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$response = array();

require_once '../global.config.php';
require_once '../config.php';

            require_once(C_P_CLASES.'actions/a.usuarios.php');
            $myIns = new A_USR("");

            // Get PROFILE
            $subquery = "";
            $logoPic = $myIns->get_datosProfilePic($DBcon,$_SESSION["ses_cuser"]);

        $_SESSION["ses_cphoto1"] = $logoPic;

$response['status'] = 'success'; // could not register
$response['message'] = 'Imagen de Perfil Actualizada correctamente';
$response['URL'] = 'perfil.php';



echo json_encode($response);
?>