<?php
	$peticion_ajax=true;
	
	require_once "../config/app.php";
	include "../view/security/session_start.php";
    
    if(isset($_POST['modulo_catalogo'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../controller/catalogue/catalogueController.php";
        $ins_venta = new catalogoControlador();
        

        /*--------- Registrar venta - Register order ---------*/
        if($_POST['modulo_catalogo']=="agregar"){
            echo $ins_venta->registrar_catalogo_controlador();
		}

		 /*--------- Eliminar venta - Delete order ---------*/
		if($_POST['modulo_catalogo']=="eliminar"){
			echo $ins_venta->eliminar_catalogo_controlador();
		}

        /*--------- Actualizar catalogo - Update category ---------*/
        if($_POST['modulo_catalogo']=="actualizar"){
            echo $ins_catalogo->actualizar_catalogo_controlador();
        }

    }else{
		session_destroy();
		header("Location: ".URL."home/");
	}

?>