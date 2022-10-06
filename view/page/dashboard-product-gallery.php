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

    <div class="row pb-4">
        <div class="col-12">
            <div class="p-md-3 pb-4">
                <div class="card">
                    <div class="card-body">
                        <?php
            
            $datos_producto=$ins_login->datos_tabla("Unico","producto","producto_id",$pagina[2]);
            if($datos_producto->rowCount()==1){
                $campos=$datos_producto->fetch();
        ?>
                        <h3 class="text-center"><?php echo $campos['producto_nombre']; ?></h3>
                        <hr>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-6 offset-md-3">
                                    <form class="FormularioAjax" data-lang="<?php echo LANG; ?>"
                                        action="<?php echo URL; ?>ajax/productoAjax.php" method="POST" data-form="save"
                                        autocomplete="off" enctype="multipart/form-data">
                                        <input type="hidden" name="producto_id" value="<?php echo $pagina[2]; ?>">
                                        <input type="hidden" name="modulo_producto" value="galeria_agregar">
                                        <fieldset>
                                            <legend><i class="fas fa-plus"></i> &nbsp; Agregar imagen a galería</legend>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="producto_galeria" class="form-label">Tipos de
                                                            archivos permitidos:
                                                            JPG, JPEG, PNG. Tamaño máximo
                                                            <?php echo GALLERY_PRODUCT; ?>MB. Resolución
                                                            recomendada 500px X 500px o superior.</label>
                                                        <input class="form-control form-control-sm"
                                                            id="producto_galeria" name="producto_galeria" type="file" />
                                                        <p class="text-center" style="margin-top: 40px;">
                                                            <button type="submit" class="btn btn-primary btn-sm"><i
                                                                    class="far fa-save"></i> &nbsp; GUARDAR
                                                                IMAGEN</button>
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
            $datos_galeria=$ins_login->datos_tabla("Normal","imagen WHERE producto_id='".$campos['producto_id']."'","*",0);

            if($datos_galeria->rowCount()>0){
        ?>
                        <hr>

                        <div class="container">
                            <legend class="text-center"><i class="far fa-images"></i> &nbsp; Imágenes del producto
                            </legend>
                            <div class="row">
                                <?php
                    while($campos_galeria=$datos_galeria->fetch()){
                ?>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="dashboard-container" style="margin: 3px;">
                                        <form class="FormularioAjax" data-lang="<?php echo LANG; ?>"
                                            action="<?php echo URL; ?>ajax/productoAjax.php" method="POST"
                                            data-form="delete" autocomplete="off">
                                            <input type="hidden" name="modulo_producto" value="galeria_eliminar">
                                            <input type="hidden" name="producto_id" value="<?php echo $pagina[2]; ?>">
                                            <input type="hidden" name="imagen_id"
                                                value="<?php echo $ins_login->encryption($campos_galeria['imagen_id']); ?>">
                                            <?php if(is_file("./public/assets/img/products/gallery/".$campos_galeria['imagen_nombre'])){ ?>
                                            <figure>
                                                <a data-fslightbox="gallery"
                                                    href="<?php echo URL; ?>public/assets/img/products/gallery/<?php echo $campos_galeria['imagen_nombre']; ?>">
                                                    <img class="img-fluid img-product-info"
                                                        src="<?php echo URL; ?>public/assets/img/products/gallery/<?php echo $campos_galeria['imagen_nombre']; ?>"
                                                        alt="<?php echo $campos['producto_nombre']; ?>">
                                                </a>
                                            </figure>
                                            <?php }else{ ?>
                                            <figure>
                                                <img class="img-fluid img-product-info"
                                                    src="<?php echo URL; ?>public/assets/img/products/gallery/default.jpg"
                                                    alt="<?php echo $campos['producto_nombre']; ?>">
                                            </figure>
                                            <?php } ?>
                                            <p class="text-center" style="margin-top: 40px;">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="far fa-trash-alt"></i> &nbsp; ELIMINAR IMAGEN</button>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                <?php } ?>

                            </div>
                        </div>
                        <script src="<?php echo URL; ?>vistas/js/fslightbox.js"></script>
                        <?php 
                }
            }else{ include "./view/inc/error_alert.php";}
        ?>
                    </div>
                </div>
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