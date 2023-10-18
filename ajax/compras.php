<?php 
session_start();
require_once "../modelos/compra.php";

/*$compra=new Compas();*/
$compra = new Compras();

$idproducto=isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$nota=isset($_POST["nota"])? limpiarCadena($_POST["nota"]):"";
$proveedor=isset($_POST["proveedor"])? limpiarCadena($_POST["proveedor"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$valor=isset($_POST["valor"])? limpiarCadena($_POST["valor"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name'])) 
		{
			$imagen=$_POST["imagenactual"];
		}else
		{

			$ext=explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			 {

			   $imagen = round(microtime(true)).'.'. end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/compras/" . $imagen);
		 	}
		}

		/**$resultado=$conexion->query("SELECT EXISTS (SELECT * FROM compra WHERE codigo='$codigo');");
		$row=mysqli_fetch_row($resultado);
		
			if ($row[0]=="1") {                 
					//Aqui colocas el código que tu deseas realizar cuando el dato existe en la base de datos
					echo "
                    <p class='avisos'>Ya existe un registro con este codigo de Producto</p>
                    ";
			}else{
				   //Aqui colocas el código que tu deseas realizar cuando el dato NO existe en la base de datos
				}**/	

		if (empty($idproducto)) {
			$rspta=$compra->insertar($nombre,$codigo,$cantidad,$nota,$proveedor,$fecha,$valor,$imagen);
			echo $rspta ? "Datos registrados correctamente" : "Datos actualizados correctamente";
		}
		else {
			$rspta=$compra->editar($idproducto,$nombre,$codigo,$cantidad,$nota,$proveedor,$fecha,$valor,$imagen,);
			echo $rspta ? "Datos actualizados correctamente" : "Datos actualizados correctamente";
		}

			
	break;
	

	case 'desactivar':
		$rspta=$compra->desactivar($idproducto);
		echo $rspta ? "Datos borrados correctamente" : "No se pudo borrados los datos";
	break;

	case 'activar':
		$rspta=$compra->activar($idproducto);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
	break;
	
	case 'mostrar':
		$rspta=$compra->mostrar($idproducto);
		echo json_encode($rspta);
	break;
	
	case 'listar':
		$rspta=$compra->listar();
		//declaramos un array
		$data=Array();


		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil-square-o"></i></button>'.''.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idproducto.')"><i class="fa fa-times-circle"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idproducto.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->nombre,
				"2"=>$reg->codigo,
				"3"=>$reg->cantidad,
				"4"=>$reg->nota,
				"5"=>$reg->proveedor,
				"6"=>$reg->fecha,
				"7"=>$reg->valor,
				"8"=>"<img src='../files/compras/".$reg->imagen."' height='50px' width='50px'>",
				"9"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
				);
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;

	case 'verificar':
		//validar si el usuario tiene acceso al sistema
		$logina=$_POST['logina'];
		$clavea=$_POST['clavea'];

		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256", $clavea);
	
		$rspta=$usuario->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch)) 
		{
			# Declaramos la variables de sesion
			$_SESSION['idproducto']=$fetch->idproducto;
			$_SESSION['nombre']=$fetch->nombre;
			$_SESSION['imagen']=$fetch->imagen;
			$_SESSION['proveedor']=$fetch->proveedor;
			$_SESSION['fecha']=$fetch->fecha;

			//obtenemos los permisos
			$marcados = $usuario->listarmarcados($fetch->idusuario);

			//declaramos el array para almacenar todos los permisos
			$valores=array();

			//almacenamos los permisos marcados en al array
			while ($per = $marcados->fetch_object()) 
			{
				array_push($valores, $per->idpermiso);
			}

			//determinamos lo accesos al usuario
			in_array(1, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			in_array(2, $valores)?$_SESSION['grupos']=1:$_SESSION['grupos']=0;
			in_array(3, $valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;


		}
		echo json_encode($fetch);

	break;

	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;
}
?>