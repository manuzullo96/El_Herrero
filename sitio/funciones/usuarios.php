<?php

// Desde el Registrarse
/**
 * Crea el usuario con el email y password, inserta el email y password y lo retorna a la base de datos.
 * @Param $db
 * @Param $data
 */
function crearUsuario($db,$data) {
    /*echo "data";
    print_r($data);*/
    $email = mysqli_real_escape_string($db, $data['email']);
    // HACER HASH https://www.php.net/manual/es/faq.passwords.php
    //echo $data['password'];
    $password = password_hash(mysqli_real_escape_string($db, $data['password']), PASSWORD_DEFAULT);
    //echo "<br>".$password."<br>";

    // $query = "INSERT INTO USUARIOS (email,`password`) VALUES ('$email', '$password')";
    $query = "INSERT INTO USUARIOS (email,`password`, domicilio, telefono, fullname, es_admin) VALUES ('$email', '$password', '', '', '', 0)";

    //echo $query;die;
    // Ejecutamos el query.
    // Como la consulta es un INSERT, mysqli_query retorna true o false.
    return mysqli_query($db, $query);
}

/**
 *Se usamo en el Registrarse para chequear que no se inscriba alguien con email repetido
 * @Param $db string
 * @Param $email string
 */
function checkEmailRepeated($db,$email) {
    $query = "SELECT * FROM usuarios WHERE email='".$email."'";
    //echo $query;die;
    $reg = mysqli_query($db, $query);
    $reg = mysqli_fetch_assoc($reg);
    /*echo "\nreg\n";
    print_r($reg);*/
    if ($reg != null and count($reg) >  0) return true;
    else return false;
}


/**
*Se usa en el Mis Datos para evitar que se le "robe" el usuario a alguien más
 * @Param $db string
 * @Param $id int
 * @Param $email string
 */
function checkEmailRepeatedOtherUser($db,$id,$email) {
    $query = "SELECT * FROM usuarios WHERE email='".$email."' AND id <> $id";
    //echo $query;die;
    $reg = mysqli_query($db, $query);
    $reg = mysqli_fetch_assoc($reg);
/*    echo "\nreg\n";
    print_r($reg);*/
    if ($reg != null and count($reg) >  0) return true;
    else return false;
}
/**
*LLama a los datos del usuario desde la base datos por id.
 * @Param $db string
 * @Param $id int
 */
function getUsuarioById($db,$id) {
    $id = mysqli_real_escape_string($db, $id);
    $query = "SELECT fullname, email, domicilio, telefono FROM usuarios WHERE id =  $id  ";
    //echo $query;
    $usuario = mysqli_query($db, $query);
    if (!$usuario) return array("fullname" => "", "email" => "", "domicilio" => "", "telefono" => "");
    else return mysqli_fetch_assoc($usuario);
}

/**♠
* Edita los datos pero lo llama desde la base datos por id
 * @Param $db string
 * @Param $id int
 * @Param $data array
 */
function editarUsuario($db,$id,$data) {
    /*echo "data";
    print_r($data);*/
    $nombre = mysqli_real_escape_string($db, $data['fullname']);
    $email = mysqli_real_escape_string($db, $data['email']);
    $domicilio = mysqli_real_escape_string($db, $data['domicilio']);
    $telefono = mysqli_real_escape_string($db, $data['telefono']);
      
    $query = "UPDATE usuarios SET fullname = '$nombre', email = '$email', 
    domicilio = '$domicilio', telefono = '$telefono' WHERE id = $id";
    //echo $query;die;
    // Ejecutamos el query.
    // Como la consulta es un INSERT, mysqli_query retorna true o false.
    return mysqli_query($db, $query);
}
?>