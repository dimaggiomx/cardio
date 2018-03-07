<?php
ob_start();
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("global.config.php");
require_once("config.php");
require_once('sescheck.php'); // para la sesion

$idPaciente = $_GET["id"];
$nombrePte = $_GET["no"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('includes/iheader.php'); ?>
    <title><?php echo C_P_TITLE; ?> - Consulta Nueva</title>
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
                    <h4 class="page-title">Nueva Consulta</h4>
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
            <form id="formPaciente" action="nueva_consulta.php">
            <div class="row">
                <div class="panel panel-info" id="divDatosGenerales">
                <div class="panel-heading"> <i data-icon="/" class="fa fa-book"></i> Consulta : <?php echo $nombrePte; ?> </div>
                    <input type="hidden"  id="idPte" name="idPte" value="<?php echo $idPaciente; ?>" >
                    <input type="hidden"  id="nombrePte" name="nombrePte" value="<?php echo $nombrePte; ?>" >
                    <div class="col-md-5">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">RESULTADOS CLINICOS</h3>

                        <div class="row">
                            <div class="col-lg-5 col-md-2 col-md-8">
                                <h3 class="box-title m-b-0">PARTE 1</h3>

                                <div class="form-group">
                                    <label for="ctas">TAS</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="ctas" name="ctas" placeholder="TAS" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ctad">TAD</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="ctad" name="ctad" placeholder="TAD" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cpeso">PESO</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="cpeso" name="cpeso" placeholder="PESO" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ctalla">TALLA</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="ctalla" name="ctalla" placeholder="TALLA" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ccintura">CINTURA</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="ccintura" name="ccintura" placeholder="CINTURA" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ccadera">CADERA</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="ccadera" name="ccadera" placeholder="CADERA" >
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-5 col-md-2 col-md-8">
                                <h3 class="box-title m-b-0">PARTE 2</h3>
                                <div class="form-group">
                                    <label for="cglucosa">GLUCOSA</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="cglucosa" name="cglucosa" placeholder="GLUCOSA" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ccolesterol">COLESTEROL</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="ccolesterol" name="ccolesterol" placeholder="COLESTEROL" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="chdl">HDL</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="chdl" name="chdl" placeholder="HDL" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cldl">LDL</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="cldl" name="cldl" placeholder="LDL" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ctrig">TRIGLICERIDOS</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-target"></i></div>
                                        <input type="text" class="form-control" id="ctrig" name="ctrig" placeholder="TRIGLICERIDOS" >
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                    <div class="col-md-7">
                    <div class="white-box">
                        <div class="form-group">
                            <label for="doctora">Doctora</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-target"></i></div>
                                <input type="text" class="form-control" id="doctora" name="doctora" placeholder="Nombre del Doctor" value="Carmen Elena Sedano Gonzalez" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="enfermera">Enfermera</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-target"></i></div>
                                <input type="text" class="form-control" id="enfermera" name="enfermera" placeholder="Nombre de la Enfermera" value="Algun nombre" >
                            </div>
                        </div>
                        <h3 class="box-title m-b-0">RECETA</h3>

                        <div class="row">
                                <div class="form-group">
                                    <textarea id="receta" name="receta" class="textarea_editor form-control" rows="15" placeholder="Escribir receta médica ..."></textarea>
                                </div>
                        </div>

                    </div>
                    </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-go">Registrar CONSULTA</button>
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
<script src="tpacientes/ps_nuevaconsulta.js"></script>

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
                swal("Registro Exitoso!", " = ) ", "success")
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
