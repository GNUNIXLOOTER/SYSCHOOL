 <?php 
if (strlen(session_id())<1) 
  session_start();
  ?>
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>SISTEMA ESCOLAR</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.png">
 
    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../vistas/css/styles.css">

  </head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="escritorio.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SISTEMA</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SISTEMA</b> ESCOLAR</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['nombre'].' '.$_SESSION['cargo']; ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="../vistas/usuario.php" class="btn btn-default btn-flat">Registrar Usuario</a>
                </div>
                <div class="pull-right">
                  <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

<br>
       <?php 
if ($_SESSION['escritorio']==1) {
  echo ' <li><a href="escritorio.php"><i class="fa  fa-dashboard (alias)"></i> <span>Dashboard</span></a>
        </li>';
}
        ?> 


               <?php 
if ($_SESSION['grupos']==1) {
  echo '<li class="treeview">
          <a href="#">
            <i class="fa far fa-edit"></i> <span>Personal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-down pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="grupos.php"><i class="fa fa-circle"></i>Grupos</a></li>
            <li><a href="empleados.php"><i class="fa fa-circle"></i>Empleados</a></li>
            <li><a href="proveedor.php"><i class="fa fa-circle"></i>Proveedor</a></li>
            <li><a href="compras.php"><i class="fa fa-circle"></i>Productos</a></li>
          </ul>
            
        </li>';
}
        ?>


          <?php
           if(isset($_GET["idgrupo"])):?>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-check"></i> <span>Asistencia</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="asistencia.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle"></i> Registrar</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-smile-o"></i> <span>Conducta</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="conducta.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle"></i> Registrar</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i> <span>Calificaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="calificaciones.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle"></i> Registrar</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-th-large"></i> <span>Cursos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a id="btncursos" href="cursos.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle"></i> Registrar</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-th-list"></i> <span>Listas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a id="btnlistas" href="listasis.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle"></i> Consultar</a></li>
          </ul>
        </li>
          <?php endif; ?>


           <?php 
if ($_SESSION['acceso']==1) {
  echo '  <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Accesos Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-down pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="usuario.php"><i class="fa fa-circle"></i> Usuarios</a></li>
            <li><a href="permiso.php"><i class="fa fa-circle"></i> Permisos</a></li>
          </ul>
        </li>';
}
        ?>   
        <li><a href="#"><i class="fa fa-question-circle"></i> <span>Ayuda</span><small class="label pull-right bg-purple">Manual de Usuario</small></a></li>
        <li><a href="acerca.php" target="_self"><i class="fa  fa-exclamation-circle"></i> <span>Acerca de</span><small class="label pull-right bg-purple">Desarrollado por</small></a></li>   
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>