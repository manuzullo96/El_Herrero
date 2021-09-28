<?php require 'funciones/pedidos.php';?>
<section class="container">
    <h1>MIS PEDIDOS</h1>
<?php 
$pedidos = getMisPedidos ($db,$_SESSION["id_usuario"]);
if (isset($pedidos->num_rows) and $pedidos->num_rows == 0) {
    echo "<p>Todavía no tiene pedidos</p>";
}
else {
?>
    <div class="row">
<?php
    foreach($pedidos as $pedido): 
?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <p><b>Fecha y hora:</b> <?=$pedido["fechayhora"]?></p>
                    <p><b>Monto:</b> $<?=number_format($pedido["monto"],2,",",".");?></p>
                    <p><b>Cantidad de items:</b> <?=$pedido["items"]?></p>
                    <p><b>
                        <?php if ($pedido["cumplido"]) echo "Pedido cumplido";
                        else echo "Pedido no cumplido";?>
                        </b>
                    </p>
                    <p><a class="btn btn-grad" href="index.php?s=DetallePedido&idpedido=<?=$pedido["id"]?>">Ver detalle</a></p>
                </div>
            </div>
        </div>
<?php 
    endforeach;
?>
    </div>
<?php
} // end if
?>

</section>
