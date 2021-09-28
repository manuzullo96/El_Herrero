<?php 
require 'funciones/productos.php';

$categorias = getCategorias($db);
$feedback = "";

//print_r($_POST);
if (isset($_POST['nombre'])) { // significa que estamos creando un nuevo producto
    // si el producto fue creado exitosamente, le dejamos acá con un feedback de exito, sino de error
    if (crearProducto($db, $_POST)) {
        $feedback = "El producto fue creado exitosamente";
        $feedback_type = "success";
    }
    else {
        $feedback = "Hubo un error al intentar crear el producto";
        $feedback_type = "error";
    }
}
?>
<section class="container">

    <h1>Crear Producto</h1>
    <a class="btn btn-grad" href="index.php?s=ABMPRODUCTOS">Volver a ABM</a>
<?php
// Preguntamos si hay un mensaje de feedback, que puede ser de error o de éxito
if($feedback != ""):
?>
    <div class="form-<?=$feedback_type?>"><?= $feedback;?></div>
<?php
endif;
?>
    <form action="index.php?s=Producto-crear" method="post" enctype="multipart/form-data" onSubmit="return validar();">
        <div class="form-group">
            <label for="NOMBRE"><b>Nombre</b></label>
            <input type="text" id="NOMBRE" name="nombre" class="form-control" >
        </div>
        <div class="form-group">
            <label for="DETALLE"><b>Detalle del Producto</b></label>
            <textarea rows="10" name="detalle" id="DETALLE" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="IDCATEGORIA"><b>Seleccione una Categoría</b></label>
            <select id="IDCATEGORIA" NAME="idcategoria" class="form-control">
                <option selected="selected" value="0">----</option>
                <?php foreach($categorias as $categoria): ?>
                <option value="<?=$categoria['id'];?>"><?=$categoria['descripcion'];?></option>
                <?php  endforeach; ?>	
            </select>
        </div>
        <div class="form-group">
            <label for="PRECIO"><b>Precio</b></label>&nbsp;
            <input type="text" id="PRECIO" name="precio" class="form-control">
        </div>
        <div class="form-group">
            <label for="NUEVAFOTO"><b>Imagen</b></label>&nbsp;
            <input type="file" id="NUEVAFOTO" name="NUEVAFOTO" class="form-control">
        </div>
        <div class="form-group">
            <div class="ofert">
                <input  type="checkbox" NAME="es_oferta" class="form-check-input" id="ESOFERTA">&nbsp;
                <label class="form-check-label" for="ESOFERTA"><b>Es oferta</b></label>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-grad">Crear Producto</button>
        </div>
        
    </form>
</section>

<script>
function validar () {

  var nombre = document.getElementsByName("nombre")[0].value;
  var detalle = document.getElementsByName("detalle")[0].value;
  var categoria = document.getElementsByName("idcategoria")[0].value;
  var precio = document.getElementsByName("precio")[0].value;

  nombre = nombre.trim();
  detalle = detalle.trim();
  precio = precio.trim();

  if (nombre == "" || detalle == "" || categoria == 0 || precio == "") {
    alert("Por favor ingrese nombre, detalle, categoría y precio");
    return false;
  }
    return true;
}
</script>
