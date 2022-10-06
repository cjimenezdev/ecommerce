<?php

    if($peticion_ajax){
        require_once "../model/mainModel.php";
    }else{
        require_once "./model/mainModel.php";
    }

	class categoriaControlador extends mainModel{

        /*--------- Controlador registrar categoria - Controller register category ---------*/
        public function registrar_categoria_controlador(){

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
            $nombre=mainModel::limpiar_cadena($_POST['categoria_nombre_reg']);
            $estado=mainModel::limpiar_cadena($_POST['categoria_estado_reg']);
            $descripcion=mainModel::limpiar_cadena($_POST['categoria_descripcion_reg']);

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

            /*-- Verificando integridad de los datos - Checking data integrity --*/
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            if($descripcion!=""){
                if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,700}",$descripcion)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Formato no valido",
                        "Texto"=>"La DESCRIPCIÓN no coincide con el formato solicitado. Solo se permiten caracteres alfanuméricos y los siguientes símbolos: () . , #",
                        "Icon"=>"error",
                        "TxtBtn"=>"Aceptar"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            /*-- Comprobando estado de categoria - Checking category status --*/
			if($estado!="Habilitada" && $estado!="Deshabilitada"){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Opción no valida",
					"Texto"=>"Ha seleccionado un ESTADO DE CATEGORÍA no valido",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Comprobando nombre - Checking name --*/
            $check_nombre=mainModel::ejecutar_consulta_simple("SELECT categoria_nombre FROM categoria WHERE categoria_nombre='$nombre'");
			if($check_nombre->rowCount()>0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"El nombre de categoría que acaba de ingresar ya se encuentra registrado, por favor elija otro",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
				echo json_encode($alerta);
				exit();
			}
			$check_nombre->closeCursor();
            $check_nombre=mainModel::desconectar($check_nombre);

            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_categoria_reg=[
                "categoria_nombre"=>[
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				"categoria_descripcion"=>[
					"campo_marcador"=>":Descripcion",
					"campo_valor"=>$descripcion
                ],
                "categoria_estado"=>[
					"campo_marcador"=>":Estado",
					"campo_valor"=>$estado
				]
            ];

            /*-- Guardando datos del categoria - Saving category data --*/
			$agregar_categoria=mainModel::guardar_datos("categoria",$datos_categoria_reg);

			if($agregar_categoria->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"¡Categoría registrada!",
                    "Texto"=>"Los datos de la categoría se registraron con éxito en el sistema",
                    "Icon"=>"success",
                    "TxtBtn"=>"Aceptar"
                ];
			}else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido registrar la categoría, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$agregar_categoria->closeCursor();
			$agregar_categoria=mainModel::desconectar($agregar_categoria);

			echo json_encode($alerta);
        } /*-- Fin controlador - End controller --*/


        /*--------- Controlador paginador categorias - categories Pager Controller ---------*/
        public function paginador_categoria_controlador($pagina,$registros,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);

			$url=mainModel::limpiar_cadena($url);
			$url=URL.DASHBOARD."/".$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
            
            if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM categoria WHERE (categoria_nombre LIKE '%$busqueda%') ORDER BY categoria_nombre ASC LIMIT $inicio,$registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM categoria ORDER BY categoria_nombre ASC LIMIT $inicio,$registros";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);
            
            /*-- Encabezado de la tabla - Table header --*/
			$tabla.='
            <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive rounded-7 ">
                            <table class="table" id="form-user">
                            <thead style="background:var(--bg-white);" >
                    <tr class=" text-center font-weight-bold">
					 <th>Acciones</th>
                        <th>Nombre</th>
						<th>Descripción</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody class="salida">
            ';

            if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr class="text-center" >
						<td class="actions ps-0">
                        <div class="btn-group dropup shadow-0">
                        <a type="button" class="btn btn-sm btn-rounded badge badge-warning m-auto shadow-3-strong ms-2" href="'.URL.DASHBOARD.'/category-update/'.mainModel::encryption($rows['categoria_id']).'/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="usuario_id_del" value="'.mainModel::encryption($rows['categoria_id']).'">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                        </div>
                        </td>
							<td>'.$rows['categoria_nombre'].'</td>
							<td>'.$rows['categoria_descripcion'].'</td>
							<td>'.$rows['categoria_estado'].'</td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="text-center" >
							<td colspan="5">
								<a href="'.$url.'" class="btn btn-primary btn-sm">
									Haga clic acá para recargar el listado
								</a>
							</td>
						</tr>
					';
				}else{
					$tabla.='
						<tr class="text-center" >
							<td colspan="5">
								No hay registros en el sistema
							</td>
						</tr>
					';
				}
			}

            $tabla .= '</tbody></table></div></div></div></div></div>';
			$tabla .= '<div class="d-block w-100"><div class="row"><div class="col-12 col-sm-6">';
			if($total>0 && $pagina<=$Npaginas){
				$tabla.='<p class="text-center text-sm-start ms-auto">Mostrando <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
			}
			
			$tabla .= '</div><div class="col-12 col-sm-6">';
			/*--Paginacion - Pagination --*/
			if($total>=1 && $pagina<=$Npaginas){
				$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7,LANG);
			}

			$tabla .= '</div></div></div>';
			return $tabla;
        } /*-- Fin controlador - End controller --*/

		/*--------- Controlador paginador categorias - categories Pager Controller ---------*/
        public function paginador_categoria_color_controlador($pagina,$registros,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);

			$url=mainModel::limpiar_cadena($url);
			$url=URL.DASHBOARD."/".$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
            
            if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM categoria WHERE (categoria_nombre LIKE '%$busqueda%') ORDER BY categoria_nombre ASC LIMIT $inicio,$registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM categoria ORDER BY categoria_nombre ASC LIMIT $inicio,$registros";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);
            
            /*-- Encabezado de la tabla - Table header --*/
			$tabla.='
            <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive rounded-7 ">
                            <table class="table salida" id="form-user">
                            <thead style="background:var(--bg-white);" >
                    <tr class=" text-center font-weight-bold">
					 <th>Acciones</th>
                        <th>#</th>
                        <th>Nombre</th>
						<th>Descripción</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
            ';

            if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr class="text-center" >
						<td class="actions ps-0">
                        <div class="btn-group dropup shadow-0">
                        <a type="button" class="btn btn-sm btn-rounded badge badge-warning m-auto shadow-3-strong ms-2" href="'.URL.DASHBOARD.'/category-update/'.mainModel::encryption($rows['categoria_id']).'/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="usuario_id_del" value="'.mainModel::encryption($rows['categoria_id']).'">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                        </div>
                        </td>
							<td>'.$rows['categoria_id'].'</td>
							<td>'.$rows['categoria_nombre'].'</td>
							<td>'.$rows['categoria_descripcion'].'</td>
							<td>'.$rows['categoria_estado'].'</td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="text-center" >
							<td colspan="5">
								<a href="'.$url.'" class="btn btn-primary btn-sm">
									Haga clic acá para recargar el listado
								</a>
							</td>
						</tr>
					';
				}else{
					$tabla.='
						<tr class="text-center" >
							<td colspan="5">
								No hay registros en el sistema
							</td>
						</tr>
					';
				}
			}

            $tabla .= '</tbody></table></div></div></div></div></div>';
			$tabla .= '<div class="d-block w-100"><div class="row"><div class="col-12 col-sm-6">';
			if($total>0 && $pagina<=$Npaginas){
				$tabla.='<p class="text-center text-sm-start ms-auto">Mostrando <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
			}
			
			$tabla .= '</div><div class="col-12 col-sm-6">';
			/*--Paginacion - Pagination --*/
			if($total>=1 && $pagina<=$Npaginas){
				$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7,LANG);
			}

			$tabla .= '</div></div></div>';
			return $tabla;
        } /*-- Fin controlador - End controller --*/


		/*--------- Controlador paginador categorias - categories Pager Controller ---------*/
        public function paginador_categoria_marca_controlador($pagina,$registros,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);

			$url=mainModel::limpiar_cadena($url);
			$url=URL.DASHBOARD."/".$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
            
            if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM categoria_marca WHERE (nombre_categoria_marca LIKE '%$busqueda%') ORDER BY nombre_categoria_marca ASC LIMIT $inicio,$registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM categoria_marca ORDER BY nombre_categoria_marca ASC LIMIT $inicio,$registros";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);
            
            /*-- Encabezado de la tabla - Table header --*/
			$tabla.='
            <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive rounded-7 ">
                            <table class="table salida" id="form-user">
                            <thead style="background:var(--bg-white);" >
                    <tr class=" text-center font-weight-bold">
					 <th>Acciones</th>
                        <th>Nombre</th>
						<th>Descripción</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
            ';
            if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $row){
					$tabla.='
						<tr class="text-center" >
						<td class="actions ps-0">
                        <div class="btn-group dropup shadow-0">
                        <a type="button" class="btn btn-sm btn-rounded badge badge-warning m-auto shadow-3-strong ms-2" href="'.URL.DASHBOARD.'/brand-update/'.mainModel::encryption($row['id_categoria_marca']).'/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="usuario_id_del" value="'.mainModel::encryption($row['id_categoria_marca']).'">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                        </div>
                        </td>
							<td>'.$row['nombre_categoria_marca'].'</td>
							<td>'.$row['descripcion_categoria_marca'].'</td>
							<td>'.$row['estado_categoria_marca'].'</td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="text-center" >
							<td colspan="5">
								<a href="'.$url.'" class="btn btn-primary btn-sm">
									Haga clic acá para recargar el listado
								</a>
							</td>
						</tr>
					';
				}else{
					$tabla.='
						<tr class="text-center" >
							<td colspan="5">
								No hay registros en el sistema
							</td>
						</tr>
					';
				}
			}

            $tabla .= '</tbody></table></div></div></div></div></div>';
			$tabla .= '<div class="d-block w-100"><div class="row"><div class="col-12 col-sm-6">';
			if($total>0 && $pagina<=$Npaginas){
				$tabla.='<p class="text-center text-sm-start ms-auto">Mostrando <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
			}
			
			$tabla .= '</div><div class="col-12 col-sm-6">';
			/*--Paginacion - Pagination --*/
			if($total>=1 && $pagina<=$Npaginas){
				$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7,LANG);
			}

			$tabla .= '</div></div></div>';
			return $tabla;
        } /*-- Fin controlador - End controller --*/
		

	
        /*--------- Controlador eliminar categoria - Controller delete category ---------*/
        public function eliminar_categoria_controlador(){

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

            /*-- Recuperando id de la categoria - Retrieving category id - --*/
			$id=mainModel::decryption($_POST['categoria_id_del']);
			$id=mainModel::limpiar_cadena($id);

            /*-- Comprobando categoria en la BD - Checking category in DB --*/
			$check_categoria=mainModel::ejecutar_consulta_simple("SELECT categoria_id FROM categoria WHERE categoria_id='$id'");
			if($check_categoria->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Categoría no encontrado",
					"Texto"=>"La categoría que intenta eliminar no existe en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_categoria->closeCursor();
			$check_categoria=mainModel::desconectar($check_categoria);

            /*-- Comprobando productos - Checking products --*/
			$check_productos=mainModel::ejecutar_consulta_simple("SELECT categoria_id FROM producto WHERE categoria_id='$id' LIMIT 1");
			if($check_productos->rowCount()>0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No podemos eliminar la categoría debido a que tiene productos asociados, recomendamos deshabilitar esta categoría si ya no será usada en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_productos->closeCursor();
			$check_productos=mainModel::desconectar($check_productos);

            /*-- Eliminando categoria - Deleting category --*/
			$eliminar_categoria=mainModel::eliminar_registro("categoria","categoria_id",$id);

			if($eliminar_categoria->rowCount()==1){
				$alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"¡Categoría eliminada!",
                    "Texto"=>"La categoría ha sido eliminada del sistema exitosamente",
                    "Icon"=>"success",
                    "TxtBtn"=>"Aceptar"
                ];
			}else{
				$alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido eliminar la categoría del sistema, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$eliminar_categoria->closeCursor();
			$eliminar_categoria=mainModel::desconectar($eliminar_categoria);

			echo json_encode($alerta);
        } /*-- Fin controlador - End controller --*/


        /*--------- Controlador actualizar categoria - Controller update category ---------*/
		public function actualizar_categoria_controlador(){

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

            /*-- Recibiendo id de la categoria - Receiving category id --*/
			$id=mainModel::decryption($_POST['categoria_id_up']);
			$id=mainModel::limpiar_cadena($id);

            /*-- Comprobando categoria en la DB - Checking category in DB --*/
			$check_categoria=mainModel::ejecutar_consulta_simple("SELECT * FROM categoria WHERE categoria_id='$id'");
			if($check_categoria->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Categoría no encontrada",
					"Texto"=>"No hemos encontrado la categoría en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}else{
				$campos=$check_categoria->fetch();
			}
			$check_categoria->closeCursor();
			$check_categoria=mainModel::desconectar($check_categoria);

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $nombre=mainModel::limpiar_cadena($_POST['categoria_nombre_up']);
            $estado=mainModel::limpiar_cadena($_POST['categoria_estado_up']);
            $descripcion=mainModel::limpiar_cadena($_POST['categoria_descripcion_up']);

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

            /*-- Verificando integridad de los datos - Checking data integrity --*/
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            if($descripcion!=""){
                if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,700}",$descripcion)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Formato no valido",
                        "Texto"=>"La DESCRIPCIÓN no coincide con el formato solicitado. Solo se permiten caracteres alfanuméricos y los siguientes símbolos: () . , #",
                        "Icon"=>"error",
                        "TxtBtn"=>"Aceptar"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            /*-- Comprobando estado de categoria - Checking category status --*/
			if($estado!="Habilitada" && $estado!="Deshabilitada"){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Opción no valida",
					"Texto"=>"Ha seleccionado un ESTADO DE CATEGORÍA no valido",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Comprobando nombre - Checking name --*/
            if($campos['categoria_nombre']!=$nombre){
                $check_nombre=mainModel::ejecutar_consulta_simple("SELECT categoria_nombre FROM categoria WHERE categoria_nombre='$nombre'");
                if($check_nombre->rowCount()>0){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"El nombre de categoría que acaba de ingresar ya se encuentra registrado, por favor elija otro",
                        "Icon"=>"error",
                        "TxtBtn"=>"Aceptar"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $check_nombre->closeCursor();
                $check_nombre=mainModel::desconectar($check_nombre);
            }

            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_categoria_up=[
                "categoria_nombre"=>[
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				"categoria_descripcion"=>[
					"campo_marcador"=>":Descripcion",
					"campo_valor"=>$descripcion
                ],
                "categoria_estado"=>[
					"campo_marcador"=>":Estado",
					"campo_valor"=>$estado
				]
            ];

            $condicion=[
				"condicion_campo"=>"categoria_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

            if(mainModel::actualizar_datos("categoria",$datos_categoria_up,$condicion)){
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