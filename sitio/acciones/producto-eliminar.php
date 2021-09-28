<?php 
require '../configuracion/conexion.php';
require '../funciones/autenticacion.php';
// Solamente un admin logueado debe poder eliminar un producto
if (!estaAutenticado() or !esAdmin()) {
	header("location:../index.php?s=Home");
	exit();
}
else {	
	require '../funciones/productos.php';
	
	if (eliminarProducto($db, $_GET['id'])) {
		eliminarProductodeCarrito($db, $_GET['id']);
		$_SESSION["feedback_type"] = "success";
		$_SESSION['feedback'] = "El producto fue eliminado del Listado para usuarios, ahora sólo será visible en pedidos";
	}
	else {
		$_SESSION["feedback_type"] = "error";
		$_SESSION['feedback'] = "Hubo un problema al eliminar el producto ID ".$_GET['id'];
	}

	header("location:../index.php?s=ABMPRODUCTOS");
}
?>
