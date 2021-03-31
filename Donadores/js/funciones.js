  /*  

$(document).ready(function(){
    $('#personal').load('php/model.php');

});*/


$(document).ready(function(){
    $('#guardarDonador').click(function(){

        $.ajax({
             type: "POST",

             url:"php/insertarDonador.php",
             data:{ nombred:$('#nombred').val(),
                    telefonod:$('#telefonod').val(),
                    correod:$('#correod').val(),
                    recurrente:$('#recurrente').val()

                  
                }
        }).success(function(data){
            
                $('#tabla_donar').html(data);
                alertify.success("¡Agregado con éxito!");

            }).fail(function()
            {
                alertify.error("¡Fallo en el servidor!");
            });

    });

    $('#editar_form').submit(function(){
         $("#fechaicolabu").val($("#fechaicolabu").val().split("/").reverse().join("-"));
         $("#fechafcolabu").val($('#fechafcolabu').val().split("/").reverse().join("-"));

    });

    $('#archivo_form').submit(function(){
        /* $("#fechaicolabu").val($("#fechaicolabu").val().split("/").reverse().join("-"));
         $("#fechafcolabu").val($('#fechafcolabu').val().split("/").reverse().join("-"));*/

    });

   $('#buscard').keyup(function(){
       $.ajax({
             type: "POST",

             url:"php/tabla.php",
             data:{ buscard:$('#buscard').val()
                }
        }).success(function(data){
            
                $('#tabla_donar').html(data);
               

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


   
