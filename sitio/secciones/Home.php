<section class="container-fluid">
    <div class="row">
        <div class="col-md-12 carrusel d-none d-md-block">
            <div class="carousel-item active">     

                <h2>Bienvenidos a Nuestro Sitio Web</h2>

              
                <p><strong>"El Herrero"</strong> es una Pyme argentina que comercializa herramientas e insumos de alta calidad.
                    Nuestras marcas están a la vanguardia tecnológica, pudiendo ofrecer una amplia gama de productos sobresalientes,
                    con menores costos y excelentes rendimientos.</p>

                <p>Estar a la altura de lo que se espera de nosotros <strong>ha sido, es y será, nuestra razón de ser.</strong> Brindaremos confianza y servicio,
                   y estableceremos una larga y fructífera relación comercial.</p>

                <p>La empresa desde el año 1994, se dedica íntegramente a la comercializacion de herramientas de alta calidad. Lo que nos caracteriza y nos diferencia de otros competidores, es que hemos lanzado a la venta productos
                   completamente nuevos e innovadores, siendo los primeros y  únicos en la argentina en vender herramientas de uso sencillo y de execelentes resultados.</p>

                <p>Nuestros productos que se incluyen en el catalogo, se distinguen por su resistencia, calidad, flexibilidad, durabilidad, buena presentación y precios accesibles.</p>
            </div>
        </div>
    </div>

   <div>
       <h2>Nuestras Ofertas</h2>
       <div class="row">
           <?php
           require 'funciones/productos.php';
           //Dibujo los productos en oferta
           $ofertas = getOfertas($db);
           foreach($ofertas as $oferta): ?>
               <div class="col-lg-3 col-md-6 mb-4">
                   <div class="card h-100">
                       <a class="d-block mx-auto" href="index.php?s=Listado-Detalle&id=<?= $oferta['id'];?>">
                           <img src="img/<?=$oferta['foto'];?>" alt="<?=$oferta['nombre'];?>" />
                       </a>

                       <div class="card-body">
                           <h3 class="card-title">
                               <a href="index.php?s=Listado-Detalle&id=<?= $oferta['id'];?>"><?=$oferta['nombre'];?></a>
                           </h3>
                           <p><B>PRECIO: </B>$<?=number_format($oferta['precio'],2,",",".");?></p>
                           <p><B>CATEGORIA: </B><?=$oferta['categoria'];?></p>

                           <?php
                           if (estaAutenticado()) {
                               ?>
                               <form name="compra<?= $oferta['id'];?>" action="acciones/carrito-agregar.php" method="POST">
                                   <input type="hidden" name="product_id" value="<?= $oferta['id'];?>">


                                   <div class="form-group">
                                       <!--<div class="col-xs-2">-->
                                       <input class="agregar form-control col-xs-2" type="number" value="1" min="1" max="10000">
                                   </div>
                                   <!--</div>-->


                                   <button type="submit"  class="btn btn-grad">Comprar Ahora</button>
                               </form>

                               <?php
                           }
                           else {
                               ?>
                               <button type="button" onclick="location.href='index.php?s=Login';" class="btn btn-grad">Comprar Ahora</button>
                               <?php
                           } // end if usuario logueado
                           ?>


                       </div>
                   </div>
               </div>
           <?php endforeach; ?>
       </div>
   </div>
</section>

