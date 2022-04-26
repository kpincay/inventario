/*=============================================
EDITAR Cadena
=============================================*/

$(".tablas").on("click", ".btnEditarCadena", function(){
	var idCadena = $(this).attr("idCadena");
	var datos = new FormData();
    datos.append("idCadena", idCadena);

    $.ajax({
      url:"ajax/cadenas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	   $("#id").val(respuesta["id"]);
           $("#editarRuc").val(respuesta["ruc"]);
           $("#editarNombre").val(respuesta["nombre"]);
	       $("#editarCiudad").val(respuesta["ciudad"]);
	       $("#editarEmail").val(respuesta["email"]);
	       $("#editarTelefono").val(respuesta["telefono"]);
	       $("#editarDireccion").val(respuesta["direccion"]);
           $("#editarFechaRegistro").val(respuesta["fecha_registro"]);
	  }

  	})

})

/*=============================================
ELIMINAR Cadena
=============================================*/
$(".tablas").on("click", ".btnEliminarCadena", function(){

	var idCadena = $(this).attr("idCadena");
	
	swal({
        title: '¿Está seguro de borrar la Cadena?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Cadena!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=cadenas&idCadena="+idCadena;
        }

  })

})