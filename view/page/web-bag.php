<?php 
if(!empty($_SESSION['Carrito'])){  ?>
<div class="container">
    <div class="row h-100 pt-5 mt-5">
        <div class="col-12 col-md-7 col-lg-8">
            <div class="row">
                <?php $subtotal=0; if(isset($_SESSION['id_cust'])){foreach ($_SESSION['Carrito'] as $indice => $producto){ ?>
                <div class="col-12">
                    <div class="card mt-2 mb-3">
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-12 col-md-3">
                                    <figure
                                        class="d-flex justify-content-center align-items-center flex-column position-relative">
                                        <?php if(is_file("./public/assets/img/products/cover/".$producto['product_portada'])){ ?>
                                        <img class="img-fluid"
                                            src="<?php echo URL."public/assets/img/products/cover/".$producto['product_portada']; ?>"
                                            alt="<?php echo $producto['product_nombre']; ?>">
                                        <span class="badge badge-warning position-absolute" style="top:80%;">$
                                            <?php echo number_format($producto['product_precio_venta'],2) ?></span>
                                        <?php }else{ ?>
                                        <img class="img-fluid"
                                            src="<?php echo URL; ?>public/assets/img/products/cover/default.jpg"
                                            alt="<?php echo $producto['product_nombre']; ?>">
                                        <?php } ?>
                                    </figure>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-12 col-lg-6 text-center">
                                            <div class="row justify-content-center">
                                                <form autocomplete="off" class="d-flex FormularioAjax" method="POST"
                                                    data-form="delete" data-lang="es" autocomplete="off"
                                                    action="<?php echo URL; ?>ajax/carritoAjax.php">
                                                    <input type="hidden" name="modulo_carrito" value="actualizar">
                                                    <input type="hidden" name="product_id" id="product_id"
                                                        value="<?php echo mainModel::encryption($producto['product_id']);?>">
                                                    <div class="col-6">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <div
                                                                class="form-outline d-flex flex-row border-0 border-light">
                                                                <input type="number"
                                                                    class="form-control aggcount ps-1 pe-1 text-center"
                                                                    name="product_cant"
                                                                    value="<?php echo $producto['product_cant'];?>"
                                                                    pattern="[0-9]{1,10}" maxlength="10">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit" id="btnAgg" name="btnAction"
                                                            value="Actualizar" class="btn btn-success p-1"
                                                            data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                                                            title="Actualizar cantidad"><i
                                                                class="fas fa-sync-alt fa-fw"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 text-center">
                                            <div class="row justify-content-center mt-4 mt-md-0">
                                                <form autocomplete="off" class="d-flex FormularioAjax" method="POST"
                                                    data-form="delete" data-lang="es" autocomplete="off"
                                                    action="<?php echo URL; ?>ajax/carritoAjax.php">
                                                    <input type="hidden" name="modulo_carrito" value="eliminar">
                                                    <input type="hidden" name="product_id"
                                                        value="<?php echo mainModel::encryption($producto['product_id']);?>"
                                                        class="form-control text-center" id="product_id" maxlength="10">
                                                    <?php if(isset($producto['id_cliente'])){?>
                                                    <input type="hidden" name="id_cliente"
                                                        value="<?php echo mainModel::encryption($producto['id_cliente']);?>"
                                                        class="form-control text-center" id="id_cliente" maxlength="10">
                                                    <?php } ?>
                                                    <div class="col-6">
                                                        <span class="poppins-regular font-weight-bold">$
                                                            <?php echo number_format($producto['product_precio_venta'] * $producto['product_cant'],2);?></span>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit" class="btn btn-danger p-1"
                                                            data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                                                            title="Quitar del carrito">
                                                            <span aria-hidden="true"><i
                                                                    class="far fa-trash-alt"></i></span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <?php $subtotal=$subtotal+number_format(($producto['product_precio_venta'])* $producto['product_cant'],2);?>
                        </div>
                    </div>
                </div>

                <?php } }else{?>
                <div class="col-12">
                    <div class="card mt-5">
                        <div class="card-body"><?php foreach ($_SESSION['Carrito'] as $indice => $producto) {?>
                            <div class="row d-flex align-items-center">
                                <div class="col-12 col-md-3">
                                    <figure
                                        class="d-flex justify-content-center align-items-center flex-column position-relative">
                                        <?php if(is_file("./public/assets/img/products/cover/".$producto['product_portada'])){ ?>
                                        <img class="img-fluid"
                                            src="<?php echo URL."public/assets/img/products/cover/".$producto['product_portada']; ?>"
                                            alt="<?php echo $producto['product_nombre']; ?>">
                                        <span class="badge badge-warning position-absolute" style="top:80%;">$
                                            <?php echo number_format($producto['product_precio_venta'],2) ?></span>
                                        <?php }else{ ?>
                                        <img class="img-fluid"
                                            src="<?php echo URL; ?>public/assets/img/products/cover/default.jpg"
                                            alt="<?php echo $producto['product_nombre']; ?>">
                                        <?php } ?>
                                    </figure>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-12 col-lg-6 text-center">
                                            <div class="row justify-content-center">
                                                <form autocomplete="off" class="d-flex FormularioAjax" method="POST"
                                                    data-form="delete" data-lang="es" autocomplete="off"
                                                    action="<?php echo URL; ?>ajax/carritoAjax.php">
                                                    <input type="hidden" name="modulo_carrito" value="actualizar">
                                                    <input type="hidden" name="product_id" id="product_id"
                                                        value="<?php echo mainModel::encryption($producto['product_id']);?>">
                                                    <div class="col-6">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <div
                                                                class="form-outline d-flex flex-row border-0 border-light">
                                                                <input type="number"
                                                                    class="form-control aggcount ps-1 pe-1 text-center"
                                                                    name="product_cant"
                                                                    value="<?php echo $producto['product_cant'];?>"
                                                                    pattern="[0-9]{1,10}" maxlength="10">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit" id="btnAgg" name="btnAction"
                                                            value="Actualizar" class="btn btn-success p-1"
                                                            data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                                                            title="Actualizar cantidad"><i
                                                                class="fas fa-sync-alt fa-fw"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 text-center">
                                            <div class="row justify-content-center mt-4 mt-md-0">
                                                <form autocomplete="off" class="d-flex FormularioAjax" method="POST"
                                                    data-form="delete" data-lang="es" autocomplete="off"
                                                    action="<?php echo URL; ?>ajax/carritoAjax.php">
                                                    <input type="hidden" name="modulo_carrito" value="eliminar">
                                                    <input type="hidden" name="product_id"
                                                        value="<?php echo mainModel::encryption($producto['product_id']);?>"
                                                        class="form-control text-center" id="product_id" maxlength="10">

                                                    <div class="col-6">
                                                        <span class="poppins-regular font-weight-bold">$
                                                            <?php echo number_format($producto['product_precio_venta'] * $producto['product_cant'],2);?></span>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit" class="btn btn-danger p-1"
                                                            data-mdb-toggle="tooltip" data-mdb-placement="bottom"
                                                            title="Quitar del carrito">
                                                            <span aria-hidden="true"><i
                                                                    class="far fa-trash-alt"></i></span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <?php $subtotal=$subtotal+number_format(($producto['product_precio_venta'])* $producto['product_cant'],2);?>
                            <?php }  ?>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-4">
            <div class="mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center text-uppercase p-2 fw-bold">Resumen
                            del pedido</h5>
                        <hr>
                        <ul class="list-group bag-details">
                            <span
                                class="list-group-item d-flex justify-content-between align-items-center text-uppercase poppins-regular font-weight-bold">
                                Subtotal
                                <span>$ <?php
                            $total=0;
                             echo number_format($subtotal,2); ?></span>
                            </span>
                            <span
                                class="list-group-item d-flex justify-content-between align-items-center text-uppercase poppins-regular font-weight-bold">
                                Envio
                                <span>$
                                    <?php
                            $envio=05.00;
                            echo number_format($envio,2); ?>
                                </span>
                            </span>
                            <span
                                class="list-group-item fw-bold d-flex justify-content-between align-items-center text-uppercase poppins-regular font-weight-bold">
                                Total
                                <span>$ <?php $total=$subtotal+$envio;

                            echo number_format($total,2);?></span>
                            </span>
                        </ul>
                        <div class="d-flex mt-3 justify-content-between">
                            <span class="fw-bold text-decoration-underline">IVA. inc</span>

                            <?php 
                            
                            if (!isset($_SESSION['nombre_cust'])){?>

                            <a type="button" value="login" href="<?php echo URL.'signin/'?>"
                                class="btn btn-primary">Confirmar
                                pedido</a>

                            <?php }else{ ?>
                            <form autocomplete="off" class=" FormularioAjax" method="POST" data-form="save"
                                data-lang="es" autocomplete="off" action="<?php echo URL; ?>ajax/pedidoAjax.php">

                                <input type="hidden" name="modulo_pedido" value="agregar">

                                <?php date_default_timezone_set('America/Guayaquil');
                                $fecha_actual = date('Y-m-d',);  
                                ?>
                                <div><input type="hidden" name="pedido_fecha_reg" value="<?php echo $fecha_actual ?>">
                                </div>
                                <div><input type="hidden" name="pedido_id_reg" value="">
                                </div>
                                <div><input type="hidden" name="pedido_total_reg"
                                        value="<?php echo number_format($total,2);?>">
                                </div>
                                <div><input type="hidden" name="pedido_estado_reg" value="Pendiente"></div>
                                <div><input type="hidden" name="pedido_cliente_reg"
                                        value="<?php echo $_SESSION['id_cust']?>">
                                </div>
                                <div>
                                    <input type="hidden" name="pedido_producto_reg"
                                        value="<?php foreach ($_SESSION['Carrito'] as $indice => $producto){ echo ' '.$producto['product_nombre'].',';}?>">
                                </div><button type=" submit" value="Proceder" class="btn btn-primary">Confirmar
                                    pedido</button>
                            </form>
                            <?php }?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class=" container">
        <p class="text-justify">
            <small>
                En caso de que no se posea el producto en almacén, los datos del mismo
                fueran
                incorrectos o
                existieran cambios o restricciones por parte de la tienda (precio,
                inventario, u
                otras
                condiciones para la venta) <strong><?php echo COMPANY; ?></strong> se
                reserva el
                derecho de
                cancelar el pedido.
            </small>
        </p>
    </div>
    <hr>
</div>
<?php }else{ ?>
<div class="container h-100">
    <div class="row h-100 pt-5">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="alert alert-danger w-50">
                <div class="container">
                    <p class="text-center"><i class="fas fa-shopping-bag fa-5x"></i></p>
                    <h4 class="text-center poppins-regular font-weight-bold">Carrito de compras
                        vacío</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>