<?php

    if($peticion_ajax){
        require_once "../model/mainModel.php";
    }else{
        require_once "./model/mainModel.php";
    }

	class comentarioControlador extends mainModel{
        
        /*--------- Controlador registrar comentario - Controller register product ---------*/
        
        public function registrar_comentario_controlador(){

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $comentario = mainModel::limpiar_cadena($_POST['comment']);
            $fecha=mainModel::limpiar_cadena($_POST['comment_fecha']);
            $comentario_ident=mainModel::limpiar_cadena($_POST['comment_ident']);
            $cliente=mainModel::limpiar_cadena($_POST['id_cliente_com']);


            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
            $datos_comentario_reg=[
                
                "comentario_detalle"=>[
					"campo_marcador"=>":Comentario",
					"campo_valor"=>$comentario
				],
                "comentario_fecha"=>[
					"campo_marcador"=>":Fecha",
					"campo_valor"=>$fecha
				],
                
                "id_cliente"=>[
					"campo_marcador"=>":Cliente",
					"campo_valor"=>$cliente
				],
                "id_producto"=>[
					"campo_marcador"=>":Producto",
					"campo_valor"=>$comentario_ident
				]
            ];

            /*-- Guardando datos del comentario - Saving product data --*/
			$agregar_comentario=mainModel::guardar_datos("comentario",$datos_comentario_reg);

			if($agregar_comentario->rowCount()==1){
                $alerta=[
                    "Alerta"=>"agregar",
                    "Texto"=>"Los datos del comentario se registraron con éxito",
                    "Icon"=>"success",
                    "TxtBtn"=>"Aceptar"
                ];
			}else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"No hemos podido registrar los datos, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$agregar_comentario->closeCursor();
			$agregar_comentario=mainModel::desconectar($agregar_comentario);

			echo json_encode($alerta);
        } 
        
        /*-- Fin controlador - End controller --*/
        
        /*--------- Controlador paginador comentario (cliente) - Product Pager Controller (client) ---------*/
        
        public function comentario_paginador_producto_controlador(){
            
			$tabla="";
            
            $id_cliente= $_SESSION['id_cust'];
            
            $campos="com.comentario_id, com.comentario_detalle, com.comentario_fecha, cl.cliente_nombre, cliente_apellido";
            
			$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM comentario as com INNER JOIN cliente as cl ON ped.id_cliente = cl.cliente_id INNER JOIN producto as pro ON com.id_producto = pro.producto_id WHERE cl.cliente_id= $id_cliente AND pro.producto_id = $producto_com";

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();
            
            $tabla.='<div class="d-flex">
            <div class="row">
            <div class="col-12">';
             foreach($datos as $rows){
            $tabla.='<div>
            <h6>'.$rows['cliente_nombre'].'</h6></div>
            <div><p>'.$rows['comentario_detalle'].'</p></div>
            <div><span>'.$rows['comentario_fecha'].'</span></div>
            ';}
            $tabla.='</div>
            </div>
            </div>';
            
            $tabla.='<div class="row"><div class="col-lg-12">
                <div class="card">
                <div class="card-body">';

            if($datos){
                $tabla.='
                <div class=" table-responsive">
                <table class="table caption-top">
                <caption>Lista de comentarios</caption>
                <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha comentario</th>
                <th scope="col">Cliente</th>
                <th scope="col">Producto</th>
                <th scope="col">Total</th>
                <th scope="col">Estado</th>
                <th scrope="col">Acción</th>
                </tr>
                </thead>
                <tbody>';
                
                foreach($datos as $rows){
                
                /*$total_price=$rows['producto_precio_venta']-($rows['producto_precio_venta']*($rows['producto_descuento']/100));*/
                
                $tabla.='
                <tr>
                <th scope="row"><div class="d-flex align-items-center" style="height:50px;">'.$rows['id_comentario'].'</div></th>
                <td><div class="d-flex align-items-center" style="height:50px;">'.$rows['fecha_comentario'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;">'.$rows['cliente_nombre'].' '.$rows['cliente_apellido'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;">'.$rows['detalle_comentario'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;">$'.$rows['total'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;">'.$rows['estado_comentario'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;"><a href="'.URL.'pay/'.mainModel::encryption($rows['id_comentario']).'/" class="btn badge badge-success btn-link btn-sm btn-rounded" data-mdb-toggle="tooltip" title="Cerrar compra" ><i class="fa-solid fa-money-bill"></i></a>
                        <form class="FormularioAjax" action="'.URL.'ajax/comentarioAjax.php" method="POST" data-form="delete" data-lang="'.LANG.'" >
                            <input type="hidden" name="modulo_comentario" value="eliminar">
							<input type="hidden" name="comentario_id_del" value="'.mainModel::encryption($rows['id_comentario']).'">
							<button type="submit" class="btn badge badge-danger btn-link text-danger btn-sm btn-rounded ms-1" data-mdb-toggle="tooltip" title="Eliminar comentario" ><i class="far fa-trash-alt"></i></button>
						</form>
                    </div>
                </td>
                </tr>';}
                
                $tabla.='</tbody>
                </table>
                </div>
                </div>
                </div>';
            }else{
                
                $tabla.='<div class="badge badge-danger w-100 p-5"><h5 class="m-0">No tiene comentarios pendientes</h5></div></div></div>';
            } 
            
            $tabla.='</div></div>';
            
            return $tabla;
        }

        /*--------- Controlador registrar comentario - Controller register product ---------*/
        
        public function agregar_comentario_controlador(){

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $fecha=mainModel::limpiar_cadena($_POST['comment_fecha']);
            $comentario = mainModel::limpiar_cadena($_POST['comment']);
            $cliente=mainModel::limpiar_cadena($_POST['user_comment']);


            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
            $datos_comentario_reg=[
                
                "fecha_comentario"=>[
					"campo_marcador"=>":Fecha",
					"campo_valor"=>$fecha
				],
                "detalle_comentario"=>[
					"campo_marcador"=>":Comentario",
					"campo_valor"=>$comentario
				],
                "id_cliente"=>[
					"campo_marcador"=>":Cliente",
					"campo_valor"=>$cliente
				]
            ];

            /*-- Guardando datos del comentario - Saving product data --*/
			$agregar_comentario=mainModel::guardar_datos("comentario_empresa",$datos_comentario_reg);

			if($agregar_comentario->rowCount()==1){
                $alerta=[
                    "Alerta"=>"agregar",
                    "Texto"=>"Los datos del comentario se registraron con éxito",
                    "Icon"=>"success",
                    "TxtBtn"=>"Aceptar"
                ];
			}else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"No hemos podido registrar los datos, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$agregar_comentario->closeCursor();
			$agregar_comentario=mainModel::desconectar($agregar_comentario);

			echo json_encode($alerta);
        } 
        
        /*-- Fin controlador - End controller --*/

        /*--------- Controlador eliminar comentario - Controller delete administrator ---------*/
        public function eliminar_comentario_controlador(){

			/*-- Recuperando id del comentario - Retrieving administrator id - --*/
			$id=mainModel::decryption($_POST['comentario_id_del']);
			$id=mainModel::limpiar_cadena($id);

			/*-- Comprobando comentario principal - Checking primary user --*/
			if($id==1){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"No podemos eliminar el comentario principal del sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}

			/*-- Comprobando comentario en la BD - Checking user in DB --*/
			$check_comentario=mainModel::ejecutar_consulta_simple("SELECT * FROM comentario WHERE id_comentario='$id'");
			if($check_comentario->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"El comentario que intenta eliminar no existe en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_comentario->closeCursor();
			$check_comentario=mainModel::desconectar($check_comentario);


			/*-- Comprobando ventas - Checking sales --
			$check_ventas=mainModel::ejecutar_consulta_simple("SELECT id_comentario FROM venta WHERE id_comentario='$id' LIMIT 1");
			if($check_ventas->rowCount()>0){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"No podemos eliminar el comentario debido a que tiene ventas asociadas, recomendamos deshabilitar este comentario si ya no será usado en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_ventas->closeCursor();
			$check_ventas=mainModel::desconectar($check_ventas);*/

			
			/*-- Eliminando comentario - Deleting administrator --*/
			$eliminar_comentario=mainModel::eliminar_registro("comentario","id_comentario",$id);

			if($eliminar_comentario->rowCount()==1){
				$alerta=[
                    "Alerta"=>"eliminar"];
			}else{
				$alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"No hemos podido eliminar el comentario del sistema, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$eliminar_comentario->closeCursor();
			$eliminar_comentario=mainModel::desconectar($eliminar_comentario);

			echo json_encode($alerta);
		} 
        /*-- Fin controlador - End controller --*/  
        
    }

?>