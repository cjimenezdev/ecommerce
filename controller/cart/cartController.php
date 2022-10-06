<?php

if($peticion_ajax){
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}
    
class carritoControlador extends mainModel{

	public function agregar_carrito_controlador(){
		
			$ID = mainModel::decryption($_POST['product_id']);
			$NOMBRE = mainModel::decryption($_POST['product_nombre']);
			$PRECIO= $_POST['product_precio_venta'];
			$PORTADA = $_POST['product_portada'];
			$CANT = $_POST['product_cant'];
			
			if(!isset($_SESSION['Carrito'])){ 
				$_SESSION['Carrito']=array(); 
			} 
			if (isset($_SESSION['Carrito'])) {
				
				if(isset($_SESSION['id_cust'])){
					
					$idProductos = array_column($_SESSION['Carrito'],'product_id');
					
					if(in_array($ID,$idProductos)){
						
						$alerta=[
							"Alerta"=>"agregar"];
							echo json_encode($alerta);
							exit();
					}else{
						
						$cont=count($_SESSION['Carrito']);
						
						$producto = array(
							'id_cliente'=>$_SESSION['id_cust'],
							'product_id'=>$ID,
							'product_nombre'=>$NOMBRE,
							'product_precio_venta'=>$PRECIO,
							'product_portada'=>$PORTADA,
							'product_cant'=>$CANT
						);
						
						$_SESSION['Carrito'][$cont]=$producto;
						
						$alerta=[
							"Alerta"=>"agregar"];
							echo json_encode($alerta);
							exit();
					}
				
				}else{
					
					$idProductos = array_column($_SESSION['Carrito'],'product_id');
					
					if(in_array($ID,$idProductos)){
						$alerta=[
							"Alerta"=>"agregar"];
							echo json_encode($alerta);
							exit();
					}else{
					
					$cont=count($_SESSION['Carrito']);
					$producto = array(
						'product_id'=>$ID,
						'product_nombre'=>$NOMBRE,
						'product_precio_venta'=>$PRECIO,
						'product_portada'=>$PORTADA,
						'product_cant'=>$CANT
					);

					$_SESSION['Carrito'][$cont]=$producto;
					
					$alerta=[
					"Alerta"=>"agregar"];
					echo json_encode($alerta);
				exit();
				}
				}
				
			}
	}

	public function actualizar_carrito_controlador(){
		
		$cant=0;
		
		if (isset($_SESSION['Carrito'])) {
			
			$ID=mainModel::decryption($_POST['product_id']);
			
			foreach ($_SESSION['Carrito'] as $indice => $producto){
				
				if ($producto['product_id']==$ID) {
					
					$producto['product_cant'] = $cant+$_POST['product_cant'];
						
					$_SESSION['Carrito'][$indice]['product_cant']=$producto['product_cant']+$cant;
				}
			}
			
		}
		$alerta=[
			"Alerta"=>"actualizar"];
			echo json_encode($alerta);
		exit();	
	}
	
	public function eliminar_carrito_controlador(){
		
		$ID=mainModel::decryption($_POST['product_id']);

		
		
		foreach ($_SESSION['Carrito'] as $indice => $producto) {
			
			if ($producto['product_id']==$ID) {
				
				unset($_SESSION['Carrito'][$indice]);
				
				$_SESSION['Carrito']=array_values($_SESSION["Carrito"]);
			
			}
		}
		$alerta=["Alerta"=>"eliminar"];
			echo json_encode($alerta);
		exit();
	}
}