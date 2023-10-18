<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Proveedor{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$empresa,$ciudad,$imagen){
	$sql="INSERT INTO proveedor (nombre,tipo_documento,num_documento,direccion,telefono,email,empresa,ciudad,imagen,condicion) VALUES ('$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email','$empresa','$ciudad','$imagen','1')";
	//return ejecutarConsulta($sql);
	 $idusuarionew=ejecutarConsulta_retornarID($sql);
	 $num_elementos=0;
	 $sw=true;
	
}

public function editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$empresa,$ciudad,$imagen){
	$sql="UPDATE proveedor SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',telefono='$telefono',email='$email',empresa='$empresa',ciudad='$ciudad',imagen='$imagen' 
	WHERE idusuario='$idusuario'";
	 ejecutarConsulta($sql);

}

public function desactivar($idusuario){
	$sql="UPDATE proveedor SET condicion='0' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}
public function activar($idusuario){
	$sql="UPDATE proveedor SET condicion='1' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idusuario){
	$sql="SELECT * FROM proveedor WHERE idusuario='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM proveedor";
	return ejecutarConsulta($sql);
}

//metodo para listar permmisos marcados de un usuario especifico
public function listarmarcados($idusuario){
	$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//Función para verificar el acceso al sistema
	public function verificar($ciudad)
    {
    	$sql="SELECT idusuario,nombre,tipo_documento,num_documento,telefono,email,empresa,imagen,ciudad FROM proveedor WHERE ciudad='$ciudad' AND condicion='1'"; 
    	return ejecutarConsulta($sql);  
    }
}

 ?>
