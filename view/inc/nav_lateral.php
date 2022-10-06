<aside class="nav__bar position-fixed h-100">
    <div class="position-absolute justify-content-start" style="width:100%;">
        <div class="postion-relative">
            <div class="nav-logo">
                <button class="btn-toggle">
                    <i class="fas fa-times navbar-toggler-icon"></i>
                </button>
            </div>
            <figure class="d-flex align-items-center justify-content-center flex-column">
                <img src="<?php echo URL; ?>public/assets/img/users/avatar/<?php echo $_SESSION['foto_sto']; ?>"
                    class="img-fluid" alt="Avatar" width="64px" style="border-radius:50%;">
                <figcaption class="roboto-medium text-center">
                    <?php echo $_SESSION['nombre_sto']; ?> <br><small
                        class="roboto-condensed-light"><?php echo $_SESSION['cargo_sto']; ?></small>
                </figcaption>
            </figure>
        </div>
    </div>

    <ul class="nav pt-0" style="position: absolute; top: 10rem;">
        <li>
            <a class="nav-link" aria-current="page" href="<?php echo URL.DASHBOARD; ?>/home/" id="nav1">
                <img src="https://i.postimg.cc/GpXnX6cy/hogar.webp" width="20" height="auto" class="img-fluid">
                <h3>Tablero</h3>
            </a>
        </li>
        <?php if($_SESSION['cargo_sto']=="Administrador"){ ?>
        <li>
            <a class="nav-link" aria-current="page" href="<?php echo URL.DASHBOARD; ?>/admin-new/" id="nav2">
                <img src="https://i.postimg.cc/YG7WWZVt/usuario-azul.webp" width="20" height="auto" class="img-fluid">
                <h3>Usuarios</h3>
            </a>
        </li>
        <?php } ?>
        <li>
            <a class="nav-link" aria-current="page" href="<?php echo URL.DASHBOARD; ?>/customer-new/" id="nav3">
                <img src="https://i.postimg.cc/ZnzVhfhy/rating.png" width="20" height="auto" class="img-fluid">
                <h3>Clientes</h3>
            </a>
        </li>
        <li>
            <a class="nav-link" aria-current="page" href="<?php echo URL.DASHBOARD; ?>/product-new/" id="nav4">
                <img src="https://i.postimg.cc/jDWP0zPY/product.webp" width="20" height="auto" class="img-fluid">
                <h3>Productos</h3>
            </a>
        </li>
        <li>
            <a class="nav-link" aria-current="page" href="<?php echo URL.DASHBOARD; ?>/order-new/" id="nav7">
                <img src="https://i.postimg.cc/gx5ynMm0/barras.webp" width="20" height="auto" class="img-fluid">
                <h3>Pedidos</h3>
            </a>
        </li>
        <?php if($_SESSION['cargo_sto']=="Administrador"){ ?>
        <li>
            <a class="nav-link" aria-current="page" href="<?php echo URL.DASHBOARD; ?>/category-new/" id="nav5">
                <img src="https://i.postimg.cc/fWKDV22t/category.png" width="20" height="auto" class="img-fluid">
                <h3>Categorias</h3>
            </a>
        </li>
        <?php } ?>
        <li>
            <a class="nav-link" aria-current="page" href="<?php echo URL.DASHBOARD; ?>/sales-all/" id="nav6">
                <img src="https://i.postimg.cc/rwyyV1YM/shopping.webp" width="20" height="auto" class="img-fluid">
                <h3>Ventas</h3>
            </a>
        </li>
        <li>
            <a class="nav-link" aria-current="page" href="<?php echo URL.DASHBOARD; ?>/company/" id="nav8">
                <img src="https://i.postimg.cc/R3H7fcZL/ajustes.webp" width="20" class="img-fluid">
                <h3>Configuración</h3>
            </a>
        </li>
    </ul>
</aside>