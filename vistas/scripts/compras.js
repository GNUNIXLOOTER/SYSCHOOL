var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   mostrarform_clave(false);
   listar();
$("#formularioc").on("submit",function(c){
   	editar_clave(c);
   })
   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })

   $("#imagenmuestra").hide();
//mostramos los permisos
$.post("../ajax/compras.php?op=permisos&id=", function(r){
	$("#permisos").html(r);
});
}

//funcion limpiar
function limpiar(){
	$("#nombre").val("");
    $("#codigo").val("");
	$("#cantidad").val("");
	$("#nota").val("");
	$("#proveedor").val("");
	$("#fecha").val("");
	$("#valor").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#idproducto").val("");
}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}
function mostrarform_clave(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formulario_clave").show();
		$("#btnGuardar_clave").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formulario_clave").hide();
		$("#btnagregar").show();
	}
}
//cancelar form
function cancelarform(){
	$("#claves").show();
	limpiar();
	mostrarform(false);
}
function cancelarform_clave(){
	limpiar();
	mostrarform_clave(false);

}

//funcion listar
function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/compras.php?op=listar',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/compras.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform(false);
     		tabla.ajax.reload();
     	}
     });
$("#claves").show();
     limpiar();
}


function mostrar(idproducto){
	$.post("../ajax/compras.php?op=mostrar",{idproducto: idproducto},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
			if ($("#idproducto").val(data.idproducto).length==0) {

           	
           }else{
			$("#claves").hide();
			}
			$("#nombre").val(data.nombre);
            $("#codigo").val(data.codigo);
            $("#codigo").selectpicker('refresh');
            $("#cantidad").val(data.cantidad);
            $("#nota").val(data.nota);
            $("#proveedor").val(data.proveedor);
            $("#fecha").val(data.fecha);
			$("#valor").val(data.valor);
        
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src","../files/compras/"+data.imagen);
            $("#imagenactual").val(data.imagen);
            $("#idproducto").val(data.idproducto);

 
		});
	$.post("../ajax/compras.php?op=permisos&id="+idproducto, function(r){
	$("#permisos").html(r);
});
}


//funcion para desactivar
function desactivar(idproducto){
	bootbox.confirm("¿Esta seguro borrar este dato?", function(result){
		if (result) {
			$.post("../ajax/compras.php?op=desactivar", {idproducto : idproducto}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idproducto){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/compras.php?op=activar", {idproducto : idproducto}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function imprimir(idproducto){
	bootbox.confirm("¿Desea imprimir?" , function(result){
		if (result) {
			$.post("../ajax/compras.php?op=imprimir", {idproducto : idproducto}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


init();