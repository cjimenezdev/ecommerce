<?php
	$peticion_ajax=true;
	
	require_once "../config/app.php";
	include "../view/security/session_start.php";
    
    if(isset($_POST['modulo_venta'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../controller/sales/salesController.php";
        $ins_venta = new ventaControlador();
        

        /*--------- Registrar venta - Register order ---------*/
        if($_POST['modulo_venta']=="agregar"){
            echo $ins_venta->registrar_venta_controlador();
		}

		 /*--------- Eliminar venta - Delete order ---------*/
		if($_POST['modulo_venta']=="eliminar"){
			echo $ins_venta->eliminar_venta_controlador();
		}

    }else{
		session_destroy();
		header("Location: ".URL."home/");
	}

?>