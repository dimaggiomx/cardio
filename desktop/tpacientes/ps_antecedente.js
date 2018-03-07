$(document).ready(function() {
    $(function() {
        $(".preloader").fadeOut();
    });


    $('#formPaciente').submit(function()
        {
            submitForm();
            return false;
        }
    );

});


function submitForm(){

    $.ajax({
        url: 'tpacientes/ps_antecedente.php',
        type: 'POST',
        encoding:"UTF-8",
        data: $('#formPaciente').serialize(),
        dataType: 'json'
    })

        .done(function(data){
            // cargar - loading
            $(".preloader").fadeIn();
            // boton - msg
            $('#btn-go').html('<img src="ajax-loader.gif" /> &nbsp; Registrando...').prop('disabled', true);

            setTimeout(function(){

                if ( data.status==='success' ) {
                    $(".preloader").fadeOut();  // desvanece preloader
                    $("#formPaciente").trigger('reset'); // resetea campos
                    // boton - texto - OK
                    $('#btn-go').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro exitoso...').prop('disabled', false);

                    // mensaje OK
                    // para el msg abajo
                    $('#r_resultOkDiv').slideDown('fast', function(){
                        $('#r_resultOkDiv').html('<i class="ti-user"></i> '+data.message+' <a href="#" class="closed">&times;</a> ');
                    }).delay(3000).slideUp('fast');
                    swal("Registro Exitoso!", "Favor de registrar la consulta", "success");
                    // redireccionar a desktop
                    setTimeout(function(){window.location.href=data.URL} , 3500);

                } else {
                    $(".preloader").fadeOut(); // desvanece preloader
                    // boton - texto - ERROR
                    $('#btn-go').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Intente nuevamente...').prop('disabled', false);
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