<?php
$id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');
$queryProducto = "SELECT id,nombre,precio,existencia,Description,fecha    FROM productos where id='$id';  ";
$resProducto = mysqli_query($con, $queryProducto);
$rowProducto = mysqli_fetch_assoc($resProducto);

$nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
$queryFecha = "SELECT fecha FROM productos where nombre ='$nombre';  ";
$resFecha = mysqli_query($con, $queryFecha);

$queryFecha = "SELECT 	* FROM descuentos where idDescuento =1";
$resDescuentos = mysqli_query($con, $queryFecha);




?>
<!-- Default box -->
<div class="card card-solid">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"><?php echo $rowProducto['nombre'] ?></h3>
                <?php
                $queryImagenes = "SELECT 
                f.web_path
                FROM
                productos AS p
                INNER JOIN productos_files AS pf ON pf.productos_id=p.id
                INNER JOIN files AS f ON f.id=pf.file_id
                WHERE p.id='$id';
                ";
                $resPrimerImagen = mysqli_query($con, $queryImagenes);
                $rowPrimerImaen=mysqli_fetch_assoc($resPrimerImagen);
                ?>
                <div class="col-12">
                    <img src="<?php echo $rowPrimerImaen['web_path'] ?>" class="product-image">
                </div>
                <div class="col-12 product-image-thumbs">
                    <?php
                    $resImagenes = mysqli_query($con, $queryImagenes);
                    while ($rowImagenes = mysqli_fetch_assoc($resImagenes)) {
                    ?>

                        <div class="product-image-thumb"><img src="<?php echo $rowImagenes['web_path'] ?>"></div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-2"><?php echo $rowProducto['nombre'] ?></h3>
               
                <p  class="my-2">Description</p>
                <p  class="my-2" ><?php echo $rowProducto['Description'] ?></p>
              
                <hr>
                <h4>Existencias: <?php echo $rowProducto['existencia'] ?></h4>



                <div class="bg-gray py-1 px-2 mt-4 col-lg-6">
                    <h2 class="mb-0">
                    Precio $<?php echo number_format( $rowProducto['precio'])  ?>
                    </h2>
                </div>
                
                <div class="mt-2">
                <div class="row">
                <div class="col-lg-6">
                          <div class="form-group">
                            <label>Descuentos </label>
                            <br>
                            <select class="form-control" name="Codigo" id = "descuentosObra">
                              <option value="0">Seleccione</option>
                              <?php

                              while ($rowDescuento = mysqli_fetch_assoc($resDescuentos)) {
                                  ?>
                                <option><?php echo $rowDescuento['nombreDescuento']   ?>-<?php echo $rowDescuento['valorDescuento']   ?>%</option>  ;
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                          
                    </div>
                    <div class="col-lg-6">
                    <?php 
                    $queryF = "SELECT 	* FROM descuentos where idDescuento =2";
                    $resD = mysqli_query($con, $queryF);
                    
                    ?>
                          <div class="form-group">
                            <label>Descuentos Para grupos </label>
                            <br>
                            <select class="form-control" name="Codigo" id = "descuentosventasCorp" style="display: visible;"  onload="mostrarBoton();">
                              <option value="0">Seleccione</option>
                              <?php

                              while ($rowD= mysqli_fetch_assoc($resD)) {
                                  ?>
                                <option><?php echo $rowD['nombreDescuento']   ?>-<?php echo $rowD['valorDescuento']   ?>%</option>  ;
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                          
                    </div>
                    
                    </div>

                <div class="col-lg-6">
                          <div class="form-group">
                            <label>Fechas del evento</label>
                            <br>
                            <select class="form-control" name="Codigo" id="SelectProduct">
                              <option value="1">Seleccione</option>
                              <?php

                              while ($rowFecha = mysqli_fetch_assoc($resFecha)) {
                                  ?>
                                <option><?php echo $rowFecha['fecha']  ?> PM</option>  ;
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                    
                <div class="mt-4 col-lg-6">
                    Catnidad
                    <input type="number" class="form-control" id="cantidadProducto" value="1">
                </div>
                <div class="row">
                
                <div class="mt-4">
                    <button class="btn btn-primary btn-lg btn-flat" id="agregarCarrito" 
                   
                    data-id="<?php echo $_REQUEST['id'] ?>"
                    data-nombre="<?php echo $rowProducto['nombre'] ?>"
                    data-web_path="<?php echo $rowPrimerImaen['web_path'] ?>"
                    data-precio="<?php echo $rowProducto['precio'] ?>"
                    data-Producto ="1" ;
                    >
                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                        Add to Cart
                     </button>
                 
     <script>
      
        if(<?php echo $_REQUEST['page'] ?> =='5'){
            document.getElementById("descuentosventasCorp").style.visibility = 'visible';
            document.getElementById("descuentosObra").style.visibility = 'hidden';
          
        }else{

        document.getElementById("descuentosventasCorp").style.visibility = 'hidden';
        
    }
        
       
    </script>
                </div>
                <p> </p>
                <div class="mt-4 col-lg-7">
                    <button class="btn btn-primary btn-lg btn-flat" id="agregarCarrito" 
                                        >
                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                        Ver descuentos disponibles
                    </button>
                </div>
                </div>

                <div class="mt-4 product-share">
                    <a href="#" class="text-gray">
                        <i class="fab fa-facebook-square fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray">
                        <i class="fab fa-twitter-square fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray">
                        <i class="fas fa-envelope-square fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray">
                        <i class="fas fa-rss-square fa-2x"></i>
                    </a>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <nav class="w-100">
                <div class="nav nav-tabs" id="product-tab" role="tablist">
                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Descripcion de la obra</a>
                    <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Descuentos </a>
                    <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">  <p  class="my-2" ><?php echo $rowProducto['Description'] ?></p></div>
            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Para aplicar adecuadamente alos descuentos y que no sede una falla al momento de pagar y validar los datos , debe tener encuenta los requisitos que debe cumplir para aplicar a algun tipo Descuento </div>
                <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Para aplicar adecuadamente alos descuentos y que no sede una falla al momento de pagar y validar los datos , debe tener encuenta los requisitos que debe cumplir para aplicar a algun tipo Descuento </div>
                <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>

            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->