<?php
	$peticion_ajax=true;
	
	require_once "../config/app.php";
	include "../view/security/session_start.php";
    
    if(isset($_POST['modulo_comentario'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../controller/comment/commentController.php";
        $ins_comentario = new comentarioControlador();
        

        /*--------- Registrar comentario - Register order ---------*/
        if($_POST['modulo_comentario']=="agregar"){
            echo $ins_comentario->registrar_comentario_controlador();
		}

		 /*--------- Eliminar comentario - Delete order ---------*/
		if($_POST['modulo_comentario']=="eliminar"){
			echo $ins_comentario->eliminar_comentario_controlador();
		}
    }else{
		session_destroy();
		header("Location: ".URL."home/");
	}

?>