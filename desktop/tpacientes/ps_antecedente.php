<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$res = array();

require_once '../global.config.php';
require_once '../config.php';

if ($_POST) {

    $p1 = trim($_POST['pdiabetes']);
    $p2 = trim($_POST['phiper']);
    $p3 = trim($_POST['ptabaquismo']);
    $p4 = trim($_POST['pcolesterol']);
    $p5 = trim($_POST['ptrigli']);
    $p6 = trim($_POST['pinfartos']);

    $a1 = trim($_POST['adiabetes']);
    $a2 = trim($_POST['ahiper']);
    $a3 = trim($_POST['atabaquismo']);
    $a4 = trim($_POST['acolesterol']);
    $a5 = trim($_POST['atrigli']);
    $a6 = trim($_POST['ainfartos']);

    $ante = trim($_POST['antecedentes']);
    $idPte = trim($_POST['idPte']);
    $nombrePte = trim($_POST['nombrePte']);


    $p1 = strip_tags($p1);
    $p2 = strip_tags($p2);
    $p3 = strip_tags($p3);
    $p4 = strip_tags($p4);
    $p5 = strip_tags($p5);
    $p6 = strip_tags($p6);

    $a1 = strip_tags($a1);
    $a2 = strip_tags($a2);
    $a3 = strip_tags($a3);
    $a4 = strip_tags($a4);
    $a5 = strip_tags($a5);
    $a6 = strip_tags($a6);

    if($p1 != "SI"){ $p1 = "NO"; }
    if($p2 != "SI"){ $p2 = "NO"; }
    if($p3 != "SI"){ $p3 = "NO"; }
    if($p4 != "SI"){ $p4 = "NO"; }
    if($p5 != "SI"){ $p5 = "NO"; }
    if($p6 != "SI"){ $p6 = "NO"; }

    if($a1 != "SI"){ $a1 = "NO"; }
    if($a2 != "SI"){ $a2 = "NO"; }
    if($a3 != "SI"){ $a3 = "NO"; }
    if($a4 != "SI"){ $a4 = "NO"; }
    if($a5 != "SI"){ $a5 = "NO"; }
    if($a6 != "SI"){ $a6 = "NO"; }

    $ante = strip_tags($ante);
    $idPte = strip_tags($idPte);
    $nombrePte = strip_tags($nombrePte);

    //error_log("Valor: ".$p1,0);
    //error_log("Valor: ".$p2,0);


    require_once(C_P_CLASES.'actions/a.pacientes.php');
    $myIns = new A_PTE("");

    $res = $myIns->ins_antecedentepaciente($DBcon, $idPte, $nombrePte, $p1, $p2, $p3, $p4, $p5, $p6, $a1, $a2, $a3, $a4, $a5, $a6, $ante);


}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>