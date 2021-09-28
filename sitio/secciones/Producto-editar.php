<?php 
require 'funciones/productos.php';

$feedback = $feedback_type = "";
if (isset($_POST['nombre'])) { // significa que estamos actualizando los datos del producto
    if (editarProducto($db, $_GET['id'], $_POST)) {
        $feedback = "El producto fue editado exitosamente";
        $feedback_type = "success";
    }
    else {
        $feedback = "Hubo un error al intentar editar el producto";
        $feedback_type = "error";
    }
}
 
$old_data = [];
$old_data = getProductoById($db, $_GET['id']); 
//print_r($old_data);
?>
    <h1>Editar Producto</h1>

    <a class="btn btn-grad"href="index.php?s=ABMPRODUCTOS">Volver a ABM</a>

<?php
// Preguntamos si hay un mensaje de feedback, que puede ser de error o de éxito
if($feedback != ""):
?>
    <div class="form-<?=$feedback_type?>"><?= $feedback;?></div>
<?php
endif;
?>

    <form action="index.php?s=Producto-editar&id=<?= $old_data['id'];?>" method="post" enctype="multipart/form-data" onSubmit="return validar();">
    <input type="hidden" name="foto" value="<?= $old_data['foto'];?>">
        <div class="form-group">
            <label><b>Imagen</b></label>
            <img class="elemento" src="img/<?= $old_data['foto'];?>" alt="<?= $old_data['nombre'] ?? '';?>">
            <p>Si deseás cambiarla, subí la nueva imagen. Sino, dejá el campo vacío.</p>
        </div>
        <div class="form-group">
            <label for="NUEVAFOTO"><b>Subir nueva imagen</b></label>
            <input type="file" id="NUEVAFOTO" name="NUEVAFOTO" class="form-control">
        </div>
        <div class="form-group">
            <label for="NOMBRE"><b>Nombre</b></label>
            <!-- Precargamos el título con el valor que
            había ingresado el usuario. Si no hay 
            ninguno, mostramos vacío. -->
            <input type="text" id="NOMBRE" name="nombre" class="form-control" value="<?= $old_data['nombre'] ?? '';?>">
        </div>
        <div class="form-group">
            <label for="DETALLE"><b>Detalle del Producto</b></label>
            <!-- En el caso de un textarea, ponemos el
            valor dentro del textarea. -->
            <textarea rows="10" name="detalle" id="DETALLE" class="form-control"><?= $old_data['detalle'] ?? '';?></textarea>
        </div>
        <div class="form-group">
            <label for="IDCATEGORIA"><b>Selecciona una Categoría</b></label>
            <select id="IDCATEGORIA" NAME="idcategoria" class="form-control">
                <option value="0">Seleccione la consulta</option>
                <?php 
                $categorias = getCategorias($db);
                foreach($categorias as $categoria): ?>
                <?php if ($old_data['idcategoria'] == $categoria['id']){ ?>
                <option value="<?=$categoria['id'];?>" selected="selected"><?=$categoria['descripcion'];?></option>
                <?php }else{?>
                <option  value="<?=$categoria['id'];?>"><?=$categoria['descripcion'];?></option>
                <?php  }endforeach; ?>	
            </select>
        </div>
        <div class="form-group">
            <label for="PRECIO"><b>Precio</b></label>
            <input type="text" id="PRECIO" name="precio" class="form-control" value="<?= $old_data['precio'] ?? '';?>">
        </div>
        <div class="form-group">
            <?php if ($old_data['es_oferta'] ){ ?>
            <input checked type="checkbox" NAME="es_oferta" class="ofert" id="ESOFERTA">
            <?php }else{?>
            <input  type="checkbox" NAME="es_oferta" class="form-check-input" id="ESOFERTA">
            <?php } ?>
        <label class="form-check-label" for="ESOFERTA"><b>Es oferta</b></label>
        </div>
        <div class="form-group">
            <?php if ($old_data['es_visible'] ){ ?>
                <input checked type="checkbox" NAME="es_visible" class="ofert" id="ESVISIBLE">
            <?php }else{?>
                <input  type="checkbox" NAME="es_visible" class="form-check-input" id="ESVISIBLE">
            <?php } ?>
            <label class="form-check-label" for="ESVISIBLE"><b>Es visible</b></label>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-grad">Grabar Cambios</button>

        </div>

    </form>

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
