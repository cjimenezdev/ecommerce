<?php

    if($peticion_ajax){
        require_once "../model/mainModel.php";
    }else{
        require_once "./model/mainModel.php";
    }

	class pedidoControlador extends mainModel{
        
        /*--------- Controlador registrar pedido - Controller register product ---------*/
        
        public function registrar_pedido_controlador(){

            /*-- Comprobando privilegios - Checking privileges 
			if($_SESSION['cargo_sto']!="Administrador"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Acceso no permitido",
                    "Texto"=>"No tienes los permisos necesarios para realizar esta operación en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
				echo json_encode($alerta);
				exit();
			}--*/

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $id_pedido = mainModel::limpiar_cadena($_POST['pedido_id_reg']);
            $fecha_pedido=mainModel::limpiar_cadena($_POST['pedido_fecha_reg']);
            $estado=mainModel::limpiar_cadena($_POST['pedido_estado_reg']);

            $total_price=mainModel::limpiar_cadena($_POST['pedido_total_reg']);
            $cliente=mainModel::limpiar_cadena($_POST['pedido_cliente_reg']);
            $producto=mainModel::limpiar_cadena($_POST['pedido_producto_reg']);

            /*-- Verificar pedido existente --*/
            $check_pedido=mainModel::ejecutar_consulta_simple("SELECT * FROM pedido WHERE id_pedido='$id_pedido'");
			if($check_pedido->rowCount()>0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"El pedido ya está en pendiente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
				echo json_encode($alerta);
				exit();
			}
			$check_pedido->closeCursor();
            $check_pedido=mainModel::desconectar($check_pedido);


            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
            $datos_pedido_reg=[
                "id_pedido"=>[
					"campo_marcador"=>":ID",
					"campo_valor"=>$id_pedido
				],
                "fecha_pedido"=>[
					"campo_marcador"=>":Fecha",
					"campo_valor"=>$fecha_pedido
				],
                "detalle_pedido"=>[
					"campo_marcador"=>":Producto",
					"campo_valor"=>$producto
				],
                "total"=>[
					"campo_marcador"=>":Total",
					"campo_valor"=>$total_price
				],
                "estado_pedido"=>[
					"campo_marcador"=>":Estado",
					"campo_valor"=>$estado
				],
                "id_cliente"=>[
					"campo_marcador"=>":Cliente",
					"campo_valor"=>$cliente
				]
            ];

            /*-- Guardando datos del pedido - Saving product data --*/
			$agregar_pedido=mainModel::guardar_datos("pedido",$datos_pedido_reg);

			if($agregar_pedido->rowCount()==1){
                $alerta=[
                    "Alerta"=>"agregar",
                    "Texto"=>"Los datos del pedido se registraron con éxito",
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

			$agregar_pedido->closeCursor();
			$agregar_pedido=mainModel::desconectar($agregar_pedido);

			echo json_encode($alerta);
        } 
        
        /*-- Fin controlador - End controller --*/
        
        /*--------- Controlador paginador pedido (cliente) - Product Pager Controller (client) ---------*/
        
        public function pedido_paginador_producto_controlador(){
            
			$tabla="";

            $id_cliente= $_SESSION['id_cust'];
            
            $campos="ped.id_pedido, ped.estado_pedido, ped.fecha_pedido, ped.detalle_pedido, ped.total, cl.cliente_nombre, cliente_apellido";
            
			$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM pedido as ped INNER JOIN cliente as cl ON ped.id_cliente = cl.cliente_id WHERE cl.cliente_id=$id_cliente";

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();
            
            $tabla.='<div class="d-flex mt-5"><h4 class="text-success text-uppercase fw-bold"><span class="text-dark">Hola, </span>'.$_SESSION['nombre_cust'].' '.$_SESSION['apellido_cust'].' <i class="fa-solid fa-handshake text-warning"></i></h4></div>';
            
            $tabla.='<div class="row"><div class="col-lg-12">
                <div class="card">
                <div class="card-body">';

            if($datos){
                $tabla.='
                <div class=" table-responsive">
                <table class="table caption-top">
                <caption>Lista de pedidos</caption>
                <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha pedido</th>
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
                <th scope="row"><div class="d-flex align-items-center" style="height:50px;">'.$rows['id_pedido'].'</div></th>
                <td><div class="d-flex align-items-center" style="height:50px;">'.$rows['fecha_pedido'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;">'.$rows['cliente_nombre'].' '.$rows['cliente_apellido'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;">'.$rows['detalle_pedido'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;">$'.$rows['total'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;">'.$rows['estado_pedido'].'</div></td>
                <td><div class="d-flex align-items-center" style="height:50px;"><a href="'.URL.'pay/'.mainModel::encryption($rows['id_pedido']).'/" class="btn badge badge-success btn-link btn-sm btn-rounded" data-mdb-toggle="tooltip" title="Cerrar compra" ><i class="fa-solid fa-money-bill"></i></a>
                        <form class="FormularioAjax" action="'.URL.'ajax/pedidoAjax.php" method="POST" data-form="delete" data-lang="'.LANG.'" >
                            <input type="hidden" name="modulo_pedido" value="eliminar">
							<input type="hidden" name="pedido_id_del" value="'.mainModel::encryption($rows['id_pedido']).'">
							<button type="submit" class="btn badge badge-danger btn-link text-danger btn-sm btn-rounded ms-1" data-mdb-toggle="tooltip" title="Eliminar pedido" ><i class="far fa-trash-alt"></i></button>
						</form>
                    </div>
                </td>
                </tr>';
            }
            $tabla.='</tbody>
                </table>
                </div>
                </div>
                </div>';
            }else{
            $tabla.='<div class="badge badge-danger w-100 p-5"><h5 class="m-0">No tiene pedidos pendientes</h5></div></div></div>';
           } 
           $tabla.='</div></div>';
            
            return $tabla;
        }
        
        /*--------- Controlador paginador administradores - Administrators Pager Controller ---------*/
        public function paginador_pedido_controlador($pagina,$registros,$url,$busqueda){
			
            $pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);

			$url=mainModel::limpiar_cadena($url);
			$url=URL.DASHBOARD."/".$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $id=1;
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
            
            $campos="ped.id_pedido, ped.fecha_pedido, ped.estado_pedido, ped.total, cl.cliente_nombre, cl.cliente_apellido, cl.cliente_foto, cl.cliente_email";
            
			$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM pedido as ped INNER JOIN cliente as cl ON ped.id_cliente = cl.cliente_id WHERE id_pedido!='1' ORDER BY fecha_pedido ASC LIMIT $inicio,$registros";
			

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);
            
            /*-- Encabezado de la tabla - Table header --*/
			$tabla.='<div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive rounded-7">
                        <table class="table" id="form-user">
                            <thead style="background:var(--bg-white);" >
                            <tr class="font-weight-bold">
							<th>Acciones</th>
                            <th>Fecha Pedido</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody class="salida">';

            if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
                    $tabla .= '<tr>
                    <td class="actions ps-0">
                    <div class="btn-group dropup shadow-0">
                    <a type="button" style="margin-left:0 !important;" class="btn btn-sm btn-rounded badge badge-warning m-auto" href="' . URL.DASHBOARD. '/admin-update/' . mainModel::encryption($rows['id_pedido']) . '/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/pedidoAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_pedido" value="eliminar">
                        <input type="hidden" name="pedido_id_del" value="' . mainModel::encryption($rows['id_pedido']) . '">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip"  title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                    </div>
                        </td>
                    ';
					$tabla .= '<td><p class=" font-weight-normal">' . $rows['fecha_pedido'] . '</p></td>
                    <td>
                            <div class="d-block position-relative">
                            ';
                if (is_file("./public/assets/img/customers/avatar/" . $rows['cliente_foto'])) {
                    $tabla .= '<img src="' . URL . 'public/assets/img/customers/avatar/' . $rows['cliente_foto'] . '" style="width: 45px; height: 45px; position:absolute;" class="rounded-circle img-fluid d-inline-block" alt="' . $rows['cliente_nombre'] . '" />';
                } else {
                    $tabla .= '<img src="' . URL . 'public/assets/img/customers/avatar/default.jpg" style="width: 45px; height: 45px;position:absolute;" class="rounded-circle img-fluid d-inline-block" alt="' . $rows['cliente_nombre'] . '" />';
                }
                $tabla .= '
                        <div class="ms-5 d-inline-block">
                            <p class="fw-bold mb-1 ">' . $rows['cliente_nombre'] . ' ' . $rows['cliente_apellido'] . '</p>
                                <p class="text-muted mb-0 ">' . $rows['cliente_email'] . '</p>
                                </div>
                            </div>
                        </td>
                        <td><p class=" font-weight-normal">$ ' . $rows['total'] . '</p></td>
                        <td>
                        <div class="d-flex">';
                        if($rows['estado_pedido']=="Pendiente"){
                            $tabla.='<span class="badge badge-warning rounded-pill">' . $rows['estado_pedido'] . '</span>';
                        }else{
                            $tabla.='<span class="badge badge-danger rounded-pill ">' . $rows['estado_pedido'] . '</span>';
                        }
                            
                        $tabla.='</div>
                            </td>
					</tr>';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="text-center" >
							<td colspan="7">
								<a href="'.$url.'" class="btn btn-primary btn-sm">
									Haga clic acá para recargar el listado
								</a>
							</td>
						</tr>
					';
				}else{
					$tabla.='
						<tr class="text-center" >
							<td colspan="7">
								No hay registros en el sistema
							</td>
						</tr>
					';
				}
			}

            $tabla.='</tbody></table></div></div></div></div></div>';

			if($total>0 && $pagina<=$Npaginas){
				$tabla.='<p class="text-end">Mostrando administradores <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
			}

			/*--Paginacion - Pagination --*/
			if($total>=1 && $pagina<=$Npaginas){
				$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7,LANG);
			}

			return $tabla;
		} 
        /*-- Fin controlador - End controller --*/ 
        
        /*--------- Controlador eliminar pedido - Controller delete administrator ---------*/
        public function eliminar_pedido_controlador(){

			/*-- Recuperando id del pedido - Retrieving administrator id - --*/
			$id=mainModel::decryption($_POST['pedido_id_del']);
			$id=mainModel::limpiar_cadena($id);

			/*-- Comprobando pedido principal - Checking primary user --*/
			if($id==1){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"No podemos eliminar el pedido principal del sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}

			/*-- Comprobando pedido en la BD - Checking user in DB --*/
			$check_pedido=mainModel::ejecutar_consulta_simple("SELECT * FROM pedido WHERE id_pedido='$id'");
			if($check_pedido->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"El pedido que intenta eliminar no existe en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_pedido->closeCursor();
			$check_pedido=mainModel::desconectar($check_pedido);


			/*-- Comprobando ventas - Checking sales --
			$check_ventas=mainModel::ejecutar_consulta_simple("SELECT id_pedido FROM venta WHERE id_pedido='$id' LIMIT 1");
			if($check_ventas->rowCount()>0){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"No podemos eliminar el pedido debido a que tiene ventas asociadas, recomendamos deshabilitar este pedido si ya no será usado en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_ventas->closeCursor();
			$check_ventas=mainModel::desconectar($check_ventas);*/

			
			/*-- Eliminando pedido - Deleting administrator --*/
			$eliminar_pedido=mainModel::eliminar_registro("pedido","id_pedido",$id);

			if($eliminar_pedido->rowCount()==1){
				$alerta=[
                    "Alerta"=>"eliminar"];
			}else{
				$alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"No hemos podido eliminar el pedido del sistema, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$eliminar_pedido->closeCursor();
			$eliminar_pedido=mainModel::desconectar($eliminar_pedido);

			echo json_encode($alerta);
		} 
        /*-- Fin controlador - End controller --*/  
        
    }

?>