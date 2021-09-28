<?php 
// si el carrito llega a estar vacío, redirijo al Listado de productos
if (!isset($_SESSION['cart']) || count($_SESSION['cart'])==0) {
    header("location:index.php?s=Productos");
    exit();
}

require 'funciones/productos.php';
/*echo "POST:";
print_r($_POST);*/

// vamos a recrear el carrito para que se imprima
$carrito = array();
$producto = array();
$monto = 0;
foreach($_SESSION['cart'] as $idproducto=>$cantidad):
    $producto = getProductoById($db,$idproducto);
    $producto["cantidad"] = $cantidad;
    $producto["subtotal"] = ($cantidad * $producto["precio"]);
    $carrito[] = $producto;
    $monto += $producto["subtotal"];
endforeach;

?>
<section class="container">
    <h1>CARRO DE COMPRAS</h1>

    <p><b>Monto:</b> $<?=number_format($monto, 2, ',', '.');?></p>
    <div class="container">
        <div class="row">  
        <?php foreach($carrito as $producto): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a class="d-block mx-auto" href="index.php?s=Listado-Detalle&id=<?= $producto['id'];?>">
                <img  src="img/<?=$producto['foto'];?>" alt="<?=$producto['nombre'];?>"/>
            </a>
                <div class="card-body">
                    <h2 class="card-title">
                    <a href="index.php?s=Listado-Detalle&id=<?= $producto['id'];?>"><?=$producto['nombre'];?></a>
                    </h2>
                    
                    <form name="modificar<?= $producto['id'];?>" method="post" action="acciones/carrito-modificar.php">
                    <input type="hidden" name="idproducto" value="<?= $producto['id'];?>">
                    
                    <div class="form-group">
                        <label for="cantidad<?= $producto['id'];?>"><b>CANTIDAD: </b></label>
                        <input class="agregar form-control col-xs-2" type="number" name="cantidad" id="cantidad<?= $producto['id'];?>" value="<?=$producto['cantidad'];?>" min="1" max="10000">
                    </div>
                        <input type="submit" value="Modificar cantidad" class="btn btn-grad">
                    </form>


                    <P><B>PRECIO: </B>$<?=number_format($producto['precio'], 2, ',', '.');?></P>
                    <P><B>SUBTOTAL: </B>$<?=number_format($producto['subtotal'], 2, ',', '.');?></P>
                    
                    <form name="eliminar<?= $producto['id'];?>" method="post" action="acciones/carrito-sacar.php">
                    <input type="hidden" name="idproducto" value="<?= $producto['id'];?>">
                    <input type="submit" value="Sacar del carrito" class="btn btn-rojo">
                    </form>
                    </div>
                </div>			
            </div>
        <?php endforeach; ?>	  
        </div>
    </div>
    <form name="carrito_checkout" method="get" action="index.php">
    <input type="hidden" name="s" value="Checkout">
    <div class="ofert">
        <input type="submit" value="Checkout" class="btn btn-grad">
        <a class="btn btn-rojo" href="acciones/carrito-vaciar.php">Vaciar carrito</a>
    </div>
    </form>

    <div class="ofert">
        <div class="botonlist">
            <a class="btn btn-grad" href="index.php?s=Productos">Volver al listado</a>
        </div>
    </div>


</section>