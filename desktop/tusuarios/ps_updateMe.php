<?php
header('Content-type: application/json');
$response = array();

require_once '../global.config.php';
require_once '../config.php';


if ($_POST) {

    $user = trim($_POST['cuser']);
    $newpass = trim($_POST['cpass']);
    $confirm = trim($_POST['cconfirm']);

    $user = strip_tags($user);
    $newpass = strip_tags($newpass);
    $confirm = strip_tags($confirm);

    // verifico cambio de pass
    if($newpass == $confirm) {
        // sha256 password hashing
        $hashed_new_password = hash('sha256', $newpass);

        require_once(C_P_CLASES.'actions/a.usuarios.php');
        $myIns = new A_USR("");

        // verifico que el password actual este correcto
        //$subquery = " AND cpass = '".$hashed_old_password."'";
        $passOk = $myIns->user_exist($DBcon,$user,$subquery);

        if($passOk['status'] == 'error')  //porque es un usuario existente de acuerdo a la funcion
        {
            $passOk['status'] = 'success';
            // agrego valores
            $res = $myIns->recover_userpass($DBcon,$user, $hashed_new_password);
        }
        else{
            $passOk['status'] = 'error';
            $res = $passOk;
        }
    }
    else{
        $res['status'] = 'error'; // could not register
        $res['message'] = 'Contraseñas no coinciden!';
        $res['debug'] = '-COOL-';
    }
}

echo json_encode($res);
?>