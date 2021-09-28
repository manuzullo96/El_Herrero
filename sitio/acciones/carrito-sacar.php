<?php
require '../configuracion/conexion.php';
require '../funciones/carrito.php';

carritoEliminar();

// si el carrito queda vacío, redirijo al Listado de productos
if (count($_SESSION['cart']) == 0) {
    header("location:../index.php?s=Productos");
}
else {
    header("location:../index.php?s=CarritoCompra");
}
?>