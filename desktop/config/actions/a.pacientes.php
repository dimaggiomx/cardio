<?php
header("Content-Type: text/html;charset=utf-8");

class A_PTE
{
    var $datos=array(); # contains field data
    var $campos=""; # contains field names
    var $arrDataNames = array();
    var $paginatorLinks = "";
    var $tableName = "";
    var $DBcon = "";
    var $lastId = "";
    var $tmpguid="";
    var $domain = "";
    /* Constructor: User passes in the name of the script where
        * form data is to be sent ($processor) and the value to show
        * on the submit button.
        */

    function __construct($arrData=array())
    {
        //inicializo
        $this->datos = $arrData;
        $this->domain = C_DOMAIN;
    }



    /***
     * Registro de pacientes
     */
    function ins_paciente($DBcon, $nombre, $sexo, $fecha, $correo, $empresa, $puesto, $noempleado, $pais, $estado, $municipio, $direccion, $cp, $tel, $fecha, $fb)
    {
        $now = date("Y-m-d H:i:s");

        //create guid for user confirm
        require_once(C_P_CLASES.'utils/string.functions.php');
        $STR = new STRFN();

        // genero UUID para mandarlo por el correo para poder confirmar
        //$guid = $STR->gen_uuid();
        //$this->set_tmpguid($guid);

        $query = "INSERT INTO tpacientes 
                    (cnombre,csexo,cemail, cmovil, cdireccion, cnacimiento, cfb, idpais, idestado, idmunicipio, ccp, tempresa, tpuesto, tnoempleado, cregdate) 
					VALUES
					(
					'" . $nombre ."','". $sexo . "','". $correo . "','". $tel . "','". $direccion . "',
					'" . $fecha."','". $fb . "','". $pais . "','". $estado . "','". $municipio . "',
					'" . $cp."','". $empresa . "','". $puesto . "','". $noempleado . "','". $now . "'
					)";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            // obtengo el ultimo ID
            //$this->set_lastId($DBcon->lastInsertId());
            $ultimoId = $DBcon->lastInsertId();

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['URL'] = 'antecedentes.php?id='.$ultimoId.'&no='.$nombre;

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['URL'] = 'nuevo_paciente.php';
        }

        return $response;
    }



    /***
     * Registro de antecedentes de un paciente
     */
    function ins_antecedentepaciente($DBcon, $idPte,$nombrePte, $p1, $p2, $p3, $p4, $p5, $p6, $a1, $a2, $a3, $a4, $a5, $a6, $ante)
    {
        $now = date("Y-m-d H:i:s");

        //create guid for user confirm
        require_once(C_P_CLASES.'utils/string.functions.php');
        $STR = new STRFN();

        // genero UUID para mandarlo por el correo para poder confirmar
        //$guid = $STR->gen_uuid();
        //$this->set_tmpguid($guid);

        $query = "INSERT INTO tantecedentes 
                    (idpaciente,cpdiabetes,cphiper,cptabaquismo, cpcolesterol, cptrigliceridos, cpinfartos, cfdiabetes,cfhiper,cftabaquismo, cfcolesterol, cftrigliceridos, cfinfartos,cdescripcion, cregdate) 
					VALUES
					(
					'" . $idPte ."','". $p1 . "','". $p2 . "','". $p3 . "','". $p4 . "',
					'" . $p5."','". $p6 . "','". $a1 . "','". $a2 . "','". $a3 . "',
					'" . $a4."','". $a5 . "','". $a6 . "','". $ante . "','". $now . "'
					)";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            // obtengo el ultimo ID
            //$this->set_lastId($DBcon->lastInsertId());
            $ultimoId = $idPte;

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['URL'] = 'nueva_consulta.php?id='.$ultimoId.'&no='.$nombrePte;

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['URL'] = 'antecedentes.php';
        }

        return $response;
    }



    /***
     * Registro de nueva consulta de un paciente
     */
    function ins_consultapaciente($DBcon, $idPte,$nombrePte, $p1, $p2, $p3, $p4, $p5, $p6, $a1, $a2, $a3, $a4, $a5, $receta, $doctor, $enfermera)
    {
        $now = date("Y-m-d H:i:s");

        //create guid for user confirm
        require_once(C_P_CLASES.'utils/string.functions.php');
        $STR = new STRFN();

        // genero UUID para mandarlo por el correo para poder confirmar
        //$guid = $STR->gen_uuid();
        //$this->set_tmpguid($guid);

        $query = "INSERT INTO tconsulta 
                    (idpaciente,cdoctor,cenfermera,cfecha, ctas, ctad, cpeso, ctalla,ccintura,ccadera, cglucosa, ccolesterol, chdl,cldl, ctrig, cobservaciones) 
					VALUES
					(
					'" . $idPte ."','". $doctor . "','". $enfermera . "','". $now . "','". $p1 . "','". $p2 . "','". $p3 . "','". $p4 . "',
					'" . $p5."','". $p6 . "','". $a1 . "','". $a2 . "','". $a3 . "',
					'" . $a4."','". $a5 . "','". $receta . "'
					)";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            // obtengo el ultimo ID
            //$this->set_lastId($DBcon->lastInsertId());
            $ultimoId = $idPte;

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['URL'] = 'consultas.php';

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['URL'] = 'consultas.php';
        }

        return $response;
    }


    /***
     * Busca los pacientes registrados
     */
    public function get_pacientes($DBcon,$page,$noRowsDisplay,$where)
    {
        require_once(C_P_CLASES.'utils/paginator.php');
        $now = date("Y-m-d H:i:s");

        $query = "SELECT * FROM tpacientes  ";
        $query.=$where;

        //error_log($query,0);
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $num_rows = $total;

        $a = new Paginator($page,$num_rows);


        $a->set_Limit($noRowsDisplay);
        $a->set_Links();
        $limit1 = $a->getRange1();
        $limit2 = $a->getRange2();
        $query .= " LIMIT $limit1 , $limit2 ";

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);

        //Paginador
        if($a->getTotalPages()>1)
        {
            $paginatorLinks = $a->paintLinks('paginateMe',$a->getFirst(),$a->getLast(),$a->getLinkArr(),$a->getCurrent());
            //guardo el string del paginador
            $this->set_paginatorLinks($paginatorLinks);
        }

        return $query;
    }

    /***
     * muestra los pacientes
     */
    function disp_pacientesPage()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp = '';
        $headerTable = '';  //nombres de columnas
        $footerTable = '';  // nombres de columnas
        $dataTable = '';    // info de la tabla
        $acciones = '';     // para borrar editar
        $displinks = '';    // pra mostrar las ligas de paginacion
        $cont = 0;          // contador general

        $encabezados = '<tr><th>Paciente</th><th>Sexo</th><th>Telefono</th><th>Fecha Nacimiento</th><th>C.P.</th><th>email</th><th>Accion</th></tr>';
        $headerTable .= '<thead>'.$encabezados.'</thead>';
        $footerTable .= '<tfoot>'.$encabezados.'</tfoot>';
        //$footerTable .= '<tfoot></tfoot>';


        while ($row = $stmt->fetchObject()) {

            $id = $row->id;

            $paso1 = $row->cnombre;
            $paso2 = $row->csexo;
            $paso3 = $row->cmovil;
            $paso4 = $row->cnacimiento;
            $paso5 = $row->ccp;
            $paso6 = $row->cemail;

            $editar = '<a href="editar_paciente.php?id='.$id.'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>';
            $detalle = '<a href="detalle_paciente.php?id='.$id.'" data-toggle="tooltip" data-original-title="Detalle"> <i class="fa fa-plus-square text-inverse m-r-10"></i> </a>';

            $detalle .= $editar;
            $acciones = '<td>'.$detalle.'</td>';

            $dataTable.='<tr><td>'.$paso1.'</td><td>'.$paso2.'</td><td>'.$paso3.'</td><td>'.$paso4.'</td><td>'.$paso5.'</td><td>'.$paso6.'</td>'.$acciones.'</tr>';

            $cont++;
        }

        $displinks.=$this->get_paginatorLinks();

        $disp .= '<table id="tpendingdisp" class="table display">'.$headerTable.$footerTable.'<tbody>'.$dataTable.'</tbody></table>'.$displinks;

        //error_log($disp,0);
        return $disp;

    }


    /***
     * Busca los pacientes registrados
     */
    public function get_consultas($DBcon,$page,$noRowsDisplay,$where)
    {
        require_once(C_P_CLASES.'utils/paginator.php');
        $now = date("Y-m-d H:i:s");

        $query = "SELECT  A.id, A.idpaciente, A.cdoctor, A.cfecha, B.cnombre, B.csexo, B.cnacimiento
                    FROM 
                    tconsulta AS A 
                    INNER JOIN tpacientes AS B 
                    ON A.idpaciente = B.id
                      ";
        $query.=$where;

        //error_log($query,0);
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $num_rows = $total;

        $a = new Paginator($page,$num_rows);


        $a->set_Limit($noRowsDisplay);
        $a->set_Links();
        $limit1 = $a->getRange1();
        $limit2 = $a->getRange2();
        $query .= " LIMIT $limit1 , $limit2 ";

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);

        //Paginador
        if($a->getTotalPages()>1)
        {
            $paginatorLinks = $a->paintLinks('paginateMe',$a->getFirst(),$a->getLast(),$a->getLinkArr(),$a->getCurrent());
            //guardo el string del paginador
            $this->set_paginatorLinks($paginatorLinks);
        }

        return $query;
    }

    /***
     * muestra los pacientes
     */
    function disp_consultasPage()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp = '';
        $headerTable = '';  //nombres de columnas
        $footerTable = '';  // nombres de columnas
        $dataTable = '';    // info de la tabla
        $acciones = '';     // para borrar editar
        $displinks = '';    // pra mostrar las ligas de paginacion
        $cont = 0;          // contador general

        $encabezados = '<tr><th>No. Consulta</th><th>Paciente</th><th>Sexo</th><th>Fecha</th><th>Doctor</th><th>Fecha Nacimiento</th><th>Accion</th></tr>';
        $headerTable .= '<thead>'.$encabezados.'</thead>';
        $footerTable .= '<tfoot>'.$encabezados.'</tfoot>';
        //$footerTable .= '<tfoot></tfoot>';


        while ($row = $stmt->fetchObject()) {

            $id = $row->id;
            $idpaciente = $row->idpaciente;

            //A.id, A.idpaciente, A.cdoctor, A.cfecha, B.cnombre, B.csexo, B.cnacimiento
            $paso1 = $row->cnombre;
            $paso2 = $row->csexo;
            $paso3 = $row->cdoctor;
            $paso4 = $row->cnacimiento;
            $paso5 = $row->cfecha;

            $editar = '<a href="editar_consulta.php?id='.$id.'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>';
            $detalle = '<a href="detalle_consulta.php?id='.$id.'" data-toggle="tooltip" data-original-title="Detalle"> <i class="fa fa-plus-square text-inverse m-r-10"></i> </a>';

            $detalle .= $editar;
            $acciones = '<td>'.$detalle.'</td>';

            $dataTable.='<tr><td>'.$id.'</td><td>'.$paso1.'</td><td>'.$paso2.'</td><td>'.$paso5.'</td><td>'.$paso3.'</td><td>'.$paso4.'</td>'.$acciones.'</tr>';

            $cont++;
        }

        $displinks.=$this->get_paginatorLinks();

        $disp .= '<table id="tpendingdisp" class="table display">'.$headerTable.$footerTable.'<tbody>'.$dataTable.'</tbody></table>'.$displinks;

        //error_log($disp,0);
        return $disp;

    }


    /***
     * Obtiene el reporte de la consulta (detalle de datos)
     */
    function get_reporteConsulta($DBcon, $where)
    {
        $query= "SELECT A.*, B.cnombre, B.csexo, B.cemail, B.cmovil, B.cnacimiento, B.tempresa, B.tpuesto, B.tnoempleado,
                        C.cpdiabetes, C.cphiper, C.cptabaquismo, C.cpcolesterol, C.cptrigliceridos, C.cpinfartos,
                        C.cfdiabetes, C.cfhiper, C.cftabaquismo, C.cfcolesterol, C.cftrigliceridos, C.cfinfartos, C.cdescripcion 
                 FROM 
                tconsulta AS A 
                INNER JOIN tpacientes AS B ON A.idpaciente = B.id 
                INNER JOIN tantecedentes AS C ON C.idpaciente = B.id
                 ";

        $query.=$where;
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();
        // regresa un solo registro
        return $obj;
    }


    /***
     * Obtiene el riesgo cardiovascular
     */
    function get_riesgoCardiovascular($DBcon, $sexo, $edad, $fumador, $presion, $colesterol)
    {
        $query= "SELECT * FROM
                triesgo
                WHERE sexo = '".$sexo."' AND  edad = '".$edad."' AND fumador = '".$fumador."' AND presion = '".$presion."' AND colesterol = '".$colesterol."'
                 ";


        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();
        // regresa un solo registro
        return $obj->valor;
    }

    /***
     * Establece el riesgo a 10 años
     */
    function set_riesgofinal($dato)
    {
        if($dato==0)
        {
            $valor = "< 1%";
        }

        if($dato==1)
        {
            $valor = "1%";
        }

        if($dato==2)
        {
            $valor = "2%";
        }

        if(($dato>=3)&&($dato<=4))
        {
            $valor = "3-4%";
        }

        if(($dato>=5)&&($dato<=9))
        {
            $valor = "5-9%";
        }

        if(($dato>=10)&&($dato<=14))
        {
            $valor = "10-14%";
        }

        if($dato>=15)
        {
            $valor = "> 15%";
        }

        return $valor;
    }

    /***
     * obtiene el sexo para el calculo del riesgo cardiovascular
     */
    function fix_sexo($sexo)
    {
        $sexoFix = '';
        switch ($sexo){
            case 'Hombre':
                $sexoFix = "H";
                break;
            case 'Mujer':
                $sexoFix = "M";
                break;
        }
        return $sexoFix;
    }

    /***
     * obtiene la edad para el calculo del riesgo cardiovascular
     */
    function fix_edad($edad)
    {
        $valor="";

        if(($edad>=40)&&($edad<=49))
        {
            $valor = "40";
        }

        if(($edad>=40)&&($edad<=54))
        {
            $valor = "50";
        }

        if(($edad>=55)&&($edad<=59))
        {
            $valor = "55";
        }

        if(($edad>=60)&&($edad<=64))
        {
            $valor = "60";
        }

        if($edad>=65)
        {
            $valor = "65";
        }

        return $valor;
    }


    /***
     * obtiene la presion para el calculo del riesgo cardiovascular
     */
    function fix_presion($presion)
    {
        $valor="";

        if(($presion>=100)&&($presion<=119))
        {
            $valor = "100";
        }

        if(($presion>=120)&&($presion<=139))
        {
            $valor = "120";
        }

        if(($presion>=140)&&($presion<=159))
        {
            $valor = "140";
        }

        if(($presion>=160)&&($presion<=179))
        {
            $valor = "160";
        }

        if($presion>=180)
        {
            $valor = "180";
        }

        return $valor;
    }

    /***
     * obtiene el colesterol para el calculo del riesgo cardiovascular
     */
    function fix_colesterol($col)
    {
        $valor="";

        if($col<=150)
        {
            $valor = "4";
        }

        if(($col>=151)&&($col<=199))
        {
            $valor = "5";
        }

        if(($col>=201)&&($col<=249))
        {
            $valor = "6";
        }

        if(($col>=250)&&($col<=299))
        {
            $valor = "7";
        }

        if($col>=300)
        {
            $valor = "8";
        }

        return $valor;
    }






    /***
     * Calcula años con base en fecha de nacimiento
     */
    function get_anios($fechaNacimiento)
    {
        //$cumpleanos = new DateTime("1982-06-03");
        $cumpleanos = new DateTime($fechaNacimiento);
        $hoy = new DateTime();
        $annos = $hoy->diff($cumpleanos);
        //echo $annos->y;

        return $annos->y;
    }


    /***
     * Calcula TAS
     *
     */
    function get_TAS($tas)
    {
        $valor = "";
        if(($tas>=91)&&($tas<=140))
        {
            $valor = "NORMAL";
        }

        if($tas<90)
        {
            $valor = "BAJA";
        }

        if($tas>140)
        {
            $valor = "ALTA";
        }
        return $valor;
    }


    /***
     * Calcula TAD
     *
     */
    function get_TAD($tad)
    {
        $valor = "";
        if(($tad>=61)&&($tad<=84))
        {
            $valor = "NORMAL";
        }

        if($tad<60)
        {
            $valor = "BAJA";
        }

        if($tad>85)
        {
            $valor = "ALTA";
        }
        return $valor;
    }

    /***
     * Calcula IMC Indice de masa corporal kg/m
     *
     */
    function get_IMC($peso, $estatura)
    {
        //transformo $estatura a metros
        $estatura = $estatura/100;


        $imc = $peso / ($estatura*$estatura);
        return $imc;
    }

    /***
     * Calcula SC superficie corporal kg/cm
     *
     */
    function get_SC($peso, $estatura)
    {
        $sc = sqrt(($peso * $estatura)/3600);
        return $sc;
    }

    /***
     * Calcula ICC indice cintura cadera (cm)
     *
     */
    function get_ICC($cintura, $cadera)
    {
        $icc = $cintura/$cadera;
        return $icc;
    }

    /***
     * Calcula peso ideal (m)
     *
     */
    function get_pesoideal($estatura, $sexo)
    {
        //transformo $estatura a metros
        $estatura = $estatura/100;

        $peso = 0;
        if($sexo=="Hombre")
        {
            $peso = ($estatura*$estatura)*23;
        }
        else
        {
            $peso = ($estatura*$estatura)*21;
        }
        return $peso;
    }

    /***
     * Calcula HDL
     *
     */
    function get_hdl($hdl)
    {
        $valor = "";
        if($hdl<40)
        {
            $valor = "BAJO";
        }

        if($hdl>41)
        {
            $valor = "ADECUADO";
        }
        return $valor;
    }


    /***
     * Calcula LDL
     *
     */
    function get_ldl($ldl)
    {
        $valor = "";
        if(($ldl>102)&&($ldl<120))
        {
            $valor = "ACEPTABLE";
        }

        if($ldl<100)
        {
            $valor = "ADECUADO";
        }

        if($ldl>121)
        {
            $valor = "ALTO";
        }
        return $valor;
    }

    /***
     * Calcula Colesterol Total
     *
     */
    function get_colesteroltotal($colesterol)
    {
        $valor = "";
        if(($colesterol>=102)&&($colesterol<=120))
        {
            $valor = "ACEPTABLE";
        }

        if($colesterol<100)
        {
            $valor = "ADECUADO";
        }

        if($colesterol>121)
        {
            $valor = "ALTO";
        }
        return $valor;
    }

    /***
     * Calcula Glucosa
     *
     */
    function get_glucosa($glucosa)
    {
        $valor = "";
        if(($glucosa>=100)&&($glucosa<=125))
        {
            $valor = "PREDIABETES";
        }

        if($glucosa<100)
        {
            $valor = "NORMAL";
        }

        if($glucosa>125)
        {
            $valor = "ALTO";
        }
        return $valor;
    }

    /***
     * Calcula Trigliceridos
     *
     */
    function get_trigliceridos($trig)
    {
        $valor = "";

        if($trig<=140)
        {
            $valor = "NORMAL";
        }

        if($trig>140)
        {
            $valor = "ALTO";
        }
        return $valor;
    }


///RECOMENDACIONES
    /***
     * Recomendacion Peso Ideal
     *
     */
    function get_recomendPesoActual($pesoIdeal, $pesoActual)
    {
        $valor = "";

        $valor = "Su peso ideal  se recomienda en: ".$pesoIdeal;

        if($pesoActual>$pesoIdeal)
        {
            $bajar = ($pesoActual-$pesoIdeal);
            $valor.=", sugiriendo  bajar: ".$bajar." en relación a su peso actual: ".$pesoActual;
        }
        return $valor;
    }


    /***
     * Recomendacion Masa Corporal
     *
     */
    function get_recomendMasaCorporal($mc)
    {
        $valor = "";

        if($mc < 18.5)
        {
            $valor = "Bajo peso, recomendación: orientación nutricional.";
        }

        if(($mc>=18.5)&&($mc<=24.9))
        {
            $valor = "Normal, recomendación : mantener su peso.";
        }

        if(($mc>=25)&&($mc<=29.9))
        {
            $valor = "Sobrepeso, recomedación: orientación nutricional  recomendada.";
        }

        if(($mc>=30)&&($mc<=34.9))
        {
            $valor = "Obesidad GI, recomedación: orientación nutricional  necesaria.";
        }

        if(($mc>=35)&&($mc<=39.9))
        {
            $valor = "Obesidad GII, recomedación: orientación nutricional inmediata.";
        }

        if($mc>40)
        {
            $valor = "Obesidad GIII, recomedación: orientación nutricional urgente y estricta.";
        }


        return $valor;
    }

    /***
     * Recomendacion ICC
     *
     */
    function get_recomendICC($icc, $sexo)
    {
        $valor = "";

        if($sexo == "Hombre")
        {
            if($icc < 0.95)
            {
                $valor = "Riesgo Cardiovascular: Muy bajo.";
            }

            if(($icc>=0.96)&&($icc<=0.99))
            {
                $valor = "Riesgo Cardiovascular: Bajo.";
            }

            if($icc>=1)
            {
                $valor = "Riesgo Cardiovascular: Alto.";
                $valor .= " Recomendación: VALORACION MEDICO-NUTRICIONAL.";
            }
        }
        else{
            if($icc < 0.80)
            {
                $valor = "Riesgo Cardiovascular: Muy bajo.";
            }

            if(($icc>=0.81)&&($icc<=0.84))
            {
                $valor = "Riesgo Cardiovascular: Bajo.";
            }

            if($icc>=0.85)
            {
                $valor = "Riesgo Cardiovascular: Alto.";
                $valor .= " Recomendación: VALORACION MEDICO-NUTRICIONAL.";
            }
        }

        return $valor;
    }

    /***
     * Recomendacion Glucosa
     *
     */
    function get_recomendGlucosa($gluc, $antecedente)
    {
        $valor = "";


        if(($gluc>=100)&&($gluc<=125))
        {
            $valor = "Probable resistencia a la Insulina (Prediabetes), recomendación: Valoracion médica Nutricional.";
        }

        if($gluc>=125)
        {
            if($antecedente == "NO")
            {
                $valor .= " Considerar diagnostico de diabetes. Recomendación:  Valoracion médica.";
            }
            else{
                $valor .= " Considerar descontrol de su Diabetes. Recomendación: Visita medica.";
            }

        }

        return $valor;
    }

    /***
     * Recomendacion Trigliceridos
     *
     */
    function get_recomendTrigliceridos($valor)
    {
        $valor = "";

        if($valor=="ALTO")
        {
            $valor .= "Trigliceridos: ALTO;  Recomendación: VALORACION MEDICO-NUTRICIONAL.";
        }

        return $valor;
    }


    /***
     * Recomendacion Colesterol
     *
     */
    function get_recomendColesterol($valor)
    {
        $valor = "";

        if($valor=="ALTO")
        {
            $valor .= "Colesterol: ALTO; Recomendación: VALORACION MEDICO-NUTRICIONAL.";
        }

        return $valor;
    }


    /***
     * Recomendacion HDL
     *
     */
    function get_recomendHdl($valor)
    {
        $valor = "";

        if($valor=="BAJO")
        {
            $valor .= "HDL: BAJO; Recomendación: VALORACION MEDICO-NUTRICIONAL.";
        }

        return $valor;
    }

    /***
     * Recomendacion LDL
     *
     */
    function get_recomendLdl($valor)
    {
        $valor = "";

        if($valor=="ALTO")
        {
            $valor .= "HDL: ALTO; Recomendación: VALORACION MEDICO-NUTRICIONAL.";
        }

        return $valor;
    }


    /***
     * Verifica si existe un usuario
     */
    function user_exist($DBcon, $mail, $subquery="")
    {
        $query = "SELECT ".$this->campos['d1']." FROM ".$this->tableName." 
                  WHERE ".$this->campos['d1']."= '".$mail."'";
        $query.=$subquery;

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'Usuario existente';
            $response['debug'] = '-E-'.$query;

        } else {
            $response['status'] = 'success'; // could not register
            $response['message'] = 'Usuario inexistente o ingreso equivocado';
            $response['debug'] = '-S-'.$query;
        }

        return $response;
    }


    /***
     * Envio de correo de liga de acceso al usuario recien registrado para actualizar su registro
     */
    function send_regMail($from, $to, $guid)
    {
        $subject = 'Bienvenido a CARDIO';

        $link = $this->domain.'confirm.php?';
        $link .= 'user='.$to.'&id='.$guid;


        $message = 'Por favor de click en la siguiente liga para complementar su registro: ';
        $message .= $link;


        $mail = mail($from, $subject, $message,
            "From: CARDIO-SYS <".$from.">\r\n"
            ."To: User<".$to.">\r\n"
            ."cc: Creator<dimaggiomx@gmail.com>\r\n"
            ."Reply-To: ".$from."\r\n"
            ."X-Mailer: PHP/" . phpversion());

        if($mail)
        {
            $response['status'] = 'success';
            $response['message'] = 'Mail de confirmacion enviado';
            $response['debug'] = '-S-'.$link;
        }
        else
        {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo enviar mail de confirmacion';
            $response['debug'] = '-E-'.$link;
        }

        return $response;
    }



    /***
     * Establece datos para recuperacion de contrasena
     */
    function set_recover($DBcon, $id)
    {
        $now = date("Y-m-d H:i:s");

        //create guid for user confirm
        require_once(C_P_CLASES.'utils/string.functions.php');
        $STR = new STRFN();

        // genero UUID para mandarlo por el correo para poder confirmar
        $guid = $STR->gen_uuid();
        $this->set_tmpguid($guid);

        $query = "UPDATE ".$this->tableName." 
                    SET ".$this->campos['d16']." = '".$guid."' WHERE cuser = '".$id."'";

        $stmt = $DBcon->prepare($query);

//        error_log($query." - ".$guid, 0);

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Guid Generado Exitosamente';

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
        }

        return $response;
    }


    /***
     * Envio de correo de liga de acceso al usuario recien registrado para actualizar su registro
     */
    function send_recoverMail($from, $to, $guid)
    {
        $subject = 'CARDIO - Recuperación de Contraseña';

        $link = $this->domain.'recover.php?';
        $link .= 'user='.$to.'&id='.$guid;


        $message = 'Por favor de click en la siguiente liga para actualizar su contraseña: ';
        $message .= $link;

        error_log($message, 0);

        $mail = mail($from, $subject, $message,
            "From: CARDIO-SYS <".$from.">\r\n"
            ."To: User<".$to.">\r\n"
            ."cc: Creator<dimaggiomx@gmail.com>\r\n"
            ."Reply-To: ".$from."\r\n"
            ."X-Mailer: PHP/" . phpversion());

        if($mail)
        {
            $response['status'] = 'success';
            $response['message'] = 'Mail de confirmacion enviado';
            $response['debug'] = '-S-'.$link;
        }
        else
        {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo enviar mail de confirmacion';
            $response['debug'] = '-E-'.$link;
        }

        return $response;
    }


    // inserta los permisos por perfil
    function ins_permisos($DBcon, $idusuario, $tipousuario)
    {

        $query = $this->set_profile($tipousuario,$idusuario);

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Perfil Aplicado';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo aplicar el perfil';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    // establece el perfil
    function set_profile($tipo, $idusuario)
    {
        //tipo: I=inversionista ,E=empresa
        $query = '';
        if($tipo == 'I')
        {
            $query = 'INSERT INTO tpermisos_usr (idpermiso, idusuario, cpermiso) VALUES
            (1, '.$idusuario.', 1),
            (2, '.$idusuario.', 1),
            (3, '.$idusuario.', 1),
            (4, '.$idusuario.', 1),
            (5, '.$idusuario.', 1),
            (6, '.$idusuario.', 1),
            (7, '.$idusuario.', 0),
            (8, '.$idusuario.', 0),
            (9, '.$idusuario.', 0),
            (10, '.$idusuario.', 0),
            (11, '.$idusuario.', 0),
            (12, '.$idusuario.', 0),
            (13, '.$idusuario.', 1),
            (14, '.$idusuario.', 1),
            (25, '.$idusuario.', 0),
            (26, '.$idusuario.', 0);';
        }

        if($tipo == 'E')
        {
            $query = 'INSERT INTO tpermisos_usr (idpermiso, idusuario, cpermiso) VALUES
            (1, '.$idusuario.', 1),
            (2, '.$idusuario.', 1),
            (3, '.$idusuario.', 1),
            (4, '.$idusuario.', 1),
            (5, '.$idusuario.', 1),
            (6, '.$idusuario.', 0),
            (7, '.$idusuario.', 1),
            (8, '.$idusuario.', 1),
            (9, '.$idusuario.', 1),
            (10, '.$idusuario.', 0),
            (11, '.$idusuario.', 0),
            (12, '.$idusuario.', 0),
            (13, '.$idusuario.', 0),
            (14, '.$idusuario.', 0),
            (25, '.$idusuario.', 1),
            (26, '.$idusuario.', 0);';
        }

        return $query;
    }

    /***
     * Obtains a user general data
     */
    function get_userdata($DBcon, $mail, $subquery="")
    {
        $query= "SELECT * FROM ".$this->tableName." WHERE ".$this->campos['d1']." = '".$mail."'";
        $query.=$subquery;
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();
        // regresa un solo registro
        return $obj;
    }

    /***
     * Obtains a user permisos
     */
    function get_userpermisos($DBcon, $idUsuario)
    {
        $query= "SELECT * FROM tpermisos_usr WHERE idusuario = '".$idUsuario."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        // regresa de 1 a n registros
        return $stmt;
    }

    /***
     * para confirmar usuario
     */
    function confirm_user($DBcon, $mail, $guid)
    {

        $query = "SELECT ".$this->campos['d1']." FROM ".$this->tableName." 
        WHERE ".$this->campos['d1']."= '".$mail."' 
        and ".$this->campos['d17']."='1' and ".$this->campos['d16']."='".$guid."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // actualizar estatus de usuario a confirmado (estatus = 1)
            $response = $this->upd_userconfirm($DBcon,$mail,$guid);

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo confirmar, Usuario no existe, favor de registrarse';
            $response['debug'] = '-E-'.$query;
        }

        return $response;

    }


    /***
     * para verificar y reocar contraseña del usuario
     */
    function revoque_user($DBcon, $mail, $guid)
    {

        $query = "SELECT ".$this->campos['d1']." FROM ".$this->tableName." 
        WHERE ".$this->campos['d1']."= '".$mail."' 
        and ".$this->campos['d16']."='".$guid."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $response['status'] = 'success'; // could not register
            $response['message'] = 'Usuario existente';
            $response['debug'] = '-E-'.$query;

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar, Usuario no existe, favor de registrarse';
            $response['debug'] = '-E-'.$query;
        }

        return $response;

    }


    /***
     * Actualiza el estatus de usuario a confirmado
     */
    private function upd_userconfirm($DBcon, $mail, $guid)
    {
        $query = "UPDATE ".$this->tableName." SET ".$this->campos['d17']." = '2' 
                    WHERE ".$this->campos['d1']."  = '".$mail."' 
                    AND ".$this->campos['d16']." = '".$guid."'
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias! favor de iniciar sesion:';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, favor de registrarse: <br/>http://www.jadecapitalflow.com/';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /***
     * Actualiza datos de usuario (perfil)
     * cumple,curp,pasaporte,www,fb,tw,ins,about,pais
     */
    function upd_userperfil($DBcon, $id)
    {
        $query = "UPDATE ".$this->tableName." SET 
                    ".$this->campos['d4']." = '".$this->datos['d4'] ."',
                    ".$this->campos['d5']." = '".$this->datos['d5'] ."',
                    ".$this->campos['d6']." = '".$this->datos['d6'] ."',
                    ".$this->campos['d7']." = '".$this->datos['d7'] ."',
                    ".$this->campos['d8']." = '".$this->datos['d8'] ."',
                    ".$this->campos['d9']." = '".$this->datos['d9'] ."',
                    ".$this->campos['d10']." = '".$this->datos['d10'] ."',
                    ".$this->campos['d11']." = '".$this->datos['d11'] ."',
                    ".$this->campos['d21']." = '".$this->datos['d21'] ."'                      
                    WHERE ".$this->campos['d0']."  = '".$id."' 
                   ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Perfil Actualizado exitosamente';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar el perfil';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza datos de cuenta (perfil)
     * nombre, correo alternativo, tel
     */
    function upd_usercuenta($DBcon, $id)
    {
        $query = "UPDATE ".$this->tableName." SET 
                    ".$this->campos['d2']." = '".$this->datos['d2'] ."',
                    ".$this->campos['d3']." = '".$this->datos['d3'] ."',
                    ".$this->campos['d20']." = '".$this->datos['d20'] ."'                   
                    WHERE ".$this->campos['d0']."  = '".$id."' 
                   ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Cuenta Actualizada exitosamente';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar la cuenta';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza datos de password (perfil)
     * password
     */
    function upd_userpass($DBcon, $id)
    {
        $query = "UPDATE ".$this->tableName." SET 
                    ".$this->campos['d15']." = '".$this->datos['d15'] ."'                 
                    WHERE ".$this->campos['d0']."  = '".$id."' 
                   ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Pasword Actualizado exitosamente';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar el password';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /***
     * Actualiza datos de password (perfil)
     * password
     */
    function recover_userpass($DBcon, $id, $newPass)
    {
        $query = "UPDATE ".$this->tableName." SET 
                    ".$this->campos['d15']." = '".$newPass ."', cuuid = ''                
                    WHERE ".$this->campos['d1']."  = '".$id."' 
                   ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Pasword Actualizado exitosamente';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar el password';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /***
     * Actualiza la foto 1 del usuario
     */
    function upd_userphoto1($DBcon, $id, $photoPath)
    {
        $query = "UPDATE ".$this->tableName." SET ".$this->campos['d13']." = '".$photoPath."' 
                    WHERE ".$this->campos['d0']."  = '".$id."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Foto Actualizada =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar la foto';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza la foto 2 del usuario
     */
    function upd_userphoto2($DBcon, $id, $photoPath)
    {
        $query = "UPDATE ".$this->tableName." SET ".$this->campos['d14']." = '".$photoPath."' 
                    WHERE ".$this->campos['d0']."  = '".$id."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Foto Actualizada =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar la foto';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /***
     * @param $DBcon
     * @param $id
     * @return mixed
     * 2018/01/27
     * FVSD
     * Obtiene el dato de imagen de perfil
     */
    function get_datosProfilePic($DBcon, $id)
    {
        $query= "SELECT cphoto1 FROM tusuarios WHERE cuser = '".$id."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();

        // regresa un solo registro
        return $obj->cphoto1;
    }

    private function set_lastId($lastId)
    {
        $this->lastId = $lastId;
    }

    function get_lastId()
    {
        return $this->lastId;
    }


    private function set_tmpguid($guid)
    {
        $this->tmpguid = $guid;
    }

    function get_tmpguid()
    {
        return $this->tmpguid;
    }

    private function set_stmt($recordset)
    {
        $this->stmt = $recordset;
    }

    public function get_stmt()
    {
        return $this->stmt;
    }

    function set_paginatorLinks($string)
    {
        $this->paginatorLinks = $string;
    }

    function get_paginatorLinks()
    {
        return $this->paginatorLinks;
    }

    function set_queryResult($query)
    {
        $this->queryResult = $query;
    }

    function get_queryResult()
    {
        return $this->queryResult;
    }


}