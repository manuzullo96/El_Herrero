<?php
/*
Acá vamos a recibir el carro de compras de la variable de sesión y crearemos el pedido
*/
require '../configuracion/conexion.php';
require '../funciones/autenticacion.php';

// como control, si se llega a llamar a este php sin usuario logueado ni un carrito de compras, nos vamos
if (!estaAutenticado() || !isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0) {
    //print_r($_SESSION);die;
    header("location:../index.php?s=Home");
    exit();
}

require '../funciones/productos.php';
require '../funciones/pedidos.php';

/*
se creará un nuevo registro en la tabla pedidos con el id del usuario, 
la fecha y hora de la compra, y el monto total.
usando el id autonumérico resultante se creará el detalle de la compra en la tabla carrito
*/
$pedido = array();
$producto = array();
$detalle = array();
$monto = 0;
foreach($_SESSION["cart"] as $idproducto=>$cantidad) {
    $producto = getProductoById($db,$idproducto);
    $producto["cantidad"] = $cantidad;
    $producto["subtotal"] = ($cantidad * $producto["precio"]);
    $monto += $producto["subtotal"];
    $detalle[] = $producto;
}

$idpedido = crearPedido($db,$monto);
if (!$idpedido) {
    // si no nos está devolviendo el id del nuevo pedido es porque algo salió mal en la base de datos
    // en ese caso no podemos continuar, tendríamos que devolver a una pantalla de error
    $_SESSION["error"] = "Algo salió mal cuando creamos su pedido. Por favor vuelva a intentar más tarde.";
    header("location:../index.php?s=Error");
    exit();
}

/*echo "idpedido:".$idpedido;
echo "\ndetalle\n";
print_r($DETALLE);*/
foreach($detalle as $item) {
    $data = array("idpedido" => $idpedido, "idproducto" => $item["id"], "cantidad" => $item["cantidad"], "precio" => $item["precio"], "subtotal" => $item["subtotal"]);
    /*echo "\n<br>data\n";
    print_r($data);*/
    if (!crearDetalle($db,$data)) {
        $_SESSION["error"] = "Algo salió mal cuando confirmábamos su compra. Por favor vuelva a intentar más tarde.";
        header("location:../index.php?s=Error");
        exit();
    }
    $data = array();
}
// eliminamos la variable de sesión del carrito
unset($_SESSION["cart"]);

header("location:../index.php?s=PedidoConfirmado");

?>