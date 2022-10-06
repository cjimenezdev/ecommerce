<?php

    if($peticion_ajax){
        require_once "../model/mainModel.php";
    }else{
        require_once "./model/mainModel.php";
    }

	class promocionControlador extends mainModel{
        
        /*--------- Controlador paginador productos (cliente) - Product Pager Controller (client) ---------*/
        public function promocion_paginador_producto_controlador(){
            
			$tabla="";

            $campos="prom.detalle_promocion,prom.descuento_promocion,pro.producto_id, pro.producto_nombre, pro.producto_precio_venta, pro.producto_descuento, pro.producto_portada, pro.producto_marca";
            
			$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM promocion as prom INNER JOIN producto as pro ON prom.id_producto= pro.producto_id WHERE prom.id_producto = pro.producto_id";

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

            $tabla.='<div class="row gy-4" data-aos="fade-left">';
            
            foreach($datos as $rows){
                
                $total_price=$rows['producto_precio_venta']-($rows['producto_precio_venta']*($rows['producto_descuento']/100));

                $total_descu = ($rows['descuento_promocion']*$total_price)/100;

                $total = $total_price - $total_descu;
                
                $tabla.='<div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200"> <div class="box"> <span class="featured bg-success">Promoción</span> <h3 style="color: #65c600">'.$rows['detalle_promocion'].'</h3> <div class="price"><sup>%</sup>'.$rows['descuento_promocion'].'<span> / desc</span></div>
                ';
                if(isset($_SESSION['id_cust'])){
                $tabla.='<img style="height: 190px !important;" src="../public/assets/img/products/cover/'.$rows['producto_portada'].'" class="img-fluid p-0" alt="" />'; }else{
                $tabla.='<img style="height: 190px !important;" src="./public/assets/img/products/cover/'.$rows['producto_portada'].'" class="img-fluid p-0" alt="" />';}
                $tabla.='<ul class="mt-0 pt-0"> <li class=" fw-bold">'.$rows['producto_nombre'].'</li> <li>'.$rows['producto_marca'].'</li></ul><p class="text-center text-black-50 text-decoration-line-through">
                            '.COIN_SYMBOL.number_format($total_price,COIN_DECIMALS,COIN_SEPARATOR_DECIMAL,COIN_SEPARATOR_THOUSAND).'
                            '.COIN_NAME.'</p><p class="text-center text-dark fw-bolder">
                            '.COIN_SYMBOL.number_format($total,COIN_DECIMALS,COIN_SEPARATOR_DECIMAL,COIN_SEPARATOR_THOUSAND).'
                            '.COIN_NAME.'</p>';
                            if(isset($_SESSION['id_cust'])){
                                $tabla.='<form class="FormularioAjax" onsubmit="return true" method="POST"
                                    data-form="save" action="../ajax/carritoAjax.php" autocomplete="off">';
                            }else{
                                $tabla.='<form class="FormularioAjax" onsubmit="return true" method="POST"
                                    data-form="save" action="./ajax/carritoAjax.php" autocomplete="off">';
                            }
                                    $tabla.='<input type="hidden" name="modulo_carrito" value="agregar">
                                    <input type="hidden" name="product_id"
                                        value="'.mainModel::encryption($rows['producto_id']).'"
                                        class="form-control text-center" id="product_id" maxlength="10">
                                    <input type="hidden" name="product_nombre"
                                        value="'.mainModel::encryption($rows['producto_nombre']).'"
                                        class="form-control text-center" id="product_nombre" maxlength="10">
                                    <input type="hidden" name="product_precio_venta"
                                        value="'.$total.'"
                                        class="form-control text-center" id="product_precio_venta" maxlength="10">
                                    <input type="hidden" name="product_portada" value="'.$rows['producto_portada'].'"
                                        class="form-control text-center" id="product_portada" maxlength="10">
                                    <input type="hidden" name="product_cant" id="product_cant" value="1"
                                        class="form-control text-center" pattern="[0-9]{1,10}" maxlength="10">
                                        <button type="submit" class="btn-buy">Comprar</button>
                                        
                                </form>
                                <a href="'.URL.'details/'.mainModel::encryption($rows['producto_id']).'/" class="btn btn-link btn-sm btn-rounded" data-mdb-toggle="tooltip" title="Info" ><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                                </div>';
            }
            $tabla.='</div>';
            return $tabla;
        }
        /*-- Fin controlador - End controller --*/
    }

?>