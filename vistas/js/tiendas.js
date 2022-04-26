/*=============================================
EDITAR Tienda
=============================================*/
$(".tablas").on("click", ".btnEditarTienda", function(){

	var idTienda = $(this).attr("idTienda");

	var datos = new FormData();
    datos.append("idTienda", idTienda);

    $.ajax({

      url:"ajax/tiendas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	   $("#idTienda").val(respuesta["id"]);
           $("#editarid_cadena").val(respuesta["id_cadena"]);
           $("#editarTienda").val(respuesta["nombre"]);
	       $("#editarCiudad").val(respuesta["ciudad"]);
	       $("#editarEmail").val(respuesta["email"]);
	       $("#editarTelefono").val(respuesta["telefono"]);
	       $("#editarDireccion").val(respuesta["direccion"]);
           $("#editarFechaRegistro").val(respuesta["fecha_registro"]);
	  }

  	})

})

/*=============================================
ELIMINAR Tienda
=============================================*/
$(".tablas").on("click", ".btnEliminarTienda", function(){

	var idTienda = $(this).attr("idTienda");
    alert(idTienda);
    swal({
        title: '¿Está seguro de borrar la Tienda?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Tienda!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=tiendas&idTienda="+idTienda;
        }

  })

})