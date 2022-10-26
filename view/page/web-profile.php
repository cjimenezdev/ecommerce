<?php
    if($ins_login->encryption($_SESSION['id_cust'])!=$pagina[1]){
        include "./view/security/client_security.php"; 
    }
?>
<div class="container-fluid pb-5" style="margin-top:7rem;">
    <div class="py-2">
        <nav class="d-flex mb-3 py-4 pb-2 ms-2">
            <h6 class="mb-0">
                <a href="<?php echo URL; ?>home/" style="color:var(--text-primary);">Home</a>
                <span style="color:var(--text-third);">/</span>
                <span class="text-primary text-decoration-underline">Perfil</a>
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
        
        $datos_cliente=$ins_login->datos_tabla("Unico","cliente","cliente_id",$pagina[1]);
        if($datos_cliente->rowCount()==1){
            $campos=$datos_cliente->fetch();
    ?>
        <div class="col-10 col-sm-6 col-md-5 col-lg-4 d-none d-sm-block nav-profile">
            <div class="card h-100">
                <div class="card-body">
                    <div class="details-profile d-flex flex-center">
                        <div class="preview">
                            <?php if (is_file("./public/assets/img/customers/avatar/" . $campos['cliente_foto'])) { ?>
                            <form class="FormularioAjax position-relative"
                                action="<?php echo URL; ?>ajax/clienteAjax.php" method="POST" autocomplete="off">
                                <input type="hidden" name="modulo_cliente" value="eliminar_foto">
                                <input type="hidden" name="cliente_id_photo" value="<?php echo $pagina[2]; ?>">
                                <img class="rounded-circle border-0" height="55" width="55" alt=""
                                    title="<?php echo $campos['cliente_nombre']; ?>"
                                    src="<?php echo URL . "./public/assets/img/customers/avatar/" . $campos['cliente_foto']; ?>">
                                <button type="submit" class="btn btn-danger btn-floating text-white" height="10"
                                    width="10"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <?php } else { ?>
                            <img src="<?php echo URL; ?>public/assets/img/customers/avatar/default.jpg"
                                class="rounded-circle img-fluid" height="50" width="40">
                            <?php } ?>
                        </div>
                        <button class="hide-profile d-blok d-sm-none" type="button"><i
                                class="fi fi-br-angle-left"></i></button>
                    </div>
                    <div class="d-flex flex-center flex-column pt-4">
                        <p class="mb-0 font-weight-bolder">
                            <?php echo $campos['cliente_nombre']; ?>&nbsp;<?php echo $campos['cliente_apellido']; ?></p>
                        <span class="badge badge-light-primary">Cliente</span>
                    </div>
                    <div class=" mt-4">
                        <p class="text-primary font-weight-bolder">Detalles</p>
                        <hr>
                    </div>
                    <div class="pt-2 d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">Estado:</span><span
                                class="badge badge-light-success ms-sm-3"><?php echo $campos['cliente_cuenta_estado']; ?></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">DNI:</span><span
                                class="text-muted ms-sm-3"><?php echo $campos['cliente_dni']; ?></span></div>
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">Celular:</span><span
                                class="text-muted ms-sm-3"><?php echo $campos['cliente_celular']; ?></span></div>
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">Fecha Nacimiento:</span><span
                                class="badge badge-light-info ms-sm-3"><?php echo $campos['cliente_fnacimiento']; ?></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start mb-4"><span
                                class="font-weight-bold">Correo:</span><span
                                class="text-muted ms-sm-3"><?php echo $campos['cliente_email']; ?></span></div>
                        <div class="d-flex align-items-center justify-content-start"><span
                                class="font-weight-bold">Residencia:</span><span
                                class="text-muted ms-sm-3"><?php echo $campos['cliente_direccion']; ?></span></div>
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
                        action="<?php echo URL; ?>ajax/clienteAjax.php">
                        <input type="hidden" name="modulo_cliente" value="actualizar">
                        <input type="hidden" name="cliente_id_up" value="<?php echo $pagina[1]?>">
                        <div class="row">
                            <div class="col-12 col-sm-9 m-auto">
                                <div class="tab-content" id="v-tabs-tabContent">
                                    <div class="tab-pane fade show active" id="v-tabs-home" role="tabpanel"
                                        aria-labelledby="v-tabs-home-tab">
                                        <fieldset class="mb-4">
                                            <legend class="ms-0 ms-lg-15 mb-3 mt-sm-4"><i class="fi fi-sr-portrait"></i>
                                                &nbsp; Cuenta de cliente:</legend>
                                            <div class="row">
                                                <div class="col-12 col-lg-10  m-auto">
                                                    <div class="mb-3 mt-3">
                                                        <div class="drag-area rounded-circle m-auto">
                                                            <div class="icon"><i class="fas fa-cloud-upload-alt"></i>
                                                            </div>
                                                            <header>Arrastrar imagen</header>
                                                            <button onclick="dragImg();"
                                                                class="btn btn-success btn-floating text-white"
                                                                height="10" width="10" type="button"><i
                                                                    class="fa-solid fa-camera"></i></button>
                                                            <input type="file" id="cliente_photo"
                                                                name="cliente_avatar_up" hidden>
                                                            <div class="preview">
                                                                <?php if (is_file("./public/assets/img/customers/avatar/" . $campos['cliente_foto'])) { ?>
                                                                <img class="rounded-circle img-fluid" height="70"
                                                                    width="30" alt="" title="user_photo"
                                                                    src="<?php echo URL . "public/assets/img/customers/avatar/" . $campos['cliente_foto']; ?>">
                                                                <?php } else { ?>
                                                                <img src="<?php echo URL; ?>public/assets/img/customers/avatar/default.jpg"
                                                                    class="rounded-circle img-fluid" height="70"
                                                                    width="30">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <label for="cliente_photo"
                                                            class="form-label p-4 mt-4 badge-light-info text-info"
                                                            style="font-size: 12px;">Permitido: JPG, JPEG,
                                                            PNG. Tamaño máximo 3MB. Aspecto cuadrado (1:1).
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <div class="form__outline mb-5">
                                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}"
                                                        class="form__input" name="cliente_nombre_up"
                                                        value="<?php echo $campos['cliente_nombre']; ?>"
                                                        id="cliente_nombre" maxlength="35" placeholder=" ">
                                                    <label for="cliente_nombre" class="form__label">Nombres
                                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <div class="form__outline mb-5">
                                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}"
                                                        class="form__input" name="cliente_apellido_up"
                                                        value="<?php echo $campos['cliente_apellido']; ?>"
                                                        id="cliente_apellido" maxlength="35">
                                                    <label for="cliente_apellido" class="form__label">Apellidos
                                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <div class="form__outline mb-5">
                                                    <input type="tel" pattern="[0-9]{10}" class="form__input"
                                                        name="cliente_celular_up"
                                                        value="<?php echo $campos['cliente_celular']; ?>"
                                                        id="cliente_telefono" maxlength="20" required placeholder=" ">
                                                    <label for="cliente_telefono" class="form__label">Celular</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <div class="form__outline mb-5">
                                                    <input type="email" class="form__input" name="cliente_email_up"
                                                        value="<?php echo $campos['cliente_email']; ?>"
                                                        id="cliente_email" maxlength="47" placeholder=" ">
                                                    <label for="cliente_email" class="form__label">Email
                                                        <?php echo FIELD_OBLIGATORY; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-10 m-auto">
                                                <legend><i class="fas fa-user-secret"></i> &nbsp; Estado Cuenta</legend>
                                                <div class="mb-4">
                                                    <div class="form-check form-check-inline mb-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="cliente_estado_up" value="Activa"
                                                            id="cliente_estado_true" <?php if ($campos['cliente_cuenta_estado'] == "Activa") {
                                                         echo "checked"; } ?> />
                                                        <label class="form-check-label"
                                                            for="cliente_estado_true">Activa</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="cliente_cargo_up" value="Deshabilitada"
                                                            id="cliente_estado_false" <?php if ($campos['cliente_cuenta_estado'] == "Deshabilitada") {
                                                         echo "checked";} ?> />
                                                        <label class="form-check-label"
                                                            for="cliente_estado_false">Deshabilitada</label>
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
                                                Información del cliente:</legend>
                                            <div class="row">
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-5 mt-3">
                                                        <input type="date" pattern="\d{1,2}/\d{1,2}/\d{4}"
                                                            class="form__input datepicker" name="cliente_birthday_up"
                                                            value="<?php echo $campos['cliente_fnacimiento']; ?>"
                                                            id="cliente_nacimiento" maxlength="20">
                                                        <label for="cliente_nacimiento" class="form__label">Año
                                                            Nacimiento</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-5">
                                                        <input type="text" pattern="[0-9]{10}" class="form__input"
                                                            name="cliente_identidad_up"
                                                            value="<?php echo $campos['cliente_dni']; ?>"
                                                            id="cliente_identidad" maxlength="20">
                                                        <label for="cliente_identidad"
                                                            class="form__label">Identidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-5">
                                                        <input type="text" pattern="([a-zA-z0-9/\\''(),-\s]{2,255})$"
                                                            class="form__input" name="cliente_provincia_up"
                                                            value="<?php echo $campos['cliente_provincia']; ?>"
                                                            id="cliente_provincia" maxlength="255">
                                                        <label for="cliente_provincia"
                                                            class="form__label">Provincia</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-5">
                                                        <input type="text" pattern="([a-zA-z0-9/\\''(),-\s]{2,255})$"
                                                            class="form__input" name="cliente_ciudad_up"
                                                            value="<?php echo $campos['cliente_ciudad']; ?>"
                                                            id="cliente_ciudad" maxlength="255">
                                                        <label for="cliente_ciudad" class="form__label">Ciudad</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-5">
                                                        <input type="text" pattern="([a-zA-z0-9/\\''(),-\s]{2,255})$"
                                                            class="form__input" name="cliente_direccion_up"
                                                            value="<?php echo $campos['cliente_direccion']; ?>"
                                                            id="cliente_direccion" maxlength="255">
                                                        <label for="cliente_direccion"
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
                                                                name="cliente_genero_up" value="Masculino"
                                                                id="cliente_genero_male"
                                                                <?php if ($campos['cliente_genero'] == "Masculino") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?> />
                                                            <label class="form-check-label"
                                                                for="cliente_genero_male">Masculino</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="cliente_genero_up" value="Femenino"
                                                                id="cliente_genero_female"
                                                                <?php if ($campos['cliente_genero'] == "Femenino") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?> />
                                                            <label class="form-check-label"
                                                                for="cliente_genero_female">Femenino</label>
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
                                                            name="cliente_clave_1_up" id="cliente_clave_1"
                                                            pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"
                                                            placeholder=" ">
                                                        <label for="cliente_clave_1" class="form__label">Nueva
                                                            contraseña
                                                            <?php echo FIELD_OBLIGATORY; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-10 m-auto">
                                                    <div class="form__outline mb-4">
                                                        <input type="password" class="form__input"
                                                            name="cliente_clave_2_up" id="cliente_clave_2"
                                                            pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"
                                                            placeholder=" ">
                                                        <label for="cliente_clave_2" class="form__label">Confirmar
                                                            contraseña
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
    </style>
</div>