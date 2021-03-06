<?php include('includes/header.php');?>
</header>
<!-- MAIN -->
<section class="section">
    <?php if(isset($_POST['btnAccion'])){?>
    <!-- MUESTRA LOS PRODUCTOS GUARDADOS EN LA VARIABLE DE SESION -->
        <div class="container-all">
            <div class="container-main">
                <div class="container-img">
                    <?php $imagen=openssl_decrypt($_POST['imagen'],$COD,$KEY);?>
                    <img src="<?php echo $imagen;?>" alt="">
                </div>
                <div class="container-description">
                    <!-- Agregar un condicional if(isset) para cuando se renueve la pagina -->
                    <div class="container-header">
                        <h1><?php $nombre=openssl_decrypt($_POST['nombre'],$COD,$KEY); echo $nombre." x 1000 g"; ?></h1>
                        <h5>SystemFish | Código de producto: 1</h5>
                        <h3><b>Características principales:</b> <?php echo "llevea a tu casa lo mejor en frutas y hortalizas, han sido seleccionadas y clasificadas con los estándares de calidad que te mereces.";  ?></h3>
                    </div> <hr>
                    <div class="container-body">
                    <h3 class="precioOne">Precio Ahora: $ <?php 
                    $id = openssl_decrypt($_REQUEST['id'],$COD,$KEY);//Agregarlo al apartado de codigo del producto
                    $nombre = openssl_decrypt($_POST['nombre'],$COD,$KEY);//esto parece qué está demás

                    $precio=openssl_decrypt($_POST['precio'],$COD,$KEY); 
                    $cantidad=openssl_decrypt($_POST['cantidad'],$COD,$KEY);
                    $iva1=openssl_decrypt($_POST['iva'],$COD,$KEY); 
                    $iva = ($iva1*$precio)/100; 
                    $impoconsumo1=openssl_decrypt($_POST['impoconsumo'],$COD,$KEY); 
                    $impoconsumo= ($impoconsumo1*$precio)/100; 
                    $total1=$precio * $cantidad+$iva+$impoconsumo;
                    echo number_format($total1); 
                    $total = 0;
                    $total= $total + ($total1 * $cantidad); 
                    //me está haciendo la suma del total, sin embargo no me está enviando nada al carrito de compras
                    ?></h3>
                
                    <form action="mostrar_carrito.php" method="POST" class="form-value">
                            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($id,$COD, $KEY); ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($nombre,$COD, $KEY); ?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($precio,$COD, $KEY); ?>">
                            <input type="hidden" name="iva" id="iva" value="<?php echo openssl_encrypt($iva1,$COD, $KEY); ?>">
                            <input type="hidden" name="impoconsumo" id="impoconsumo" value="<?php echo openssl_encrypt($impoconsumo1,$COD, $KEY); ?>">
                        
                        <input type="number" placeholder="<?php  echo $cantidad; ?>" class="buttonQuanty" name="cantidad"
                        id="cantidad" value="<?php  echo 1; ?>" min="1">
                        

                        <button class="buttonConfirm" type="submit" name="btnAccion" value="Agregar">Comprar </button>
                        <button class="addCar" type="submit" name="btnAccion" value="Agregar"> <i class='bx bxs-cart-add'></i></button>
                        
                    </form>
                    
                    </div>
                    <hr>
                    <div class="container-footer">
                       <div class="Mtd-pago"><h4>Metodos de pago: </h4><i class='bx bxs-store'></i> <h6>Contra Entrega</h6></div> 
                       
                        <div class="Mtd-envio"><h4>Metodos de envío:</h4>  </h4>  <i class='bx bxs-package'></i><h6>Envío a domicilio </h6></div>
                    </div>
                        
                </div>
            </div>
       </div>
         
        <?php } ?>   
</section>


<section class="section featured">
    <div class="title"><h1>Te podría interesar</h1> </div>
    
    <div class="product-center container">
        
        <!-- PREPARA Y ALMACENA LOS DATOS EN UNA VARIABLE -->
        <?php
            $sentencia=$pdo->prepare("SELECT * FROM `productos`");//VARIABLE PDO IN THE ARCHIVE OF CONEXION
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!-- CICLO PARA MOSTRAR LOS PRODUCTOS  -->
        <?php foreach($listaProductos as $producto){ ?>
            <div class="product">
                <div class="product-header">
                    
                        <img title="<?php echo $producto['nombre_producto']; ?>"
                        src="<?php echo $producto['imagen_producto']; ?>"
                        alt="<?php echo $producto['nombre_producto']; ?>">
               
                    <!-- ICONO DE AGREGAR AL CARRITO -->
                    <ul class="icons">
                        <a href="mostrar_carrito.php"><span><i class="bx bx-shopping-bag"></i></span></a>   
                    </ul>
                    <!-- DETALLES DEL PRODUCTO -->
                    <div class="product-footer">
                        <a href="#"><h3 class="item-title"><?php echo $producto['nombre_producto'];?></h3></a>
                        <h5>Precio Ahora </h5>
                        <h4 class="price">$<?php echo $producto['precio_producto']." Kg";?></h4>
                        <!-- FORMULARIO PARA ENVIAR LA INFORMACIÓN ENCRIPTADA AL CARRITO DE COMPRAS -->
                        <form action="" method="POST">
                            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id_productos'],$COD,$KEY); ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre_producto'],$COD,$KEY); ?>">
                            <input type="hidden" name="imagen" id="imagen" value="<?php echo openssl_encrypt($producto['imagen_producto'],$COD, $KEY); ?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio_producto'],$COD,$KEY); ?>">
                            <input type="hidden" name="iva" id="iva" value="<?php echo openssl_encrypt($producto['iva'],$COD,$KEY); ?>">
                            <input type="hidden" name="impoconsumo" id="impoconsumo" value="<?php echo openssl_encrypt($producto['impoconsumo'],$COD,$KEY); ?>">
                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,$COD,$KEY); ?>">
                            <button class="button-product" 
                            type="submit" 
                            name="btnAccion" 
                            value="Agregar">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

 
<?php include('includes/footer.php'); ?>