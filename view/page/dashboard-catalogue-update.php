<?php
    include "./view/security/admin_security.php";
?>

<div class="container-fluid mt-5">
    <div class="py-2">
        <nav class="d-flex mb-3 py-4 pb-2 ms-2">
            <h6 class="mb-0">
                <a href="<?php echo URL; ?>home/" style="color:var(--text-primary);">Home</a>
                <span class="text-dark">/</span>
                <a href="<?php echo URL; ?>admin/catalogue-new/">catalogo/</a>
                <span class="text-primary text-decoration-underline">Actualizar</a>
            </h6>
        </nav>
    </div>
    <?php
        
        $datos_catalogo=$ins_login->datos_tabla("Unico","catalogo","id_catalogo",$pagina[2]);
        if($datos_catalogo->rowCount()==1){
            $campos=$datos_catalogo->fetch();
    ?>

    <div class="card">
        <div class="card-body">
            <form class="dashboard-container FormularioAjax" method="POST" data-form="update"
                data-lang="<?php echo LANG; ?>" autocomplete="off" action="<?php echo URL;?>ajax/catalogoAjax.php">
                <input type="hidden" name="modulo_catalogo" value="actualizar">
                <input type="hidden" name="catalogo_id_up" value="<?php echo $pagina[2]; ?>">
                <fieldset class="mb-4">
                    <legend class="mb-5"><i class="fas fa-tag fa-fw"></i> &nbsp; Información del catálogo</legend>
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-12 col-md-6">
                                <div class="form__outline mb-4">
                                    <input type="date" class="form__input" name="catalogo_fecha_up"
                                        value="<?php echo $campos['fecha_catalogo']; ?>" id="catalogue_fecha"
                                        maxlength="49">
                                    <label for="catalogue_fecha" class="form__label">Fecha
                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form__outline mb-4">
                                    <input type="text" class="form__input" name="catalogo_identificador_up"
                                        value="<?php echo $campos['identificador']; ?>" id="catalogo_identificador"
                                        maxlength="49">
                                    <label for="catalogo_identificador" class="form__label">Identficador
                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form__outline mb-4">
                                    <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,700}" class="form__input"
                                        name="catalogo_detalle_up" id="catalogue_detalle" maxlength="700"
                                        rows="50"><?php echo $campos['detalle_catalogo']; ?></textarea>
                                    <label for="catalogue_detalle" class="form__label">Descripción</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class=" m-auto d-flex flex-column justify-content-center">
                                    <div class="drag-area m-auto justify-content-start position-relative"
                                        style="height: 420px;width: 300px">
                                        <div class="icon"><i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <header>Arrastrar imagen</header>
                                        <button class="btn btn-success btn-floating text-white" height="10" width="10"
                                            type="button" style="top: 50%;left: 50%;"><i
                                                class="fa-solid fa-camera"></i></button>
                                        <input type="file" id="catalogo_foto" name="catalogo_foto_up" hidden>
                                        <div class="preview">
                                            <?php if (is_file("./public/assets/img/catalogue/" . $campos['foto_catalogo'])) { ?>
                                            <img class="img-fluid" style="height:420px; width:100%; border-radius: 0;"
                                                alt="" title="user_photo"
                                                src="<?php echo URL . "public/assets/img/catalogue/" . $campos['foto_catalogo']; ?>">
                                            <?php } else { ?>
                                            <img src="<?php echo URL; ?>public/assets/img/catalogue/default.jpg"
                                                class="img-fluid" style="height:420px; width:50%;">
                                            <?php } ?>
                                        </div>
                                        <style>
                                        .drag-area .preview img {
                                            height: 420px;
                                            width: 100%;
                                            border-radius: 0%;
                                        }
                                        </style>
                                    </div>
                                    <label for="catalogo_foto"
                                        class="form-label p-4 mt-4 badge-light-info text-info text-center"
                                        style="font-size: 12px;">Permitido: JPG, JPEG,
                                        PNG. Tamaño máximo 3MB. Aspecto cuadrado (1:1).
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 40px;">
                    <button type="submit" class="btn bg-primary text-white"><i class="fas fa-sync-alt"></i> &nbsp;
                        ACTUALIZAR</button>
                </p>
                <p class="text-center">
                    <small>Los campos marcados con <?php echo FIELD_OBLIGATORY; ?> son obligatorios</small>
                </p>
            </form>
        </div>
    </div>


    <?php
        }else{ include "./view/inc/".LANG."/error_alert.php";}
    ?>
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