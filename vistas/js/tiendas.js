/*=============================================
EDITAR Tienda
=============================================*/
$(".tablas").on("click", ".btnEditarTienda", function(){

	var idTienda = $(this).attr("idtienda");

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
           $("#editarCadena").val(respuesta["id_cadena"]);
           $("#editarTienda").val(respuesta["nombre"]);
	       $("#editarCiudad").val(respuesta["ciudad"]);
	       $("#editarDireccion").val(respuesta["direccion"]);
           $("#editarFechaRegistro").val(respuesta["fecha_registro"]);
           consultarCadena();
	  }

  	});
})



function consultarCadena() {

    var idCadena_ = $("#editarCadena").val();
    var datos_cadena = new FormData();
    datos_cadena.append("idCadena", idCadena_);
    console.log(datos_cadena);

    $.ajax({
        url:"ajax/cadenas.ajax.php",
        method: "POST",
        data: datos_cadena,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            $('#editarCadena').append($('<option>', {
                value: respuesta["id"],
                text: respuesta["nombre"]
            }));
        }

    })

}

/*=============================================
ELIMINAR Tienda
=============================================*/
$(".tablas").on("click", ".btnEliminarTienda", function(){

	var idTienda = $(this).attr("idTienda");
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