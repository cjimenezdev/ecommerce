<?php

    if($peticion_ajax){
        require_once "../model/mainModel.php";
    }else{
        require_once "./model/mainModel.php";
    }

	class catalogoControlador extends mainModel{
        
        /*--------- Controlador registrar catalogo - Controller register product ---------*/
        
        public function registrar_catalogo_controlador(){

            /*-- Comprobando privilegios - Checking privileges --*/
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
			}

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $fecha=mainModel::limpiar_cadena($_POST['catalogo_fecha_reg']);
            $detalle=mainModel::limpiar_cadena($_POST['catalogo_detalle_reg']);
            $identificador=mainModel::limpiar_cadena($_POST['catalogo_identificador_reg']);

            /*-- Directorios de comprobantees - Image Directories --*/
			
			$img_dir = '../public/assets/img/catalogue/';
			/*-- Comprobando si se ha seleccionado una comprobante - Checking if an image has been selected --*/
			if ($_FILES['catalogo_foto_reg']['name'] != "" && $_FILES['catalogo_foto_reg']['size'] > 0) {

            /*-- Comprobando formato de las comprobantees - Checking image format --*/
            if (mime_content_type($_FILES['catalogo_foto_reg']['tmp_name']) != "image/jpeg" && mime_content_type($_FILES['catalogo_foto_reg']['tmp_name']) != "image/png") {
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
            if (($_FILES['catalogo_foto_reg']['size'] / 1024) > $img_max_size) {
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
            switch (mime_content_type($_FILES['catalogo_foto_reg']['tmp_name'])) {
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
            $correlativo = mainModel::ejecutar_consulta_simple("SELECT id_catalogo FROM catalogo");
            $correlativo = ($correlativo->rowCount()) + 1;
            $codigo_com = mainModel::generar_codigo_aleatorio(10, $correlativo);

            /*-- Nombre final de la comprobante - Final image name --*/
            $img_catalogo = $codigo_com . $img_ext;

            /* Moviendo comprobante al directorio - Moving image to directory */
            if (!move_uploaded_file($_FILES['catalogo_foto_reg']['tmp_name'], $img_dir . $img_catalogo)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Texto" => "Error al subir comprobante, por favor intente nuevamente.",
                    "Icon" => "error",
                    "TxtBtn" => "Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            } } else {
				$img_catalogo = "";       
			}

            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
            $datos_catalogo_reg=[
                "fecha_catalogo"=>[
					"campo_marcador"=>":Fecha",
					"campo_valor"=>$fecha
				],
                "detalle_catalogo"=>[
					"campo_marcador"=>":Detalle",
					"campo_valor"=>$detalle
				],
                "foto_catalogo"=>[
					"campo_marcador"=>":Portada",
					"campo_valor"=>$img_catalogo
				],
                "identificador"=>[
					"campo_marcador"=>":Identificador",
					"campo_valor"=>$identificador
				],
            ];

            /*-- Guardando datos del catalogo - Saving product data --*/
			$agregar_catalogo=mainModel::guardar_datos("catalogo",$datos_catalogo_reg);

			if($agregar_catalogo->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Texto"=>"Los datos del catalogo se registraron con éxito",
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

			$agregar_catalogo->closeCursor();
			$agregar_catalogo=mainModel::desconectar($agregar_catalogo);

			echo json_encode($alerta);
        } 
        
        /*-- Fin controlador - End controller --*/

        /*--------- Controlador paginador ventas - Controller Users Pager  ---------*/
		public function controller_catalogue_pager($pagina, $registros, $url, $busqueda){
			$pagina = mainModel::limpiar_cadena($pagina);
			$registros = mainModel::limpiar_cadena($registros);
			$url = mainModel::limpiar_cadena($url);
			$url=URL.DASHBOARD."/".$url."/";
			$busqueda = mainModel::limpiar_cadena($busqueda);
			$id = 1;
			$tabla = "";
			$pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
			$start = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
			
            
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM catalogo WHERE id_catalogo!='1' ORDER BY fecha_catalogo ASC LIMIT $start,$registros";
			
			
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
                            <th>Fecha</th>
                            <th>Detalle</th>
                            <th>Portada</th>
                            <th>Identificador</th>
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
                    <a type="button" style="margin-left:0 !important;" class="btn btn-sm btn-rounded badge badge-warning m-auto disabled" href="' . URL.DASHBOARD. '/catalogue-update/' . mainModel::encryption($rows['id_catalogo']) . '/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="id_catalogo_del" value="' . mainModel::encryption($rows['id_catalogo']) . '">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger disabled mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                    </div>
                        </td>
                    ';
                } else {
                    $tabla .= '
                    <td class="actions ps-0">
                        <div class="btn-group dropup shadow-0">
                        <a type="button" class="btn btn-sm btn-rounded badge badge-warning m-auto shadow-3-strong ms-2" href="' . URL.DASHBOARD. '/catalogue-update/' . mainModel::encryption($rows['id_catalogo']) . '/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="id_catalogo_del" value="' . mainModel::encryption($rows['id_catalogo']) . '">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                        </div>
                        </td>
                    ';
                }
                
                $tabla .= '
                <td><p class=" font-weight-light">' . $rows['detalle_catalogo'] . '</p></td></td>
                <td><p class=" font-weight-light">' . $rows['foto_catalogo'] . '</p></td>
                <td><p class=" font-weight-light">' . $rows['identificador'] . '</p></td>';
                        $tabla .= '<td>
                            <div class="d-block position-relative">
                            ';
                if (is_file("./public/assets/img/catalogue/" . $rows['foto_catalogo'])) {
                    $tabla .= '<img src="' . URL . 'public/assets/img/catalogue/' . $rows['foto_catalogo'] . '" style="width: 45px; height: 45px;" class="rounded-circle img-fluid" alt="' . $rows['foto_catalogo'] . '" />';
                } else {
                    $tabla .= '<img src="' . URL . 'public/assets/img/catalogue/default.jpg" style="width: 45px; height: 45px;" class="rounded-circle img-fluid" alt="' . $rows['foto_catalogo'] . '" />';
                }
                        $tabla.='</td>
                        <td>
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

        /*--------- Controlador actualizar catalogo - Controller update category ---------*/
		public function actualizar_catalogo_controlador(){

            /*-- Comprobando privilegios - Checking privileges --*/
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
			}

            /*-- Recibiendo id de la catalogo - Receiving category id --*/
			$id=mainModel::decryption($_POST['catalogo_id_up']);
			$id=mainModel::limpiar_cadena($id);

            /*-- Comprobando catalogo en la DB - Checking category in DB --*/
			$check_catalogo=mainModel::ejecutar_consulta_simple("SELECT * FROM catalogo WHERE id_catalogo='$id'");
			if($check_catalogo->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"No hemos encontrado el catálogo en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}else{
				$campos=$check_catalogo->fetch();
			}
			$check_catalogo->closeCursor();
			$check_catalogo=mainModel::desconectar($check_catalogo);

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $fecha=mainModel::limpiar_cadena($_POST['catalogo_fecha_up']);
            $detalle=mainModel::limpiar_cadena($_POST['catalogo_detalle_up']);
            $identificador=mainModel::limpiar_cadena($_POST['catalogo_identificador_up']);

            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($nombre==""){
                $alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No has llenado todos los campos que son obligatorios",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }


            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_catalogo_up=[
                "fecha_catalogo"=>[
					"campo_marcador"=>":Fecha",
					"campo_valor"=>$fecha
				],
				"detalle_catalogo"=>[
					"campo_marcador"=>":Detalle",
					"campo_valor"=>$descripcion
                ],
                "foto_catalogo"=>[
					"campo_marcador"=>":Portada",
					"campo_valor"=>$img_catalogo
				]
                ,
                "identificador"=>[
					"campo_marcador"=>":Identficador",
					"campo_valor"=>$identificador
				]
            ];

            $condicion=[
				"condicion_campo"=>"catalogo_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

            if(mainModel::actualizar_datos("catalogo",$datos_catalogo_up,$condicion)){
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"¡Categoría actualizada!",
					"Texto"=>"Los datos de la categoría se actualizaron con éxito en el sistema",
					"Icon"=>"success",
					"TxtBtn"=>"Aceptar"
				];
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No hemos podido actualizar los datos de la categoría, por favor intente nuevamente",
					"Icon"=>"error",
					"TxtBtn"=>"Aceptar"
				];
			}
			echo json_encode($alerta);
        } /*-- Fin controlador - End controller --*/
    }
    
?>