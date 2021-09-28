<?php
/*Agrego el item al Carrito de compras y redirijo a la sección
lo hago así para que si el usuario da actualizar en el carrito de compras 
no se repita la operación de agregar*/
require '../configuracion/conexion.php';
require '../funciones/carrito.php';

carritoAgregar();

header("location:../index.php?s=CarritoCompra");
?>