<?php
require '../configuracion/conexion.php';
require '../funciones/carrito.php';

carritoModificar();

header("location:../index.php?s=CarritoCompra");
?>