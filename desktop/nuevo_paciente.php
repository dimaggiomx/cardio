<?php
ob_start();
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("global.config.php");
require_once("config.php");
require_once('sescheck.php'); // para la sesion

$idProyecto = $_GET["id"];

// obtengo catalogos
// pinto los paises
require_once(C_P_CLASES."utils/html.functions.php"); // HTML functions
$myHTML = new HTML("",$DBcon);
// Paises
$myHTML->set_newInputName('cpais');
$myHTML->fill_query('tpaises','','','nombre','id');
$selectPaises = $myHTML->set_selectBox('146',0,'form-control form-control-line'); // 146 = Mexico

// estado
$myHTML->set_newInputName('cestado');
$myHTML->fill_query('estados','','','nombre','id');
$selectEstados = $myHTML->set_selectBox('17',0,'form-control form-control-line'); //17 = Morelos

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('includes/iheader.php'); ?>
    <title><?php echo C_P_TITLE; ?> - Mi Perfil</title>
    <?php include ('includes/icss.php'); ?>

    <!-- Date picker plugins css -->
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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

            <!-- .datos generales -->
            <form id="formPaciente" action="nuevo_paciente.php">
            <div class="row">
                <div class="panel panel-info" id="divDatosGenerales">
                <div class="panel-heading"> <i data-icon="/" class="fa fa-book"></i> Datos Generales</div>

                    <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Datos Generales</h3>
                        <div id="graf-generales">

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <label for="exampleInputuname">Nombre</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-user"></i></div>
                                            <input type="text" class="form-control" id="cnombre" name="cnombre" placeholder="Nombre Completo" value="<?php echo $datosProy->cname; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputpwd1">Sexo</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-control-play"></i></div>
                                            <select name="csexo" id="csexo" class="form-control form-control-line">
                                                <option selected="selected" value="Hombre">Masculino</option>
                                                <option value="Mujer">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">Fecha Nacimiento</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            <input type="text" class="form-control mydatepicker"  data-date-format='yyyy-mm-dd' placeholder="yyyy/mm/dd" value="1990-01-01" name="cbdate" id="cbdate">



                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">E-mail</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-email"></i></div>
                                            <input type="text" class="form-control" id="cmail" name="cmail" placeholder="Correo Electronico" value="<?php echo $datosProy->cemail; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">Empresa</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-shield"></i></div>
                                            <input type="text" class="form-control" id="cempresa" name="cempresa" placeholder="Nombre de la empresa" value="<?php echo $datosProy->ccompany; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">Puesto</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-id-badge"></i></div>
                                            <input type="text" class="form-control" id="cpuesto" name="cpuesto" placeholder="Puesto" value="<?php echo $datosProy->cposition; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpwd2">No. Empleado</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-user"></i></div>
                                            <input type="text" class="form-control" id="cnoempleado" name="cnoempleado" placeholder="Numero de empleado" value="<?php echo $datosProy->cnumber; ?>">
                                        </div>
                                    </div>



                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Otros Datos</h3>
                        <div id="graf-fiscales">

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>País</label>
                                            <?php echo $selectPaises; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>Estado</label>
                                            <?php echo $selectEstados; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Municipio</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cmunicipio" name="cmunicipio" placeholder="Municipio" value="<?php echo $datosProy->clocal; ?>">
                                            <div class="input-group-addon"><i class="ti-map-alt"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Direccion</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cdireccion" name="cdireccion" placeholder="Direccion completa" value="<?php echo $datosProy->caddress; ?>">
                                            <div class="input-group-addon"><i class="ti-home"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">C.P.</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="ccp" name="ccp" placeholder="Codigo Postal" value="<?php echo $datosProy->cpobox; ?>">
                                            <div class="input-group-addon"><i class="ti-home"></i></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname">Telefono</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="ctel" name="ctel" placeholder="Movil / Casa" value="<?php echo $datosProy->ctel; ?>">
                                            <div class="input-group-addon"><i class="ti-mobile"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Facebook</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cfb" name="cfb" placeholder="Facebook" value="<?php echo $datosProy->cfb; ?>">
                                            <div class="input-group-addon"><i class="ti-facebook"></i></div>
                                        </div>
                                    </div>



                            </div>
                        </div>
                    </div>
                    </div>

            </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-go">Registrar Paciente</button>
                </div>

                </form>
            <!--./row-->

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
<script src="tpacientes/ps_nuevo.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Sweet-Alert  -->
<script src="../plugins/bower_components/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript">

    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
    });

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
</body>
</html>
