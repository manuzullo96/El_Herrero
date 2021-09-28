<nav class="col navbar navbar-expand-md navbar-dark">
    <p id="logo">El Herrero</p>

    <a href="index.php" class="navbar-brand">
        <h1 class="herrero">El Herrero</h1>
    </a>
    <button class="navbar-toggler"
        type="button"
            data-toggle="collapse"
            data-target = "#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  <?= $seccion == 'Home' ? ' active' : '';?>" href="index.php?s=Home">Inicio</a></li>
            <li class="nav-item"> 
                <a class="nav-link  <?= $seccion == 'Productos' ? ' active' : '';?>" href="index.php?s=Productos">Listado</a></li>
            <li class="nav-item"> 
                <a class="nav-link <?= $seccion == 'Contacto' ? ' active' : '';?>" href="index.php?s=Contacto">Contacto</a></li>
        </ul>
            
        <div class="mr-auto"></div>
        <ul class="navbar-nav">
        <?php
        // si hay un usuario logueado
        if (estaAutenticado()){
            // si es un admin
            if (esAdmin()) {
        ?>
            <li class="nav-item"> 
            <a class="nav-link  <?= $seccion == 'Admin' ? ' active' : '';?>" href="index.php?s=Admin">Panel de control</a>
            </li>
        <?php
            }
            else { // si es un usuario común
            // si el usuario tiene un carrito de compras
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                ?>
            <li class="nav-item"> 
            <a class="nav-link  <?= $seccion == 'CarritoCompra' ? ' active' : '';?>" href="index.php?s=CarritoCompra">Carro de compras (<?php echo count($_SESSION['cart']); ?>)</a>
            </li>
                <?php
                } // end if session cart
        ?>
            <li class="nav-item"> 
            <a class="nav-link  <?= $seccion == 'MisPedidos' ? ' active' : '';?>" href="index.php?s=MisPedidos">Mis pedidos</a>
            </li>
            <li class="nav-item"> 
            <a class="nav-link  <?= $seccion == 'MisDatos' ? ' active' : '';?>" href="index.php?s=MisDatos">Mis datos</a>
            </li>
        <?php
            } // end if usuario admin o común
        ?>
            <li class="nav-item"> 
            <a class="nav-link" href="acciones/hacer-logout.php">Cerrar sesión</a>
            </li>
        <?php
        }else{ // si el usuario no está logueado
        ?>
            <li class="nav-item"> 
            <a class="nav-link  <?= $seccion == 'Registrarse' ? ' active' : '';?>" href="index.php?s=Registrarse">Registrarse</a>
            </li>
            <li class="nav-item"> 
            <a class="nav-link  <?= $seccion == 'Login' ? ' active' : '';?>" href="index.php?s=Login">Acceder</a>
            </li>
        <?php
        } // end if usuario logueado
        ?>
        </ul>
    </div>
</nav>
