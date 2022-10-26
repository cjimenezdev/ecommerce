<?php 

if(isset($_POST['txtbusca'])){
    
$peticion_ajax=true;

$busqueda = $_POST['txtbusca'];

require "../config/db.php";
require "../config/app.php";
require "../model/mainModel.php";

   $user=new ApptivaDB();  
    $u=$user->buscar("cliente","(cliente_nombre LIKE '%$busqueda%' OR cliente_apellido LIKE '%$busqueda%' OR cliente_email LIKE '%$busqueda%' OR cliente_provincia LIKE '%$busqueda%' OR cliente_ciudad LIKE '%$busqueda%') ORDER BY cliente_nombre");

    if($u){
        $html='';
        
        foreach ($u as $v)
        
        $html.='<tr>
                    <td class="actions ps-0">
                        <div class="btn-group dropup shadow-0">
                        <a type="button" class="btn btn-sm btn-rounded badge badge-warning m-auto shadow-3-strong ms-2" href="'.URL.DASHBOARD.'/customer-update/'.mainModel::encryption($v['cliente_id']).'/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="usuario_id_del" value="'.$v['cliente_id'].'">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                        </div>
                    </td>
                        
                    <td>
                        <div class="d-block position-relative">
                            ';
                            
                            if (is_file("../public/assets/img/users/avatar/".$v['cliente_foto'])) {
                                $html .= '<img src="'.URL.'public/assets/img/users/avatar/'. $v['cliente_foto'] . '" style="width: 45px; height: 45px; position:absolute;" class="rounded-circle img-fluid d-inline-block" alt="' . $v['cliente_nombre'] . '" />';
                            } else {
                                
                                $html .= '<img src="' . URL . 'public/assets/img/users/avatar/default.jpg" style="width: 45px; height: 45px;position:absolute;" class="rounded-circle img-fluid d-inline-block" alt="' . $v['cliente_nombre'] . '" />';
                            }
                            
                            $html .= '
                            <div class="ms-5 d-inline-block">
                            <p class="fw-bold mb-1 ">' . $v['cliente_nombre'] . ' ' . $v['cliente_apellido'] . '</p>
                                <p class="text-muted mb-0 ">' . $v['cliente_email'] . '</p>
                                </div>
                            </div>
                    </td>
                        <td>
                            <p class="text-muted mb-0 ">' . $v['cliente_genero'] . '</p>
                        </td>
                        <td><p class=" font-weight-normal">' . $v['cliente_dni'] . '</p></td>
                        <td><p class="font-weight-light">0' . $v['cliente_celular'] . '</p></td>
                        <td><p class=" font-weight-light">' . $v['cliente_fnacimiento'] . '</p></td>
                        <td><p class=" font-weight-normal">' . $v['cliente_direccion'] . '</p></td>
                        <td>
                        <div class="d-flex">
                            <span class="badge badge-success rounded-pill ">' . $v['cliente_cuenta_estado'] . '</span>
                        </div>
                        </td>
				</tr>';              
    echo $html;
    }else{
        $html='<tr class="text-center">
							<td colspan="8">
								No hay registros en el sistema
							</td>
						</tr>';
                        echo $html;
    }
}else{
    echo "Error";
}
 ?>