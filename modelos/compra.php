<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Compras{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$codigo,$cantidad,$nota,$proveedor,$fecha,$valor,$imagen){
	$sql="INSERT INTO compra (nombre,codigo,cantidad,nota,proveedor,fecha,valor,imagen,condicion) VALUES ('$nombre','$codigo','$cantidad','$nota','$proveedor','$fecha','$valor','$imagen','1')";
	//return ejecutarConsulta($sql);
	 $idproductonew=ejecutarConsulta_retornarID($sql);
	 $num_elementos=0;
	 $sw=true;
	
}

public function editar($idproducto,$nombre,$codigo,$cantidad,$nota,$proveedor,$fecha,$valor,$imagen){
	$sql="UPDATE compra SET nombre='$nombre',codigo='$codigo',cantidad='$cantidad',nota='$nota',proveedor='$proveedor',fecha='$fecha',valor='$valor',imagen='$imagen' 
	WHERE idproducto='$idproducto'";
	 ejecutarConsulta($sql);

}

public function imprimir($idproducto){
	$sql="SELECT FROM compra
    WHERE idproducto = '$idproducto'";
	return ejecutarConsulta($sql);
}
public function desactivar($idproducto){
	//$sql="UPDATE compra SET condicion='0' WHERE idproducto='$idproducto'";
	$sql="DELETE FROM compra
    WHERE idproducto = '$idproducto'";

	return ejecutarConsulta($sql);
}
public function activar($idproducto){
	$sql="UPDATE compra SET condicion='1' WHERE idproducto='$idproducto'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idproducto){
	$sql="SELECT * FROM compra WHERE idproducto='$idproducto'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM compra";
	return ejecutarConsulta($sql);
}

//metodo para listar permmisos marcados de un usuario especifico
public function listarmarcados($idproducto){
	$sql="SELECT * FROM usuario_permiso WHERE idproducto='$idproducto'";
	return ejecutarConsulta($sql);
}

//Función para verificar el acceso al sistema
	public function verificar($fecha)
    {
    	$sql="SELECT idproducto,nombre,codigo,cantidad,nota,proveedor,imagen, fecha FROM compra WHERE fecha='$fecha' AND condicion='1'"; 
    	return ejecutarConsulta($sql);  
    }

	
}

 ?>
