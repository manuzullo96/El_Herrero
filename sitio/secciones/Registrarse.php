<?php
/*
Si algo salio mal, va a volver a esta pantalla con un mensaje de feedback y con los mismos datos que el usuario envió
*/
$feedback = "";
$olddata = array("fullname" => "","email" => "","password" => "");
if (isset($_SESSION["feedback"])) {
    $feedback = $_SESSION["feedback"];
    unset($_SESSION["feedback"]);
    if (isset($_SESSION['old_data'])) $olddata = $_SESSION['old_data'];
}
?>
<section class="container">
  <div>
    <h1>Crear usuario</h1>
<?php
// Preguntamos si hay un feedback para mostrarlo
if($feedback != ""):
?>
    <div class="form-<?=$_SESSION["feedback_type"]?>"><?= $feedback;?></div>
<?php
endif;
?>
    <form class="login" action="acciones/usuario-crear.php" method="post" onSubmit="return validar();"> 
    <div class="form-group">
      <label for="email">E-mail</label>
      <input class="form-control" name="email"  id="email" placeholder="E-mail..." required value="<?=$olddata["email"];?>">
    </div>              
                                
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" value="<?=$olddata["password"];?>" required>
    </div>              
            
    <div class="form-group">
      <label for="cpassword">Confirme contraseña</label>
      <input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="Confirme contraseña" required>
    </div>              

        <input type="submit"  class="btn btn-grad btn-lg btn-block" value="Crear usuario">
                           
			</form>
		</div>
</section>	         

<script>
function validar () {

  var email = document.getElementsByName("email")[0].value;
  var password = document.getElementsByName("password")[0].value;
  var cpassword = document.getElementsByName("cpassword")[0].value;

  email = email.trim();
  password = password.trim();
  cpassword = cpassword.trim();

  if (email == "" || password == "") {
    alert("Por favor ingrese e-mail y contraseña");
    return false;
  }
  else if(password != cpassword)  {
    alert("La contraseña debe coincidir con su confirmación");
    return false;
  }
  return true;
}
</script>