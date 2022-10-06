<?php
    include "./view/security/admin_security.php";
?>

<div class="container-fluid h-100 w-100 mt-5 d-flex flex-column justify-content-center">

    <div class="pt-18">
        <nav class="d-flex ms-2">
            <h6 class="mb-2">
                <a href="<?php echo URL.DASHBOARD; ?>/admin-home/" style="color:var(--text-primary);">Home</a>
                <span>/</span>
                <a href="<?php echo URL.DASHBOARD; ?>/brand-new/"
                    class="text-primary text-decoration-underline disabled">Marcas</a>
            </h6>
        </nav>
    </div>
    <!-- Modal -->
    <div class="modal right fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-mdb-backdrop="static" data-mdb-keyboard="true">
        <div class="modal-dialog modal-side modal-center-right modal-dialog-scrollable">
            <div class="modal-content h-100">
                <div class="modal-header">
                    <div class="d-flex ms-2">
                        <h6 class="mb-0">
                            <a class="text-primary"><i class="fa-solid fa-plus"></i> Nueva Marca</a>
                        </h6>
                    </div>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body h-100 d-flex justify-content-center align-items-center">
                    <div class="pb-4">
                        <div class="row">
                            <div class="col-12 m-xxl-auto">
                                <!-- Tab content -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <form class="dashboard-container FormularioAjax" method="POST"
                                                    data-form="save" data-lang="<?php echo LANG; ?>" autocomplete="off"
                                                    action="<?php echo URL;?>ajax/categoriaAjax.php">
                                                    <input type="hidden" name="modulo_categoria" value="registro">
                                                    <div class="tab-content" id="v-tabs-tabContent">
                                                        <div class="tab-pane fade show active" id="v-tabs-home"
                                                            role="tabpanel" aria-labelledby="v-tabs-home-tab">
                                                            <fieldset class="mb-4">
                                                                <legend class="mb-3 mt-sm-4"><i
                                                                        class="fi fi-sr-portrait"></i> &nbsp; Agregar
                                                                    Marca:
                                                                </legend>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="text"
                                                                                pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}"
                                                                                class="form__input"
                                                                                name="categoria_nombre_reg"
                                                                                id="categoria_nombre" maxlength="49"
                                                                                placeholder=" ">
                                                                            <label for="categoria_nombre"
                                                                                class="form__label">Nombre
                                                                                <?php echo FIELD_OBLIGATORY; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-4">
                                                                            <textarea
                                                                                pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,700}"
                                                                                class="form__input"
                                                                                name="categoria_descripcion_reg"
                                                                                id="categoria_descripcion"
                                                                                maxlength="700" rows="7"
                                                                                placeholder=" "></textarea>
                                                                            <label for="categoria_descripcion"
                                                                                class="form__label">Descripción</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline">
                                                                            <select class="form__input"
                                                                                name="categoria_estado_reg"
                                                                                id="categoria_estado">
                                                                                <option value="" selected="">Estado de
                                                                                    categoría</option>
                                                                                <option value="Habilitada">Habilitada
                                                                                </option>
                                                                                <option value="Deshabilitada">
                                                                                    Deshabilitada</option>
                                                                            </select>
                                                                            <label for="categoria_estado"
                                                                                class="form__label"></label>
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
                                    class="fa-solid fa-floppy-disk"></i> &nbsp;
                                Guardar Categoria</button>
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
                            <div class="col-12 col-sm-3">
                                <div class="d-flex justify-content-sm-end justify-content-start mt-3 mt-sm-0">
                                    <div class="form__outline w-sm-auto ms-sm-auto me-auto me-sm-0">
                                        <input type="search" id="txtbusca" class="form__input w-100" placeholder=" "
                                            aria-label="Search" />
                                        <label class="d-flex d-inline-flex me-3 form__label"> Buscar </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $("#txtbusca").keyup(function() {
            var parametros = "txtbusca=" + $(this).val()
            $.ajax({
                data: parametros,
                url: '../../ajax/buscarCategoriaAjax.php',
                type: 'post',
                beforeSend: function() {},
                success: function(response) {
                    $(".salida").html(response);
                },
                error: function() {
                    alert("error")
                }
            });
        })
    })
    </script>
    <div class="row pb-4">
        <div class="col-12">
            <div class="p-md-3 pb-0">
                <?php
            require_once "./controller/categories/categoryController.php";
            $list_user = new categoriaControlador();

            echo $list_user->paginador_categoria_marca_controlador($pagina[2], 5, $pagina[1], "");
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