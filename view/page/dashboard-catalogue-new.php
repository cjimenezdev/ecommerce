<?php
    include "./view/security/admin_security.php";
?>

<div class="container-fluid h-100 w-100 mt-5 d-flex flex-column justify-content-center">

    <!-- Modal -->
    <div class="pt-18">
        <nav class="d-flex ms-2">
            <h6 class="mb-2">
                <a href="<?php echo URL.DASHBOARD; ?>/home/" style="color:var(--text-primary);">Home</a>
                <span>/</span>
                <a href="<?php echo URL.DASHBOARD; ?>/catalogue-new/"
                    class="text-primary text-decoration-underline">Ctalogos</a>
            </h6>
        </nav>
    </div>
    <!-- Modal -->
    <div class="modal right fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-mdb-backdrop="static" data-mdb-keyboard="true">
        <div class="modal-dialog modal-side modal-top-right modal-dialog-scrollable ">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex ms-2">
                        <h6 class="mb-0">
                            <a class="text-primary"><i class="fa-solid fa-plus"></i> Nuevo catalogo</a>
                        </h6>
                    </div>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4">
                        <div class="row">
                            <div class="col-12 m-xxl-auto">
                                <!-- Tab content -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <form class="dashboard-container FormularioAjax" method="POST"
                                                    data-form="save" data-lang="es" autocomplete="off"
                                                    action="<?php echo URL; ?>ajax/catalogoAjax.php">
                                                    <input type="hidden" name="modulo_catalogo" value="agregar">
                                                    <div class="tab-content" id="v-tabs-tabContent">
                                                        <div class="tab-pane fade show active" id="v-tabs-home"
                                                            role="tabpanel" aria-labelledby="v-tabs-home-tab">
                                                            <fieldset class="mb-4">
                                                                <legend class="mb-3 mt-sm-4"><i
                                                                        class="fi fi-sr-portrait"></i> &nbsp; Detalles:
                                                                </legend>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 mt-3">
                                                                            <div class="drag-area m-auto">
                                                                                <div class="icon"><i
                                                                                        class="fas fa-cloud-upload-alt"></i>
                                                                                </div>
                                                                                <button
                                                                                    class="btn btn-success text-white"
                                                                                    height="10" width="10"
                                                                                    type="button"><i
                                                                                        class="fa-solid fa-camera"></i></button>
                                                                                <input hidden class=" w-25"
                                                                                    id="catalogo_foto"
                                                                                    name="catalogo_foto_reg"
                                                                                    type="file" />
                                                                                <div class="preview">
                                                                                    <img src="<?php echo URL; ?>public/assets/img/catalogue/default.jpg"
                                                                                        class=" img-fluid" height="70"
                                                                                        width="30">
                                                                                </div>
                                                                            </div>
                                                                            <label for="catalogo_foto"
                                                                                class="form-label pt-3"
                                                                                style="font-size: 12px; color:var(--text);">Permitido:
                                                                                JPG, JPEG,
                                                                                PNG. Tamaño máximo 3MB. Aspecto cuadrado
                                                                                (1:1).
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="date"
                                                                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}"
                                                                                class="form__input"
                                                                                name="catalogo_fecha_reg"
                                                                                id="catalogo_fecha" maxlength="35"
                                                                                placeholder=" ">
                                                                            <label for="catalogo_fecha"
                                                                                class="form__label">Fecha
                                                                                <?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="text" class="form__input"
                                                                                name="catalogo_detalle_reg"
                                                                                id="catalogo_detalle" maxlength="30"
                                                                                placeholder=" ">
                                                                            <label for="catalogo_detalle"
                                                                                class="form__label">Descripcion
                                                                                <?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <legend><i class="fas fa-user-secret"></i>
                                                                            &nbsp;
                                                                            Identificador
                                                                        </legend>
                                                                        <div class="mb-4">
                                                                            <div class="p-2">
                                                                                <div
                                                                                    class="form-check form-check-inline mb-2">
                                                                                    <input class="form-check-input"
                                                                                        type="radio"
                                                                                        name="catalogo_identificador_reg"
                                                                                        value="Caballero"
                                                                                        id="catalogo_identificador_caballero"
                                                                                        checked />
                                                                                    <label class="form-check-label"
                                                                                        for="catalogo_identificador_caballero">Caballero</label>
                                                                                </div>
                                                                                <div
                                                                                    class="form-check form-check-inline">
                                                                                    <input class="form-check-input"
                                                                                        type="radio"
                                                                                        name="catalogo_identificador_reg"
                                                                                        value="Dama"
                                                                                        id="catalogo_identificador_dama" />
                                                                                    <label class="form-check-label"
                                                                                        for="catalogo_identificador_dama">Dama</label>
                                                                                </div>
                                                                                <div
                                                                                    class="form-check form-check-inline">
                                                                                    <input class="form-check-input"
                                                                                        type="radio"
                                                                                        name="catalogo_identificador_reg"
                                                                                        value="Niños"
                                                                                        id="catalogo_identificador_niños" />
                                                                                    <label class="form-check-label"
                                                                                        for="catalogo_identificador_miños">Niños/niñas</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn bg-primary w-100 text-white rounded-4 mt-auto mb-auto"
                                style="padding:0.55rem 0.75rem !important; box-shadow:none !important; height:40px !important;"><i
                                    class="fi fi-sr-disk"></i> &nbsp;
                                Agregar</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="p-md-3 pb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-9">
                                <div class="d-flex  justify-content-sm-start ">
                                    <?php if ($_SESSION['cargo_sto'] == "Cajero") { ?>
                                    <button type="button" data-mdb-toggle="modal" data-mdb-target="#exampleModal"
                                        class="btn text-white rounded-4" title="Agregar"
                                        style="background-color: #7367f0 !important; height: 40px;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" data-mdb-toggle="modal" data-mdb-target="#exampleModal"
                                        class="btn text-white rounded-4" title="Agregar"
                                        style="background-color: #7367f0 !important; height: 40px;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-4">
        <div class="col-12">
            <div class="p-md-3 pb-0">
                <?php
            require_once "./controller/catalogue/catalogueController.php";
            $list_user = new catalogoControlador();

            echo $list_user->controller_catalogue_pager($pagina[2], 5, $pagina[1], "");
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