<?php
    include "./view/security/admin_security.php";
?>

<div class="container-fluid mt-5">
    <div class="py-2">
        <nav class="d-flex mb-3 py-4 pb-2 ms-2">
            <h6 class="mb-0">
                <a href="<?php echo URL; ?>home/" style="color:var(--text-primary);">Home</a>
                <span class="text-dark">/</span>
                <a href="<?php echo URL; ?>admin/catalogo-new/">catalogo/</a>
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
                                    <input type="date" class="form__input" name="catalogo_nombre_up"
                                        value="<?php echo $campos['fecha_catalogo']; ?>" id="catalogo_nombre"
                                        maxlength="49">
                                    <label for="catalogo_nombre" class="form__label">Fecha
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
                                        name="catalogo_descripcion_up" id="catalogo_descripcion" maxlength="700"
                                        rows="50"><?php echo $campos['detalle_catalogo']; ?></textarea>
                                    <label for="catalogo_descripcion" class="form__label">Descripción</label>
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