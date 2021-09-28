<?php require 'funciones/pedidos.php';?>
<section class="container">
    <h1>DETALLE DE PEDIDO</h1>

    <div class="row">
<?php 
        // parseamos la variable de get, si algo sale mal queda en 0
        $idpedido = (isset($_GET["idpedido"]) and is_numeric($_GET["idpedido"]) and $_GET["idpedido"] > 0) ? (int)$_GET["idpedido"] : 0;
        // dependiendo si el usuario logueado es admin o no, volvemos al panel de control o a la home
        $location = (esAdmin()) ? "PanelPedidos" : "MisPedidos";
        // si la variable de id de pedido vino mal, volvemos
        if (!$idpedido) {
            header("location:index.php?s=".$location);
            exit();
        }
        $pedido = getPedidoById($db,$idpedido);
        // si no existe en la base un pedido con ese id, volvemos
        if (count($pedido) == 0) {
            header("location:index.php?s=".$location);
            exit();
        }
        $leyenda = ($pedido["cumplido"]) ? "Cumplido" : "No cumplido";
?>
        <div class="ofert">
            <ul>
                <li><b>Fecha y hora:</b> <?=$pedido["fechayhora"]?></li>
                <li><b>Usuario:</b> <?=$pedido["fullname"]?></li>
                <li><b>Monto:</b> $<?=number_format($pedido["monto"], 2, ',', '.');?></li>
                <li><b>Status:</b> <?=$leyenda?></li>
            </ul>
        </div>
    </div>
    <div class="row">
<?php
        $detalle = getDetalle ($db,$idpedido);
        foreach($detalle as $item):
?>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <a class="d-block mx-auto" href="index.php?s=Listado-Detalle&id=<?= $item['idproducto'];?>">
                    <img src="img/<?=$item['foto'];?>" class="img-fluid" alt="<?=$item['nombre'];?>"/>
                </a>
                <div class="card-body">
                    <h2 class="card-title">
                        <a href="index.php?s=Listado-Detalle&id=<?= $item['idproducto'];?>"><?=$item['nombre'];?></a>
                    </h2>
                    <P><B>PRECIO: </B>$<?=number_format($item['precio'], 2, ',', '.');?></P>
                    <P><B>CANTIDAD: </B><?=$item['cantidad'];?></P>
                    <P><B>SUBTOTAL: </B>$<?=number_format($item['subtotal'], 2, ',', '.');?></P>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <a class="btn btn-grad" href="index.php?s=<?=$location?>">Volver</a>
</section>
