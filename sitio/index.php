<?php
//Otros archivos necesarios para la configuracion de base de datos
require 'configuracion/conexion.php';
require 'funciones/autenticacion.php';
// se encarga de verificar la sección que viene por get, en su defecto manda a home
// si la sección no existe, manda a un 404
require 'configuracion/secciones.php';

?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $seccionesPermitidas[$seccion]['title'];?></title>
    <link rel="icon" href="img/icono.png">
    <link rel="icon" href="demo_icon.gif" type="image/gif">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <header>
        <?php require 'templates/menu.php';?>
    </header>
    <main class="content">

            <?php
                //Si la seccion no existe lo redirecciono a mantenimiento
            if(file_exists('secciones/' . $seccion . '.php')) {
                require 'secciones/' . $seccion . '.php';
            } else {
                require 'secciones/Mantenimiento.php';
            }
            ?>
    </main>
    
   <footer>
	    <?php require 'templates/footer.php';?>
   </footer>
   
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>