<?php
header('Content-Type: text/html');

require_once 'global.config.php';
require_once 'config.php';

$response = array();

if ($_GET) {

    $usuario = trim($_GET['user']);
    $id = trim($_GET['id']);

    $t_usuario = strip_tags($usuario);
    $t_id = strip_tags($id);

    require_once(C_P_CLASES.'actions/a.usuarios.php');
    $myIns = new A_USR("");


    $response = $myIns->revoque_user($DBcon,$t_usuario, $t_id);
    if($response['status']=='success')
    {
        $invalid = '<div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" placeholder="New Password" id="cpass" name="cpass">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" placeholder="Confirm Password" id="cconfirm" name="cconfirm">
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" id="btn_updpass">Actualizar</button>
                    </div>
                </div>';
    }
    else{
        $invalid = 'El código de recuperación ha expirado o es inválido';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Jade Capital Flow - Confirmacion</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue.css" id="theme"  rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal form-material" id="updatePassform" action="index.html">
                <h3 class="box-title m-b-20">Jade Capital Flow</h3>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Usuario" id="cuser" name="cuser" value="<?php echo $usuario; ?>">
                    </div>
                </div>
                <?php echo $invalid; ?>

            </form>
        </div>
    </div>
</section>
<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- FVSD procesar -->
<script src="tusuarios/ps_login.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.js"></script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
