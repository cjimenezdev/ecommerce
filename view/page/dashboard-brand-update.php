<?php
    include "./view/security/admin_security.php";
?>

<div class="container-fluid mt-5">
    <div class="py-2">
        <nav class="d-flex mb-3 py-4 pb-2 ms-2">
            <h6 class="mb-0">
                <a href="<?php echo URL; ?>admin/home/" style="color:var(--text-primary);">Home</a>
                <span class="text-dark">/</span>
                <a href="<?php echo URL; ?>admin/brand-new/">Marcas/</a>
                <span class="text-primary text-decoration-underline">Actualizar</a>
            </h6>
        </nav>
    </div>
    <?php
        
        $datos_categoria=$ins_login->datos_tabla("Unico","categoria_marca","id_categoria_marca",$pagina[2]);
        if($datos_categoria->rowCount()==1){
            $campos=$datos_categoria->fetch();
    ?>

    <div class="card">
        <div class="card-body">
            <form class="dashboard-container FormularioAjax" method="POST" data-form="update"
                data-lang="<?php echo LANG; ?>" autocomplete="off" action="<?php echo URL;?>ajax/categoriaAjax.php">
                <input type="hidden" name="modulo_categoria" value="actualizar">
                <input type="hidden" name="categoria_id_up" value="<?php echo $pagina[2]; ?>">
                <fieldset class="mb-4">
                    <legend class="mb-4"><i class="fas fa-tag fa-fw"></i> &nbsp; Información de marcas</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form__outline mb-4">
                                    <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}" class="form__input"
                                        name="categoria_nombre_up"
                                        value="<?php echo $campos['nombre_categoria_marca']; ?>" id="categoria_nombre"
                                        maxlength="49">
                                    <label for="categoria_nombre" class="form__label">Nombre
                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form__outline">
                                    <select class="form__input" name="categoria_estado_up" id="categoria_estado">
                                        <?php
                                    $array_estado=["Habilitada","Deshabilitada"];
                                    echo $ins_login->generar_select($array_estado,$campos['estado_categoria_marca']);
                                ?>
                                    </select>
                                    <label for="categoria_estado" class="form__label"></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form__outline mb-4">
                                    <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,700}" class="form__input"
                                        name="categoria_descripcion_up" id="categoria_descripcion" maxlength="700"
                                        rows="50"><?php echo $campos['descripcion_categoria_marca']; ?></textarea>
                                    <label for="categoria_descripcion" class="form__label">Descripción</label>
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