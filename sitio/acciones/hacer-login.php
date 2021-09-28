<?php
/*
Acá vamos a recibir las credenciales del form de login, y 
verificar que sean válidas.
Si lo son, lo vamos a autenticar, y redirigir a la sección de
noticias.
Si no, como es costumbre, lo pateamos al login de nuevo para
que arregle los datos.
*/

require '../configuracion/conexion.php';
require '../funciones/autenticacion.php';

$email = trim($_POST['email']);
$password = trim($_POST['password']);

// primero chequeamos que el email ingresado sea válido
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // si el email no es válido, lo devuelvo a login con un mensaje de error
    $_SESSION["feedback_type"] = "error";
    $_SESSION['feedback'] = 'El email ingresado no es válido.';
    $_SESSION['old_data'] = $_POST;
    header("Location: ../index.php?s=Login");
}
else{
    // Verificamos si el usuario es correcto.   
    if(login($db, $email, $password)) {
        // si había un mensaje de feedback anterior (login incorrecto), lo elimino
        if (isset($_SESSION['feedback'])){
            unset($_SESSION['feedback']);
        }
        // si el usuario es un admin, va al panel de control. si no, va a la home
        if (esAdmin()) {
            header("Location: ../index.php?s=Admin");
        }
        else {
            header("Location: ../index.php?s=Home");
        }        
    } 
    // si no se pudo loguear, lo devuelvo al login con un mensaje de error
    else {
        $_SESSION["feedback_type"] = "error";
        $_SESSION['feedback'] = 'Las credenciales ingresadas no coinciden con nuestros registros.';
        $_SESSION['old_data'] = $_POST;
        header("Location: ../index.php?s=Login");
    }
}


