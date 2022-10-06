<?php

    if($peticion_ajax){
        require_once "../model/mainModel.php";
    }else{
        require_once "./model/mainModel.php";
    }

    class ventaControlador extends mainModel{

        public function registrar_venta_controlador(){


             /*-- Recibiendo datos del formulario - Receiving form data --*/
            $codigo = mainModel::limpiar_cadena($_POST['venta_codigo_reg']);
            $fecha = mainModel::limpiar_cadena($_POST['venta_fecha_reg']);
            $tipo_envio = mainModel::limpiar_cadena($_POST['venta_envio_reg']);
            $direccion =mainModel::limpiar_cadena($_POST['venta_direccion_reg']);
            $impuesto = mainModel::limpiar_cadena($_POST['venta_impuesto_reg']);
            $total = mainModel::limpiar_cadena($_POST['venta_total_reg']);
            $pedido = mainModel::limpiar_cadena($_POST['venta_pedido_reg']);
            $cliente = mainModel::limpiar_cadena($_POST['venta_cliente_reg']);
            $empresa = mainModel::limpiar_cadena($_POST['venta_empresa_reg']);


            /*-- Comprobando foto o avatar - Checking photo or avatar --*/
            /*-- Directorios de comprobantees - Image Directories --*/
			
			$img_dir = '../public/assets/docs/sales/voucher/';
			/*-- Comprobando si se ha seleccionado una comprobante - Checking if an image has been selected --*/
			if ($_FILES['venta_comprobante_reg']['name'] != "" && $_FILES['venta_comprobante_reg']['size'] > 0) {

            /*-- Comprobando formato de las comprobantees - Checking image format --*/
            if (mime_content_type($_FILES['venta_comprobante_reg']['tmp_name']) != "image/jpeg" && mime_content_type($_FILES['venta_comprobante_reg']['tmp_name']) != "image/png") {
                $alerta = [
                    "Alerta" => "simple",
                    "Texto" => "comprobante formato inválido",
                    "Icon" => "error",
                    "TxtBtn" => "Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*-- Comprobando que la comprobante no supere el peso permitido - Checking that the image does not exceed the allowed weight --*/
            $img_max_size = COVER_PRODUCT * 1024;
            if (($_FILES['venta_comprobante_reg']['size'] / 1024) > $img_max_size) {
                $alerta = [
                    "Alerta" => "simple",
                    "Texto" => "Tamaño máximo de la comprobante 3MB",
                    "Icon" => "error",
                    "TxtBtn" => "Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*-- Extencion de las comprobantes - extension of the images --*/
            switch (mime_content_type($_FILES['venta_comprobante_reg']['tmp_name'])) {
                case 'image/jpeg':
                    $img_ext = ".jpg";
                    break;
                case 'image/png':
                    $img_ext = ".png";
                    break;
            }

            /*-- Cambiando permisos al directorio - Changing permissions to the directory --*/
            chmod($img_dir, 0777);

            /*-- Generando un codigo para la comprobante - Generating a code for the image --*/
            $correlativo = mainModel::ejecutar_consulta_simple("SELECT venta_id FROM venta");
            $correlativo = ($correlativo->rowCount()) + 1;
            $codigo_com = mainModel::generar_codigo_aleatorio(10, $correlativo);

            /*-- Nombre final de la comprobante - Final image name --*/
            $img_comprobante = $codigo_com . $img_ext;

            /* Moviendo comprobante al directorio - Moving image to directory */
            if (!move_uploaded_file($_FILES['venta_comprobante_reg']['tmp_name'], $img_dir . $img_comprobante)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Texto" => "Error al subir comprobante, por favor intente nuevamente.",
                    "Icon" => "error",
                    "TxtBtn" => "Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            } } else {
				$img_comprobante = "";       
			}


            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
            $datos_venta_reg=[
                
                "venta_codigo"=>[
					"campo_marcador"=>":Codigo",
					"campo_valor"=>$codigo
				],
                "venta_fecha"=>[
					"campo_marcador"=>":Fecha",
					"campo_valor"=>$fecha
				],
                "venta_tipo_envio"=>[
					"campo_marcador"=>":Envio",
					"campo_valor"=>$tipo_envio
				],
                "venta_direccion"=>[
					"campo_marcador"=>":Direccion",
					"campo_valor"=>$direccion
				],
                "venta_comprobante"=>[
					"campo_marcador"=>":Comprobante",
					"campo_valor"=>$img_comprobante
				],
                "venta_impuestos"=>[
					"campo_marcador"=>":Impuesto",
					"campo_valor"=>$impuesto
				],
                "venta_total"=>[
					"campo_marcador"=>":Total",
					"campo_valor"=>$total
				],
                "pedido_id"=>[
					"campo_marcador"=>":Pedido",
					"campo_valor"=>$pedido
				],
                "cliente_id"=>[
					"campo_marcador"=>":Cliente",
					"campo_valor"=>$cliente
				],
                "empresa_id"=>[
					"campo_marcador"=>":Producto",
					"campo_valor"=>$empresa
				]
            ];

            /*-- Guardando datos del venta - Saving product data --*/
			$agregar_venta=mainModel::guardar_datos("venta",$datos_venta_reg);

			if($agregar_venta->rowCount()==1){
                $alerta=["Alerta"=>"limpiar_venta"];
					echo json_encode($alerta);
					exit();
			}else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"No hemos podido registrar los datos, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
                echo json_encode($alerta);
                exit();
			}

			$agregar_venta->closeCursor();
			$agregar_venta=mainModel::desconectar($agregar_venta);
        }


        /*--------- Controlador paginador ventas - Controller Users Pager  ---------*/
		public function controller_sale_pager($pagina, $registros, $url, $busqueda){
			$pagina = mainModel::limpiar_cadena($pagina);
			$registros = mainModel::limpiar_cadena($registros);
			$url = mainModel::limpiar_cadena($url);
			$url=URL.DASHBOARD."/".$url."/";
			$busqueda = mainModel::limpiar_cadena($busqueda);
			$id = 1;
			$tabla = "";
			$pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
			$start = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
			
            
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM venta WHERE venta_id!='1' ORDER BY venta_fecha ASC LIMIT $start,$registros";
			
			
			$conexion = mainModel::conectar();
			$data = $conexion->query($consulta);
			$data = $data->fetchAll();
			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();
			$Npaginas = ceil($total / $registros);
			/*-- Encabezado de la tabla - tabla header --*/
			$tabla .= '<div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive rounded-7">
                            <table class="table" id="form-user">
                            <thead style="background:var(--bg-white);" >
                            <tr class="font-weight-bold">
							<th>Acciones</th>
                            <th>Cliente</th>
                            <th>Pedido</th>
                            <th>Fecha</th>
                            <th>Codigo</th>
                            <th>Direccion</th>
                            <th>Tipo</th>
                            <th>Iva</th>
                            <th>Total</th>
                            <th>Comprobante</th>
                            <th>Empresa</th>
                            <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody class="salida">';
							if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $start + 1;
            $pag_inicio = $start + 1;
            foreach ($data as $rows) {
                $tabla .= '
                    <tr>';
					if ($_SESSION['cargo_sto'] == "Cajero") {
                    $tabla .= '
                    <td class="actions ps-0">
                    <div class="btn-group dropup shadow-0">
                    <a type="button" style="margin-left:0 !important;" class="btn btn-sm btn-rounded badge badge-warning m-auto disabled" href="' . URL.DASHBOARD. '/sale-update/' . mainModel::encryption($rows['venta_id']) . '/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="venta_id_del" value="' . mainModel::encryption($rows['venta_id']) . '">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger disabled mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                    </div>
                        </td>
                    ';
                } else {
                    $tabla .= '
                    <td class="actions ps-0">
                        <div class="btn-group dropup shadow-0">
                        <a type="button" class="btn btn-sm btn-rounded badge badge-warning m-auto shadow-3-strong ms-2" href="' . URL.DASHBOARD. '/sale-update/' . mainModel::encryption($rows['venta_id']) . '/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="venta_id_del" value="' . mainModel::encryption($rows['venta_id']) . '">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                        </div>
                        </td>
                    ';
                }
                
                $tabla .= '<td><p class=" font-weight-light">' . $rows['cliente_id'] . '</p></td></td>
                <td><p class=" font-weight-light">' . $rows['pedido_id'] . '</p></td></td>
                <td><p class=" font-weight-light">' . $rows['venta_fecha'] . '</p></td>
                <td><p class=" font-weight-light">' . $rows['venta_codigo'] . '</p></td>
                        <td><p class=" font-weight-light">' . $rows['venta_direccion'] . '</p></td>
                        <td><p class=" font-weight-normal">' . $rows['venta_tipo_envio'] . '</p></td>
                        <td><p class=" font-weight-normal">' . $rows['venta_impuestos'] . '</p></td>
                        <td><p class=" font-weight-normal">' . $rows['venta_total'] . '</p></td>';
                        $tabla .= '<td>
                            <div class="d-block position-relative">
                            ';
                if (is_file("./public/assets/docs/sales/voucher/" . $rows['venta_comprobante'])) {
                    $tabla .= '<img src="' . URL . 'public/assets/docs/sales/voucher/' . $rows['venta_comprobante'] . '" style="width: 45px; height: 45px;" class="rounded-circle img-fluid" alt="' . $rows['venta_comprobante'] . '" />';
                } else {
                    $tabla .= '<img src="' . URL . 'public/assets/docs/sales/default.jpg" style="width: 45px; height: 45px;" class="rounded-circle img-fluid" alt="' . $rows['venta_comprobante'] . '" />';
                }
                        $tabla.='</td><td><p class=" font-weight-light">' . $rows['empresa_id'] . '</p></td><td>
                        <div class="d-flex">
                            <span class="badge badge-success rounded-pill ">Agregado</span>
                        </div>
                            </.td>
                            
                </tr>';
                
                $contador++;
            } $pag_final = $contador - 1; } else {
            if ($total >= 1) {
                $tabla .= '
                    <tr class="text-center" >
                        <td colspan="7">
                            <a href="' . $url . '" class="btn btn-primary btn-sm">
                                Haga clic acá para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
            } else {
                $tabla .= '
                    <tr class="text-center" >
                        <td colspan="7">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            } }
			
			$tabla .= '</tbody></table></div></div></div></div></div>';
			$tabla .= '<div class="d-block w-100"><div class="row"><div class="col-12 col-sm-6">';
			if ($total > 0 && $pagina <= $Npaginas) {
				$tabla .= '<p class="text-center text-sm-start ms-auto">Mostrando <strong>' . $pag_inicio . '</strong> a <strong>' . $pag_final . '</strong> de <strong>' . $total . '</strong> entradas</p>';
			}
			$tabla .= '</div><div class="col-12 col-sm-6">';
			/*--Paginacion - Pagination --*/
			if ($total >= 1 && $pagina <= $Npaginas) {
				$tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
			}
			$tabla .= '</div></div></div>';
			return $tabla;
		} 
	/*-- Fin controlador - End controller --*/	
    }