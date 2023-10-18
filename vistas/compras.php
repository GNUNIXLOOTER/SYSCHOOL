

<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['acceso']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box" >
<div class="box-header with-border">
  <h1 class="box-title"><i class="fa fa-th-large"></i> <strong>Productos <span><i class="fa fa-arrow-right"></i></span> </strong><button class="btn btn-dropbox" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i>Registrar</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      
      <th>Opciones</th>
      <th>Nombre</th>
      <th>Codigo</th>
      <th>Cantidad</th>
      <th>Nota</th>
      <th>Proveedor</th>
      <th>Fecha</th>
      <th>valor</th>
      <th>Foto</th>
      <th>Estado</th>
      
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Nombre</th>
      <th>Codigo</th>
      <th>Cantidad</th>
      <th>Nota</th>
      <th>Proveedor</th>
      <th>Fecha</th>
      <th>valor</th>
      <th>Foto</th>
      <th>Estado</th>

    </tfoot>   
  </table>
</div>

<div class="panel-body" id="formularioregistros">

  <form action="" name="formulario" id="formulario" method="POST">
  <div  id="GFG">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre(*):</label>
      <input class="form-control" type="hidden" name="idproducto" id="idproducto">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
    </div>

    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Proveedor(*):</label>
      <input type="text" class="form-control" name="proveedor" id="proveedor" placeholder="Proveedor" maxlength="20">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Codigo(*):</label>
      <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo" maxlength="20">
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Cantidad</label>
      <input class="form-control" type="text" name="cantidad" id="cantidad" placeholder="Cantidad" maxlength="70">
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nota</label>
      <input class="form-control" type="text" name="nota" id="nota" maxlength="20" placeholder="Nota">
    </div>

    <?php 
    $originalDate = "2021-07-18"; 
    $newDate = date("d-m-Y", strtotime($originalDate));
    ?>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Fecha: </label>
      <input class="form-control" type="date" name="fecha" id="fecha" maxlength="70" placeholder="Fecha">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Valor: </label>
      <input class="form-control" type="text" name="valor" id="valor" maxlength="70" placeholder="valor">
    </div>

        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Imagen:</label>
      <input class="form-control" type="file" name="imagen" id="imagen">
      <input type="hidden" name="imagenactual" id="imagenactual">
      <img src="" alt="" width="150px" height="120" id="imagenmuestra">
    </div>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    
    </div>
  </form>
</div>
<script>
        function imprim1(invoice){
        var printContents = document.getElementById('GFG').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
        w.print();
        w.close();
        return true;}
 </script>




<!--inicio de modal editar contraseña--->
<!--fin de modal editar contraseña--->
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php';
 ?>
 <script src="scripts/compras.js"></script>
 <?php 
}

ob_end_flush();
  ?>
