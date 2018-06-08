import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// require jQuery normally
const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;

//assets/js/app.js

$( document ).ready(function() {
    console.log('aaaa');
    
    $('#left li').on('click', function () {
        var idcat = $(this).attr('cat-id');
        

        console.log ('hola');


        $.ajax({
            url: 'categoria' + idcat"/json",
            dataType: 'json',
            success: function(datos) {
                $('#productos').empty();
                $.each(datos.results, function(k, v) {
                
                   nuevo.find('...').text(v.name);
                   
                   plantilla.show();
                   $('#productos').append(nuevo);   


                })
                    /*$("#personas").text(v.email);
                    console.log(datos);*/
            }
        });
    });