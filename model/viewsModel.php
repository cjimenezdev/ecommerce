<?php 
	class vistasModelo{

		/*---------- Modelo obtener vistas ----------*/
		protected static function obtener_vistas_modelo($vistas,$modulo){
			
			$lista_blanca=["index","profile","product","catalogue","offer","sold","home","bag","order","pay","details","men","women","boy","girl","about","services","contact","admin-profile","admin-new","admin-list","admin-search","admin-update","brand-new","brand-update","customer-new","client-list","client-search","customer-update","category-new","category-list","category-search","category-update","company","product-new","product-list","product-search","product-minimum","product-update","product-cover","product-gallery","product-info","order-new","sale-all"];
			
			if(in_array($vistas, $lista_blanca)){
				
				if(is_file("./view/page/".$modulo."-".$vistas.".php")){
					$contenido="./view/page/".$modulo."-".$vistas.".php";
				}else{
					$contenido="404";
				}
			}else{
					if($vistas!="login" && $vistas!="signin"){
						$contenido="404";
					}else{
						if($vistas!="login" && $vistas=="signin"){
							$contenido="signin";
						}
					}
					
					if($vistas!="signin" && $vistas!="register"){
						$contenido="404";
					}else{
						
						if($vistas!="signin" && $vistas=="register"){
							$contenido="register";
						}
					}
					
				return $contenido;
			}
			return $contenido;
		}
	}