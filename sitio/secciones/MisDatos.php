<?php
require 'funciones/usuarios.php';
/*
Tanto si modificó bien los datos como si hay error, vuelve a esta pantalla con un feedback
*/
$feedback = "";
if (isset($_SESSION["feedback"])) {
  $feedback = $_SESSION["feedback"];
  unset($_SESSION["feedback"]);
}

$old_data = [];
$old_data = getUsuarioById($db, $_SESSION['id_usuario']); 
//print_r($old_data);
?>
<section class="container">
  <h1>Mis datos</h1>
<?php
// Preguntamos si hay un feedback para mostrarlo
if($feedback != ""):
?>
<div class="form-<?=$_SESSION["feedback_type"]?>"><?= $feedback;?></div>
<?php
endif;
?>
  <form class="login" action="acciones/usuario-editar.php" method="post" onSubmit="return validar();">
    <div class="form-group">
      <label for="email">E-mail</label>
      <input class="form-control" name="email"  id="email" placeholder="E-mail..." required value="<?=$old_data["email"];?>">
    </div>

    <div class="form-group">
      <label for="fullname">Nombre completo</label>
      <input class="form-control" name="fullname"  id="fullname" placeholder="Nombre completo..." required value="<?=$old_data["fullname"];?>">
    </div>

    <div class="form-group">
      <label for="domicilio">Domicilio</label>
      <input class="form-control" name="domicilio"  id="domicilio" placeholder="Domicilio..." value="<?=$old_data["domicilio"];?>">
    </div>

    <div class="form-group">
      <label for="telefono">Teléfono</label>
      <input class="form-control" name="telefono"  id="telefono" placeholder="Teléfono..." value="<?=$old_data["telefono"];?>">
    </div>

    <input type="submit"  class="btn btn-grad btn-lg btn-block" value="Actualizar">
  </form>
</section>

<script>
function validar () {

  var email = document.getElementsByName("EMAIL")[0].value;
  var fullname = document.getElementsByName("FULLNAME")[0].value;
  var domicilio = document.getElementsByName("DOMICILIO")[0].value;
  var telefono = document.getElementsByName("TELEFONO")[0].value;

  email = email.trim();
  fullname = fullname.trim();
  telefono = telefono.trim();
  domicilio = domicilio.trim();

  if (fullname == "" || email == "" || telefono == "" || domicilio == "") {
    alert("Por favor ingrese nombre completo, e-mail, teléfono y domicilio");
    return false;
  }
    return true;
}
</script>