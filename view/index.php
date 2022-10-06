<?php
    /*---------- Iniciando sesion ----------*/
    include "./view/security/session_start.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "./view/inc/head.php"; ?>
</head>

<body id="main-body" class="scroll">

    <div class="h-100">
        <?php
        
        $peticion_ajax=false;

        if(isset($_GET['view'])){
            $pagina=explode("/", $_GET['view']);
        }else{
            $pagina=[];
        }

        /*---------- Instancia controlador vistas ----------*/
        require_once "./controller/config/viewsController.php";
        $ins_vistas = new vistasControlador();

        /*---------- Instancia controlador login ----------*/
        require_once "./controller/login/loginController.php";
        $ins_login = new loginControlador();
        

        if(isset($pagina[0]) && DASHBOARD==$pagina[0]){

            /*---------- Dashboard ----------*/
            $vistas=$ins_vistas->obtener_vistas_controlador("dashboard");

            if($vistas=="login" || $vistas=="404" || $vistas=="signin" || $vistas=="register"){
                require_once './view/page/web-'.$vistas.'.php';
            }else{

                /*-- Comprobando acceso del usuario - Checking user access --*/
                if(!isset($_SESSION['token_sto']) || !isset($_SESSION['id_sto']) || !isset($_SESSION['nombre_sto']) || !isset($_SESSION['apellido_sto']) || !isset($_SESSION['usuario_sto']) || !isset($_SESSION['cargo_sto'])){
                    $ins_login->forzar_cierre_sesion_controlador();
                }
            ?>
        <!-- Nav lateral -->
        <?php include "./view/inc/nav_lateral.php"; ?>
        <!-- Main container -->
        <main class="h-100">

            <!-- Page content -->
            <section class="container-fluid h-100">

                <!-- Nav bar -->
                <?php include "./view/inc/nav_bar.php"; ?>

                <?php 
                /*---------- Vista ----------*/
                require_once $vistas;
                if(isset($_SESSION['cargo_sto']) && ($_SESSION['cargo_sto']=="Administrador" || $_SESSION['cargo_sto']=="Cajero")){
                    include "./view/security/log_out_admin.php";
                }
                ?>

            </section>
        </main>
        <?php
                include "./view/security/log_out_admin.php";
            }
            include "./view/inc/admin-script.php";
        }else{

        /*---------- Web ----------*/
        $vistas=$ins_vistas->obtener_vistas_controlador("web");

        if($vistas=="404"){
        require_once "./view/page/web-404.php";
        }else{
        if($vistas=="signin"){
        require_once './view/page/web-signin.php';
        }else{
        if($vistas=="register"){
        require_once "./view/page/web-register.php";
        }else{

        /*---------- Header ----------*/
        include "./view/inc/header.php";

        /*---------- Vista ----------*/
        require_once $vistas;

        /*---------- Footer ----------*/
        include "./view/inc/footer.php";

        if(isset($_SESSION['nombre_cust']) && isset($_SESSION['correo_cust'])){
        include "./view/security/log_out_cliente.php";
        }
        }
        }
        }
        /*---------- Scripts ----------*/
        include "./view/inc/scripts.php";
        }
        ?>
    </div>

    <script type='text/javascript'>
    $(function() {
        $(document).bind("contextmenu", function(e) {
            return false;
        });
        $('body').bind('cut copy paste', function(e) {
            e.preventDefault();
        });
    });
    </script>
</body>

</html>
