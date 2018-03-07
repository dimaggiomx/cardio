<?php
session_start();
header('Content-type: application/json');
header("Content-Type: text/html;charset=utf-8");
$res = array();

require_once '../global.config.php';
require_once '../config.php';

if ($_POST) {

    $nombre = trim($_POST['cnombre']);
    $sexo = trim($_POST['csexo']);
    $fecha = trim($_POST['cbdate']);
    $correo = trim($_POST['cmail']);
    $empresa = trim($_POST['cempresa']);
    $puesto = trim($_POST['cpuesto']);
    $noempleado = trim($_POST['cnoempleado']);
    $pais = trim($_POST['cpais']);
    $estado = trim($_POST['cestado']);
    $municipio = trim($_POST['cmunicipio']);
    $direccion = trim($_POST['cdireccion']);
    $cp = trim($_POST['ccp']);
    $tel = trim($_POST['ctel']);
    $fb = trim($_POST['cfb']);


    $nombre = strip_tags($nombre);
    $sexo = strip_tags($sexo);
    $fecha = strip_tags($fecha);
    $correo = strip_tags($correo);
    $empresa = strip_tags($empresa);
    $puesto = strip_tags($puesto);
    $noempleado = strip_tags($noempleado);
    $pais = strip_tags($pais);
    $estado = strip_tags($estado);
    $municipio = strip_tags($municipio);
    $direccion = strip_tags($direccion);
    $cp = strip_tags($cp);
    $tel = strip_tags($tel);
    $fb = strip_tags($fb);


    require_once(C_P_CLASES.'actions/a.pacientes.php');
    $myIns = new A_PTE("");

    $res = $myIns->ins_paciente($DBcon, $nombre, $sexo, $fecha, $correo, $empresa, $puesto, $noempleado, $pais, $estado, $municipio, $direccion, $cp, $tel, $fecha, $fb);
}

//$response['status'] = 'error'; // could not register
//$response['message'] = 'PRUEBA CON mensaje ERROR';

echo json_encode($res);
?>