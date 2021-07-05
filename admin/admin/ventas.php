<?php
include_once "db_ecommerce.php";
$con = mysqli_connect($host, $user, $pass, $db);
if(isset($_REQUEST['idBorrar'])){
    $id= mysqli_real_escape_string($con,$_REQUEST['idBorrar']??'');
    $query="DELETE from usuarios  where id='".$id."';";
    $res=mysqli_query($con,$query);
    if($res){
        ?>
        <div class="alert alert-warning float-right" role="alert">
            Usuario borrado con exito (no tienes corazon)
        </div>
        <?php
    }else{
        ?>
        <div class="alert alert-danger float-right" role="alert">
            Error al borrar <?php echo mysqli_error($con); ?>
        </div>
        <?php
    }
}
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Ventas</h1>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table id="example2" class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>Nombre Producto</th>
                                      <th>Nombre Cliente</th>
                                      <th>Cantidad</th>
                                      <th>Subtotal</th>
                                      <th>fecha y hora </th>
                                      <th>Estado</th>

                                      <th>Acciones
                                          <a href="panel.php?modulo=crearUsuario"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                      </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                    $query = "SELECT productos.nombre,ventas.fecha, clientes.nombre AS nombrecliente, detalleventa.cantidad,detalleventa.subTotal FROM detalleventa INNER join productos on detalleventa.idProd = productos.id INNER JOIN ventas on detalleventa.idVenta = ventas.id inner JOIN clientes on clientes.id = ventas.idCli;  ";
                                    $resVenta = mysqli_query($con, $query);

                                    while ($rowVenta = mysqli_fetch_assoc($resVenta)) {
                                    ?>
                                      <tr>
                                          <td><?php echo $rowVenta['nombre'] ?></td>
                                          <td><?php echo $rowVenta['nombrecliente'] ?></td>
                                          <td><?php echo $rowVenta['cantidad'] ?></td>
                                          <td><?php echo number_format($rowVenta['subTotal']) ?></td>
                                          <td><?php echo $rowVenta['fecha'] ?></td>
                                          <td> PAGADO</td>

                                          <td>
                                              <a href="panel.php?modulo=editarUsuario&id=<?php echo $row['id'] ?>" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                              <a href="panel.php?modulo=usuarios&idBorrar=<?php echo $row['id'] ?>" class="text-danger borrar"> <i class="fas fa-trash"></i> </a>
                                          </td>
                                      </tr>
                                  <?php
                                    }
                                    ?>
                              </tbody>
                          </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
  </div>