<?php 
require 'funciones/productos.php';
// si viene un feedback por sesión lo recuperamos para mostrarlo
$feedback = "";
if (isset($_SESSION['feedback'])) {	
    $feedback = $_SESSION['feedback'];
    unset($_SESSION['feedback']);
}
?>
<section class="container">
    <h1>ALTA, BAJA Y MODIFICACIÓN DE PRODUCTOS</h1>
<?php
// Preguntamos si hay un mensaje de feedback para mostrarlo
if($feedback != ""):
?>
    <div class="form-<?=$_SESSION["feedback_type"]?>"><?= $feedback;?></div>
<?php
endif;
?>
<div class="botoncrear">
    <a class="btn btn-grad" href="index.php?s=Producto-crear">Crear producto</a>
</div>
    <div class="row">
        <?php $productos = getProductosAdmin ($db);

         foreach($productos as $producto): ?>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <a class="d-block mx-auto" href="index.php?s=Listado-Detalle&id=<?= $producto['id'];?>">
                    <img src="img/<?=$producto['foto'];?>" class="img-fluid" alt="<?=$producto['nombre'];?>"/>
                </a>
                <div class="card-body">
                    <h2 class="card-title">
                        <?=$producto['nombre'];?>
                    </h2>
                    
                    <p><B><?php if ($producto['es_visible']) echo "Visible";
                    else echo "No es visible"; ?>
                    <?php if ($producto['es_oferta']) echo " / Es oferta"; ?>
                    </B></p>
                    <p><B>PRECIO: </B><?=number_format($producto['precio'],2,",",".");?></p>
                    <p><B>CATEGORIA: </B><?=$producto['categoria'];?></p>
                    <p>
					<a class="btn btn-grad" href="index.php?s=Producto-editar&id=<?=$producto['id'];?>">Editar</a>
                    <a class="btn btn-rojo"  href="javascript:eliminar(<?= $producto['id'];?>, '<?=$producto['nombre'];?>');">Eliminar</a>
                    </p>
                    
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

<div>
    <a class="btn btn-grad" href="index.php?s=Admin">Volver a Panel</a>
</div>

</section>

<script>
function eliminar (id, nombre) {
    if (confirm("¿Desea eliminar el producto '" + nombre + "'?")) {
        location.href = "acciones/producto-eliminar.php?id=" + id;
    }
}
</script>
