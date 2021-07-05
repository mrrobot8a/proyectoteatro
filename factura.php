<?php
    $total=$_REQUEST['total']??'';
    include_once "stripe/init.php";
    \Stripe\Stripe::setApiKey("sk_test_JaTXHOFLk3lllnj1PnpahfxR00NLGmUe8M");
    $toke=$_POST['stripeToken'];
    $charge=\Stripe\Charge::create([
        'amount'=>$total,
        'currency'=>'usd',
        'description'=>'Pago de ecommerce',
        'source'=>$toke
    ]);
    if($charge['captured']){
        $queryVenta="INSERT INTO ventas 
        (idCli                       ,idPago             ,fecha) values
        ('".$_SESSION['idCliente']."','".$charge['id']."',now());
        ";
        $resVenta=mysqli_query($con,$queryVenta);
        $id=mysqli_insert_id($con);
        


        
        
        //aqui lo que neces
        $where = "where id=";
        $insertaDetalle="";
        $cantProd=count($_REQUEST['id']);
        for($i=0;$i<$cantProd;$i++){
        
            $insertaDetalle=$insertaDetalle."('".$_REQUEST['id'][$i]."','$id','".$_REQUEST['cantidad'][$i]."','".$_REQUEST['precio'][$i]."','".$_REQUEST['total']."'),";
          $cantidad = $_REQUEST['cantidad'][$i];
          $ide = $_REQUEST['id'][$i] ;
            $consulta="UPDATE productos SET existencia = existencia - $cantidad where id = $ide ";
            $resultado=mysqli_query($con, $consulta);
        }
        $insertaDetalle=rtrim($insertaDetalle,",");
        $queryDetalle="INSERT INTO detalleVenta 
        (idProd, idVenta, cantidad, precio, subTotal) values 
        $insertaDetalle;";


       
        $resDetalle=mysqli_query($con,$queryDetalle);
        echo $resDetalle;
        if(1==1){
            echo "La venta fue exitosa con el id=".$queryDetalle;
        }
        if($resVenta && $resDetalle){
        ?>
        <div class="row">
            <div class="col-6">
                <?php muestraRecibe($id); ?>
            </div>
            <div class="col-6">
                <?php muestraDetalle($id); ?>
            </div>
        </div>
        <?php
        borrarCarrito();
        }
    }
    function borrarCarrito(){
        ?>
            <script>
                $.ajax({
                    type: "post",
                    url: "ajax/borrarCarrito.php",
                    dataType: "json",
                    success: function (response) {
                        $("#badgeProducto").text("");
                        $("#listaCarrito").text("");
                    }
                });
            </script>
        <?php
    }
    function muestraRecibe($idVenta){
    ?>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3" class="text-center">Persona que recibe</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            <?php
                global $con;
                $queryRecibe="SELECT nombre,email,direccion 
                from recibe 
                where idCli='".$_SESSION['idCliente']."';";
                $resRecibe=mysqli_query($con,$queryRecibe);
                $row=mysqli_fetch_assoc($resRecibe);
            ?>
            <tr>
                <td><?php echo $row['nombre'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['direccion'] ?></td>
            </tr>
        </tbody>
    </table>
    <?php
    }
    function muestraDetalle($idVenta){
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3" class="text-center">Detalle de venta</th>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>fecha</th>
                    <th>SubTotal</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                    global $con;
                    $queryDetalle="SELECT
                    p.nombre,
                    dv.cantidad,
                    dv.precio,
                    dv.subTotal,
                    v.fecha
                    FROM  ventas AS v
                    INNER JOIN detalleVenta AS dv ON dv.idVenta = v.id
                    INNER JOIN productos AS p ON p.id = dv.idProd
                    
                    WHERE
                    v.id = '$idVenta'";
                    $resDetalle=mysqli_query($con,$queryDetalle);
                    $total=0;
                    while($row=mysqli_fetch_assoc($resDetalle)){
                        $total=$row['subTotal']/100;
                        
                ?>
                <tr>
                    <td><?php echo $row['nombre'] ?></td>
                    <td><?php echo $row['cantidad'] ?></td>
                    <td><?php echo $row['precio'] ?></td>
                    <td><?php echo $row['fecha'] ?>PM </td>
                    <td><?php echo number_format( $row['subTotal'] /100,3) ?></td>
                    
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td colspan="3" class="text-right">Total:</td>
                    <td><?php echo number_format($total,3); ?></td>
                </tr>

            </tbody>
        </table>
        <a class="btn btn-secondary float-right" target="_blank" href="imprimirFactura.php?idVenta=<?php echo $idVenta; ?>" role="button">Imprimir factura <i class="fas fa-file-pdf"></i> </a>
        <?php
        }
    
?>