<?php require 'funciones/pedidos.php';?>
<section class="container">
    <h1>PANEL DE PEDIDOS</h1>

    <ul>
        <?php $pedidos = getPedidos ($db);
         foreach($pedidos as $pedido): 
            if ($pedido["cumplido"]) {
                $leyenda = "Pedido cumplido";
                $accion = "0";
                $link = "Marcar como no cumplido";
            }
            else {
                $leyenda = "Pedido no cumplido";
                $accion = "1";
                $link = "Marcar como cumplido";
            }
         ?>
      
        <li class="nopunto">
      <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
      <div class="card-body">
            <p><b>Fecha y hora:</b> <?=$pedido["fechayhora"]?></p>
            <p><b>Usuario:</b> <?=$pedido["fullname"]?></p>
            <p><b>Monto:</b> $<?=number_format($pedido["monto"], 2, ',', '.');?></p>
            <p><b>Cantidad de items:</b> <?=$pedido["items"]?></p>
            <p><b><?=$leyenda?></b></p>
            <p><a class ="btn btn-grad" href="acciones/pedido-marcar.php?idpedido=<?=$pedido["id"]?>&accion=<?=$accion?>"><?=$link?></a></p>
            <p><a class ="btn btn-grad" href="index.php?s=DetallePedido&idpedido=<?=$pedido["id"]?>">Ver detalle</a></p>
        </div>
        </div> 
        </div>        
        </li>
        
        <?php endforeach; ?>
    </ul>
    <div class="ofert">
        <a class="btn btn-grad" href="index.php?s=Admin">Volver a Panel</a>
    </div>

</section>
