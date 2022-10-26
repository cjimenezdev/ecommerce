<?php
    include "./view/security/admin_security.php";
?>

<div class="container-fluid h-100 w-100 mt-5 d-flex flex-column justify-content-center">

    <!-- Modal -->
    <div class="pt-2">
        <nav class="d-flex ms-2">
            <h6 class="mb-2">
                <a href="<?php echo URL.DASHBOARD; ?>/home/" style="color:var(--text-primary);">Home</a>
                <span>/</span>
                <a href="<?php echo URL.DASHBOARD; ?>/customer-new/"
                    class="text-primary text-decoration-underline">Clientes</a>
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
                            <a class="text-primary"><i class="fa-solid fa-plus"></i> Nuevo Usuario</a>
                        </h6>
                    </div>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4">
                        <div class="row">
                            <div class="col-12 mt-xxl-4 mb-4" style="position: absolute; z-index: 2;left: 0;">
                                <div style="background-color: var(--bg-header);" class=" rounded-4">
                                    <!-- Tab navs -->
                                    <div class="nav nav-tabs admin d-flex d-md-block flex-column flex-md-row"
                                        id="v-tabs-tab" role="tablist" aria-orientation="vertical">
                                        <a id="v-tabs-home-tab" data-mdb-toggle="tab" href="#v-tabs-home" role="tab"
                                            aria-controls="v-tabs-home" aria-selected="false"><i
                                                class="fi fi-sr-portrait"></i> &nbsp;Cuenta</a>
                                        <a id="v-tabs-profile-tab" data-mdb-toggle="tab" href="#v-tabs-profile"
                                            role="tab" aria-controls="v-tabs-profile" aria-selected="false"><i
                                                class="fi fi-sr-form"></i> &nbsp;Información</a>
                                        <a id="v-tabs-password-tab" data-mdb-toggle="tab" href="#v-tabs-password"
                                            role="tab" aria-controls="v-tabs-password" aria-selected="false"><i
                                                class="fi fi-br-password"></i> &nbsp;
                                            Contraseña</a>
                                    </div>
                                </div>
                                <!-- Tab navs -->
                            </div>
                            <div class="col-12 m-xxl-auto mt-7 mt-md-5">
                                <!-- Tab content -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <form class="dashboard-container FormularioAjax" method="POST"
                                                    data-form="save" data-lang="es" autocomplete="off"
                                                    action="<?php echo URL; ?>ajax/administradorAjax.php">
                                                    <input type="hidden" name="modulo_administrador" value="registro">
                                                    <div class="tab-content" id="v-tabs-tabContent">
                                                        <div class="tab-pane fade show active" id="v-tabs-home"
                                                            role="tabpanel" aria-labelledby="v-tabs-home-tab">
                                                            <fieldset class="mb-4">
                                                                <legend class="mb-3 mt-sm-4"><i
                                                                        class="fi fi-sr-portrait"></i> &nbsp; Cuenta de
                                                                    usuario:</legend>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 mt-3">
                                                                            <div
                                                                                class="drag-area rounded-circle m-auto">
                                                                                <div class="icon"><i
                                                                                        class="fas fa-cloud-upload-alt"></i>
                                                                                </div>
                                                                                <button
                                                                                    class="btn btn-success text-white"
                                                                                    height="10" width="10"
                                                                                    type="button"><i
                                                                                        class="fa-solid fa-camera"></i></button>
                                                                                <input hidden class=" w-25"
                                                                                    id="usuario_photo"
                                                                                    name="usuario_photo" type="file" />
                                                                                <div class="preview">
                                                                                    <img src="<?php echo URL; ?>public/assets/img/users/avatar/default.jpg"
                                                                                        class="rounded-circle img-fluid"
                                                                                        height="70" width="30">
                                                                                </div>
                                                                            </div>
                                                                            <label for="usuario_photo"
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
                                                                            <input type="text"
                                                                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}"
                                                                                class="form__input"
                                                                                name="usuario_nombre_reg"
                                                                                id="usuario_nombre" maxlength="35"
                                                                                placeholder=" ">
                                                                            <label for="usuario_nombre"
                                                                                class="form__label">Nombres
                                                                                <?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="text"
                                                                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}"
                                                                                class="form__input"
                                                                                name="usuario_apellido_reg"
                                                                                id="usuario_apellido" maxlength="35"
                                                                                placeholder=" ">
                                                                            <label for="usuario_apellido"
                                                                                class="form__label">Apellidos
                                                                                <?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="text"
                                                                                pattern="[a-zA-Z0-9]{4,30}"
                                                                                class="form__input"
                                                                                name="usuario_usuario_reg"
                                                                                id="usuario_usuario" maxlength="30"
                                                                                placeholder=" ">
                                                                            <label for="usuario_usuario"
                                                                                class="form__label">Usuario
                                                                                <?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="email" class="form__input"
                                                                                name="usuario_email_reg"
                                                                                id="usuario_email" maxlength="47"
                                                                                placeholder=" ">
                                                                            <label for="usuario_email"
                                                                                class="form__label">Email
                                                                                <?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <legend><i class="fas fa-user-secret"></i>
                                                                            &nbsp;
                                                                            Cargo
                                                                        </legend>
                                                                        <div class="mb-4">
                                                                            <div class="p-2">
                                                                                <div
                                                                                    class="form-check form-check-inline mb-2">
                                                                                    <input class="form-check-input"
                                                                                        type="radio"
                                                                                        name="usuario_cargo_reg"
                                                                                        value="Administrador"
                                                                                        id="usuario_cargo_admin"
                                                                                        checked />
                                                                                    <label class="form-check-label"
                                                                                        for="usuario_cargo_admin">Administrador</label>
                                                                                </div>

                                                                                <div
                                                                                    class="form-check form-check-inline">
                                                                                    <input class="form-check-input"
                                                                                        type="radio"
                                                                                        name="usuario_cargo_reg"
                                                                                        value="Cajero"
                                                                                        id="usuario_cargo_cajero" />
                                                                                    <label class="form-check-label"
                                                                                        for="usuario_cargo_cajero">Cajero</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <legend><i class="fas fa-user-secret"></i>
                                                                            &nbsp;
                                                                            Estado
                                                                        </legend>
                                                                        <div class="mb-4">
                                                                            <div class="p-2">
                                                                                <div
                                                                                    class="form-check form-check-inline mb-2">
                                                                                    <input class="form-check-input"
                                                                                        type="radio"
                                                                                        name="usuario_estado_reg"
                                                                                        value="Activa"
                                                                                        id="usuario_estado_activa"
                                                                                        checked />
                                                                                    <label class="form-check-label"
                                                                                        for="usuario_estado_activa">Activo</label>
                                                                                </div>
                                                                                <div
                                                                                    class="form-check form-check-inline">
                                                                                    <input class="form-check-input"
                                                                                        type="radio"
                                                                                        name="usuario_estado_reg"
                                                                                        value="Deshabilitada"
                                                                                        id="usuario_estado_deshabilitada" />
                                                                                    <label class="form-check-label"
                                                                                        for="usuario_estado_deshabilitada">Deshabilitada</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="tab-pane fade" id="v-tabs-profile" role="tabpanel"
                                                            aria-labelledby="v-tabs-profile-tab">
                                                            <fieldset class="mb-4">
                                                                <legend class="mb-3 mt-sm-4"><i
                                                                        class="fi fi-sr-form"></i>
                                                                    &nbsp; Información del usuario:</legend>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5 mt-3">
                                                                            <input type="date"
                                                                                pattern="\d{1,2}/\d{1,2}/\d{4}"
                                                                                placeholder=" "
                                                                                class="form__input datepicker"
                                                                                name="usuario_birthday_reg"
                                                                                id="usuario_nacimiento" maxlength="20">
                                                                            <label for="usuario_nacimiento"
                                                                                class="form__label">Año
                                                                                Nacimiento</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="number" pattern="[0-9]{10}"
                                                                                class="form__input"
                                                                                name="usuario_identidad_reg"
                                                                                id="usuario_identidad" maxlength="10"
                                                                                placeholder=" ">
                                                                            <label for="usuario_identidad"
                                                                                class="form__label">Identidad
                                                                                <?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="tel" pattern="[0-9]{10}"
                                                                                class="form__input"
                                                                                name="usuario_telefono_reg"
                                                                                id="usuario_telefono" maxlength="20"
                                                                                placeholder=" ">
                                                                            <label for="usuario_telefono"
                                                                                class="form__label">Teléfono</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="text"
                                                                                pattern="([a-zA-z0-9/\\''(),-\s]{2,255})$"
                                                                                class="form__input"
                                                                                name="usuario_direccion_reg"
                                                                                id="usuario_direccion" maxlength="255"
                                                                                placeholder=" ">
                                                                            <label for="usuario_direccion"
                                                                                class="form__label">Dirección<?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <legend><i class="fas fa-female"></i> <i
                                                                                class="fas fa-male"></i> &nbsp; Genero
                                                                        </legend>
                                                                        <div class="mb-4">
                                                                            <div
                                                                                class="form-check form-check-inline mb-2">
                                                                                <input class="form-check-input"
                                                                                    type="radio"
                                                                                    name="usuario_genero_reg"
                                                                                    value="Masculino"
                                                                                    id="usuario_genero_male" checked />
                                                                                <label
                                                                                    class="form-check-label check-label"
                                                                                    for="usuario_genero_male">Masculino</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio"
                                                                                    name="usuario_genero_reg"
                                                                                    value="Femenino"
                                                                                    id="usuario_genero_female" />
                                                                                <label
                                                                                    class="form-check-label check-label"
                                                                                    for="usuario_genero_female">Femenino</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="tab-pane fade" id="v-tabs-password" role="tabpanel"
                                                            aria-labelledby="v-tabs-password-tab">
                                                            <fieldset>
                                                                <legend class="mb-3 mt-sm-4"><i
                                                                        class="fi fi-br-password"></i> &nbsp;
                                                                    Contraseña:
                                                                </legend>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <p class="text-start">Ingrese una
                                                                            <strong>contraseña</strong> y <strong>clave
                                                                                personal</strong> para esta cuenta.
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="password" class="form__input"
                                                                                name="usuario_clave_1_reg"
                                                                                id="usuario_clave_1"
                                                                                pattern="[a-zA-Z0-9$@.-]{7,100}"
                                                                                maxlength="100" placeholder=" ">
                                                                            <label for="usuario_clave_1"
                                                                                class="form__label">Contraseña
                                                                                <?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="password" class="form__input"
                                                                                name="usuario_clave_2_reg"
                                                                                id="usuario_clave_2"
                                                                                pattern="[a-zA-Z0-9$@.-]{7,100}"
                                                                                maxlength="100" placeholder=" ">
                                                                            <label for="usuario_clave_2"
                                                                                class="form__label">Repita contraseña
                                                                                <?php echo "*"; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form__outline mb-5">
                                                                            <input type="text" class="form__input"
                                                                                name="usuario_code_reg"
                                                                                id="usuario_código" pattern="[0-9]{6}"
                                                                                maxlength="6" placeholder=" ">
                                                                            <label for="usuario_codigo"
                                                                                class="form__label">Clave personal
                                                                                <?php echo "*"; ?></label>
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
                                Guardar Usuario</button>
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
                                    <button type="button" disabled data-mdb-toggle="modal" data-mdb-target="#exampleModal"
                                        class="btn text-white rounded-4 disabled" title="Agregar"
                                        style="background-color: #7367f0 !important; height: 40px;">
                                        <i class="fa-solid fa-plus"></i> Agregar
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" data-mdb-toggle="modal"
                                        data-mdb-target="#exampleModal" class="btn text-white rounded-4"
                                        title="Agregar" style="background-color: #7367f0 !important; height: 40px;">
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
                url: '../../ajax/buscadorClienteAjax.php',
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
            require_once "./controller/customers/customersController.php";
            $list_user = new clienteControlador();

            echo $list_user->paginador_cliente_controlador($pagina[2], 5, $pagina[1], "");
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