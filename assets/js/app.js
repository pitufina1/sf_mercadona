import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// require jQuery normally
const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;

//assets/js/app.js


$(document).ready (function () {

	$('.card').on('click', function () {
          var id = $(this).find('input').val();

         $.ajax({
			    method: "get",
			    data: {},
			    url: "/producto/"+id+"/json",
			    dataType: "json",
			    success: function (datos) { 
			    	//Rellenar el modal con los datos
			    	$('#myModal p.....').text(datos.nombre);
					console.log( "La solicitud se ha completado correctamente." );

					//Mostar el modal
					$('#myModal').modal('show');
			    }
		});
	});
})

