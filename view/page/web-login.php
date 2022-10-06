<section class="login container-fluid d-flex justify-content-center align-items-center h-100">
    <div class="content d-flex h-100">
        <div class="row d-flex align-items-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <figure class=" text-center mb-4">
                            <h2> <img src="<?php echo URL; ?>public/assets/img/logo.png" alt=""
                                    class="img-fluid login-icon">
                                Administrador</h2>
                        </figure>
                        <form action="" method="POST" autocomplete="off"
                            class="d-flex justify-content-center flex-column">
                            <div class="form-outline mb-4">
                                <input type="text" class="form-control" id="login_usuario" name="dashboard_usuario"
                                    pattern="[a-zA-Z0-9]{4,30}" maxlength="30" required="" autocomplete="off">
                                <label for="login_usuario" class="form-label"><i class="fas fa-user-secret"></i> &nbsp;
                                    Usuario</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" class="form-control" id="login_clave" name="dashboard_clave"
                                    pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required=""
                                    autocomplete="new-password">
                                <label for="login_clave" class="form-label"><i class="fas fa-key"></i> &nbsp;
                                    Contraseña</label>
                            </div>
                            <button type="submit" class="btn btn-primary text-center mb-4 w-100">Ingresar</button>
                            <a href="<?php echo URL;?>" class="text-center m-auto" data-toggle="tooltip"
                                data-placement="top" title="Tienda WILLIAM´S"><i class="fas fa-home"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    if(isset($_POST['dashboard_usuario']) && isset($_POST['dashboard_clave'])){
		require_once "./controller/login/loginController.php";

		$ins_login= new loginControlador();
		$ins_login->iniciar_sesion_administrador_controlador();
	}
?>