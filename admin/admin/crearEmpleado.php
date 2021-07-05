<?php
if (isset($_REQUEST['guardar'])) {
    include_once "db_ecommerce.php";
    $con = mysqli_connect($host, $user, $pass, $db);

    $identificacion = mysqli_real_escape_string($con, $_REQUEST['identificacion'] ?? '');
    $cargo = mysqli_real_escape_string($con, $_REQUEST['cargo'] ?? '');
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');

    $query = "INSERT INTO empleado 
        ( nombre,  identificacion, cargo ) VALUES
        ('" . $nombre . "','" . $identificacion . "','" . $cargo . "');
        ";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=empleado&mensaje=Empleado creado exitosamente" />  ';
    } else {
?>
        <div class="alert alert-danger" role="alert">
            Error al crear usuario <?php echo mysqli_error($con); ?>
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
                    <h1>Crear Empleado</h1>
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
                        <form action="panel.php?modulo=crearEmpleado" method="post">
                            <div class="form-group">
                                <label>nombre</label>
                                <input type="text" name="nombre" class="form-control"  required="required" >
                            </div>
                            <div class="form-group">
                                <label>identificacion</label>
                                <input  name="identificacion" class="form-control"  required="required" >
                            </div>
                            <div class="form-group">
                                <label>cargo</label>
                                <input type="text" name="cargo" class="form-control"  required="required" >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
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