<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");

require_once '../global.config.php';
require_once '../config.php';

$response = array();


if ($_POST) {

    $var2 = $_POST['page'];
    $where = " WHERE 1 ";

    require_once(C_P_CLASES.'actions/a.pacientes.php');
    $myReg = new A_PTE("");

    $disp = $myReg->get_consultas($DBcon,$var2,10,$where);
    $disp = $myReg->disp_consultasPage();

}

$response['status'] = 'success'; // could not register
$response['message'] = '&nbsp; Exito..';
$response['result'] =$disp;

echo json_encode($response);
?>