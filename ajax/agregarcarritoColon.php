<?php
    $productos= unserialize($_COOKIE['productos']??'');    

    if(is_array($productos)==false)$productos=array();
    $siYaEstaProducto=false;
    foreach ($productos as $key => $value) {
        if($value['id']==$_REQUEST['id']){
            $productos[$key]['cantidad']=$productos[$key]['cantidad']+$_REQUEST['cantidadcolon'];
            $siYaEstaProducto=true;
        }
    }
    if($siYaEstaProducto==false){
        $nuevo=array(
            "id"=>$_REQUEST['id'],
            "nombre"=>$_REQUEST['nactividades'],
            "precio"=>$_REQUEST['preciocolon'],
            "existencia"=>$_REQUEST['existenciacolon'],  
            "cantidad"=>$_REQUEST['cantidadcolon'],       
            "fecha" =>$_REQUEST['fechacolon'],
            "inxcolon" =>$_REQUEST['inxcolon'],
            "descuentoobras" =>$_REQUEST['descuentocolon'],
        );
        array_push($productos,$nuevo);
    }
    setcookie("productos",serialize($productos));
    echo json_encode($productos);



    
?>