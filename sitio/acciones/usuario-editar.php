<?php
require '../configuracion/conexion.php';
require '../funciones/usuarios.php';

/*echo "\npost\n";
print_r($_POST);*/

$old_data = [];
$old_data = getUsuarioById($db, $_SESSION['id_usuario']); 
/*echo "\nolddata\n";
print_r($old_data);*/

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $_SESSION["feedback_type"] = "error";
    $_SESSION['feedback'] = 'El email ingresado no es válido.';
    $_SESSION['old_data'] = $_POST;
    header("Location: ../index.php?s=MisDatos");
}
else{
    // Si el email que viene por el post es distinto del viejo, chequeemos que no esté repetido en otro usuario
    if ($old_data["email"] != $_POST["email"]) {
        //Si el e-mail nuevo está repetido en otro usuario no hacemos la modificación
        if(checkEmailRepeatedOtherUser($db, $_SESSION['id_usuario'], $_POST["email"])) {
            $_SESSION["feedback_type"] = "error";
            $_SESSION['feedback'] = 'Si desea modificar su e-mail debe ingresar uno que no esté en nuestra base de datos.';
            header("Location: ../index.php?s=MisDatos");
            exit();
        }
    }
    // si no se cambió el e-mail o el nuevo no está en la base, procedemos a actualizar los datos
    if (editarUsuario($db,$_SESSION['id_usuario'],$_POST)) {
        $_SESSION["feedback_type"] = "success";
        $_SESSION['feedback'] = 'Los datos fueron modificados con éxito.';
        header("Location: ../index.php?s=MisDatos");
    }
    else {
        $_SESSION["feedback_type"] = "error";
        $_SESSION['feedback'] = 'Hubo un error. Por favor intente nuevamente.';
        header("Location: ../index.php?s=MisDatos");
    }
}
?>