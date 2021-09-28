<?php
/*
En este archivo, vamos a hacer el cierre de la sesión, en otras
palabras, desautenticar al usuario, de manera que cuando visite
de nuevo panel se le requiere re autenticarse.
*/
// Arrancamos la sesión.
//require '../../bootstrap/conexion.php';

require '../configuracion/conexion.php';
require '../funciones/autenticacion.php';


// Borramos las variables de sesión de la autenticación.
logout();
// session_destroy destruye todas las variables de sesión para
// este visitante.
// Es posible que haya otros módulos del sistema que utilicen
// variables de sesión para otras funcionalidades que no tengan
// que ver con la autenticación.
// Con el session_destroy() si ocurre ese escenario, se pierden
// esos valores.
//session_destroy();

// Redireccionamos.
header("Location: ../index.php?s=Home");