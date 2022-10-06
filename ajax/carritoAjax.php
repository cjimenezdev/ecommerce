<?php
	$peticion_ajax=true;
	require_once "../config/app.php";
	include "../view/security/session_start.php";

	if(isset($_POST['modulo_carrito'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../controller/cart/cartController.php";
        $ins_cart = new carritoControlador();
        

        /*--------- Registrar administrador - Register administrator ---------*/
        if($_POST['modulo_carrito']=="agregar"){
            echo $ins_cart->agregar_carrito_controlador();
		}
		
		/*--------- Eliminar administrador - Delete administrator ---------*/
        if($_POST['modulo_carrito']=="eliminar"){
            echo $ins_cart->eliminar_carrito_controlador();
		}

		/*--------- Actualizar administrador - Update administrator ---------*/
        if($_POST['modulo_carrito']=="actualizar"){
            echo $ins_cart->actualizar_carrito_controlador();
        }

	}else{
		session_destroy();
		header("Location: ".URL."/");
	}