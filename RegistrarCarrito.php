<?php
include_once "admin/db_ecommerce.php";
$con = mysqli_connect($host, $user, $pass, $db);

$insertaDetalle="";
$cantProd=count($_REQUEST['id']);
for($i=0;$i<$cantProd;$i++){
    $subTotal=$_REQUEST['precio'][$i]*$_REQUEST['cantidad'][$i];
    $insertaDetalle=$insertaDetalle."('".$_REQUEST['id'][$i]."','$id','".$_REQUEST['cantidad'][$i]."','".$_REQUEST['precio'][$i]."','".$_REQUEST['total']."'),";
}
$insertaDetalle=rtrim($insertaDetalle,",");
$queryDetalle="INSERT INTO detalleVentas 
(idProd, idVenta, cantidad, precio, subTotal) values 
$insertaDetalle;";
$resDetalle=mysqli_query($con,$queryDetalle);
?>
