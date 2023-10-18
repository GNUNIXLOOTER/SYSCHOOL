<?php
include_once "../config/Conexion.php";
$con = $conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$query="SELECT * from compra";
$res = mysqli_query($con, $query);
//var_dump($query);exit;
$row = mysqli_fetch_assoc($res);
if ($row) {
    include_once "../config/Conexion.php";
    $con=$conexion=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
    $query="SELECT * from compra";
    $res=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($res);
    if($row){
?>

    <style>
   
        thead {
            font-weight: bold;
            color: black;
            background-color: #ADD8E6;
        }
    </style>
<style>
    
    td,th{
        width: 10%;
        border: 1px solid #000;
    }
    thead{
        font-weight: bold;
        text-align: center;
    }
</style>
    <table cellspacing="0">
        <thead>
            <tr>
                <th colspan="9" >Productos</th>
            </tr>
            <tr>
                <td>Nombre </td>
                <td>Codigo</td>
                <td>Cantidad</td>
                <th>nota</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Imagen</th>
                <th>Condicion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['codigo']; ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo $row['nota'] ?></td>
                <td><?php echo $row['proveedor'] ?></td>
                <td><?php echo $row['fecha'] ?></td>
                <td><?php echo $row['valor'] ?></td>
                <td><?php echo $row['imagen'] ?></td>
                <td><?php echo $row['condicion'] ?></td>
            </tr>
        </tbody>
    </table>
<?php
} else {
    echo "No hay productos";
}
    }else{
        echo "No hay datos";
    }
?>