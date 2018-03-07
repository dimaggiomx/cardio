<?php
ob_start();
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("global.config.php");
require_once("config.php");
require_once('sescheck.php'); // para la sesion

$idPaciente = $_GET["id"];
$nombrePte = $_GET["no"];

// obtengo datos del paciente
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('includes/iheader.php'); ?>
    <title><?php echo C_P_TITLE; ?> - Antecedentes</title>
    <?php include ('includes/icss.php'); ?>
    <link rel="stylesheet" href="../plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />
    <!--alerts CSS -->
    <link href="../plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">


</head>
<body class="fix-sidebar fix-header">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Mensajes de resultado -->
    <div id="r_resultErrDiv" class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-danger myadmin-alert-bottom alertbottom"> <i class="ti-user"></i> Bienvenido <a href="#" class="closed">&times;</a> </div>
    <div id="r_resultOkDiv" class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-success myadmin-alert-bottom alertbottom"> <i class="ti-user"></i> Bienvenido <a href="#" class="closed">&times;</a> </div>
    <!--div id="r_resultDebDiv" class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-dark myadmin-alert-top alerttop"> <i class="ti-user"></i> DEB <a href="#" class="closed">&times;</a> </div-->
    <div id="alerttopright" class="myadmin-alert myadmin-alert-img alert-info myadmin-alert-top-right"> <a href="#" class="closed">&times;</a>
        <h4>You have a Message!</h4>
        <b>John Doe</b> sent you a message.</div>
    <!-- END  msg -->
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0" >
        <div class="navbar-header">
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="ti-menu"></i>
            </a>
            <?php include ('includes/inavvar.php'); ?>
            <!-- SEARCH Position -->
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
                        <i class="icon-arrow-left-circle ti-menu"></i></a></li>
                <li>
                    <form role="search" class="app-search hidden-xs">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </li>
            </ul>
            <!-- END SEARCH Position -->
            <ul class="nav navbar-top-links navbar-right pull-right">
                <?php include ('includes/imsg.php'); ?>
                <?php include ('includes/imenu.php'); ?>
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- Left navbar-header -->
    <?php include ('leftnav.php'); ?>
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"><?php echo $nombrePte; ?></h4>

                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Editar</a></li>
                        <li class="active">Resumen</li>
                        <li class="active">Ficha</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- .datos generales -->
            <form id="formPaciente" action="antecedentes.php">
            <div class="row">
                <div class="panel panel-info" id="divDatosGenerales">
                    <div class="panel-heading"> <i data-icon="/" class="fa fa-book"></i> Datos Generales</div>
                    <input type="hidden"  id="idPte" name="idPte" value="<?php echo $idPaciente; ?>" >
                    <input type="hidden"  id="nombrePte" name="nombrePte" value="<?php echo $nombrePte; ?>" >
                    <div class="col-md-5">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">ANTECEDENTES</h3>
                            <div class="row">
                                <div class="col-lg-5 col-md-2 col-md-8">
                                    <h3 class="box-title m-b-0">PERSONALES</h3>

                                    <div class="checkbox checkbox-info checkbox-circle">
                                        <input id="pdiabetes" name="pdiabetes" type="checkbox" value="SI">
                                        <label for="pdiabetes"> Diabetes </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-circle">
                                        <input id="phiper" name="phiper" type="checkbox" value="SI">
                                        <label for="phiper"> Hipertensión </label>
                                    </div>
                                    <div class="checkbox checkbox-success checkbox-circle">
                                        <input id="ptabaquismo" name="ptabaquismo" type="checkbox" value="SI">
                                        <label for="ptabaquismo"> Tabaquismo </label>
                                    </div>
                                    <div class="checkbox checkbox-warning checkbox-circle">
                                        <input id="pcolesterol" name="pcolesterol" type="checkbox" value="SI">
                                        <label for="pcolesterol"> Colesterol </label>
                                    </div>
                                    <div class="checkbox checkbox-danger checkbox-circle">
                                        <input id="ptrigli" name="ptrigli" type="checkbox" value="SI">
                                        <label for="ptrigli"> Trigliceridos </label>
                                    </div>
                                    <div class="checkbox checkbox-purple checkbox-circle">
                                        <input id="pinfartos" name="pinfartos" type="checkbox" value="SI">
                                        <label for="pinfartos"> Infartos Previos </label>
                                    </div>

                                </div>
                                <div class="col-lg-5 col-md-2 col-md-8">
                                    <h3 class="box-title m-b-0">FAMILIARES</h3>
                                    <div class="checkbox checkbox-info checkbox-circle">
                                        <input id="adiabetes" name="adiabetes" type="checkbox"  value="SI">
                                        <label for="adiabetes"> Diabetes </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-circle">
                                        <input id="ahiper" name="ahiper" type="checkbox" value="SI">
                                        <label for="ahiper"> Hipertensión </label>
                                    </div>
                                    <div class="checkbox checkbox-success checkbox-circle">
                                        <input id="atabaquismo" name="atabaquismo" type="checkbox" value="SI">
                                        <label for="atabaquismo"> Tabaquismo </label>
                                    </div>
                                    <div class="checkbox checkbox-warning checkbox-circle">
                                        <input id="acolesterol" name="acolesterol"  type="checkbox" value="SI">
                                        <label for="acolesterol"> Colesterol </label>
                                    </div>
                                    <div class="checkbox checkbox-danger checkbox-circle">
                                        <input id="atrigli" name="atrigli" type="checkbox"  value="SI">
                                        <label for="atrigli"> Trigliceridos </label>
                                    </div>
                                    <div class="checkbox checkbox-purple checkbox-circle">
                                        <input id="ainfartos" name="ainfartos" type="checkbox"  value="SI">
                                        <label for="ainfartos"> Infartos Previos </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">

                        <div class="white-box">
                            <h3 class="box-title m-b-0">OBSERVACIONES</h3>
                            <div class="row">
                                    <div class="form-group">
                                        <textarea id="antecedentes" name="antecedentes" class="textarea_editor form-control" rows="15" placeholder="Escribir antecedentes clínicos ..."></textarea>
                                    </div>
                            </div>
                        </div>

                    </div>

                </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-go">Registrar Antecedentes</button>
                    </div>

            </div>
            <!--./row-->
            </form>

            <!-- .right-sidebar -->
            <?php include ('rightnav.php'); ?>
            <!-- /.right-sidebar -->
        </div>
        <!-- /.container-fluid -->
        <?php include ('includes/ifooter.php'); ?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include ('includes/iscripts.php'); ?>
<!-- Custom procesar -->
<script src="tpacientes/ps_antecedente.js"></script>

<!-- Sweet-Alert  -->
<script src="../plugins/bower_components/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript">
    !function($) {
        "use strict";

        var SweetAlert = function() {};

        //examples
        SweetAlert.prototype.init = function() {

            //Success Message
            $('#sa-success').click(function(){
                swal("Registro Exitoso!", "Favor de registrar los antecedentes", "success")
            });
        },
            //init
            $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
    }(window.jQuery),

//initializing
        function($) {
            "use strict";
            $.SweetAlert.init()
        }(window.jQuery);
</script>

<!-- wysuhtml5 Plugin JavaScript -->
<script src="../plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="../plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
<script>
    $(document).ready(function () {

        $('.textarea_editor').wysihtml5();


    });
</script>

</body>
</html>
