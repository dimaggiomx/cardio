<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");

require_once '../global.config.php';
require_once '../config.php';

$response = array();


if ($_POST) {

    $var2 = $_POST['page'];
    $where = " ";

    require_once(C_P_CLASES.'actions/a.user.php');
    $myReg = new A_PRO("");

    $disp = $myReg->get_listuser($DBcon,$var2,10,$where);
    $disp = $myReg->disp_usersPage();

}


$response['status'] = 'success'; // could not register
$response['message'] = '&nbsp; Exito..';
$response['result'] =$disp;

echo json_encode($response);
?>