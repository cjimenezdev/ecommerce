<?php 

if(isset($_POST['txtbuscaUsuario'])){
    
$peticion_ajax=true;

$busqueda = $_POST['txtbuscaUsuario'];

require "../config/db.php";
require "../config/app.php";
require "../model/mainModel.php";
include "../view/security/session_start.php";

   $id = 1;
   $user=new ApptivaDB();  
    $u=$user->buscar("usuario","((usuario_id!='$id' AND usuario_id!='".$_SESSION['id_sto']."') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_cargo LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%')) ORDER BY usuario_nombre");
    if($u){
        $html='';
        
        foreach ($u as $v)
        
        $html.='<tr>
                    <td class="actions ps-0">
                        <div class="btn-group dropup shadow-0">
                        <a type="button" class="btn btn-sm btn-rounded badge badge-warning m-auto shadow-3-strong ms-2" href="'.URL.DASHBOARD.'/admin-update/'.mainModel::encryption($v['usuario_id']).'/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="usuario_id_del" value="'.$v['usuario_id'].'">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                        </div>
                    </td>
                        
                    <td>
                        <div class="d-block position-relative">
                            ';
                            
                            if (is_file("../public/assets/img/users/avatar/".$v['usuario_foto'])) {
                                $html .= '<img src="'.URL.'public/assets/img/users/avatar/'. $v['usuario_foto'] . '" style="width: 45px; height: 45px; position:absolute;" class="rounded-circle img-fluid d-inline-block" alt="' . $v['usuario_nombre'] . '" />';
                            } else {
                                
                                $html .= '<img src="' . URL . 'public/assets/img/users/avatar/default.jpg" style="width: 45px; height: 45px;position:absolute;" class="rounded-circle img-fluid d-inline-block" alt="' . $v['usuario_nombre'] . '" />';
                            }
                            
                            $html .= '
                            <div class="ms-5 d-inline-block">
                            <p class="fw-bold mb-1 ">' . $v['usuario_nombre'] . ' ' . $v['usuario_apellido'] . '</p>
                                <p class="text-muted mb-0 ">' . $v['usuario_email'] . '</p>
                                </div>
                            </div>
                    </td>
                        <td>
                            <p class="fw-normal mb-1 ">' . $v['usuario_cargo'] . '</p>
                            <p class="text-muted mb-0 ">' . $v['usuario_genero'] . '</p>
                        </td>
                        <td><p class=" font-weight-normal">' . $v['usuario_dni'] . '</p></td>
                        <td><p class="font-weight-light">0' . $v['usuario_telefono'] . '</p></td>
                        <td><p class=" font-weight-light">' . $v['usuario_fnacimiento'] . '</p></td>
                        <td><p class=" font-weight-normal">' . $v['usuario_direccion'] . '</p></td>
                        <td>
                        <div class="d-flex">
                            <span class="badge badge-success rounded-pill ">' . $v['usuario_cuenta_estado'] . '</span>
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