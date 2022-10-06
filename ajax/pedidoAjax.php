<?php
	$peticion_ajax=true;
	
	require_once "../config/app.php";
	include "../view/security/session_start.php";
    
    if(isset($_POST['modulo_pedido'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../controller/order/orderController.php";
        $ins_pedido = new pedidoControlador();
        

        /*--------- Registrar pedido - Register order ---------*/
        if($_POST['modulo_pedido']=="agregar"){
            echo $ins_pedido->registrar_pedido_controlador();
		}

		 /*--------- Eliminar pedido - Delete order ---------*/
		if($_POST['modulo_pedido']=="eliminar"){
			echo $ins_pedido->eliminar_pedido_controlador();
		}

    }else{
		session_destroy();
		header("Location: ".URL."home/");
	}

?>