<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Tablero

      <small>Panel de Control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Dashboard</li>

    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

   <div class="row">
     <?php if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Demo"){
     include "inicio/cajas.php";}
    ?>
   </div>

   <div class="row">
     <div class="col-lg-12">
       <?php if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Demo"){
       include "reportes/grafico-ventas.php";}
       ?>
     </div>
     <div class="col-lg-6">
       <?php if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Demo"){
        include "reportes/productos-mas-vendidos.php";}
       ?>
     </div>
     <div class="col-lg-6">
       <?php if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Demo"){
        include "inicio/productos-recientes.php";}
       ?>
     </div>
     <div class="col-lg-12">
       <?php if($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Supervisor"){
        echo '
        <div class="box box-success">
        <div class="box-header">
        <h1 style="text-align: center">Bienvenido/a, ' .$_SESSION["nombre"].'</h1>
        </div>
        </div>';
       } ?>
     </div>
   </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
