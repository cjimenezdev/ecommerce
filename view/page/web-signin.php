<?php if(isset($_SESSION['nombre_cust'])){ 
    
    header("Location: ".URL."home/");

}else{
?>

<!-- Precarga -->
<div class="preloader">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<!-- /Precarga -->

<section class="singin container-fluid p-0 h-100" id="page">
    <div class="content h-100">
        <div class="row h-100">
            <div class="col-lg-7 d-lg-flex d-none align-items-center justify-content-center"
                style="background:url(../public/assets/img/bg/login/user/fondo1.jpg);background-size:cover; background-position:center;">
                <div class="d-flex justify-content-center p-2 position-relative">
                    <div class="h-100"
                        style="position: absolute;backdrop-filter: blur(10px);top: -0.5rem;left: 0;right: 0;bottom: 0;">
                        <img src="<?php echo URL;?>public/assets/img/bg/singin/login-banner.png" class="img-fluid" />
                    </div>
                    <div>
                        <img src="<?php echo URL;?>public/assets/img/bg/singin/login-banner.png" class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-flex align-items-center justify-content-center h-100 bg-light">
                <div class="card m-2 m-md-0" id="login">
                    <div class="card-body">
                        <figure class=" text-center mb-4">
                            <h2> <img src="<?php echo URL; ?>public/assets/img/logo.png" alt=""
                                    class="img-fluid login-icon">
                                <a href="<?php echo URL;?>" class=" text-black">WILLIAM´S</a>
                            </h2>
                        </figure>
                        <form action="" method="POST" autocomplete="off"
                            class="d-flex justify-content-center flex-column">
                            <div class="form__outline mb-4">
                                <input type="email" class="form__input" id="login_email" name="login_email"
                                    maxlength="50" required="" autocomplete="off" placeholder=" ">
                                <label for="login_email" class="form__label"><i class="fas fa-envelope-open-text"></i>
                                    &nbsp;
                                    Email</label>
                            </div>
                            <div class="form__outline mb-2">
                                <input type="password" class="form__input" id="login_clave" name="login_clave"
                                    pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" placeholder=" "
                                    autocomplete="new-password">
                                <label for="login_clave" class="form__label"><i class="fas fa-key"></i> &nbsp;
                                    Contraseña</label>
                                <span>
                                    <id= class="fa-solid fa-eye icon-pass" id="eye" onclick="toggle()"></i>
                                </span>
                                <input type="hidden" name="" autocomplete="off">
                            </div>
                            <a href="#register" onclick="showReg();" class="font-weight-bold mb-4">¿Ólvidaste la
                                contraseña?</a>
                            <button type="submit" class="btn btn-primary text-center w-100">Iniciar Sesión</button>
                            <div class="d-flex align-items-center flex-row my-2">
                                <hr class="w-100"><span class="mx-2">O</span>
                                <hr class="w-100">
                            </div>
                            <p class="text-center poppins-regular">¿Todavía no tienes cuenta? <a href="#register"
                                    onclick="showReg();" class="font-weight-bold">Regístrate</a>
                            </p>
                        </form>
                        <?php
                        if(isset($_POST['login_email']) && isset($_POST['login_clave'])){
                            require_once "./controller/login/loginController.php";
                            
                            $ins_login= new loginControlador();
                            $ins_login->iniciar_sesion_cliente_controlador();
                        }
                        ?>
                    </div>
                </div>
                <style>
                #reg {
                    display: none;
                }
                </style>
                <div class="card m-4 m-md-5" id="reg">
                    <div class="card-body">
                        <figure class=" text-center mb-4">
                            <h2> <img src="<?php echo URL; ?>public/assets/img/logo.png" alt=""
                                    class="img-fluid login-icon">
                                <a href="<?php echo URL;?>" class=" text-black">WILLIAM´S</a>
                            </h2>
                        </figure>
                        <form autocomplete="off" class="d-flex justify-content-center flex-column FormularioAjax"
                            method="POST" data-form="save" data-lang="es" autocomplete="off"
                            action="<?php echo URL; ?>ajax/clienteAjax.php">
                            <input type="hidden" name="modulo_cliente" value="registro">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form__outline mb-4">
                                        <input type="text" class="form__input" id="login_name" name="cliente_nombre_reg"
                                            pattern="[a-zA-Z0-9]{4,30}" maxlength="30" required="Nombre"
                                            autocomplete="off" placeholder=" ">
                                        <label for="login_name" class="form__label"><i
                                                class="fa-solid fa-signature"></i>
                                            &nbsp;
                                            Nombre</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form__outline mb-4">
                                        <input type="text" class="form__input" id="login_user"
                                            name="cliente_apellido_reg" maxlength="50" required="" autocomplete="off"
                                            placeholder=" ">
                                        <label for="login_user" class="form__label"><i
                                                class="fa-solid fa-signature"></i>
                                            &nbsp;
                                            Apellido</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form__outline mb-4">
                                <input type="email" class="form__input" id="login_email_reg" name="cliente_email_reg"
                                    pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" autocomplete="off"
                                    placeholder=" ">
                                <label for="login_email_reg" class="form__label"><i
                                        class="fas fa-envelope-open-text"></i>
                                    &nbsp;
                                    Email</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form__outline mb-4">
                                        <input type="password" class="form__input" id="login_clave_1_reg"
                                            name="cliente_clave_1_reg" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"
                                            required="" placeholder=" " autocomplete="new-password">
                                        <label for="login_clave_1_reg" class="form__label"><i class="fas fa-key"></i>
                                            &nbsp;
                                            Contraseña</label>
                                        <span>
                                            <id= class="fa-solid fa-eye icon-pass" id="eye2" onclick="toggle2();"></i>
                                        </span>
                                        <input type="hidden" name="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form__outline mb-4">
                                        <input type="password" class="form__input" id="login_clave_2_reg"
                                            name="cliente_clave_2_reg" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"
                                            required="" placeholder=" " autocomplete="new-password">
                                        <label for="login_clave_2_reg" class="form__label"><i class="fas fa-key"></i>
                                            &nbsp;
                                            Repetir Contraseña</label>
                                        <span>
                                            <id= class="fa-solid fa-eye icon-pass" id="eye3" onclick="toggle3();"></i>
                                        </span>
                                        <input type="hidden" name="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary text-center w-100">
                                Regístrate</button>
                            <div class="d-flex align-items-center flex-row my-2">
                                <hr class="w-100"><span class="mx-2">O</span>
                                <hr class="w-100">
                            </div>
                            <p class="text-center poppins-regular">¿Ya tienes una cuenta? <a href="#login"
                                    onclick="showLogin();" class=" font-weight-bold">Iniciar Sesión</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}
?>