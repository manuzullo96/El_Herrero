<?php 

require '../configuracion/conexion.php';
require '../funciones/autenticacion.php';
// Solamente un admin logueado debe poder eliminar un producto
if (!estaAutenticado() or !esAdmin()) {
	header("location:index.php?s=Home");
	exit();
}
else {	
	require '../funciones/pedidos.php';

	$idpedido = (isset($_GET["idpedido"]) && is_numeric($_GET["idpedido"]) && (int)$_GET["idpedido"] > 0) ? (int)$_GET["idpedido"] : 0;
	if (!$idpedido) {
		header("location:index.php?s=PanelPedidos");
		exit();
	}
	$accion = (isset($_GET["accion"]) && ($_GET["accion"] == 0 || $_GET["accion"] == 1)) ? $_GET["accion"] : "error";
	if ($accion == "error") {
		header("location:index.php?s=PanelPedidos");
		exit();
	}

	marcarPedido($db, $idpedido, $accion);

	header("location:../index.php?s=PanelPedidos");
}
?>
