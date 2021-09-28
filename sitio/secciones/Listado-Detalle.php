<?php
require 'funciones/productos.php';

//Obtengo el valor del id que recibo como parametro, primero valido que sea un número mayor a 0
// si no, vamos de vuelta a la pantalla de productos
$id = (isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] > 0) ? (int)$_GET['id'] : 0;
//echo "id: ".$id;
if ($id == 0) {
    header("Location: index.php?s=Productos");
    exit();
}

$producto = getProductoById($db,$id);

// Por precaución debemos chequear que el producto exista en la base de datos
// Si el id enviado por get no existe en la base de datos, vamos de vuelta a la pantalla de productos
if (count($producto) == 0) {
    header("Location: index.php?s=Productos");
    exit();
}

//print_r($producto);
?>

<section id="listado-detalle">
    <div class="conteiner">
        <div class="tarjeta-detalle">
            <div class="left-column">
                <img src="img/<?=$producto['foto'];?>" alt="<?=$producto['nombre'];?>">
            </div>
            <div class="right-column">
                <div class="producto-nombre">
                    <h1><?=$producto['nombre'];?></h1>
                    <p><B>DETALLE: </B><?=$producto['detalle'];?></p>
                </div>

                    <div>
                        <p><B>PRECIO: </B>$<?=number_format($producto['precio'],2,",",".");?></p>
                        <p><B>CATEGORIA: </B><?=$producto['categoria'];?></p>

                        <?php
                        // si el usuario está logueado le dejamos comprar
                        if (estaAutenticado()) {
                            ?>

                            <form name="compra<?= $producto['id'];?>" action="acciones/carrito-agregar.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $producto['id'];?>">
                                <div class="form-group">
                                    <input class="agregar form-control col-xs-2" type="number" value="1" min="1" max="10000">
                                </div>
                                <button type="submit"  class="btn btn-grad">Comprar Ahora</button>
                            </form>



                            <?php
                        }
                        // si el usuario no está logueado el botón de comprar le redirigirá al login
                        else {
                            ?>
                            <button type="button" onclick="location.href='index.php?s=Login';" class="btn btn-grad">Comprar Ahora</button>
                            <button type="button" onclick="location.href='index.php?s=Productos';" class="btn btn-volver">Volver</button>
                            <?php
                        } // end if usuario logueado
                        ?>


                </div>
            </div>
        </div>
    </div>
</section>


