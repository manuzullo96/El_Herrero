<?php 
// si el carrito llega a estar vacío, redirijo al Listado de productos
if (!isset($_SESSION['cart']) || count($_SESSION['cart'])==0) {
    header("location:index.php?s=Productos");
    exit();
}

require 'funciones/productos.php';

// vamos a crear el pedido a partir del carrito para que se imprima
$pedido = array();
$producto = array();
$monto = 0;
foreach($_SESSION['cart'] as $idproducto=>$cantidad):
    $producto = getProductoById($db,$idproducto);
    $producto["cantidad"] = $cantidad;
    $producto["subtotal"] = ($cantidad * $producto["precio"]);
    $pedido[] = $producto;
    $monto += $producto["subtotal"];
endforeach;
?>
<section class="container">
    <h1>CONFIRME SU COMPRA</h1>

    <p><b>Monto:</b> $<?=number_format($monto, 2, ',', '.');?></p>
    <div class="container">
        <div class="row">  
        <?php foreach($pedido as $producto): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a class="d-block mx-auto" href="index.php?s=Listado-Detalle&id=<?= $producto['id'];?>">
                <img  src="img/<?=$producto['foto'];?>" alt="<?=$producto['nombre'];?>"/>
                </a>
                <div class="card-body">
                    <h2 class="card-title">
                    <a href="index.php?s=Listado-Detalle&id=<?= $producto['id'];?>"><?=$producto['nombre'];?></a>
                    </h2>
                    <p><B>CANTIDAD: </B><?=$producto['cantidad']?></p>
                    <p><B>PRECIO: </B>$<?=number_format($producto['precio'], 2, ',', '.');?></p>
                    <p><B>SUBTOTAL: </B>$<?=number_format($producto['subtotal'], 2, ',', '.');?></p>
                    </div>
                </div>			
            </div>
        <?php endforeach; ?>	  
        </div>
    </div>
    <form name="confirmar_pedido" method="get" action="acciones/pedido-confirmar.php">
        <div class="ofert">
            <input type="submit" value="Confirmar la compra" class="btn btn-grad">
            <a class="btn btn-rojo" href="acciones/carrito-vaciar.php">Cancelar la compra</a>
        </div>
    </form>


    <div class="ofert">
        <div class="botonlist">
            <a  class="btn btn-grad" href="index.php?s=CarritoCompra">Volver al carro de compras</a>
        </div>
    </div>




</section>