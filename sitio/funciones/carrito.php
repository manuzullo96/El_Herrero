<?php
/*
El carrito se guardará en una variable de sesión con la siguiente estructura
$_SESSION["cart"][id de producto] = cantidad;
*/

/**
 *Levanta el POST de la funcion del carritoArgregar
 *Agrega la cantidad a la variable de session en el carrito los id de los productos.
 *
 */
function carritoAgregar() {
    // parseo la variable post cantidad, llega a venir algo mal le pongo 1
    $cantidad = (isset($_POST["cantidad"]) && is_numeric($_POST["cantidad"]) && (int)$_POST["cantidad"] > 0) ? (int)$_POST["cantidad"] : 1;

    // si cantidad es menor a 1 no hacemos nada
    if ($cantidad > 0) {
        // si el producto agregado ya estaba en el carrito, le incrementa la cantidad
        if(isset($_SESSION['cart'][$_POST['product_id']])){
            $_SESSION['cart'][$_POST['product_id']] += $cantidad;
        }
        // si el producto es nuevo en el carrito, o incluso si es el primero
        else {
            $_SESSION['cart'][$_POST['product_id']] = $cantidad;
        }
    }
}

/**
 *Elimina el producto del carrito de compras.
 */
function carritoEliminar() {
    // eliminamos el registro correspondiente al producto
    unset($_SESSION['cart'][$_POST['idproducto']]);
}

/**
 *Modifica el numero del carrito si es un numero.
 */
function carritoModificar() {
    // recibe y parsea el cantidad que viene por post, debe ser número entero
    // si llega a venir mal o en 0, no hacemos nada
    $cantidad = (isset($_POST["cantidad"]) && is_numeric($_POST["cantidad"])) ? (int)$_POST["cantidad"] : 0;
    if ($cantidad > 0) {
        $_SESSION['cart'][$_POST['idproducto']] = $cantidad;
    }
}

/**
 *Elimina el carrito de compras.
 */
function carritoVaciar() {
    // directamente elimina la variable de sesión del carrito
    unset($_SESSION['cart']);
}
?>