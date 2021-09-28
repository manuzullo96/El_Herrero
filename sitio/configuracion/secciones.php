<?php
//Si el parametro s esta vacio le asigno home a seccion
$seccion = $_GET['s'] ?? 'Home';
//Indico las secciones permitidas

$seccionesPermitidas = [
    'Home' => [
        'title' => 'El Herrero'
    ],
    'Productos' => [
        'title' => 'El Herrero :: Listado de Productos'
	],
    'CarritoCompra' => [
        'title' => 'El Herrero :: Carro de compras'
	],

    'Contacto' => [
        'title' => 'El Herrero :: Contacto'
    ],
    'Listado-Detalle' => [
        'title' => 'El Herrero :: Detalle del producto'
    ],
    'Login' => [
        'title' => 'El Herrero :: Login'
    ],
    '404' => [
        'title' => 'Oops! Página no encontrada'
    ],
    'Gracias' => [
        'title' => 'Gracias por contactarnos'
    ],
    'Registrarse' => [
        'title' => 'Crear una nueva cuenta'
    ],
    'MisDatos' => [
        'title' => 'Modificar mi cuenta'
    ],
    'Checkout' => [
        'title' => 'Confirme su compra'
    ]
    ,'PedidoConfirmado' => [
        'title' => 'Su compra ha sido confirmada'
    ],
    'Error' => [
        'title' => 'Ha sucedido un error'
    ],
    'MisPedidos' => [
        'title' => 'Mis Pedidos'
    ],
    'DetallePedido' => [
        'title' => 'Ver detalle de pedido'
    ],
];

// si el usuario logueado es admin, le vamos a permitir las secciones de administración
if (isset($_SESSION['is_admin']) and $_SESSION['is_admin']) {
    $seccionesPermitidas['Admin'] = array('title' => 'panel de administración');
    $seccionesPermitidas['ABMPRODUCTOS'] = array('title' => 'ABM de productos');
    $seccionesPermitidas['PanelPedidos'] = array('title' => 'Panel de Pedidos');
    $seccionesPermitidas['Producto-crear'] = array('title' => 'Crear producto');
    $seccionesPermitidas['Producto-editar'] = array('title' => 'Editar producto');
}

//Si la seccion no aparece lo redirecciono a 404
if(!isset($seccionesPermitidas[$seccion])) {
    $seccion = "404";
}

?>