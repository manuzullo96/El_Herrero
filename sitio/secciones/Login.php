<?php
$feedback = "";
if (isset($_SESSION["feedback"])) {
    $feedback = $_SESSION["feedback"];
    unset($_SESSION["feedback"]);
}

// En caso de login erróneo, recuperamos el email y password ingresados
if (isset($_SESSION["old_data"]))
	$old_data = $_SESSION["old_data"];
else 
	$old_data = array("email" => "", "password" => "");

?>
<section class="container">
	<div>
		<h1>Iniciar Sesión</h1>
<?php
// Preguntamos si hay un feedback para mostrarlo
if($feedback != ""):
?>
    <div class="form-<?=$_SESSION["feedback_type"]?>"><?= $feedback;?></div>
<?php
endif;
?>
		<form action="acciones/hacer-login.php" method="post" onSubmit="return validar();">
		<div class="form-group">
			<label for="email">E-mail</label>
			<input class="form-control" name="email"  id="email" placeholder="E-mail..." required value="<?=$old_data["email"]?>">
		</div>              
		<div class="form-group">
			<label for="password">Contraseña</label>
			<input class="form-control" type="password" name="password"  id="password" placeholder="Contraseña..." required value="<?=$old_data["password"]?>">
		</div>              
		<input type="submit"  class="btn btn-grad btn-lg btn-block" value="Entrar">
		</form>
	</div>
</section>

<script>
function validar () {

  var email = document.getElementsByName("email")[0].value;
  var password = document.getElementsByName("password")[0].value;

  email = email.trim();
  password = password.trim();

  if (email == "" || password == "") {
    alert("Por favor ingrese email y password");
    return false;
  }
    return true;
}
</script>
