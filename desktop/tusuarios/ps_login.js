$(document).ready(function() {
    $(function() {
        $(".preloader").fadeOut();
    });


    $('#loginform').submit(function()
        {
            submitForm();
            return false;
        }
    );

    $('#recoverform').submit(function()
        {
            recoverMeForm();
            return false;
        }
    );

    $('#updatePassform').submit(function()
        {
            updateMeForm();
            return false;
        }
    );



});

function updateMeForm(){

    $.ajax({
        url: 'tusuarios/ps_updateMe.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#updatePassform').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn_updpass').html('<img src="ajax-loader.gif" /> &nbsp; Verificando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    $("#updatePassform").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn_updpass').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Actuailzación exitosa...').prop('disabled', false);

                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    // redireccionar a desktop
                    //setTimeout(function(){window.location.href=data.URL} , 3500);
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn_updpass').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}

function recoverMeForm(){

    $.ajax({
        url: 'tusuarios/ps_recover.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#recoverform').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn_recover').html('<img src="ajax-loader.gif" /> &nbsp; Verificando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    $("#recoverform").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn_recover').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Envio exitoso...').prop('disabled', false);

                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    // redireccionar a desktop
                    //setTimeout(function(){window.location.href=data.URL} , 3500);
                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn_recover').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}

function submitForm(){

    $.ajax({
        url: 'tusuarios/ps_login.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#loginform').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn_sign').html('<img src="ajax-loader.gif" /> &nbsp; Iniciando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    $("#loginform").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn_sign').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Inicio exitoso...').prop('disabled', false);

                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                   // $('#r_resultDebDiv').slideDown('fast', function(){
                   //     $('#r_resultDebDiv').html('<i class="ti-user"></i> '+data.debug+' <a href="#" class="closed">&times;</a> ');
                   // });
                    // redireccionar a desktop
                    setTimeout(function(){window.location.href=data.URL} , 3500);


                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn_sign').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
                    // mensaje ERROR
                    // para el msg abajo
                    $('#r_resultErrDiv').slideDown('fast', function(){
                        $('#r_resultErrDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    // para el debug
                    //$('#r_resultDebDiv').slideDown('fast', function(){
                    //    $('#r_resultDebDiv').html('<i class="ti-user"></i> '+data.debug+' <a href="#" class="closed">&times;</a> ');
                    //});
                }

            },3000);

        })
        .fail(function(){
            // $("#loginform").trigger('reset');
            alert('An unknown error occoured, Please try again Later...');
        });
}