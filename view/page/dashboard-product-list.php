<?php
    include "./view/security/admin_security.php";
?>

<div class="container-fluid h-100 w-100 mt-5">

    <!-- Modal -->
    <div class="pt-18 mb-3">
        <nav class="d-flex ms-2">
            <h6 class="mb-2">
                <a href="<?php echo URL.DASHBOARD; ?>/home/" style="color:var(--text-primary);">Home</a>
                <span>/</span>
                <a href="<?php echo URL.DASHBOARD; ?>/product-new/"
                    class="text-primary text-decoration-underline disabled">Productos</a>
            </h6>
        </nav>
    </div>
    <div class="row pb-4">
        <div class="col-12">
            <div class="p-md-3 pb-0">
                <?php
            require_once "./controller/products/productsController.php";
            $ins_producto = new productoControlador();

            echo $ins_producto->administrador_paginador_producto_controlador($pagina[2],15,$pagina[1],"");
        ?>
            </div>
        </div>
    </div>
</div>
<style>
.card {
    background-color: var(--bg-card) !important;
    border-radius: 30px !important;
}

.navbar {
    position: fixed;
    width: 100%;
    right: 0;
    box-shadow: none !important;
    z-index: 3;
}

.navbar {
    position: fixed !important;
    background-color: var(--bg-light);
    backdrop-filter: blur(10px);
    box-shadow: 0 1px 4px var(--text-third) !important;
    top: 0;
    width: 100%;
    z-index: 2;
}
</style>