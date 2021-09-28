<?php 
require 'funciones/productos.php';
$busqueda =  (isset($_GET["busqueda"])) ? trim($_GET["busqueda"]) : "";
?>
<section class="container">
    <h1>Listado de Productos</h1>

    <form name="fbusqueda" action="index.php" method="GET">    
    <div class="form-group row">
    <div class="col-xs-2 ml-3">
        <input class="form-control" type="hidden" name="s" value="Productos">
        <input class="form-control" type="text" name="busqueda" value="<?=$busqueda?>">
    </div>
        <input type="submit" value="Buscar" class="btn btn-grad ml-1">
    </div>
    </form>
<?php
if ($busqueda != "") {
?>
<a href="index.php?s=Productos">Volver a listado completo</a>
<?php
}

$pagina = (isset($_GET["pag"]) && is_numeric($_GET["pag"])) ? (int)$_GET["pag"] : 1;
dibujarPaginador($db,$busqueda,$pagina);

$productos = getProductos ($db,$busqueda,$pagina);
?>
    <div class="row">
        <?php foreach($productos as $producto): ?>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <a class="d-block mx-auto" href="index.php?s=Listado-Detalle&id=<?= $producto['id'];?>">
                    <img src="img/<?=$producto['foto'];?>" class="img-fluid" alt="<?=$producto['nombre'];?>"/>
                </a>
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="index.php?s=Listado-Detalle&id=<?= $producto['id'];?>"><?=$producto['nombre'];?></a>
                    </h3>
                    
                    <p><B>PRECIO: </B>$<?=number_format($producto['precio'],2,",",".");?></p>
                    <p><B>CATEGORIA: </B><?=$producto['categoria'];?></p>
                    
                    <?php
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
                    else {
                    ?>
                    <button type="button" onclick="location.href='index.php?s=Login';" class="btn btn-grad">Comprar Ahora</button>
                    <?php
                    } // end if usuario logueado
                    ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
