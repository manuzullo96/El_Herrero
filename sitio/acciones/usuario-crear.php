<?php
require '../configuracion/conexion.php';
require '../funciones/usuarios.php';

/*echo "post";
print_r($_POST);*/

// primero chequeamos que el email sea válido
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $_SESSION["feedback_type"] = "error";
    $_SESSION["feedback"] = 'El email ingresado no es válido.';
    $_SESSION['old_data'] = $_POST;
    header("Location: ../index.php?s=Registrarse");
}
else{
    // luego verificamos que el email no esté repetido en la base de datos
    if(checkEmailRepeated($db, $_POST["email"])) {
        $_SESSION["feedback_type"] = "error";
        $_SESSION["feedback"] = 'El email ingresado ya existe en nuestra base de datos.';
        $_SESSION['old_data'] = $_POST;
        header("Location: ../index.php?s=Registrarse");
    }
    else {
        // si el email no está repetido, chequeamos que la contraseña y su confirmación coincidan
        if ($_POST["password"] != $_POST["cpassword"]) {
            $_SESSION["feedback_type"] = "error";
            $_SESSION['feedback'] = 'La contraseña debe coincidir con su confirmación.';
            $_POST["cpassword"] = $_POST["password"] = "";
            $_SESSION['old_data'] = $_POST;
            header("Location: ../index.php?s=Registrarse");
        }
        else {
            // intentamos crear el usuario. en caso de éxito lo llevamos al login
            if (crearUsuario($db,$_POST)) {
                $_SESSION["feedback_type"] = "success";
                $_SESSION['feedback'] = 'El usuario ha sido creado con éxito. Ya puede loguearse.';
                header("Location: ../index.php?s=Login");
            }
            else {
                $_SESSION["feedback_type"] = "error";
                $_SESSION['feedback'] = 'Hubo un error. Por favor intente nuevamente.';
                $_SESSION['old_data'] = $_POST;
                header("Location: ../index.php?s=Registrarse");
            }
        }
    }
}


?>