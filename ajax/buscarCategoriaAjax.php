<?php 

if(isset($_POST['txtbusca'])){$peticion_ajax=true;

require "../config/db.php";
require "../config/app.php";
require "../model/mainModel.php";

   $user=new ApptivaDB();  
    $u=$user->buscar("categoria"," categoria_nombre like '%".$_POST['txtbusca']."%' ORDER BY categoria_nombre");

    if($u){
        $html='';
        
        foreach ($u as $v)
        
        $html.='
						<tr class="text-center" >
						<td class="actions ps-0">
                        <div class="btn-group dropup shadow-0">
                        <a type="button" class="btn btn-sm btn-rounded badge badge-warning m-auto shadow-3-strong ms-2" href="'.URL.DASHBOARD.'/category-update/'.mainModel::encryption($v['categoria_id']).'/" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Editar"><i class="fa-solid fa-pen-nib"></i></a>
						<form class="FormularioAjax d-inline-block m-auto" action="' . URL . 'ajax/administradorAjax.php" method="POST" data-form="delete" data-lang="es">
                        <input type="hidden" name="modulo_administrador" value="eliminar">
                        <input type="hidden" name="usuario_id_del" value="'.$v['categoria_id'].'">
                        <button type="submit" class="btn btn-sm btn-rounded badge badge-danger mx-2" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Eliminar"><i class="fa-solid fa-trash"></i></button></form> 
                        </div>
                        </td>
							<td>'.$v['categoria_nombre'].'</td>
							<td>'.$v['categoria_descripcion'].'</td>
							<td>'.$v['categoria_estado'].'</td>
						</tr>
					';              
            echo $html;
    }else{
        $html='<tr class="text-center">
							<td colspan="5">
								No hay registros en el sistema
							</td>
						</tr>';
                        echo $html;
    }
}else{
    echo "Error";
}
 ?>