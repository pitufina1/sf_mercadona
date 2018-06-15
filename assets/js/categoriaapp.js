import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// require jQuery normally
const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;

//assets/js/app.js

$( document ).ready(function() {
    console.log('aaaa');
    
    $('#left li').on('click', function () {
        var cargarProductos = function (categoria) {
        console.log ('hola');

        $.ajax({
            url: '/categoria/' + idcat + '/json',
            dataType: 'json',
            success: function(datos) {
                $('#productos').empty();

                ('.content').find('#plantilla').text(datos[1].categoria.nombre);
                $.each(datos, function(k, v) {
                    plantilla = $('#plantilla').clone();
                    plantilla.find('.card-group input').attr('value',v.id);
                    plantilla.find('.card-group img').attr('src',v.url);
                    plantilla.find('.card-group p:first-child').text(v.nombre);
                    plantilla.find('.card-group p:nth-child(2)').text(v.descripcion);
                    plantilla.find('.card-group p:last-child').text(v.precio);
                   
                    plantilla.show();
                   $('#productos').append(plantilla);   
                });     
            }
        });
    }


   /* $('#plantilla').hide();
    cargarProductos('1');

    $('.nav button').on('click', function (e) {
        e.preventDefault();
        var id = $(this).find('input').val();
        cargarProductos(id);
    });

    $('.modal').on('click', function () {
        var cat-id = $(this).find('input').val();
        console.log(id);
        $.ajax({
                method: "get",
                data: {},
                url: "/producto/"+id+"/json",
                dataType: "json",
                success: function (datos) { 
                    //Rellenar el modal con los datos
                    $('#myModal img').attr('src',datos.url);
                    $('#myModal h4').text(datos.nombre);    
                    $('#myModal h5').text(datos.descripcion);   
                    $('#myModal h3').text(datos.precio);


                    console.log( "La solicitud se ha completado correctamente." );
                    //Mostar el modal
                    $('#myModal').modal('show');
                }
        });
    });

});*/