/*  

$(document).ready(function(){
    $('#personal').load('php/model.php');

});*/


$(document).ready(function()
{
    $('#guardarnuevo').click(function()
    {
        $.ajax(
            {
                type: "POST",
                url:"php/realizarConsulta.php",
                data:
                {
                    NomAlmacen:$('#NomAlmacen').val(),
                    fechaIConsulta:$("#fechaIConsulta").val().split("/").reverse().join("-"),
                    fechaFConsulta:$('#fechaFConsulta').val().split("/").reverse().join("-")
                }
            }
            ).success(function(data)
            {
                $('#tabla_buscar').html(data);
                alertify.success("¡¡Consulta exitosa!!");

            }
            ).fail(function()
            {
                alertify.error("¡¡Fallo en el servidor!!");
            }
            );
    }
    );

});

   var datepicker, config;
    config = {
        locale: 'es-es',
        uiLibrary: 'bootstrap4'
    };

    $(document).ready(function () {
        $("#fechaIConsulta").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechaIConsulta').datepicker(config);
    });
    $(document).ready(function () {
        $("#fechaFConsulta").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechaFConsulta').datepicker(config);
    });