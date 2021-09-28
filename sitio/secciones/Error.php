<?php
//Recupera el mensaje de error de la variable de sesión antes de eliminarla
$error =  isset($_SESSION['error']) ? $_SESSION['error'] : "";
if ($error == "") {
       header("location:index.php?s=Home");
       exit();
}
unset($_SESSION['error']);
 
?>
<section id="gracias" >
       <h1 id="recibido">Ha sucedido un error</h1>
       <p><b><?= $error; ?></b></p>
       <p>Le pedimos disculpas por las molestias ocasionadas.</p>
       <p><a href="index.php?s=Home">Volver al Inicio</a></p>
       <p><a href="index.php?s=Contacto">Formulario de contacto</a></p>
</section>  
