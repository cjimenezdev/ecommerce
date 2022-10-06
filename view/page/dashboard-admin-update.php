<?php
    if($ins_login->encryption($_SESSION['id_sto'])!=$pagina[2]){
        include "./view/security/admin_security.php"; 
    }
?>
<div class="container-fluid pb-5">
    <div class="py-2">
        <nav class="d-flex mb-3 py-4 pb-2 ms-2">
            <h6 class="mb-0 mt-4">
                <a href="<?php echo URL; ?>admin/home/" style="color:var(--text-primary);">Home</a>
                <span class="text-dark">/</span>
                <a href="<?php echo URL; ?>admin/admin-new/">Administrador/</a>
                <span class="text-primary text-decoration-underline">Actualizar</a>
            </h6>
        </nav>
    </div>
    <nav class="navbar navbar-expand-xl navbar-light d-block d-sm-none navbar-profile">
        <div class="container-fluid m-xxl-2 p-0">
            <button class="show-profile ms-2" type="button"><i class="fi fi-rr-align-left"></i></button>
        </div>
    </nav>
    <div class="row">
        <?php
        
        $datos_usuario=$ins_login->datos_tabla("Unico","usuario","usuario_id",$pagina[2]);
        if($datos_usuario->rowCount()==1){
            $campos=$datos_usuario->fetch();
    ?>
        <div class="col-10 col-sm-6 col-md-5 col-lg-4 d-none d-sm-block nav-profile">
            <div class="card h-100">
                <div class="card-body">
                    <div class="details-profile d-flex flex-center">
                        <div class="preview">
                            <?php if (is_file("./public/assets/img/users/avatar/" . $campos['usuario_foto'])) { ?>
                            <form class="FormularioAjax position-relative"
                                action="<?php echo URL; ?>ajax/administradorAjax.php" method="POST" autocomplete="off">
                                <input type="hidden" name="modulo_administrador" value="eliminar_foto">
                                <input type="hidden" name="usuario_id_photo" value="<?php echo $pagina[2]; ?>">
                                <img class="rounded-circle border-0" height="55" width="55" alt=""
                                    title="<?php echo $campos['usuario_nombre']; ?>"
                                    src="<?php echo URL . "./public/assets/img/users/avatar/" . $campos['usuario_foto']; ?>">
                                <button type="submit" class="btn btn-danger btn-floating text-white" height="10"
                                    width="10"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <?php } else { ?>
                            <img src="<?php echo URL; ?>public/assets/img/users/avatar/default.jpg"
                                class="rounded-circle img-fluid" height="50" width="40">
                            <?php } ?>
                        </div>
                        <button class="hide-profile d-blok d-sm-none" type="button"><i
                                class="fi fi-br-angle-left"></i></button>
                    </div>
                    <div class="d-flex flex-center flex-column pt-4">
                        <p class="mb-0 font-weight-bolder">
                            <?php echo $campos['usuario_nombre']; ?>&nbsp;<?php echo $campos['usuario_apellido']; ?></p>
                        <span class="badge badge-light-primary"><?php echo $campos['usuario_cargo']; ?></span>
                    </div>
                    <div class=" mt-4">
                        <p class="text-primary font-weight-bolder">Detalles</p>
                        <hr>
                    </div>
                    <div class="pt-2 d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">Usuario:</span><span
                                class="text-muted ms-sm-3"><?php echo $campos['usuario_usuario']; ?></span></div>
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">Estado:</span><span
                                class="badge badge-light-success ms-sm-3"><?php echo $campos['usuario_cuenta_estado']; ?></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">Correo:</span><span
                                class="text-muted ms-sm-3"><?php echo $campos['usuario_email']; ?></span></div>
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">Celular:</span><span
                                class="text-muted ms-sm-3">0<?php echo $campos['usuario_telefono']; ?></span></div>
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">DNI:</span><span
                                class="text-muted ms-sm-3"><?php echo $campos['usuario_dni']; ?></span></div>
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">Cargo:</span><span
                                class="text-muted ms-sm-3"><?php echo $campos['usuario_cargo']; ?></span></div>
                        <div class="d-flex align-items-center justify-content-start"><span
                                class="font-weight-bold">Residencia:</span><span
                                class="text-muted ms-sm-3"><?php echo $campos['usuario_direccion']; ?></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-7 col-lg-8">
            <div class="content-info border-0">
                <div class="d-block">
                    <!-- Tab navs -->
                    <ul class="nav nav-tabs mb-3 border-0 d-block d-sm-flex" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#v-tabs-home"
                                role="tab" aria-controls="ex1-tabs-1" aria-selected="true"><i
                                    class="fi fi-sr-portrait"></i> &nbsp;
                                Cuenta</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#v-tabs-profile" role="tab"
                                aria-controls="ex1-tabs-2" aria-selected="false"><i class="fi fi-sr-form"></i> &nbsp;
                                Información</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#v-tabs-password" role="tab"
                                aria-controls="ex1-tabs-3" aria-selected="false"><i class="fi fi-br-password"></i>
                                &nbsp;
                                Contraseña</a>
                        </li>
                    </ul>
                    <!-- Tabs navs -->

                    <!-- Tab navs -->
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="FormularioAjax" method="POST" data-form="update" data-lang="es" autocomplete="off"
                        action="<?php echo URL; ?>ajax/administradorAjax.php">
                        <input type="hidden" name="modulo_administrador" value="actualizar">
                        <input type="hidden" name="usuario_id_up" value="<?php echo $pagina[2]?>">
                        <div class="row">
                            <div class="col-12 col-sm-9 m-auto">
                                <div class="tab-content" id="v-tabs-tabContent">
                                    <div class="tab-pane fade show active" id="v-tabs-home" role="tabpanel"
                                        aria-labelledby="v-tabs-home-tab">
                                        <fieldset class="mb-4">
                                            <legend class="ms-0 ms-lg-15 mb-3 mt-sm-4"><i class="fi fi-sr-portrait"></i>
                                                &nbsp; Cuenta de usuario:</legend>
                                            <div class="row">
                                                <div class="col-12 col-lg-10  m-auto">
                                                    <div class="mb-3 mt-3">
                                                        <div class="drag-area rounded-circle m-auto">
                                                            <div class="icon"><i class="fas fa-cloud-upload-alt"></i>
                                                            </div>
                                                            <header>Arrastrar imagen</header>
                                                            <button class="btn btn-success btn-floating text-white"
                                                                height="10" width="10" type="button"><i
                                                                    class="fa-solid fa-camera"></i></button>
                                                            <input type="file" id="usuario_photo"
                                                                name="usuario_avatar_up" hidden>
                                                            <div class="preview">
                                                                <?php if (is_file("./public/assets/img/users/avatar/" . $campos['usuario_foto'])) { ?>
                                                                <img class="rounded-circle img-fluid" height="70"
                                                                    width="30" alt="" title="user_photo"
                                                                    src="<?php echo URL . "public/assets/img/users/avatar/" . $campos['usuario_foto']; ?>">
                                                                <?php } else { ?>
                                                                <img src="<?php echo URL; ?>public/assets/img/users/avatar/default.jpg"
                                                                    class="rounded-circle img-fluid" height="70"
                                                                    width="30">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <label for="usuario_photo"
                                                            class="form-label p-4 mt-4 badge-light-info text-info"
                                                            style="font-size: 12px;">Permitido: JPG, JPEG,
                                                            PNG. Tamaño máximo 3MB. Aspecto cuadrado (1:1).
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <div class="form__outline mb-5">
                                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}"
                                                        class="form__input" name="usuario_nombre_up"
                                                        value="<?php echo $campos['usuario_nombre']; ?>"
                                                        id="usuario_nombre" maxlength="35" placeholder=" ">
                                                    <label for="usuario_nombre" class="form__label">Nombres
                                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <div class="form__outline mb-5">
                                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}"
                                                        class="form__input" name="usuario_apellido_up"
                                                        value="<?php echo $campos['usuario_apellido']; ?>"
                                                        id="usuario_apellido" maxlength="35">
                                                    <label for="usuario_apellido" class="form__label">Apellidos
                                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <div class="form__outline mb-5">
                                                    <input type="text" pattern="[a-zA-Z0-9]{4,30}" class="form__input"
                                                        name="usuario_usuario_up"
                                                        value="<?php echo $campos['usuario_usuario']; ?>"
                                                        id="usuario_usuario" maxlength="30" placeholder=" ">
                                                    <label for="usuario_usuario" class="form__label">Usuario
                                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <div class="form__outline mb-5">
                                                    <input type="email" class="form__input" name="usuario_email_up"
                                                        value="<?php echo $campos['usuario_email']; ?>"
                                                        id="usuario_email" maxlength="47" placeholder=" ">
                                                    <label for="usuario_email" class="form__label">Email
                                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <legend><i class="fas fa-user-secret"></i> &nbsp; Cargo</legend>
                                                <div class="mb-4">
                                                    <div class="form-check form-check-inline mb-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="usuario_cargo_up" value="Administrador"
                                                            id="usuario_cargo_admin" <?php if ($campos['usuario_cargo'] == "Administrador") {
                                                         echo "checked"; } ?> />
                                                        <label class="form-check-label"
                                                            for="usuario_cargo_admin">Administrador</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="usuario_cargo_up" value="Cajero"
                                                            id="usuario_cargo_cajero" <?php if ($campos['usuario_cargo'] == "Cajero") {
                                                         echo "checked";} ?> />
                                                        <label class="form-check-label"
                                                            for="usuario_cargo_cajero">Cajero</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <legend><i class="fas fa-user-secret"></i> &nbsp; Estado Cuenta</legend>
                                                <div class="mb-4">
                                                    <div class="form-check form-check-inline mb-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="usuario_estado_up" value="Activa"
                                                            id="usuario_estado_true" <?php if ($campos['usuario_cuenta_estado'] == "Activa") {
                                                         echo "checked"; } ?> />
                                                        <label class="form-check-label"
                                                            for="usuario_estado_true">Activa</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="usuario_cargo_up" value="Deshabilitada"
                                                            id="usuario_estado_false" <?php if ($campos['usuario_cuenta_estado'] == "Deshabilitada") {
                                                         echo "checked";} ?> />
                                                        <label class="form-check-label"
                                                            for="usuario_estado_false">Deshabilitada</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane fade" id="v-tabs-profile" role="tabpanel"
                                        aria-labelledby="v-tabs-profile-tab">
                                        <fieldset class="mb-4">
                                            <legend class="ms-0 ms-lg-15 mb-3 mt-sm-4"><i class="fi fi-sr-form"></i>
                                                &nbsp;
                                                Información del usuario:</legend>
                                            <div class="row">
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-5 mt-3">
                                                        <input type="date" pattern="\d{1,2}/\d{1,2}/\d{4}"
                                                            class="form__input datepicker" name="usuario_birthday_up"
                                                            value="<?php echo $campos['usuario_fnacimiento']; ?>"
                                                            id="usuario_nacimiento" maxlength="20">
                                                        <label for="usuario_nacimiento" class="form__label">Año
                                                            Nacimiento</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-5">
                                                        <input type="text" pattern="[0-9]{10}" class="form__input"
                                                            name="usuario_identidad_up"
                                                            value="<?php echo $campos['usuario_dni']; ?>"
                                                            id="usuario_identidad" maxlength="20">
                                                        <label for="usuario_identidad"
                                                            class="form__label">Identidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-5">
                                                        <input type="tel" pattern="[0-9]{10}" class="form__input"
                                                            name="usuario_telefono_up"
                                                            value="<?php echo '0'.$campos['usuario_telefono']; ?>"
                                                            id="usuario_telefono" maxlength="20" placeholder=" ">
                                                        <label for="usuario_telefono"
                                                            class="form__label">Teléfono</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-5">
                                                        <input type="text" pattern="([a-zA-z0-9/\\''(),-\s]{2,255})$"
                                                            class="form__input" name="usuario_direccion_up"
                                                            value="<?php echo $campos['usuario_direccion']; ?>"
                                                            id="usuario_direccion" maxlength="255">
                                                        <label for="usuario_direccion"
                                                            class="form__label">Dirección</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <legend><i class="fas fa-female"></i> <i class="fas fa-male"></i>
                                                        &nbsp;
                                                        Genero</legend>
                                                    <div class="mb-4">
                                                        <div class="form-check form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="usuario_genero_up" value="Masculino"
                                                                id="usuario_genero_male"
                                                                <?php if ($campos['usuario_genero'] == "Masculino") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?> />
                                                            <label class="form-check-label"
                                                                for="usuario_genero_male">Masculino</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="usuario_genero_up" value="Femenino"
                                                                id="usuario_genero_female"
                                                                <?php if ($campos['usuario_genero'] == "Femenino") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?> />
                                                            <label class="form-check-label"
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
                                            <legend class="ms-0 ms-lg-15 mb-3 mt-sm-4"><i class="fi fi-br-password"></i>
                                                &nbsp; Cambiar la contraseña:</legend>
                                            <div class="row">
                                                <div
                                                    class="col-12 col-lg-10 m-auto p-4 mb-4 badge-light-warning rounded-pil">
                                                    <p class="text-warning font-weight-bolder">Asegúrese de que se
                                                        cumplan
                                                        estos requisitos: </p>
                                                    <span class="text-warning">Mínimo 8 caracteres de largo, mayúsculas
                                                        y
                                                        símbolos</span>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-4">
                                                        <input type="password" class="form__input"
                                                            name="usuario_nueva_clave_1_up" id="usuario_clave_1"
                                                            pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"
                                                            placeholder=" ">
                                                        <label for="usuario_clave_1" class="form__label">Nueva
                                                            contraseña
                                                            <?php echo FIELD_OBLIGATORY; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-4">
                                                        <input type="password" class="form__input"
                                                            name="usuario_nueva_clave_2_up" id="usuario_clave_2"
                                                            pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"
                                                            placeholder=" ">
                                                        <label for="usuario_clave_2" class="form__label">Confirmar
                                                            contraseña
                                                            <?php echo FIELD_OBLIGATORY; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-4">
                                                        <input type="number" class="form__input"
                                                            name="usuario_nuevo_codigo_up"
                                                            value="<?php echo $campos['usuario_codigo']; ?>"
                                                            id="usuario_codigo" pattern="[a-zA-Z0-9$@.-]{7,100}"
                                                            maxlength="100" placeholder=" " required>
                                                        <label for="usuario_codigo" class="form__label">Código Personal
                                                            <?php echo FIELD_OBLIGATORY; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-5 col-lg-4">
                                    <button type="submit"
                                        class="btn bg-primary rounded-4 ms-0 ms-lg-15 w-100 mt-3 text-white"
                                        data-mdb-dismiss="modal" aria-label="Close"
                                        style="border-radius: 15px;padding:0.7rem;"><i
                                            class="fa-solid fa-floppy-disk"></i> &nbsp;
                                        Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } else {
        include "./view/inc/error_alert.php";
    }
    ?>
    </div>
    <div class="mask hide d-sm-none"></div>
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
</div>