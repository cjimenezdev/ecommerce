<?php

    if($peticion_ajax){
        require_once "../model/mainModel.php";
    }else{
        require_once "./model/mainModel.php";
    }

	class clienteControlador extends mainModel{

         /*--------- Controlador registrar cliente - Controller register client ---------*/
        public function registrar_cliente_controlador(){

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $nombre=mainModel::limpiar_cadena($_POST['cliente_nombre_reg']);
            $apellido=mainModel::limpiar_cadena($_POST['cliente_apellido_reg']);
            $email=mainModel::limpiar_cadena($_POST['cliente_email_reg']);
            $clave_1=mainModel::limpiar_cadena($_POST['cliente_clave_1_reg']);
            $clave_2=mainModel::limpiar_cadena($_POST['cliente_clave_2_reg']);

            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($nombre=="" || $apellido=="" || $email=="" || $clave_1=="" || $clave_2==""){
                $alerta=[
					"Alerta"=>"simple",
					"Texto"=>"Campos obligatorios vacíos",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Verificando integridad de los datos - Checking data integrity --*/
            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}",$apellido)){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"El APELLIDO no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_1) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_2)){
                $alerta=[
					"Alerta"=>"simple",
					"Texto"=>"Las CONTRASEÑAS no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Comprobando email - Checking email --*/
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $check_email=mainModel::ejecutar_consulta_simple("SELECT cliente_email FROM cliente WHERE cliente_email='$email'");
                if($check_email->rowCount()>0){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Texto"=>"El EMAIL ingresado ya se encuentra registrado",
                        "Icon"=>"error",
                        "TxtBtn"=>"Aceptar"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $check_email->closeCursor();
                $check_email=mainModel::desconectar($check_email);
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"Ha ingresado un EMAIL no valido",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*-- Comprobando claves - Checking passwords --*/
			if($clave_1!=$clave_2){
                $alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"Las contraseñas que acaba de ingresar no coinciden",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
				echo json_encode($alerta);
				exit();
			}else{
				$clave=mainModel::encryption($clave_1);
            }


            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_cliente_reg=[
				"cliente_nombre"=>[
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				"cliente_apellido"=>[
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
                ],
				"cliente_email"=>[
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				],
				"cliente_clave"=>[
					"campo_marcador"=>":Clave",
					"campo_valor"=>$clave
				]
			];

            /*-- Guardando datos del cliente - Saving client data --*/
			$agregar_cliente=mainModel::guardar_datos("cliente",$datos_cliente_reg);

			if($agregar_cliente->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Texto"=>"Los datos se registraron con éxito",
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

			$agregar_cliente->closeCursor();
			$agregar_cliente=mainModel::desconectar($agregar_cliente);

			echo json_encode($alerta);
        } /*-- Fin controlador - End controller --*/
        /*--------- Controlador registrar cliente - Controller register client ---------*/
        
        public function registrar_cliente_administrador_controlador(){

            /*-- Comprobando privilegios - Checking privileges --*/
            if(isset($_SESSION['cargo_sto']) && ($_SESSION['cargo_sto']=="Administrador" || $_SESSION['cargo_sto']=="Cajero")){
                $estado=mainModel::limpiar_cadena($_POST['cliente_estado_reg']);
                $verificacion=mainModel::limpiar_cadena($_POST['cliente_verificacion_reg']);
            }else{
                $estado="Activa";
                $verificacion="No verificada";
            }

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $nombre=mainModel::limpiar_cadena($_POST['cliente_nombre_reg']);
            $apellido=mainModel::limpiar_cadena($_POST['cliente_apellido_reg']);
            $telefono=mainModel::limpiar_cadena($_POST['cliente_telefono_reg']);
            $genero=mainModel::limpiar_cadena($_POST['cliente_genero_reg']);

            $provincia=mainModel::limpiar_cadena($_POST['cliente_provincia_reg']);
            $ciudad=mainModel::limpiar_cadena($_POST['cliente_ciudad_reg']);
            $direccion=mainModel::limpiar_cadena($_POST['cliente_direccion_reg']);

            $email=mainModel::limpiar_cadena($_POST['cliente_email_reg']);
            $clave_1=mainModel::limpiar_cadena($_POST['cliente_clave_1_reg']);
            $clave_2=mainModel::limpiar_cadena($_POST['cliente_clave_2_reg']);

            $avatar=mainModel::limpiar_cadena($_POST['cliente_avatar_reg']);

            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($nombre=="" || $apellido=="" || $telefono=="" || $genero=="" || $provincia=="" || $ciudad=="" || $direccion=="" || $email=="" || $clave_1=="" || $clave_2==""){
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
            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}",$nombre)){
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

            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}",$apellido)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El APELLIDO no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            if(mainModel::verificar_datos("[0-9()+]{8,20}",$telefono)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Formato no valido",
                    "Texto"=>"El TELÉFONO no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,29}",$provincia)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Formato no valido",
                    "Texto"=>"ESTADO, PROVINCIA O DEPARTAMENTO no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,29}",$ciudad)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Formato no valido",
                    "Texto"=>"CIUDAD o PUEBLO no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,70}",$direccion)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Formato no valido",
                    "Texto"=>"La DIRECCIÓN no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_1) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_2)){
                $alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"Las CONTRASEÑAS no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Comprobando genero - Checking gender --*/
			if($genero!="Masculino" && $genero!="Femenino"){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Opción no valida",
					"Texto"=>"Ha seleccionado un GÉNERO no valido",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Comprobando email - Checking email --*/
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $check_email=mainModel::ejecutar_consulta_simple("SELECT cliente_email FROM cliente WHERE cliente_email='$email'");
                if($check_email->rowCount()>0){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"El EMAIL ingresado ya se encuentra registrado",
                        "Icon"=>"error",
                        "TxtBtn"=>"Aceptar"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $check_email->closeCursor();
                $check_email=mainModel::desconectar($check_email);
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Formato no valido",
                    "Texto"=>"Ha ingresado un EMAIL no valido",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*-- Comprobando claves - Checking passwords --*/
			if($clave_1!=$clave_2){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"Las contraseñas que acaba de ingresar no coinciden",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
				echo json_encode($alerta);
				exit();
			}else{
				$clave=mainModel::encryption($clave_1);
            }

            /*-- Comprobando estado de cuenta - Checking account status --*/
			if($estado!="Activa" && $estado!="Deshabilitada"){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Opción no valida",
					"Texto"=>"Ha seleccionado un ESTADO DE CUENTA no valido",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Comprobando verificacion de cuenta - Checking account verification --*/
			if($verificacion!="Verificada" && $verificacion!="No verificada"){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Opción no valida",
					"Texto"=>"Ha seleccionado un valor de VERIFICACION DE CUENTA no valido",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Comprobando foto o avatar - Checking photo or avatar --*/
            if(!is_file("../vistas/assets/avatar/".$avatar)){
                $alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No hemos encontrado el avatar en el sistema, por favor seleccione otro e intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }


            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_cliente_reg=[
				"cliente_nombre"=>[
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				"cliente_apellido"=>[
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
                ],
				"cliente_genero"=>[
					"campo_marcador"=>":Genero",
					"campo_valor"=>$genero
                ],
                "cliente_telefono"=>[
					"campo_marcador"=>":Telefono",
					"campo_valor"=>$telefono
				],
                "cliente_provincia"=>[
					"campo_marcador"=>":Provincia",
					"campo_valor"=>$provincia
                ],
                "cliente_ciudad"=>[
					"campo_marcador"=>":Ciudad",
					"campo_valor"=>$ciudad
				],
                "cliente_direccion"=>[
					"campo_marcador"=>":Direccion",
					"campo_valor"=>$direccion
				],
				"cliente_email"=>[
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				],
				"cliente_clave"=>[
					"campo_marcador"=>":Clave",
					"campo_valor"=>$clave
				],
				"cliente_foto"=>[
					"campo_marcador"=>":Foto",
					"campo_valor"=>$avatar
				],
				"cliente_cuenta_estado"=>[
					"campo_marcador"=>":Estado",
					"campo_valor"=>$estado
				],
				"cliente_cuenta_verificada"=>[
					"campo_marcador"=>":Verificacion",
					"campo_valor"=>$verificacion
				]
			];

            /*-- Guardando datos del cliente - Saving client data --*/
			$agregar_cliente=mainModel::guardar_datos("cliente",$datos_cliente_reg);

			if($agregar_cliente->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"¡Cliente registrado!",
                    "Texto"=>"Los datos del cliente se registraron con éxito",
                    "Icon"=>"success",
                    "TxtBtn"=>"Aceptar"
                ];
			}else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido registrar los datos, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$agregar_cliente->closeCursor();
			$agregar_cliente=mainModel::desconectar($agregar_cliente);

			echo json_encode($alerta);
        }  
        /*-- Fin controlador - End controller --*/

        /*--------- Controlador paginador clientes - Clients Pager Controller ---------*/
        public function paginador_cliente_controlador($pagina,$registros,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);

			$url=mainModel::limpiar_cadena($url);
			$url=URL.DASHBOARD."/".$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $id=1;
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
            
            if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE (cliente_nombre LIKE '%$busqueda%' OR cliente_apellido LIKE '%$busqueda%' OR cliente_email LIKE '%$busqueda%' OR cliente_provincia LIKE '%$busqueda%' OR cliente_ciudad LIKE '%$busqueda%') ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);
            
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
                            <th>Género</th>
                            <th>Cédula</th>
                            <th>Celular</th>
                            <th>Fecha Nacimiento</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody class="salida">';
							if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $pag_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '
                    <tr>';
					if ($_SESSION['cargo_sto'] == "Cajero") {
                    $tabla .= '
                    <td class="actions ps-0">
                    <div class="btn-group dropup shadow-0">
                    <a type="button" style="margin-left:0 !important;" class="btn btn-sm btn-rounded badge badge-warning m-auto disabled" href="' . URL.DASHBOARD. '/customer-update/' . mainModel::encryption($rows['cliente_id']) . '/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="'.URL.'ajax/clienteAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_cliente" value="eliminar">
                        <input type="hidden" name="cliente_id_del" value="' . mainModel::encryption($rows['cliente_id']) . '">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger disabled mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                    </div>
                        </td>
                    ';
                } else {
                    $tabla .= '
                    <td class="actions ps-0">
                        <div class="btn-group dropup shadow-0">
                        <a type="button" class="btn btn-sm btn-rounded badge badge-warning m-auto shadow-3-strong ms-2" href="' . URL.DASHBOARD. '/customer-update/' . mainModel::encryption($rows['cliente_id']) . '/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/clienteAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_cliente" value="eliminar">
                        <input type="hidden" name="cliente_id_del" value="' . mainModel::encryption($rows['cliente_id']) . '">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                        </div>
                        </td>
                    ';
                }
                $tabla .= '<td>
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
                        <td>
                            <p class="text-muted mb-0 ">' . $rows['cliente_genero'] . '</p>
                        </td>
                        <td><p class=" font-weight-normal">' . $rows['cliente_dni'] . '</p></td>
                        <td><p class="font-weight-light">0' . $rows['cliente_celular'] . '</p></td>
                        <td><p class=" font-weight-light">' . $rows['cliente_fnacimiento'] . '</p></td>
                        <td><p class=" font-weight-normal">' . $rows['cliente_direccion'] . '</p></td>
                        <td>
                        <div class="d-flex">
                            <span class="badge badge-success rounded-pill ">' . $rows['cliente_cuenta_estado'] . '</span>
                        </div>
                            </td>
                            
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
        } /*-- Fin controlador - End controller --*/


        /*--------- Controlador eliminar cliente - Controller delete client ---------*/
        public function eliminar_cliente_controlador(){

            /*-- Comprobando privilegios - Checking privileges --*/
			if($_SESSION['cargo_sto']!="Administrador" && $_SESSION['cargo_sto']!="Cajero"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"No tienes los permisos necesarios para realizar esta operación en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
				echo json_encode($alerta);
				exit();
			}

            /*-- Recuperando id del cliente - Retrieving client id - --*/
			$id=mainModel::decryption($_POST['cliente_id_del']);
			$id=mainModel::limpiar_cadena($id);

            /*-- Comprobando cliente en la BD - Checking client in DB --*/
			$check_cliente=mainModel::ejecutar_consulta_simple("SELECT cliente_id FROM cliente WHERE cliente_id='$id'");
			if($check_cliente->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"El cliente que intenta eliminar no existe en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_cliente->closeCursor();
			$check_cliente=mainModel::desconectar($check_cliente);

            /*-- Comprobando ventas - Checking sales --*/
			$check_ventas=mainModel::ejecutar_consulta_simple("SELECT cliente_id FROM venta WHERE cliente_id='$id' LIMIT 1");
			if($check_ventas->rowCount()>0){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"No podemos eliminar el cliente debido a que tiene ventas asociadas, recomendamos deshabilitar este cliente si ya no será usado en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_ventas->closeCursor();
			$check_ventas=mainModel::desconectar($check_ventas);

            /*-- Eliminando cliente - Deleting client --*/
			$eliminar_cliente=mainModel::eliminar_registro("cliente","cliente_id",$id);

			if($eliminar_cliente->rowCount()==1){
				$alerta=[
                    "Alerta"=>"recargar",
                    "Texto"=>"El cliente ha sido eliminado del sistema exitosamente",
                    "Icon"=>"success",
                    "TxtBtn"=>"Aceptar"
                ];
			}else{
				$alerta=[
                    "Alerta"=>"simple",
                    "Texto"=>"No hemos podido eliminar el cliente del sistema, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$eliminar_cliente->closeCursor();
			$eliminar_cliente=mainModel::desconectar($eliminar_cliente);

			echo json_encode($alerta);
        } 
        /*-- Fin controlador - End controller --*/

        /*--------- Controlador actualizar cliente - Controller update administrator ---------*/
	    public function actualizar_cliente_controlador(){

			/*-- Recibiendo id del cliente - Receiving user id --*/
			$id=mainModel::decryption($_POST['cliente_id_up']);
			$id=mainModel::limpiar_cadena($id);

			/*-- Comprobando cliente en la DB - Checking user in DB --*/
			$check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM cliente WHERE cliente_id='$id'");
			if($check_user->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"No hemos encontrado la cuenta del cliente en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}else{
				$campos=$check_user->fetch();
			}
			$check_user->closeCursor();
			$check_user=mainModel::desconectar($check_user);


			/*-- Recibiendo datos del formulario - Receiving form data --*/
            $nombre=mainModel::limpiar_cadena($_POST['cliente_nombre_up']);
            $apellido=mainModel::limpiar_cadena($_POST['cliente_apellido_up']);
            $telefono=mainModel::limpiar_cadena($_POST['cliente_celular_up']);
			$identidad = mainModel::limpiar_cadena($_POST['cliente_identidad_up']);
			$fnacimiento = mainModel::limpiar_cadena($_POST['cliente_birthday_up']);
			$genero=mainModel::limpiar_cadena($_POST['cliente_genero_up']);
			
			$direccion = mainModel::limpiar_cadena($_POST['cliente_direccion_up']);
            $provincia = mainModel::limpiar_cadena($_POST['cliente_provincia_up']);
            $ciudad = mainModel::limpiar_cadena($_POST['cliente_ciudad_up']);
            $email=mainModel::limpiar_cadena($_POST['cliente_email_up']);
            $clave_1=mainModel::limpiar_cadena($_POST['cliente_clave_1_up']);
			$clave_2=mainModel::limpiar_cadena($_POST['cliente_clave_2_up']);
			$estado = mainModel::limpiar_cadena($_POST['cliente_estado_up']);
			
			if(isset($_POST['cliente_estado_up'])){
				$estado=mainModel::limpiar_cadena($_POST['cliente_estado_up']);	
			}else{
				$estado=$campos['cliente_cuenta_estado'];
			}

			
			/*$avatar=mainModel::limpiar_cadena($_POST['cliente_avatar_up']);*/

			/*-- Comprobando campos vacios - Checking empty fields --*/
            if($nombre=="" || $apellido=="" || $email=="" || $identidad=="" || $direccion=="" || $estado ==""){
                $alerta=[
					"Alerta"=>"simple",
					"Texto"=>"No has llenado todos los campos que son obligatorios",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }	

			/*-- Verificando integridad de los datos - Checking data integrity --*/
            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}",$apellido)){
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"El APELLIDO no coincide con el formato solicitado",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            if($telefono!=""){
                if(mainModel::verificar_datos("[0-9()+]{8,20}",$telefono)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Texto"=>"El TELÉFONO no coincide con el formato solicitado",
                        "Icon"=>"error",
                        "TxtBtn"=>"Aceptar"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
			
			/*-- Comprobando genero - Checking gender --*/
			if($genero!="Masculino" && $genero!="Femenino"){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Opción no valida",
					"Texto"=>"Ha seleccionado un GÉNERO no valido",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Comprobando estado de cuenta - Checking account status --*/
			if($estado!="Activa" && $estado!="Deshabilitada"){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Opción no valida",
					"Texto"=>"Ha seleccionado un ESTADO no valido",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }
			
			/*-- Comprobando si se ha seleccionado una imagen - Checking if an image has been selected --*/
			
			if ($_FILES['cliente_avatar_up']['name'] != "" && $_FILES['cliente_avatar_up']['size'] > 0) {


            /*-- Comprobando formato de las imagenes - Checking image format --*/
            if (mime_content_type($_FILES['cliente_avatar_up']['tmp_name']) != "image/jpeg" && mime_content_type($_FILES['cliente_avatar_up']['tmp_name']) != "image/png") {
                $alerta = [
                    "Alerta" => "simple",
                    "Texto" => "Formato de la imagen no permitido",
                    "Icon" => "error",
                    "TxtBtn" => "Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*-- Comprobando que la imagen no supere el peso permitido - Checking that the image does not exceed the allowed weight --*/
            $img_max_size = COVER_PRODUCT * 1024;
            if (($_FILES['cliente_avatar_up']['size'] / 1024) > $img_max_size) {
                $alerta = [
                    "Alerta" => "simple",
                    "Texto" => "Tamaño de la imagen debe ser máximo 3MB",
                    "Icon" => "error",
                    "TxtBtn" => "Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*-- Extencion de las imagenes - extension of the images --*/
            switch (mime_content_type($_FILES['cliente_avatar_up']['tmp_name'])) {
                case 'image/jpeg':
                    $img_ext = ".jpg";
                    break;
                case 'image/png':
                    $img_ext = ".png";
                    break;
            }

            /*-- Nombre final de la imagen - Final image name --*/
            $codigo_img = mainModel::generar_codigo_aleatorio(10, $id);
            $img_portada = $codigo_img . $img_ext;

            /*-- Directorios de imagenes - Image Directories --*/
            $img_dir = '../public/assets/img/customers/avatar/';

            /*-- Cambiando permisos al directorio - Changing permissions to the directory --*/
            chmod($img_dir, 0777);

            /* Moviendo imagen al directorio - Moving image to directory */
            if (!move_uploaded_file($_FILES['cliente_avatar_up']['tmp_name'], $img_dir . $img_portada)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Texto" => "La imagen no se subio al sistema, por favor intente nuevamente",
                    "Icon" => "error",
                    "TxtBtn" => "Aceptar"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Eliminando la imagen anterior - Deleting the previous image */
            if (is_file($img_dir . $campos['cliente_foto'])) {
                chmod($img_dir, 0777);
                unlink($img_dir . $campos['cliente_foto']);
            }

            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
            $datos_cliente_up = [
                "cliente_foto" => [
                    "campo_marcador" => ":Portada",
                    "campo_valor" => $img_portada
                ]
            ];

            $condicion = [
                "condicion_campo" => "cliente_id",
                "condicion_marcador" => ":ID",
                "condicion_valor" => $id
            ];

            if (mainModel::actualizar_datos("cliente", $datos_cliente_up, $condicion)) {
                if ($_SESSION['id_cust'] == $id) {
                    $_SESSION['foto_cust'] = $img_portada;
                }
            } else {

                if (is_file($img_dir . $img_portada)) {
                    chmod($img_dir, 0777);
                    unlink($img_dir . $img_portada);
                }
            }
        }

            /*-- Comprobando email - Checking email --*/
			if($email!=$campos['cliente_email'] && $email!=""){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=mainModel::ejecutar_consulta_simple("SELECT cliente_email FROM cliente WHERE cliente_email='$email'");
					if($check_email->rowCount()>0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Texto"=>"El EMAIL ingresado ya se encuentra registrado en el sistema",
                            "Icon"=>"error",
                            "TxtBtn"=>"Aceptar"
                        ];
						echo json_encode($alerta);
						exit();
					}
					$check_email->closeCursor();
					$check_email=mainModel::desconectar($check_email);
				}else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Texto"=>"Ha ingresado un EMAIL no valido",
                        "Icon"=>"error",
                        "TxtBtn"=>"Aceptar"
                    ];
					echo json_encode($alerta);
					exit();
				}
			}
			

			/*-- Comprobando contraseñas - Checking passwords --*/
			if($clave_1!="" || $clave_2!=""){

				if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_1) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_2)){
					$alerta=[
						"Alerta"=>"simple",
						"Texto"=>"Las NUEVAS CONTRASEÑAS no coincide con el formato solicitado",
						"Icon"=>"error",
						"TxtBtn"=>"Aceptar"
					];
					echo json_encode($alerta);
					exit();
				}else{
					if($clave_1!=$clave_2){
						$alerta=[
							"Alerta"=>"simple",
							"Texto"=>"Las NUEVAS CONTRASEÑAS que acaba de ingresar no coinciden",
							"Icon"=>"error",
							"TxtBtn"=>"Aceptar"
						];
						echo json_encode($alerta);
						exit();
					}else{
						$clave=mainModel::encryption($clave_1);
					}
				}
			}else{
				$clave=$campos['cliente_clave'];
			}


			/*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_cliente_up=[
				"cliente_nombre"=>[
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				"cliente_apellido"=>[
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
                ],
                "cliente_celular"=>[
					"campo_marcador"=>":Telefono",
					"campo_valor"=>$telefono
				],
				"cliente_fnacimiento"=>[
					"campo_marcador"=>":FNacimiento",
					"campo_valor"=>$fnacimiento
				],
				"cliente_dni"=>[
					"campo_marcador"=>":Identidad",
					"campo_valor"=>$identidad
				],
				"cliente_genero"=>[
					"campo_marcador"=>":Genero",
					"campo_valor"=>$genero
                ],
				"cliente_email"=>[
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				],
				"cliente_clave"=>[
					"campo_marcador"=>":Clave",
					"campo_valor"=>$clave
				],
				"cliente_direccion"=>[
					"campo_marcador"=>":Direccion",
					"campo_valor"=>$direccion
				],
                "cliente_provincia"=>[
					"campo_marcador"=>":Provincia",
					"campo_valor"=>$provincia
				],
                "cliente_ciudad"=>[
					"campo_marcador"=>":Ciudad",
					"campo_valor"=>$ciudad
				],
				"cliente_cuenta_estado"=>[
					"campo_marcador"=>":Estado",
					"campo_valor"=>$estado
				],
			];

			$condicion=[
				"condicion_campo"=>"cliente_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if(mainModel::actualizar_datos("cliente",$datos_cliente_up,$condicion)){

				if($_SESSION['id_cust']==$id){
					$_SESSION['nombre_cust']=$nombre;
					$_SESSION['apellido_cust']=$apellido;
					$_SESSION['genero_cust']=$genero;
				}

				$alerta = [
                "Alerta" => "recargar",
                "Texto" => "Los datos se actualizaron con éxito",
                "Icon" => "success",
                "TxtBtn" => "Aceptar"
            ];

			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Texto"=>"No hemos podido actualizar los datos de la cuenta, por favor intente nuevamente",
					"Icon"=>"error",
					"TxtBtn"=>"Aceptar"
				];
			}
			echo json_encode($alerta);
		} 	
	/*-- Fin controlador - End controller --*/
}