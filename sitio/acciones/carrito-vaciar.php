<?php
require '../configuracion/conexion.php';
require '../funciones/carrito.php';

// elimina el carrito de compras y manda al usuario a la Home
carritoVaciar();
header("location:../index.php?s=Home");
?>