<?php

/**
 * Intenta loguear al usuario con el $email y $password provistos.
 * Si son correctos, retorna un array con los datos del usuario,
 * y marca como autenticado al usuario.
 * Si no son correctos, retorna falso.
 *
 * @param mysqli $db
 * @param string $email
 * @param string $password
 * @return array|bool
 */
function login($db, $email, $password) {
    // Como el password lo tenemos que verificar desde php,
    // la consulta para buscar al usuario va a limitarse a usar
    // el email.
    // Escapamos el email.
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);
    
    // Hacemos la consulta.
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $res = mysqli_query($db, $query);
    
    // Usamos el mismo mysqli_fetch_assoc para realizar la
    // verificación.
    // mysqli_fetch_assoc si hacemos memoria, retornada un array
    // con los datos de la fila, si había un registro, o false
    // si no había registros.
    // En otras palabras, esta condición se lee:
    // "Si podemos sacar una fila del resultado...".
    if($fila = mysqli_fetch_assoc($res)){
        // El email existe, ahora tenemos que verificar si los
        // passwords coinciden.
        // como la password fue hasheada al momento de crear el usuario,
        // usamos password_verify
        if(password_verify($password, $fila['password'])) {
            // Si coinciden, entonces el password es correcto.
            // Autenticamos al usuario.
            // La idea es sencilla: vamos a guardar en una
            // variable de sesión el id del usuario.
            $_SESSION['id_usuario'] = $fila['id'];
            // Opcionalmente, pueden guardar otros datos.
            $_SESSION['email'] = $fila['email'];
	        $_SESSION['is_admin'] = ($fila['es_admin'] == 1);
            
            return true;
        }
    }
    // Si alguna condición falló, retornamos false.
    return false;
}

/**
 * Cierra la sesión.
 */
function logout() {
    unset($_SESSION['id_usuario'], $_SESSION['email'], $_SESSION['is_admin'], $_SESSION['cart']);
}


/**
 * Retorna true si el usuario está autenticado.
 * false de lo contrario.
 * @return bool
 */
function estaAutenticado() {
    return isset($_SESSION['id_usuario']);
}

/**
 * Retorna true si el usuario está autenticado.
 * false de lo contrario.
 * @return bool
 */
function esAdmin() {
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) return true;
    else return false;
}
/**
 * Retorna el email del usuario autenticado.
 *
 * @return string
 */
function autenticacionObtenerEmail() {
    return $_SESSION['email'];
}




