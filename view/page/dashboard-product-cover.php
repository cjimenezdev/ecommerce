<?php
    include "./view/security/admin_security.php";
?>
<div class="container-fluid h-100 w-100 mt-5">
    <div class="pt-18">
        <nav class="d-flex ms-2">
            <h6 class="mb-2">
                <a href="<?php echo URL.DASHBOARD; ?>/home/" style="color:var(--text-primary);">Home</a>
                <span>/</span>
                <a href="<?php echo URL.DASHBOARD; ?>/product-new/"
                    class="text-primary text-decoration-underline disabled">Productos</a>
                <span>/</span>
                <a href="<?php echo URL.DASHBOARD; ?>/product-list/"
                    class="text-primary text-decoration-underline disabled">Productos-lista</a>
            </h6>
        </nav>
    </div>
    <div class="container">
        <?php
            
            $datos_producto=$ins_login->datos_tabla("Unico","producto","producto_id",$pagina[2]);
            if($datos_producto->rowCount()==1){
                $campos=$datos_producto->fetch();
        ?>
        <h3 class="text-center"><?php echo $campos['producto_nombre']; ?></h3>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6">
                    <?php if(is_file("./public/assets/img/products/cover/".$campos['producto_portada'])){ ?>
                    <form class="FormularioAjax" data-lang="<?php echo LANG; ?>"
                        action="<?php echo URL; ?>ajax/productoAjax.php" method="POST" data-form="delete"
                        autocomplete="off">
                        <input type="hidden" name="modulo_producto" value="portada_eliminar">
                        <input type="hidden" name="producto_id" value="<?php echo $pagina[2]; ?>">
                        <div class="card">
                            <div class="card-body">
                                <figure>
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <img class="img-fluid img-product-info"
                                                src="<?php echo URL; ?>/public/assets/img/products/cover/<?php echo $campos['producto_portada']; ?>"
                                                alt="<?php echo $campos['producto_nombre']; ?>" width="200px">
                                        </div>
                                    </div>
                                </figure>
                                <p class="text-center" style="margin-top: 40px;">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="far fa-trash-alt"></i> &nbsp; ELIMINAR IMAGEN</button>
                                </p>
                            </div>
                        </div>

                    </form>
                    <?php }else{ ?>
                    <div class="card">
                        <div class="card-body">
                            <figure>
                                <div class="card">
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                        <img class="img-fluid img-product-info"
                                            src="<?php echo URL; ?>public/assets/img/products/cover/default.jpg"
                                            alt="<?php echo $campos['producto_nombre']; ?>" width="200px">
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>

                    <?php } ?>
                </div>
                <div class="col-12 col-md-6">
                    <form class="FormularioAjax dashboard-container" data-lang="<?php echo LANG; ?>"
                        action="<?php echo URL; ?>ajax/productoAjax.php" method="POST" data-form="update"
                        autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="producto_id" value="<?php echo $pagina[2]; ?>">
                        <input type="hidden" name="modulo_producto" value="portada_actualizar">
                        <fieldset>
                            <legend><i class="far fa-file-image"></i> &nbsp; Foto o portada de producto</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="producto_portada" class="form-label">Tipos de archivos permitidos:
                                            JPG, JPEG, PNG. Tamaño máximo <?php echo COVER_PRODUCT; ?>MB. Resolución
                                            recomendada 500px X 500px o superior manteniendo el aspecto cuadrado
                                            (1:1)</label>
                                        <input class="form-control form-control-sm" id="producto_portada"
                                            name="producto_portada" type="file" />
                                        <p class="text-center" style="margin-top: 40px;">
                                            <button type="submit" class="btn btn-success btn-sm"><i
                                                    class="fas fa-sync"></i> &nbsp; ACTUALIZAR IMAGEN</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <?php
            }else{ include "./view/inc/error_alert.php";}
        ?>
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