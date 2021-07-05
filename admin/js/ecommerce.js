$(document).ready(function () {
    $.ajax({
        type: "post",
        url: "ajax/leerCarrito.php",
        dataType: "json",
        success: function (response) {
            llenaCarrito(response);
        }
    });
    //aqui lleno la tabla de carritoooooooooo
    $.ajax({
        type: "post",
        url: "ajax/leerCarrito.php",
        dataType: "json",
        success: function (response) {
            llenarTablaCarrito(response);
        }
    });

    
    //aqui me calcular los decuentos  y lleno la tabla carrito
    function llenarTablaCarrito(response){
        $("#tablaCarrito tbody").text("");
        var TOTAL=0;
        response.forEach(element => {
            if(element['producto'] == "1"||element['producto'] == "3"){
            var precio=parseFloat(element['precio']);
            //aqui hace el calculo n
            var totalProd=element['cantidad']*precio;
           
           
            // calcular descuentos 
            if(element['descuentoobras']=='ADULTO MAYOR-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            } else  if(element['descuentoobras']=='Personas en situacion de discapacidad-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Fuerzas militares-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Estudiantes-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Ministerio de Cultura-30%'){
                TotalDescuentos= totalProd * 0.3 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='socios del club vivamos el tiempo uno-30%'){
                TotalDescuentos= totalProd * 0.3 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='socios del club vivamos el tiempo dos-20%'){
                TotalDescuentos= totalProd * 0.2 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='grupo de 100-10%' && element['cantidad'] >=100 ){
                TotalDescuentos= totalProd* 0.1  ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='grupo de 200-20%' && element['cantidad'] >=100 ){
                TotalDescuentos= totalProd* 0.1  ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='grupo de 30 -5%' && element['cantidad'] >=100 ){
                TotalDescuentos= totalProd* 0.1  ; 
                totalProd = totalProd - TotalDescuentos ;
            }
            
            if(element['producto']=="3"){
                TOTAL=0;
                totalFprod = parseFloat(element['precio']);
                TOTAL= totalFprod;
            }else{
  //aqui hace el calculo 
  TOTAL=TOTAL+totalProd;
   var totalFprod = totalProd;
            }
           
            
            $("#tablaCarrito tbody").append(
                `
                <tr>
                    <td><img src="${element['web_path']}" class="img-size-50"/></td>
                    <td>${element['nombre']}</td>
                    <td>
                        ${element['cantidad']}
                        <button type="button" class="btn-xs btn-primary mas" 
                        data-id="${element['id']}"
                        data-tipo="mas"
                        data-producto ="${element['producto']}"
                        >+</button>
                        <button type="button" class="btn-xs btn-danger menos" 
                        data-id="${element['id']}"
                        data-tipo="menos"
                        data-producto ="${element['producto']}"
                        >-</button>
                    </td>
                    <td>${element['descuentoobras']}</td>
                    <td>$${precio.toFixed(2)}</td>
                    <td>$${totalFprod.toFixed(2)}</td>
                    <td><i class="fa fa-trash text-danger borrarProducto" data-id="${element['id']}" ></i></td>
                <tr>
                `
            );
        }else if(element.inxcolon=="2"){
            var precio=parseFloat(element['precio']);
            //aqui hace el calculo n
            var totalProd=element['cantidad']*precio;
            
           
              // calcular descuentos 
              if(element['descuentoobras']=='ADULTO MAYOR-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            } else  if(element['descuentoobras']=='Personas en situacion de discapacidad-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Fuerzas militares -50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Estudiantes-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Ministerio de Cultura -30%'){
                TotalDescuentos= totalProd * 0.3 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='socios del club vivamos el tiempo uno-30%'){
                TotalDescuentos= totalProd * 0.3 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='socios del club vivamos el tiempo dos-20%'){
                TotalDescuentos= totalProd * 0.2 ; 
                totalProd = totalProd - TotalDescuentos ;
            }
            var totalFprod = totalProd;
            //aqui hace el calculo 
            TOTAL=TOTAL+totalProd;
            $("#tablaCarrito tbody").append(
                `
                <tr>
                  
                    <td>${element['nombre']}</td> 
                    <td>${element['nombre']}</td>

                    <td>
                        ${element['cantidad']}
                        <button type="button" class="btn-xs btn-primary mas" 
                        data-id="${element['id']}"
                        data-tipo="mas"
                        >+</button>
                        <button type="button" class="btn-xs btn-danger menos" 
                        data-id="${element['id']}"
                        data-tipo="menos"
                        >-</button>
                    </td>
                    <td>${element['descuentoobras']}</td>
                    <td>$${precio.toFixed(2)}</td>
                    <td>$${totalFprod.toFixed(2)}</td>
                    <td><i class="fa fa-trash text-danger borrarProducto" data-id="${element['id']}" ></i></td>
                <tr>
                `
            );


        }
        });
        //este el valor total de todo
        $("#tablaCarrito tbody").append(
            `
            <tr>
                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                <td>$${TOTAL.toFixed(2)}</td>
                <td></td>
            <tr>
            
            `
            
        );
       
    }
    //aqui lleno la tabla  pasarela
    $.ajax({
        type: "post",
        url: "ajax/leerCarrito.php",
        dataType: "json",
        success: function (response) {
            llenarTablaPasarela(response);
        }
    });

    function llenarTablaPasarela(response){
        $("#tablaPasarela tbody").text("");
        var TOTAL=0;
        response.forEach(element => {
          
  //aqui hace el calculo 
    //aqui hace el calculo n
    var precio=parseFloat(element['precio']);
 var totalProd=element['cantidad']*precio;
  
  var totalProd = totalProd;
            

           
          
           
           
            // calcular descuentos 
            if(element['descuentoobras']=='ADULTO MAYOR-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            } else  if(element['descuentoobras']=='Personas en situacion de discapacidad-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Fuerzas militares-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Estudiantes-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Ministerio de Cultura-30%'){
                TotalDescuentos= totalProd * 0.3 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='socios del club vivamos el tiempo uno-30%'){
                TotalDescuentos= totalProd * 0.3 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='socios del club vivamos el tiempo dos-20%'){
                TotalDescuentos= totalProd * 0.2 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='grupo de 100-10%' && element['cantidad'] >=100 ){
                TotalDescuentos= totalProd* 0.1  ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='grupo de 200-20%' && element['cantidad'] >=100 ){
                TotalDescuentos= totalProd* 0.1  ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='grupo de 30-5%' && element['cantidad'] >=100 ){
                TotalDescuentos= totalProd* 0.1  ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='ADULTO MAYOR-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            } else  if(element['descuentoobras']=='Personas en situacion de discapacidad-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Fuerzas militares-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Estudiantes-50%'){
                TotalDescuentos= totalProd * 0.5 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='Ministerio de Cultura-30%'){
                TotalDescuentos= totalProd * 0.3 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='socios del club vivamos el tiempo uno-30%'){
                TotalDescuentos= totalProd * 0.3 ; 
                totalProd = totalProd - TotalDescuentos ;
            }else  if(element['descuentoobras']=='socios del club vivamos el tiempo dos-20%'){
                TotalDescuentos= totalProd * 0.2 ; 
                totalProd = totalProd - TotalDescuentos ;
            }
            TOTAL=TOTAL+totalProd;
        
            if(element['producto']=="3"){
                var totalProd = parseFloat(element['precio']);
                TOTAL=0;
               
                TOTAL= TOTAL+totalProd;
            }
         
            $("#tablaPasarela tbody").append(
                `
                <tr>
                    <td><img src="${element['web_path']}" class="img-size-50"/></td>
                    <td>${element['nombre']}</td>
                    <td>
                        ${element['cantidad']}
                        <input type="hidden" name="id[]" value="${element['id']}">
                        <input type="hidden" name="cantidad[]" value="${element['cantidad']}">
                        <input type="hidden" name="precio[]" value="${precio.toFixed(3)}">
                    </td>
                    <td>$${precio.toFixed(2)}</td>
                    <td>$${totalProd.toFixed(2)}</td>
                <tr>
                `
            );
            
               
            
    
    
            
        });
        $("#tablaPasarela tbody").append(
            `
            <tr>
                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                <td>
                $${TOTAL.toFixed(2)}
                <input type="hidden" name="total" value="${TOTAL.toFixed(2)*100}" >
                </td>
            <tr>
            `
        );
    }

    
    


    //aqui hace el calculo de los botones de la tabla carrito
    $(document).on("click",".mas,.menos",function(e){
        e.preventDefault();
        var id=$(this).data('id');
        var tipo=$(this).data('tipo');
        var producto=$(this).data('producto');

        if(producto== 1){
            $.ajax({
                type: "post",
                url: "ajax/cambiaCantidadProductos.php",
                data: {"id":id,"tipo":tipo},
                dataType: "json",
                success: function (response) {
                    llenarTablaCarrito(response);
                    llenaCarrito(response);
                }
            });
    

        }else {
            
            $.ajax({
                type: "post",
                url: "ajax/cambiaCantidadColon.php",
                data: {"id":id,"tipo":tipo},
                dataType: "json",
                success: function (response) {
                    llenarTablaCarrito(response);
                    llenaCarrito(response);
                }
            });

        }
       
        
        
    });

    $(document).on("click",".borrarProducto",function(e){
        e.preventDefault();
        var id=$(this).data('id');
        $.ajax({
            type: "post",
            url: "ajax/borrarProductoCarrito.php",
            data: {"id":id},
            dataType: "json",
            success: function (response) {
                llenarTablaCarrito(response);
                llenaCarrito(response);
            }
        });
    });
    //aqui resivo la info de la vista detalle producto
    $("#agregarCarrito").click(function (e) { 
        e.preventDefault();
        var id=$(this).data('id');
        var nombre=$(this).data('nombre');
        var web_path=$(this).data('web_path');
        var cantidad=$("#cantidadProducto").val();
        var precio=$(this).data('precio');
        var fecha=$("#SelectProduct").val();
        var producto=$(this).data('producto');

        var descuentos =$("#descuentosObra").val();
        if(descuentos == 0){
            var descuentos =$("#descuentosventasCorp").val();
        }
       
   

        //colonn datos de
        var nactividades =$(this).data('nombre');
        var inxcolon=$(this).data('idcolon');
        var preciocolon=$(this).data('precio');
        var existenciacolon=$(this).data('existencia');
        var cantidadcolon=$("#cantidadProductocolon").val();
        var fechacolon=$("#FechaColon").val();
        var descuentoscolon =$("#descuentoscolon").val();
        // datos de las salas alquiler


        
        var nombreS=$(this).data('nombre');
        var web_pathS=$(this).data('web_path');
        var cantidadS=$("#SelectCantidad").val();
        var precioS=$(this).data('precio');
        var fechaS=$("#SelectProduct").val();
        var productoS=$(this).data('producto');
        var descuentoss ="NO EXISTE";


        if(inxcolon=="2"){

        
            //var Tipodescuento = $(this).data("#Tipodescuento").val() ;
            $.ajax({
                //creo mi cookes
                type: "post",
                url: "ajax/agregarcarritoColon.php",
                data: {"id":id,"nactividades":nactividades,"cantidadcolon":cantidadcolon,"fechacolon":fechacolon,"inxcolon":inxcolon ,"existenciacolon":existenciacolon, "preciocolon":preciocolon,'descuentocolon':descuentoscolon },
                dataType: "json",
                success: function (responses) {
                    llenaCarrito(responses);
                    $("#badgeProducto").hide(500).show(500).hide(500).show(500).hide(500).show(500);
                    $("#iconoCarrito").click();
                }
            });
        }else if(producto =="1"){
            $.ajax({
                //creo mi cookes
                type: "post",
                url: "ajax/agregarCarrito.php",
                data: {"id":id,"nombre":nombre,"web_path":web_path,"cantidad":cantidad,"precio":precio,"fecha":fecha,"producto":producto,'descuentoobras':descuentos},
                dataType: "json",
                success: function (response) {
                    llenaCarrito(response);
                    $("#badgeProducto").hide(500).show(500).hide(500).show(500).hide(500).show(500);
                    $("#iconoCarrito").click();
                }
            });
    
        }else if(producto =="3"){
            $.ajax({
                //creo mi cookes
                type: "post",
                url: "ajax/agregarcarritosalas.php",
                data: {"id":id,"nombre":nombreS,"web_path":web_pathS,"cantidad":cantidadS,"precio":precioS,"fecha":fechaS,"producto":productoS,'descuentoobras':descuentoss},
                dataType: "json",
                success: function (response) {
                    llenaCarrito(response);
                    $("#badgeProducto").hide(500).show(500).hide(500).show(500).hide(500).show(500);
                    $("#iconoCarrito").click();
                }
            });
    
        }

    
    });
   
    
    function llenaCarrito(response){
        var cantidad=Object.keys(response).length;
        if(cantidad>0){
            $("#badgeProducto").text(cantidad);
        }else{
            $("#badgeProducto").text("");
        }
        $("#listaCarrito").text("");
        response.forEach(element => {
            if( element.producto == "1" || element.producto =="3"){
            $("#listaCarrito").append(
                `
                <a href="index.php?modulo=detalleproducto&id=${element['id']}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="${element['web_path']}" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                ${element['nombre']}
                                <span class="float-right text-sm text-primary"><i class="fas fa-eye"></i></span>
                            </h3>
                            <p class="text-sm">Cantidad ${element['cantidad']}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                `
            );
               }else  if(element.inxcolon == "2"){

                $("#listaCarrito").append(
                    `
                    <a href="index.php?modulo=detalleproducto&idColon=${element['id']}" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    ${element['nombre']}
                                    <span class="float-right text-sm text-primary"><i class="fas fa-eye"></i></span>
                                </h3>
                                <p class="text-sm">Cantidad ${element['cantidad']}</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    `
                );


            }
        });
        $("#listaCarrito").append(
            `
            <a href="index.php?modulo=carrito" class="dropdown-item dropdown-footer text-primary">
                Ver carrito 
                <i class="fa fa-cart-plus"></i>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer text-danger" id="borrarCarrito">
                Borrar carrito 
                <i class="fa fa-trash"></i>
            </a>
            `
        );
    }
    
    $(document).on("click","#borrarCarrito",function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "ajax/borrarCarrito.php",
            dataType: "json",
            success: function (response) {
                llenaCarrito(response);
            }
        });
    });

    var nombreRec=$("#nombreRec").val();
    var emailRec=$("#emailRec").val();
    var direccionRec=$("#direccionRec").val();
    $("#jalar").click(function (e) { 
        var nombreCli=$("#nombreCli").val();
        var emailCli=$("#emailCli").val();
        var direccionCli=$("#direccionCli").val();
        
        if( $(this).prop("checked")==true ){
            $("#nombreRec").val(nombreCli);
            $("#emailRec").val(emailCli);
            $("#direccionRec").val(direccionCli);
        }else{
            $("#nombreRec").val(nombreRec);
            $("#emailRec").val(emailRec);
            $("#direccionRec").val(direccionRec);
        }
        
    });

    var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var oilData = {
    labels: [
        "Saudi Arabia",
        "Russia",
        "Iraq",
        "United Arab Emirates",
        "Canada"
    ],
    datasets: [
        {
            data: [133.3, 86.2, 52.2, 51.2, 50.2],
            backgroundColor: [
                "#FF6384",
                "#63FF84",
                "#84FF63",
                "#8463FF",
                "#6384FF"
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
});
});