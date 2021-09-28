<?php

CONST PRODUCTOS_POR_PAGINA = 4;
// require ('../configuracion/conexion.php');

/**
 *Traigo la cantidad de productos en la base datos
 * @Param $db string
 * @Param $busqueda string
 *
 * @return int
 */
function getCantidadProductos($db,$busqueda="") {
	//Obtengo la cantidad de productos visibles, esto se usa para paginar el listado
	$query = "SELECT id FROM productos WHERE es_visible = 1 ";
    $busqueda = trim($busqueda);
    if ($busqueda != "") {
        $query .= "  AND nombre LIKE '%".$busqueda."%'";
    }
    $result = mysqli_query($db, $query);

    return (isset($result->num_rows) ? $result->num_rows : 0);
}

/**
 *Crea el paginador para los productos
 * Trae y busca los productos desde la base de datos
 * @Param $db string
 * @Param $busqueda string
 * @Param $pagina string
*/
function dibujarPaginador($db,$busqueda,$pagina) {
    $cantidadproductos = getCantidadProductos($db,$busqueda);
    $totalpaginas = ceil($cantidadproductos/PRODUCTOS_POR_PAGINA);
    // si el listado ocupa más de una página, dibuja el paginador
    if ($totalpaginas > 1) {
        if ($busqueda != "") {
            $_GET["busqueda"] = $busqueda;
        }
        echo "<div class='botoncrear'>Páginas ";
        for($i=1;$i<=$totalpaginas;$i++) {
            // a la página actual no le pongo el link
            if ($i == $pagina) echo $i." ";
            else echo '<a href="index.php?s=Productos&pag='.$i.'">'.$i.'</a> ';
        }
        echo "</div>";
    }
}

/**
 * Trae las ofertas guardadas desde la base de datos
 * @Param $db string
 * @return string
*/
function getOfertas($db) {
	//Obtengo los productos que estan seteados como oferta en la db
	$query = "SELECT I.id, C.descripcion AS categoria, I.nombre, I.detalle, I.precio, I.foto 
    FROM productos I INNER JOIN categorias C ON I.idcategoria = C.id 
    WHERE es_visible = 1 AND es_oferta = 1 ORDER BY I.nombre";

	return mysqli_query($db, $query);
}

/**
 * Trae los productos guardados desde la base de datos y luego los busca en el paginador
 * @Param $db string
 * @Param $busqueda string
 * @Param $pagina string
 * @return string
 */
function getProductos($db,$busqueda="",$pagina=0) {
    //Trae todos los productos visibles, con filtro de búsqueda si lo hay y paginados
    $queryProductos = "SELECT I.id, C.descripcion AS categoria, I.es_oferta, I.nombre,
    I.detalle, I.precio, I.foto FROM productos I 
    INNER JOIN categorias C ON I.idcategoria = C.id  WHERE I.es_visible = 1 ";
    $busqueda = trim($busqueda);
    if ($busqueda != "") {
        $queryProductos .= " AND I.nombre LIKE '%".$busqueda."%'";
    }
    $queryProductos .= " ORDER BY I.nombre";
    
    if ($pagina > 0) {
        $queryProductos .= " LIMIT ".(($pagina-1)*PRODUCTOS_POR_PAGINA)." , ".PRODUCTOS_POR_PAGINA;
    }
    //echo $queryProductos;
    
    return mysqli_query($db, $queryProductos);
}

/**
* Trae los productos guardados por el administrador
 * @Param $db string
 * @return string
 */
function getProductosAdmin($db) {
    //Trae todos los productos
    $queryProductos = "SELECT I.id, C.descripcion AS categoria, I.es_oferta, I.nombre,
    I.precio, I.foto, I.es_visible FROM productos I 
    INNER JOIN categorias C ON I.idcategoria = C.id ORDER BY I.nombre";
    
    //echo $queryProductos;
    
    return mysqli_query($db, $queryProductos);
}

/**
*  Trae los productos por id desde la base de datos y si no existe el producto nos devuelve un array
 * @Param $db string
 * @Param $id int
 * @return array
 */
function getProductoById($db,$id) {
    $id = mysqli_real_escape_string($db, $id);

    //Trae un producto
    $queryProductobyId = "SELECT I.id, C.descripcion AS categoria, I.nombre,
    I.detalle, I.precio, I.es_oferta, I.foto, I.es_visible, I.idcategoria FROM productos I 
    INNER JOIN categorias C ON I.idcategoria = C.id WHERE I.id =  $id  ";
    //echo $queryProductobyId;

    $ProductoDetalle = mysqli_query($db, $queryProductobyId);
    /*echo "ProductoDetalle:";
    print_r($ProductoDetalle);*/

    // tomamos todas las precauciones por si la consulta da error o si no devuelve registros
    if (!$ProductoDetalle or $ProductoDetalle == null) return array();
    else {
        $ProductoDetalle = mysqli_fetch_assoc($ProductoDetalle);
        //echo "ProductoDetalle2:";
        if ($ProductoDetalle != null) {
            //print_r($ProductoDetalle);
            return $ProductoDetalle;
        }
        else {
            //echo "null";
            return array();
        }
    }
}
/**
*Traigo  todas las categorias guardadas desde la base de datos
 * @Param $db  string
 */
function getCategorias($db) {
    //Trae categorias
    // Armamos y ejecutamos el query.
    $queryCategorias = "SELECT id, descripcion FROM categorias order by descripcion ";
    return mysqli_query($db, $queryCategorias);
}

/**
 *Crea el producto con sus caracteristicas y lo guarda en la base de datos
 * @Param $db string
 * @Param $data array
 *
 * @return string
 */
function crearProducto($db, $data) {
    //Crea el producto (viene del ABM)
    //Por default el producto recién creado será visible
    $nombre = mysqli_real_escape_string($db, $data['nombre']);
    $detalle = mysqli_real_escape_string($db, $data['detalle']);
    $categoria = mysqli_real_escape_string($db, $data['idcategoria']);
    // si no se envió el archivo o algo salió mal en la subida, el campo quedará vacío
    $foto = "";
    if (isset($_FILES['NUEVAFOTO']) && $_FILES['NUEVAFOTO']['name'] != ""){
        $fichero_subido = 'img/' . basename($_FILES['NUEVAFOTO']['name']);
        if (move_uploaded_file($_FILES['NUEVAFOTO']['tmp_name'], $fichero_subido)) {
            $foto = mysqli_real_escape_string($db, $_FILES['NUEVAFOTO']['name']);
        }
    }
    $es_oferta = (isset($data['es_oferta']) && $data['es_oferta'] == "on") ? 1 : 0;
    $precio = mysqli_real_escape_string($db, $data['precio']);
    
    $query = "INSERT INTO productos (nombre, detalle, precio, idcategoria, foto, es_oferta)
    VALUES ('$nombre', '$detalle', $precio, $categoria, '$foto', $es_oferta)";
    //echo $query;die;
    // Ejecutamos el query.
    // Como la consulta es un INSERT, mysqli_query retorna true o false.      
    return mysqli_query($db, $query);
}

/**
 * Edita los productos buscandolo desde la base de datos.
 * Guarda y actualiza los cambios de los productos desde la base de datos.
 * Al actualizar los datos te da un true o false
 *@Param $db string
 *@Param $id int
 *@Param $data array
 *@return bool
 */
function editarProducto($db, $id,$data) {
    //Modifica el producto (viene del ABM)
    $nombre = mysqli_real_escape_string($db, $data['nombre']);
    $detalle = mysqli_real_escape_string($db, $data['detalle']);
    $categoria = mysqli_real_escape_string($db, $data['idcategoria']);
    // si se seleccionó un nuevo archivo de imagen hay que subirlo y cambiar el campo en la base
    // si no se seleccionó otro archivo o hay algún error en la subida, queda el mismo que antes
    $foto = mysqli_real_escape_string($db, $data['foto']);
    if (isset($_FILES['NUEVAFOTO']) && $_FILES['NUEVAFOTO']['name'] != ""){
        $fichero_subido = 'img/' . basename($_FILES['NUEVAFOTO']['name']);
        if (move_uploaded_file($_FILES['NUEVAFOTO']['tmp_name'], $fichero_subido)) {
            $foto = mysqli_real_escape_string($db, $_FILES['NUEVAFOTO']['name']);
        }
    }
    $es_oferta = (isset($data['es_oferta']) && $data['es_oferta'] == "on") ? 1 : 0;
    $precio = mysqli_real_escape_string($db, $data['precio']);
    $es_visible = (isset($data['es_visible']) && $data['es_visible'] == "on") ? 1 : 0;
    
    $query = "
    UPDATE productos SET nombre = '$nombre',
    detalle = '$detalle',
    precio = $precio,
    idcategoria = $categoria,
    foto = '$foto',
    es_oferta = $es_oferta ,
    es_visible = $es_visible 
    where id = $id ";
    //echo $query;die;   
    // Ejecutamos el query.
    // Como la consulta es un UPDATE, mysqli_query retorna true o false.
    return mysqli_query($db, $query);
}

/**
*Hago un eliminar producto, seteando el producto como no visible en los listados del usuario
 * @Param $db string
 * @Param $id int
 */
function eliminarProducto($db, $id) {
    $id = mysqli_real_escape_string($db, $id);
    // $query = "UPDATE productos SET es_visible = 0 WHERE id = $id ";
    $query = "DELETE FROM productos WHERE id = $id";
    //echo $query; die;    
    
    return mysqli_query($db, $query);
}

function eliminarProductodeCarrito($db, $id){
    $id = mysqli_real_escape_string($db, $id);
    $query = "DELETE FROM carrito WHERE idproducto = $id";
    return mysqli_query($db, $query);
}