<style>
body {
    background: #FDFDFD !important;
}
</style>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="container mt-5">
                <div class="row">
                    <!-- Page header -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-start roboto-condensed-regular text-uppercase">
                                    <i class="fab fa-dashcube fa-fw"></i> &nbsp; DASHBOARD
                                </h3>
                                <hr>
                                <p class="lead">
                                    ¡Bienvenido
                                    <strong
                                        class=" badge badge-info mb-3"><?php echo $_SESSION['nombre_sto']." ".$_SESSION['apellido_sto'];?></strong>!<br>
                                    Este
                                    es el panel principal del sistema acá podrá encontrar atajos para acceder a los
                                    distintos
                                    listados de cada módulo del sistema.
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class=" text-primary">Acceso directo</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <?php $total_clientes=$ins_login->datos_tabla("Normal","cliente","cliente_id",0);?>
                                                <a href="<?php echo URL.DASHBOARD; ?>/customer-new/" class="tile">
                                                    <div class="tile-tittle">Clientes</div>
                                                    <div class="tile-icon">
                                                        <i class="fas fa-users fa-fw"></i>
                                                        <p><?php echo $total_clientes->rowCount(); ?> Registrados</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <?php $total_clientes->closeCursor(); $total_clientes=$ins_login->desconectar($total_clientes);
                                                $total_productos=$ins_login->datos_tabla("Normal","producto","producto_id",0);?>
                                                <a href="<?php echo URL.DASHBOARD; ?>/product-new/" class="tile">
                                                    <div class="tile-tittle">Productos</div>
                                                    <div class="tile-icon">
                                                        <i class="fas fa-box-open fa-fw"></i>
                                                        <p><?php echo $total_productos->rowCount(); ?> Registrados</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <?php if($_SESSION['cargo_sto']=="Administrador"){
                                        $total_catalogo=$ins_login->datos_tabla("Normal","catalogo","id_catalogo",0);?>
                                        <div class="card shadow-5-primary">
                                            <div class="card-body">
                                                <a href="<?php echo URL.DASHBOARD; ?>/catalogue-new/" class="tile">
                                                    <div class="tile-tittle">Catalogo</div>
                                                    <div class="tile-icon">
                                                        <i class="fas fa-tag fa-fw"></i>
                                                        <p><?php echo $total_catalogo->rowCount(); ?> Registradas</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <?php $total_catalogo->closeCursor(); $total_catalogo=$ins_login->desconectar($total_catalogo);}?>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <?php  $total_promociones=$ins_login->datos_tabla("Normal","promocion","id_promocion",0);?>
                                                <a href="<?php echo URL.DASHBOARD; ?>/promocion_new/" class="tile">
                                                    <div class="tile-tittle">Promociones</div>
                                                    <div class="tile-icon">
                                                        <i class="fas fa-box-open fa-fw"></i>
                                                        <p><?php echo $total_promociones->rowCount(); ?> Registrados</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <?php if($_SESSION['cargo_sto']=="Administrador"){
                                        $total_categorias=$ins_login->datos_tabla("Normal","categoria","categoria_id",0);?>
                                        <div class="card shadow-5-primary">
                                            <div class="card-body">
                                                <a href="<?php echo URL.DASHBOARD; ?>/category-new/" class="tile">
                                                    <div class="tile-tittle">Categorías</div>
                                                    <div class="tile-icon">
                                                        <i class="fas fa-tag fa-fw"></i>
                                                        <p><?php echo $total_categorias->rowCount(); ?> Registradas</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <?php $total_categorias->closeCursor(); $total_categorias=$ins_login->desconectar($total_categorias);}?>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <?php $total_pedidos=$ins_login->datos_tabla("Normal","pedido WHERE estado_pedido='Pendiente'","id_pedido",0);?>
                                                <a href="<?php echo URL.DASHBOARD; ?>/order-new/" class="tile">
                                                    <div class="tile-tittle">Pedidos</div>
                                                    <div class="tile-icon">
                                                        <i class="fas fa-truck-loading fa-fw"></i>
                                                        <p><?php echo $total_pedidos->rowCount(); ?> Registrados</p>
                                                    </div>
                                                </a>
                                                <?php $total_pedidos->closeCursor(); $total_pedidos=$ins_login->desconectar($total_pedidos);  ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <?php $total_ventas=$ins_login->datos_tabla("Normal","venta WHERE venta_id!='1'","venta_id",0);?>
                                                <a href="<?php echo URL.DASHBOARD; ?>/sale-all/" class="tile">
                                                    <div class="tile-tittle">Ventas</div>
                                                    <div class="tile-icon">
                                                        <i class="fas fa-file-invoice-dollar fa-fw"></i>
                                                        <p><?php echo $total_ventas->rowCount(); ?> Registrados</p>
                                                    </div>
                                                </a><?php $total_ventas->closeCursor(); $total_ventas=$ins_login->desconectar($total_ventas); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <?php $total_productos->closeCursor(); $total_productos=$ins_login->desconectar($total_productos);
                                                if($_SESSION['cargo_sto']=="Administrador"){
                                                    $total_usuarios=$ins_login->datos_tabla("Normal","usuario WHERE usuario_id!='1' AND usuario_id!='".$_SESSION['id_sto']."'","usuario_id",0);?>
                                                <a href="<?php echo URL.DASHBOARD; ?>/admin-new/" class="tile">
                                                    <div class="tile-tittle">Administradores</div>
                                                    <div class="tile-icon">
                                                        <i class="fas fa-user-secret fa-fw"></i>
                                                        <p><?php echo $total_usuarios->rowCount(); ?> Registrados</p>
                                                    </div>
                                                </a>
                                                <?php $total_usuarios->closeCursor(); $total_usuarios=$ins_login->desconectar($total_usuarios);}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content -->
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer-admin d-flex justify-content-center align-items-center my-4">
    <div class="footer__content text-center flex-column flex-lg-row p-3 ps-lg-0 ">
        <p class="mb-0 "><i class="fas fa-copyright "></i> 2022 WILLIAM´S.</p>
        <a href="# ">Todos los derechos reservados.</a>
    </div>
</footer>
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