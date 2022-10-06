<div class="container-fluid pb-5 pt-5">
    <div class="container pt-5">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <?php
                    $datos_producto=$ins_login->datos_tabla("Unico","producto","producto_id",$pagina[1]);
                    if($datos_producto->rowCount()==1){
                        $campos=$datos_producto->fetch();
                        $total_price=$campos['producto_precio_venta']-($campos['producto_precio_venta']*($campos['producto_descuento']/100));?>
                    <div class="col-12 col-lg-5">
                        <figure>
                            <div class="card">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <?php if(is_file("./public/assets/img/products/cover/".$campos['producto_portada'])){ ?>
                                    <img class="img-fluid" style="height:250px;"
                                        src="<?php echo URL."public/assets/img/products/cover/".$campos['producto_portada']; ?>"
                                        alt="<?php echo $campos['producto_nombre']; ?>">
                                    <?php }else{ ?>
                                    <img class="img-fluid"
                                        src="<?php echo URL; ?>public/assets/img/products/cover/default.jpg"
                                        alt="<?php echo $campos['producto_nombre']; ?>">
                                    <?php } ?>
                                </div>
                            </div>
                        </figure>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <?php if($campos['producto_descripcion']!=""){ ?>
                                <p class="lead ms-0 ms-md-3">
                                    <span
                                        class="text-uppercase fw-bold"><?php echo $campos['producto_descripcion']; ?></span><br>
                                </p>
                                <?php } ?>
                                <div class="ms-0 ms-md-3 mb-4">
                                    <button class="p-0 border-0 bg-transparent"><i
                                            class="bi-star h4 text-black-50"></i></button>
                                    <button class="p-0 border-0 bg-transparent"><i
                                            class="bi-star h4 text-black-50"></i></button>
                                    <button class="p-0 border-0 bg-transparent"><i
                                            class="bi-star h4 text-black-50"></i></button>
                                    <button class="p-0 border-0 bg-transparent"><i
                                            class="bi-star h4 text-black-50"></i></button>
                                    <button class="p-0 border-0 bg-transparent"><i
                                            class="bi-star h4 text-black-50"></i></button>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 ">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <strong class="font-weight-bold text-uppercase ms-0 ms-md-3"><i
                                                class="far fa-credit-card fa-fw"></i>
                                        </strong>
                                        &nbsp
                                        <span
                                            class="text-primary fw-bold"><?php echo COIN_SYMBOL.number_format($total_price,COIN_DECIMALS,COIN_SEPARATOR_DECIMAL,COIN_SEPARATOR_THOUSAND).' '.COIN_NAME; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 ">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <strong class="text-uppercase">
                                            Descuento:</strong>
                                        &nbsp
                                        <span class="text-danger"><?php echo $campos['producto_descuento']; ?>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12 col-md-6 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <strong class="text-uppercase">
                                            Tipo:</strong>
                                        &nbsp
                                        <span><?php echo $campos['producto_tipo']; ?></span>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <strong class=" text-uppercase">
                                            Stock:</strong>
                                        &nbsp
                                        <span class=" badge badge-primary">
                                            <?php if($campos['producto_tipo']=="Fisico"){ echo $campos['producto_stock']; }else{ echo "Disponible"; } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <strong class="text-uppercase">
                                            Fabricante:</strong> &nbsp <?php echo $campos['producto_marca']; ?>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <strong class=" text-uppercase">
                                            Modelo:</strong>
                                        &nbsp <?php echo $campos['producto_modelo']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Agregar al carrito -->
                            <form autocomplete="off" class="d-flex justify-content-center flex-column FormularioAjax"
                                method="POST" data-form="save" data-lang="es"
                                action="<?php echo URL; ?>ajax/carritoAjax.php">
                                <input type="hidden" name="modulo_carrito" value="agregar">
                                <input type="hidden" name="product_id"
                                    value="<?php echo mainModel::encryption($campos['producto_id']);?>"
                                    class="form-control text-center" id="product_id" maxlength="10">
                                <input type="hidden" name="product_nombre"
                                    value="<?php echo $campos['producto_nombre']?>" class="form-control text-center"
                                    id="product_nombre" maxlength="10">
                                <input type="hidden" name="product_precio_venta"
                                    value="<?php echo $campos['producto_precio_venta']-($campos['producto_precio_venta']*($campos['producto_descuento']/100))?>"
                                    class="form-control text-center" id="product_precio_venta" maxlength="10">
                                <input type="hidden" name="product_portada"
                                    value="<?php echo $campos['producto_portada']?>" class="form-control text-center"
                                    id="product_portada" maxlength="10">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <button type="button" class="btn btn-light" id="notplus"><i
                                                        class="fa-solid fa-minus"></i></button>
                                                <div class="form-outline">
                                                    <input type="text" id="aggcount" class="form-control text-center"
                                                        name="product_cant" pattern="[0-9]{1,10}" maxlength="10">
                                                </div>
                                                <button type="button" class="btn btn-light" id="plus"><i
                                                        class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 text-center mt-4 mt-md-0">
                                            <button type="submit" class="btn btn-info"><i
                                                    class="fas fa-shopping-bag fa-fw"></i>
                                                &nbsp; Agregar al carrito</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    $datos_galeria=$ins_login->datos_tabla("Normal","imagen WHERE producto_id='".$campos['producto_id']."'","*",0);
                    if($datos_galeria->rowCount()>0){?>
                    <div class="col-12">
                        <?php while($campos_galeria=$datos_galeria->fetch()){ ?>
                        <div class="row">
                            <div class="col-4 col-md-3">
                                <div class="card">
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                        <figure class="gallery-links">
                                            <?php if(is_file("./public/assets/img/products/gallery/".$campos_galeria['imagen_nombre'])){ ?>
                                            <a data-gallery="galleryGallery" class="gallery-lightbox"
                                                href="<?php echo URL; ?>public/assets/img/products/gallery/<?php echo $campos_galeria['imagen_nombre']; ?>">
                                                <img class="img-fluid bg-white" style="height:100px;"
                                                    src="<?php echo URL; ?>public/assets/img/products/gallery/<?php echo $campos_galeria['imagen_nombre']; ?>"
                                                    alt="<?php echo $campos['producto_nombre']; ?>">
                                            </a>
                                            <?php }else{ ?>
                                            <a data-fslightbox="gallery"
                                                href="<?php echo URL; ?>public/assets/img/products/gallery/default.jpg">
                                                <img class="img-fluid"
                                                    src="<?php echo URL; ?>public/assets/img/products/gallery/default.jpg"
                                                    alt="<?php echo $campos['producto_nombre']; ?>">
                                            </a>
                                            <?php } ?>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5 class="poppins-regular text-uppercase" style="padding-top: 70px;">Calificar producto</h5>
                        <hr>
                    </div>
                    <?php }else{ ?>
                    <div class=" col-12">
                        <h5 class="poppins-regular text-uppercase">No hay galería de
                            imagenes
                        </h5>
                        <hr>
                    </div>
                    <?php }?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo URL; ?>ajax/comentarioAjax.php" class="FormularioAjax"
                                    method="POST" data-form="save" data-lang="es">
                                    <input type="hidden" name="modulo_comentario" value="agregar">
                                    <div class="mb-4">
                                        <div class="row">
                                            <div class="col-12 col-md-6 ">
                                                <?php date_default_timezone_set('America/Guayaquil');$fecha_actual = date('Y-m-d',); ?>
                                                <div><input type="hidden" name="comment_fecha"
                                                        value="<?php echo $fecha_actual ?>">
                                                    <input type="hidden" name="comment_ident"
                                                        value="<?php echo $campos['producto_id'] ?>"><input
                                                        type="hidden" name="id_cliente_com"
                                                        value="<?php echo $_SESSION['id_cust']?>">
                                                </div>
                                                <div class="form-outline mb-3">
                                                    <input class="form-control" name="user_comment" id="user_comment"
                                                        disabled
                                                        value="<?php echo $_SESSION['nombre_cust'].' '. $_SESSION['apellido_cust']?>">
                                                    <label class="form-label" for="user_comment">Nombre
                                                        usuario</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 ">
                                                <div class="form-outline mb-3">
                                                    <input type="email" class="form-control" name="email_comment"
                                                        id="email_comment" disabled
                                                        value="<?php echo $_SESSION['correo_cust']?>">
                                                    <label class="form-label" for="email_comment">Correo
                                                        electrónico</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-outline">
                                            <textarea class="form-control" name="comment" id="comment" cols="5"
                                                rows="5"></textarea>
                                            <label class="form-label" for="comment">Comentario</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn bg-danger badge badge-danger text-white">Publicar
                                        comentario</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h5 class="poppins-regular text-uppercase" style="padding-top: 70px;">Comentarios</h5>
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="mt-4">
                            <div class="badge badge-info p-5 w-100">
                                <?php
                                $producto_com = $campos['producto_id'];
                                $id_cliente= $_SESSION['id_cust'];
                                $campos="com.comentario_id, com.comentario_detalle, com.comentario_fecha, cl.cliente_nombre, cl.cliente_apellido, cl.cliente_foto";
                                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM comentario as com INNER JOIN cliente as cl ON com.id_cliente = cl.cliente_id INNER JOIN producto as pro ON com.id_producto = pro.producto_id WHERE pro.producto_id = $producto_com";
                                $conexion = mainModel::conectar();
                                $datos = $conexion->query($consulta);
                                $datos = $datos->fetchAll();?>
                                <?php if($datos){ ?>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row w-100">
                                            <?php foreach($datos as $rows){?>
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <img style="height: 40px; width:40px;"
                                                            class="img-fluid rounded-circle"
                                                            src="<?php echo URL;?>public/assets/img/customers/avatar/<?php echo $rows['cliente_foto']?>"
                                                            alt="">
                                                        <div
                                                            class="d-flex flex-column ms-0 ms-md-2 justify-content-start">
                                                            <h6><?php echo $rows['cliente_nombre'].' '.$rows['cliente_apellido']?>
                                                            </h6>
                                                            <span
                                                                class="text-start"><?php echo $rows['comentario_fecha']?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex mt-3">
                                                    <p class="text-start p-4 badge badge-light-info w-100">
                                                        <?php echo $rows['comentario_detalle']?>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php }else{ include "./view/inc/error_alert.php";}?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
let aggcount = document.getElementById("aggcount").value = 1;

let notplus = document.getElementById("notplus");

notplus.addEventListener("click", function() {

    if (document.getElementById("aggcount").value > 1) {

        var disminuir = parseInt(document.getElementById("aggcount").value) - 1;

        document.getElementById("aggcount").value = disminuir;
    }
});

let plus = document.getElementById("plus");

plus.addEventListener("click", function() {

    if (aggcount >= 1 || aggcount <= 100) {

        var aumentar = parseInt(document.getElementById("aggcount").value) + 1;

        document.getElementById("aggcount").value = aumentar;

    } else {
        document.getElementById("aggcount").value = 0;
    }
});
</script>