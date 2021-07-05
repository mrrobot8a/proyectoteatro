<?php
include_once "db_ecommerce.php";
$con = mysqli_connect($host, $user, $pass, $db);
if (isset($_REQUEST['guarda'])) {

    $identificacion = mysqli_real_escape_string($con, $_REQUEST['identificacion'] ?? '');
    
    $cargo = mysqli_real_escape_string($con, $_REQUEST['cargo'] ?? '');
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
    $id = mysqli_real_escape_string($con, $_REQUEST['idEmpleado'] ?? '');

    $query = "UPDATE empleado SET
        nombre='" . $nombre . "'
        where idEmpleado='".$id."';
        ";

    $res = mysqli_query($con, $query);
    if ($res) {
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=empleado&mensaje=Empleado '.$nombre.' editado exitosamente" />  ';
    } else {
?>
        <div class="alert alert-danger" role="alert">
            Error al crear usuario <?php echo mysqli_error($con); ?>
        </div>
<?php
    }
}
$id= mysqli_real_escape_string($con,$_REQUEST['idEmpleado']??'');
$query="SELECT * from empleado where idEmpleado='".$id."'; ";
$res=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($res);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear usuario</h1>
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
                        <form action="panel.php?modulo=editarEmpleado" method="post">
                            <div class="form-group">
                            <label>nombre</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre'] ?>" required="required" >
                            </div>
                            <div class="form-group">
                                <label>identificacion</label>
                                <input   name="idenficacion" class="form-control" value="<?php echo $row['identificacion'] ?>" required="required" >
                            </div>
                            <div class="form-group">
                                <label>cargo</label>
                                <input type="text" name="cargo" class="form-control" value="<?php echo $row['cargo'] ?>"  required="required" >
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
                                <button type="submit" class="btn btn-primary" name="guarda">Guardar</button>
                            </div>
                        </form>
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