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

             url:"php/insertarProducto.php",
             data:{ nombreproducto:$('#nombreproducto').val(),
                    descripcionproducto:$('#descripcionproducto').val(),
                    precioestimado:$('#precioestimado').val()
                }
        }).success(function(data){
            
                $('#tabla_buscar').html(data);
                alertify.success("¡¡Agregado con exito!!");

            }).fail(function()
            {
                alertify.error("¡¡Fallo en el servidor!!");
            });

    });

    $('#editar_form').submit(function(){
         $("#fechaicolabu").val($("#fechaicolabu").val().split("/").reverse().join("-"));
         $("#fechafcolabu").val($('#fechafcolabu').val().split("/").reverse().join("-"));

    });

   $('#buscar').keyup(function(){
       $.ajax({
             type: "POST",

             url:"php/tabla.php",
             data:{ buscar:$('#buscar').val()
                }
        }).success(function(data){
            
                $('#tabla_buscar').html(data);
               

            }).fail(function()
            {
                alertify.error("¡¡Fallo en el servidor!!");
            });
   });
});




   var datepicker, config;
    config = {
        locale: 'es-es',
        uiLibrary: 'bootstrap4'
    };

    $(document).ready(function () {
        $("#fechaicolab").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechaicolab').datepicker(config);
    });
    $(document).ready(function () {
        $("#fechafcolab").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechafcolab').datepicker(config);
    });

    $(document).ready(function () {
        $("#fechaicolabu").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechaicolabu').datepicker(config);
    });

     $(document).ready(function () {
        $("#fechafcolabu").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechafcolabu').datepicker(config);
    });




