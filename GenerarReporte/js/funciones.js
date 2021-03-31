
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
                url:"php/realizarReporte.php",
                data:
                {
                    fechaIReporte:$("#fechaIReporte").val().split("/").reverse().join("-"),
                    fechaFReporte:$('#fechaFReporte').val().split("/").reverse().join("-")
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
        $("#fechaIReporte").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechaIReporte').datepicker(config);
    });
    $(document).ready(function () {
        $("#fechaFReporte").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechaFReporte').datepicker(config);
    });