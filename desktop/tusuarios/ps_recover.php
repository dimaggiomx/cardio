<?php
header('Content-type: application/json');
$response = array();

require_once '../global.config.php';
require_once '../config.php';


if ($_POST) {

    $usuario = trim($_POST['cemailrec']);

    $usuario = strip_tags($usuario);

        require_once(C_P_CLASES.'actions/a.usuarios.php');
        $myIns = new A_USR("");

        // verifico si existe usuario y esta activo
        $subquery = " AND cstatus = 2 ";
        $res = $myIns->user_exist($DBcon,$usuario,$subquery);

        if($res['status'] == 'error'){
            // lo pongo como correcto (es correcto que si exista el usuario
            $res['status'] = 'success';

            $res2 = $myIns->set_recover($DBcon,$usuario);
            $guid = $myIns->get_tmpguid();
            $res = $myIns->send_recoverMail('info@jadecapitalflow.com',$usuario,$guid);

            // establezco liga de acceso
            $res['URL'] = 'desktop.php';

        }else{
            // lo pongo como Incorrecto (usuario o pass erroneo)
            $res['status'] = 'error';
        }
}

echo json_encode($res);
?>