<?php
//Recupera los parametros nombre y apellido por post que fueron enviados por el form Contacto
 $nombre =  $_POST['nombre'];
 $apellido = $_POST['apellido'];
 
?>
<section>
       <h1>¡Recibido!</h1>
       <p>Muchas gracias por contactarnos.<b><?= $nombre; ?> <?= $apellido;?></b></p>
       <p>En unos momentos nos pondremos en contacto con usted.</p>

          
       <div>   
              <a  class="btn btn-grad" href="index.php?s=Home">Volver al Inicio</a>
               <a class="btn btn-grad" href="index.php?s=Contacto">Volver al formulario de contacto</a>
       </div>
</section>  
	
	