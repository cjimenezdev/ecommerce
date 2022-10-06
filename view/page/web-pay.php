<?php 

$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 
if(isset($link)){
    echo '<style>.navbar ul.overflow-hidden .nav-link{opacity:0;}.navbar ul.overflow-hidden a.nav-link.d-block{opacity:1 !important;}</style>';
 }

?>

<div class="container">
    <?php $subtotal=0; 
    
    if(isset($_SESSION['id_cust'])){?>
    <section id="contact" class="contact">
        <div class="row h-100 pt-5 mt-5">
            <div class="col-lg-12">
                <div class="card bg-transparent p-3">
                    <form action="<?php echo URL;?>ajax/ventaAjax.php" method="POST" class="p-0 p-md-4 FormularioAjax"
                        data-form="save">
                        <input type="hidden" name="modulo_venta" value="agregar">
                        <div class="row d-flex flex-column-reverse flex-md-row">
                            <div class="col-12 col-md-7 col-lg-8 mt-4 mt-md-0">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="p-4 pb-4 pt-3">
                                            <h5 class="text-center text-uppercase fw-bold ">Formulario de pago
                                            </h5>
                                            <hr>
                                        </div>
                                        <div class="row gy-4 p-3">
                                            <div class="col-md-6">
                                                <div class="form-outline bg-white">
                                                    <input type="text" name="name" class="form-control" id="id_user"
                                                        required />
                                                    <label for="id_user" class="form-label">Nombre y
                                                        Apellido</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-outline bg-white">
                                                    <input type="email" class="form-control" name="email"
                                                        id="correo_user" required />
                                                    <label for="correo_user" class="form-label">Correo
                                                        electrónico</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-outline bg-white">
                                                    <input type="text" class="form-control" name="venta_direccion_reg"
                                                        id="direccion_user" required />
                                                    <label for="direccion_user" class="form-label">Dirección</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-outline bg-white">
                                                    <input type="number" class=" form-control" name="dni" id="dni_user"
                                                        required />
                                                    <label for="dni_user" class="form-label">Número de Identidad</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-outline bg-white">
                                                    <input type="phone" class="form-control" name="phone"
                                                        id="celular_user" required />
                                                    <label for="celular_user"
                                                        class="form-label">Teléfono/Celular</label>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <label for="comprobante_user"
                                                    class=" form-file-label">Comprobante</label>
                                                <div class="form-outline bg-white">
                                                    <input type="file" name="venta_comprobante_reg"
                                                        class="form-control form-file-input" id="comprobante_user"
                                                        placeholder=" " required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php 
                        
                        $datos_producto=$ins_login->datos_tabla("Unico","pedido","id_pedido",$pagina[1]);
                        if($datos_producto->rowCount()==1){
                            
                            $campos=$datos_producto->fetch();
                            
                            $total_price=$campos['total']?>

                            <div class="col-12 col-md-5 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-center text-uppercase p-2 fw-bold">Resumen</h5>
                                        <hr>
                                        <ul class="list-group bag-details">
                                            <span
                                                class="list-group-item d-flex justify-content-between align-items-center text-uppercase poppins-regular font-weight-bold">
                                                Subtotal
                                                <span>$
                                                    <?php $total=0;echo number_format($total_price,2); ?>
                                                </span>
                                            </span>
                                            <span
                                                class="list-group-item d-flex justify-content-between align-items-center text-uppercase poppins-regular font-weight-bold">
                                                Iva
                                                <span>$
                                                    <?php $envio=0.12; echo number_format($envio,2); ?>
                                                </span>
                                            </span>
                                            <span
                                                class="list-group-item fw-bold d-flex justify-content-between align-items-center text-uppercase poppins-regular font-weight-bold">
                                                Total
                                                <span>$
                                                    <?php $total=$total_price+$envio;echo number_format($total,2);?>
                                                </span>
                                            </span>
                                        </ul>

                                        <div class="mt-3 justify-content-between">

                                            <div><input type="text" name="venta_codigo_reg" value="WV-002">
                                            </div>

                                            <?php date_default_timezone_set('America/Guayaquil');$fecha_actual = date('Y-m-d',);  ?>
                                            <div><input type="text" name="venta_fecha_reg"
                                                    value="<?php echo $fecha_actual ?>">
                                            </div>
                                            <div><input type="text" name="venta_pedido_reg"
                                                    value="<?php echo $campos['id_pedido']?>">
                                            </div>
                                            <div><input type="text" name="venta_impuesto_reg"
                                                    value="<?php echo number_format($envio,2);?>">
                                            </div>
                                            <div><input type="text" name="venta_total_reg"
                                                    value="<?php echo number_format($total,2);?>">
                                            </div>
                                            <div><input type="text" name="venta_estado_reg" value="Pendiente">
                                            </div>
                                            <div><input type="text" name="venta_envio_reg" value="Por definir">
                                            </div>
                                            <div><input type="text" name="venta_cliente_reg"
                                                    value="<?php echo $_SESSION['id_cust']?>"></div>
                                            <div><input type="text" name="venta_empresa_reg" value="1"></div>
                                            <?php } ?>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-center">
                                            <button type="submit" class="btn bg-success text-white"><i
                                                    class="fa-solid fa-dollar-sign"></i>
                                                Pagar Ahora</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
</div>