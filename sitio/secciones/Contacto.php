<section class="container">
    <div id="contacto">
        <form action="index.php?s=Gracias" method="post"  enctype="multipart/form-data" onsubmit="return validar();">
        <h1>No Dude en Contactarnos</h1>
                  
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input class="form-control" name="nombre"  id="nombre" placeholder="Nombre..." required>
        </div>
                    
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input class="form-control" name="apellido" id="apellido" placeholder="Apellido..." required>
        </div>
					
		<div class="form-group">
            <label for="mail">Email</label>
			<input type="email" class="form-control" placeholder="Email..." name="mail" id="mail" required>
        </div>               
        <div class="form-group">
            <label for="Telefono">Telefono</label>
			<input type="tel" class="form-control"  placeholder="Telefono..." name="telefono" id="Telefono" required>
        </div>               
        <div class="form-group">
            <label for="consulta">Selecciona una opcion</label>
            <select name="consulta" id="consulta" class="form-control">
                <option value="">Seleccione la consulta</option>
                <option value="r">Consulta de Productos</option>
                <option value="v">Pedido de Presupuesto</option>
                <option value="v">Reclamo</option>
                <option value="a">Otro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comentario">Mensaje</label>
            <textarea name="comentario"  id="comentario" class="form-control" cols="30" rows="5"></textarea>
        </div>



        <input type="reset" value="Limpiar" class="btn-rojo">
        <input type="submit" value="Enviar" class="btn btn-grad">
        </form>
    </div>
</section>

<script>
function validar () {

  var email = document.getElementsByName("mail")[0].value;
  var nombre = document.getElementsByName("nombre")[0].value;
  var apellido = document.getElementsByName("apellido")[0].value;
  var telefono = document.getElementsByName("telefono")[0].value;
  var comentario = document.getElementsByName("comentario")[0].value;

  email = email.trim();
  nombre = nombre.trim();
  telefono = telefono.trim();
  apellido = apellido.trim();
  comentario = comentario.trim();

  if (apellido == "" || email == "" || telefono == "" || nombre == "" || consulta == "" || comentario == "") {
    alert("Por favor ingrese nombre, apellido, e-mail, teléfono, tipo de consulta y mensaje");
    return false;
  }
    return true;
}
</script>