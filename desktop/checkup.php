<?php
ob_start();
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("global.config.php");
require_once("config.php");
require_once('sescheck.php'); // para la sesion

require_once(C_P_CLASES.'actions/a.pacientes.php');
$myReg = new A_PTE("");


$where .= " WHERE A.id = 2";
$obj = $myReg->get_reporteConsulta($DBcon,$where);

$anios = $myReg->get_anios($obj->cnacimiento);

$r_tas = $myReg->get_TAS($obj->ctas);
$r_tad = $myReg->get_TAD($obj->ctad);
$r_imc = $myReg->get_IMC($obj->cpeso, $obj->ctalla);
$r_sc = $myReg->get_SC($obj->cpeso, $obj->ctalla);
$r_icc = $myReg->get_ICC($obj->ccintura, $obj->ccadera);
$r_pesoideal = $myReg->get_pesoideal($obj->ctalla,$obj->csexo);
$r_hdl = $myReg->get_hdl($obj->chdl);
$r_ldl = $myReg->get_ldl($obj->cldl);
$r_colesteroltotal = $myReg->get_colesteroltotal($obj->ccolesterol);
$r_glucosa = $myReg->get_glucosa($obj->cglucosa);
$r_trig = $myReg->get_trigliceridos($obj->ctrig);


// Obtengo recomendaciones:
$recomendacionPesoIdeal = $myReg->get_recomendPesoActual($r_pesoideal, $obj->cpeso);
$recomendacionMasaCorporal = $myReg->get_recomendMasaCorporal($r_imc);
$recomendacionICC = $myReg->get_recomendICC($r_icc, $obj->csexo);
$recomendacionGlucosa = $myReg->get_recomendGlucosa($obj->cglucosa, $obj->cfdiabetes);
$recomendacionTrig = $myReg->get_recomendTrigliceridos($r_trig);
$recomendacionColesterol = $myReg->get_recomendColesterol($r_colesteroltotal);
$recomendacionHdl = $myReg->get_recomendHdl($r_hdl);
$recomendacionLdl = $myReg->get_recomendLdl($r_ldl);



// antecedentes
// personales
$p1 = $obj->cpdiabetes;
$p2 = $obj->cphiper;
$p3 = $obj->cptabaquismo;
$p4 = $obj->cpcolesterol;
$p5 = $obj->cptrigliceridos;
$p6 = $obj->cpinfartos;

if($p1 == "SI"){ $p1 = 'checked'; }
if($p2 == "SI"){ $p2 = 'checked'; }
if($p3 == "SI"){ $p3 = 'checked'; }
if($p4 == "SI"){ $p4 = 'checked'; }
if($p5 == "SI"){ $p5 = 'checked'; }
if($p6 == "SI"){ $p6 = 'checked'; }

// familiares
$a1 = $obj->cfdiabetes;
$a2 = $obj->cfhiper;
$a3 = $obj->cftabaquismo;
$a4 = $obj->cfcolesterol;
$a5 = $obj->cftrigliceridos;
$a6 = $obj->cfinfartos;

if($a1 == "SI"){ $a1 = 'checked'; }
if($a2 == "SI"){ $a2 = 'checked'; }
if($a3 == "SI"){ $a3 = 'checked'; }
if($a4 == "SI"){ $a4 = 'checked'; }
if($a5 == "SI"){ $a5 = 'checked'; }
if($a6 == "SI"){ $a6 = 'checked'; }


// obtengo el riesgo cardiovascular
// $sexo, $edad, $fumador, $presion, $colesterol
$riesgoTmp = $myReg->get_riesgoCardiovascular($DBcon, $myReg->fix_sexo($obj->csexo), $myReg->fix_edad($anios), $obj->cptabaquismo, $myReg->fix_presion($obj->ctas), $myReg->fix_colesterol($obj->ccolesterol) );
$riesgoFinal = $myReg->set_riesgofinal($riesgoTmp);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('includes/iheader.php'); ?>
    <title><?php echo C_P_TITLE; ?> - Desktop</title>
    <?php include ('includes/icss.php'); ?>
</head>
<body class="fix-sidebar fix-header">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper" style="background-color: #FFF;">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <img src="../plugins/images/logoCardio3.png">
                <!--h4 class="page-title">CARDIO - SYS</h4-->
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <h2>REPORTE PERSONAL CHECK UP BASICO</h2>
                <H3><?php echo $obj->tempresa; ?></H3>

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="panel panel-info" id="divDatosGenerales">
            <div class="panel-heading"> <i data-icon="/" class="fa fa-book"></i> RESULTADOS </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-7 col-lg-9 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">DATOS</h3>
                        <ul class="list-inline text-right">
                            <li>
                                <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>Glucosa</h5>
                            </li>
                            <li>
                                <h5><i class="fa fa-circle m-r-5" style="color: #fb9678;"></i>Colesterol</h5>
                            </li>
                            <li>
                                <h5><i class="fa fa-circle m-r-5" style="color: #9675ce;"></i>HDL</h5>
                            </li>
                            <li>
                                <h5><i class="fa fa-circle m-r-5" style="color: #00aff0;"></i>LDL</h5>
                            </li>
                            <li>
                                <h5><i class="fa fa-circle m-r-5" style="color: #e67e22;"></i>TRIGLICERIDOS</h5>
                            </li>
                        </ul>
                        <div id="morris-area-chart" style="height: 400px;"></div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
                    <div class="bg-theme-dark m-b-15">
                        <div class="row weather p-20">
                            <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
                                <h3><?php echo $obj->cnombre; ?></h3>
                                <p class="text-white"><?php echo $obj->cemail; ?></p>
                            </div>
                            <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right">

                                <b class="text-white"><?php echo $anios; ?>  años</b>
                                <p class="w-title-sub"><?php echo $obj->tpuesto; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
                    <div class="bg-theme m-b-15">
                        <div id="myCarouse2" class="carousel vcarousel slide p-20">
                            <!-- Carousel items -->
                            <div class="carousel-inner ">
                                <div class="active item">
                                    <h3 class="text-white">RIESGO <span class="font-bold">CARDIOVASCULAR</span> A 10 AÑOS:</h3>
                                        <h1 class="text-white m-b-0"><?php echo $riesgoFinal;  ?></h1>
                                        <p class="text-white">- kardio systems -</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--row -->
        <br><br><br><br>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">CONCLUSIONES Y RECOMENDACIONES</h3>
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>Peso Ideal</h5>
                                <span class="mail-desc"><?php echo $recomendacionPesoIdeal; ?></span> </div>
                        </div>
                    </div>
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>Masa Corporal</h5>
                                <span class="mail-desc"><?php echo $recomendacionMasaCorporal; ?></span> </div>
                        </div>
                    </div>
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>ICC</h5>
                                <span class="mail-desc"><?php echo $recomendacionICC; ?></span> </div>
                        </div>
                    </div>
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>Glucosa</h5>
                                <span class="mail-desc"><?php echo $recomendacionGlucosa; ?></span> </div>
                        </div>
                    </div>
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>Trigliceridos</h5>
                                <span class="mail-desc"><?php echo $recomendacionTrig; ?></span> </div>
                        </div>
                    </div>
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>Colesterol</h5>
                                <span class="mail-desc"><?php echo $recomendacionColesterol; ?></span> </div>
                        </div>
                    </div>
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>HDL</h5>
                                <span class="mail-desc"><?php echo $recomendacionHdl; ?></span> </div>
                        </div>
                    </div>
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>LDL</h5>
                                <span class="mail-desc"><?php echo $recomendacionLdl; ?></span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">RESULTADOS</h3>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th>PARAMETRO</th>
                                <th>RESULTADOS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="txt-oflo">T/A</td>
                                <td><span class="label label-megna label-rounded"><?php echo $r_tas; ?>/<?php echo $r_tad; ?></span> </td>
                            </tr>
                            <tr>
                                <td class="txt-oflo">INDICE DE MASA CORPORAL</td>
                                <td><span class="label label-info label-rounded"><?php echo $r_imc; ?></span></td>
                            </tr>
                            <tr>
                                <td class="txt-oflo">AREA DE SUPERFICIE CORPORAL</td>
                                <td><span class="label label-danger label-rounded"><?php echo $r_sc; ?></span></td>
                            </tr>
                            <tr>
                                <td class="txt-oflo">INDICE CINTURA/CADERA</td>
                                <td><span class="label label-megna label-rounded"><?php echo $r_icc; ?></span></td>
                            </tr>
                            <tr>
                                <td class="txt-oflo">PESO IDEAL</td>
                                <td><span class="label label-success label-rounded"><?php echo $r_pesoideal; ?></span></td>
                            </tr>
                            <tr>
                                <td class="txt-oflo">HDL</td>
                                <td><span class="label label-megna label-rounded"><?php echo $r_hdl; ?></span> </td>
                            </tr>
                            <tr>
                                <td class="txt-oflo">LDL</td>
                                <td><span class="label label-success label-rounded"><?php echo $r_ldl; ?></span></td>
                            </tr>
                            <tr>
                                <td class="txt-oflo">COLESTEROL TOTAL</td>
                                <td><span class="label label-success label-rounded"><?php echo $r_colesteroltotal; ?></span></td>
                            </tr>
                            <tr>
                                <td class="txt-oflo">GLUCOSA</td>
                                <td><span class="label label-success label-rounded"><?php echo $r_glucosa; ?></span></td>
                            </tr>
                            <tr>
                                <td class="txt-oflo">TRIGLICERIDOS</td>
                                <td><span class="label label-success label-rounded"><?php echo $r_trig; ?></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="panel panel-info" id="divDatosGenerales">
                <div class="panel-heading"> <i data-icon="/" class="fa fa-book"></i> ANTECEDENTES</div>
                <div class="col-lg-12" >
                    <div class="white-box">

                        <div class="row">
                            <div class="col-md-4 col-md-2 col-md-4" >
                                <h3 class="box-title m-b-0">PERSONALES</h3>

                                <div class="checkbox checkbox-info checkbox-circle">
                                    <input id="pdiabetes" name="pdiabetes" type="checkbox" value="SI" <?php echo $p1; ?> >
                                    <label for="pdiabetes"> Diabetes </label>
                                </div>
                                <div class="checkbox checkbox-primary checkbox-circle">
                                    <input id="phiper" name="phiper" type="checkbox" value="SI" <?php echo $p2; ?>>
                                    <label for="phiper"> Hipertensión </label>
                                </div>
                                <div class="checkbox checkbox-success checkbox-circle">
                                    <input id="ptabaquismo" name="ptabaquismo" type="checkbox" value="SI" <?php echo $p3; ?>>
                                    <label for="ptabaquismo"> Tabaquismo </label>
                                </div>
                                <div class="checkbox checkbox-warning checkbox-circle">
                                    <input id="pcolesterol" name="pcolesterol" type="checkbox" value="SI" <?php echo $p4; ?>>
                                    <label for="pcolesterol"> Colesterol </label>
                                </div>
                                <div class="checkbox checkbox-danger checkbox-circle">
                                    <input id="ptrigli" name="ptrigli" type="checkbox" value="SI" <?php echo $p5; ?>>
                                    <label for="ptrigli"> Trigliceridos </label>
                                </div>
                                <div class="checkbox checkbox-purple checkbox-circle">
                                    <input id="pinfartos" name="pinfartos" type="checkbox" value="SI" <?php echo $p6; ?>>
                                    <label for="pinfartos"> Infartos Previos </label>
                                </div>

                            </div>
                            <div class="col-md-4 col-md-2 col-md-4" >
                                <h3 class="box-title m-b-0">FAMILIARES</h3>
                                <div class="checkbox checkbox-info checkbox-circle">
                                    <input id="adiabetes" name="adiabetes" type="checkbox"  value="SI" <?php echo $a1; ?>>
                                    <label for="adiabetes"> Diabetes </label>
                                </div>
                                <div class="checkbox checkbox-primary checkbox-circle">
                                    <input id="ahiper" name="ahiper" type="checkbox" value="SI" <?php echo $a2; ?>>
                                    <label for="ahiper"> Hipertensión </label>
                                </div>
                                <div class="checkbox checkbox-success checkbox-circle">
                                    <input id="atabaquismo" name="atabaquismo" type="checkbox" value="SI" <?php echo $a3; ?>>
                                    <label for="atabaquismo"> Tabaquismo </label>
                                </div>
                                <div class="checkbox checkbox-warning checkbox-circle">
                                    <input id="acolesterol" name="acolesterol"  type="checkbox" value="SI" <?php echo $a4; ?>>
                                    <label for="acolesterol"> Colesterol </label>
                                </div>
                                <div class="checkbox checkbox-danger checkbox-circle">
                                    <input id="atrigli" name="atrigli" type="checkbox"  value="SI" <?php echo $a5; ?>>
                                    <label for="atrigli"> Trigliceridos </label>
                                </div>
                                <div class="checkbox checkbox-purple checkbox-circle">
                                    <input id="ainfartos" name="ainfartos" type="checkbox"  value="SI" <?php echo $a6; ?>>
                                    <label for="ainfartos"> Infartos Previos </label>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-md-10" >
                                <h3 class="box-title m-b-0">OBSERVACIONES</h3>
                                <div class="form-group">
                                    <p><?php echo $obj->cdescripcion; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!--./row-->
        <div class="panel panel-info" id="divDatosGenerales">
            <div class="panel-heading"> <i data-icon="/" class="fa fa-book"></i> SOMATOMETRIA Y DETERMINACIONES</div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
                        <div class="row row-in">
                            <div class="col-lg-2 col-sm-4 row-in-br">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E" class="linea-icon linea-basic" ></i>
                                        <h5 class="text-muted vb">TAS</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-danger"><?php echo $obj->ctas; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="300" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 row-in-br  b-r-none">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                                        <h5 class="text-muted vb">TAD</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-megna"><?php echo $obj->ctad; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="300" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 row-in-br">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                        <h5 class="text-muted vb">PESO</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-primary"><?php echo $obj->cpeso; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="500" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 row-in-br">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                        <h5 class="text-muted vb">TALLA</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-primary"><?php echo $obj->ctalla; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="300" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 row-in-br">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                        <h5 class="text-muted vb">CINTURA</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-primary"><?php echo $obj->ccintura; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="300" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4  b-0">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe016;"></i>
                                        <h5 class="text-muted vb">CADERA</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-success"><?php echo $obj->ccadera; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="300" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--row -->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
                        <div class="row row-in">
                            <div class="col-lg-2 col-sm-4 row-in-br">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E" class="linea-icon linea-basic" ></i>
                                        <h5 class="text-muted vb">GLUCOSA</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-danger"><?php echo $obj->cglucosa; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 row-in-br  b-r-none">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                                        <h5 class="text-muted vb">COLESTEROL</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-megna"><?php echo $obj->ccolesterol; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 row-in-br">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                        <h5 class="text-muted vb">HDL</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-primary"><?php echo $obj->chdl; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 row-in-br">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                        <h5 class="text-muted vb">LDL</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-primary"><?php echo $obj->cldl; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 row-in-br">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                        <h5 class="text-muted vb">TRIGLICERIDOS</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-primary"><?php echo $obj->ctrig; ?></h3>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?php echo $obj->ctrig; ?>" aria-valuemin="0" aria-valuemax="450" style="width: <?php echo $obj->ctrig; ?>%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--row -->
        </div>


        <div class="panel panel-info" id="divDatosGenerales">
            <div class="panel-heading"> <i data-icon="/" class="fa fa-book"></i> RECETA </div>
            <!-- /.row -->
            <div class="row">
                <div class="white-box">
                <p><?php echo $obj->cobservaciones; ?></p>

                </div>
            </div>
        </div>
        <!--row -->


    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#wrapper -->
<?php include ('includes/iscripts.php'); ?>
<!--Counter js -->
<script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!--Morris JavaScript -->
<script src="../plugins/bower_components/raphael/raphael-min.js"></script>
<script src="../plugins/bower_components/morrisjs/morris.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.js"></script>
<!--script src="js/dashboard1.js"></script-->
<!-- Sparkline chart JavaScript -->
<script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<script src="../plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $.toast({
            heading: 'Reporte Cardiovascular',
            text: 'Datos con base en las mediciones y analisis establecidos',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3500,

            stack: 6
        })
    });


    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '10',
            G: <?php echo $obj->cglucosa; ?>,
            C: 1,
            H: 1,
            L:1,
            T:1
        }, {
            period: '20',
            G: 1,
            C: <?php echo $obj->ccolesterol; ?>,
            H: 1,
            L:1,
            T:1
        }, {
            period: '30',
            G: 1,
            C: 1,
            H: <?php echo $obj->chdl; ?>,
            L:1,
            T:1
        }, {
            period: '40',
            G: 1,
            C: 1,
            H: 1,
            L:<?php echo $obj->cldl; ?>,
            T:1
        }, {
            period: '50',
            G: 1,
            C: 1,
            H: 1,
            L:1,
            T: <?php echo $obj->ctrig; ?>
        }],
        xkey: 'period',
        ykeys: ['G', 'C', 'H','L','T'],
        labels: ['GLUCOSA', 'COLESTEROL', 'HDL','LDL','TRIG'],
        pointSize: 8,
        fillOpacity: 0,
        pointStrokeColors:['#00bfc7', '#fb9678', '#9675ce','#00aff0','#e67e22'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 4,
        hideHover: 'auto',
        lineColors: ['#00bfc7', '#fb9678', '#9675ce','#00aff0','#e67e22'],
        resize: true

    });
</script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
