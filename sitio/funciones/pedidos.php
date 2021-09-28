<?php
//Operaciones en la base de datos

/**
 *Trae todos los pedidos.
 * @param $db string
 */
function getPedidos($db) {
    //Trae todos los pedidos
    $query = "SELECT p.id, p.idusuario, p.fechayhora, p.monto, 
    (select COUNT(c.clavecarrito) FROM carrito c WHERE c.idpedido = p.id) as items, 
    u.fullname, p.cumplido  FROM pedidos p INNER JOIN usuarios u ON p.idusuario=u.id 
    ORDER BY p.fechayhora DESC";

    return mysqli_query($db, $query);
}

/**
 *Trae todos los pedidos del usuario.
 * @param $db string
 * @param $idusuario int
 */
function getMisPedidos($db, $idusuario) {
    $idusuario = mysqli_real_escape_string($db, $idusuario);
    //Trae todos los pedidos de un usuario
    $query = "SELECT p.id, p.fechayhora, p.monto, u.fullname,
    (select COUNT(c.clavecarrito) FROM carrito c WHERE c.idpedido = p.id) as items, p.cumplido 
    FROM pedidos p INNER JOIN usuarios u ON p.idusuario=u.id where p.idusuario=".$idusuario." 
    ORDER BY p.fechayhora DESC";

    return mysqli_query($db, $query);
}

/**
 *Marca todos los pedidos del usuario.
 * @param $db string
 * @param $idupedido int
 * @param $status string
 */
function marcarPedido($db, $idpedido, $status) {
    $idpedido = mysqli_real_escape_string($db, $idpedido);
    $status = mysqli_real_escape_string($db, $status);
    //Trae todos los pedidos de un usuario
    $query = "UPDATE pedidos SET cumplido = ".$status." WHERE id = ".$idpedido;

    return mysqli_query($db, $query);
}

/**
 *Trae el detalle del pedido.
 * @param $db string
 * @param $idupedido int
 */
function getDetalle($db,$idpedido) {
    $idpedido = mysqli_real_escape_string($db, $idpedido);
    //Trae el detalle de un pedido
    $query = "SELECT c.idproducto, c.cantidad, c.precio, c.subtotal, p.nombre, p.foto 
    FROM carrito c INNER JOIN productos p ON c.idproducto = p.id WHERE c.idpedido = ".$idpedido;
    //echo $query;

    return mysqli_query($db, $query);
}

/**
 *Trae un pedido desde el id.
 * Devuelve con un array el pedido.
 * @param $db string
 * @param $id int
 */
function getPedidoById($db,$Id) {
    $id = mysqli_real_escape_string($db, $Id);

    //Trae un pedido con su carro de compras
    $queryProductobyId = "SELECT p.id, p.idusuario, p.fechayhora, p.monto, 
    (select COUNT(c.clavecarrito) FROM carrito c WHERE c.idpedido = p.id) as items, 
    u.fullname, p.cumplido  FROM pedidos p, usuarios u where p.idusuario=u.id and p.id=".$id;
    //echo $queryProductobyId;

    $ProductoDetalle = mysqli_query($db, $queryProductobyId);
    /*echo "ProductoDetalle:";
    print_r($ProductoDetalle);*/

    // tomamos todas las precauciones por si la consulta da error o si no devuelve registros
    if (!$ProductoDetalle or $ProductoDetalle == null) return array();
    else {
        $ProductoDetalle = mysqli_fetch_assoc($ProductoDetalle);
        //echo "ProductoDetalle2:";
        if ($ProductoDetalle != null) {
            //print_r($ProductoDetalle);
            return $ProductoDetalle;
        }
        else {
            //echo "null";
            return array();
        }
    }
}

/**
 *Crea un nuevo pedido y le inserta el monto y el usuario y retorna un true o false (booleano).
 * Devuelve con un array el pedido.
 * @param $db string
 * @param $id int
 */
function crearPedido($db, $monto) {
  //Crea el pedido
    $idusuario =  mysqli_real_escape_string($db, $_SESSION['id_usuario']);

    $query = "INSERT INTO pedidos (idusuario, monto) VALUES ($idusuario, $monto)";
    //echo $query;die;
    // Ejecutamos el query.
    // Como la consulta es un INSERT, mysqli_query retorna
    // true o false.
    $exito = mysqli_query($db, $query);
    if ($exito) {
        $exito = mysqli_query($db, "SELECT MAX(id) AS id FROM pedidos");
        if (!$exito) return false;
        else {
            $idpedido = mysqli_fetch_assoc($exito);
            if (isset($idpedido["id"])) return $idpedido["id"];
            else return false;
        }
    }
    else return false;
}

/**
 *Crea el detalle y lo inserta en el carrito y retorna un query procesado.
 * @Param $db string
 * @Param $data array
 * @return array
 */
function crearDetalle($db, $data) {
    //Crea el detalle vinculado al pedido en la tabla carrito
  
    $query = "INSERT INTO carrito (idpedido, idproducto, cantidad, precio, subtotal) 
    VALUES (".$data["idpedido"].", ".$data["idproducto"].", ".$data["cantidad"].", ".$data["precio"].", ".$data["subtotal"].")";
    //echo $query;die;
    // Ejecutamos el query.
    // Como la consulta es un INSERT, mysqli_query retorna
    // true o false.
    return mysqli_query($db, $query);
}