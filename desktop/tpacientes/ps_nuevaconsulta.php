<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$res = array();

require_once '../global.config.php';
require_once '../config.php';

if ($_POST) {

    $p1 = trim($_POST['ctas']);
    $p2 = trim($_POST['ctad']);
    $p3 = trim($_POST['cpeso']);
    $p4 = trim($_POST['ctalla']);
    $p5 = trim($_POST['ccintura']);
    $p6 = trim($_POST['ccadera']);

    $a1 = trim($_POST['cglucosa']);
    $a2 = trim($_POST['ccolesterol']);
    $a3 = trim($_POST['chdl']);
    $a4 = trim($_POST['cldl']);
    $a5 = trim($_POST['ctrig']);

    $receta = trim($_POST['receta']);
    $idPte = trim($_POST['idPte']);
    $nombrePte = trim($_POST['nombrePte']);
    $doctora = trim($_POST['doctora']);
    $enfermera = trim($_POST['enfermera']);


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

    $receta = strip_tags($receta);
    $idPte = strip_tags($idPte);
    $nombrePte = strip_tags($nombrePte);
    $doctora = strip_tags($doctora);
    $enfermera = strip_tags($enfermera);

    //error_log("Valor: ".$p1,0);
    //error_log("Valor: ".$p2,0);


    require_once(C_P_CLASES.'actions/a.pacientes.php');
    $myIns = new A_PTE("");

    $res = $myIns->ins_consultapaciente($DBcon, $idPte, $nombrePte, $p1, $p2, $p3, $p4, $p5, $p6, $a1, $a2, $a3, $a4, $a5, $receta, $doctora, $enfermera);


}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>