<?php
    include "./view/security/admin_security.php";
?>

<div class="container-fluid h-100 w-100 mt-5">
    <div class="pt-18">
        <nav class="d-flex ms-2">
            <h6 class="mb-2">
                <a href="<?php echo URL.DASHBOARD; ?>/home/" style="color:var(--text-primary);">Home</a>
                <span>/</span>
                <a href="<?php echo URL.DASHBOARD; ?>/product-new/"
                    class="text-primary text-decoration-underline disabled">Productos</a>
                <span>/</span>
                <a href="<?php echo URL.DASHBOARD; ?>/product-list/"
                    class="text-primary text-decoration-underline disabled">Productos-lista</a>
            </h6>
        </nav>
    </div>

    <div class="row pb-4">
        <div class="col-12">
            <div class="p-md-3 pb-4">
                <div class="card">
                    <div class="card-body">
                        <?php
            
            $datos_producto=$ins_login->datos_tabla("Unico","producto","producto_id",$pagina[2]);
            if($datos_producto->rowCount()==1){
                $campos=$datos_producto->fetch();
        ?>
                        <h4 class="font-weight-bold text-center poppins-regular tittle-details">
                            <?php echo $campos['producto_nombre']; ?></h4>
                        <br>
                        <form class="FormularioAjax" method="POST" data-form="update" data-lang="<?php echo LANG; ?>"
                            autocomplete="off" action="<?php echo URL;?>ajax/productoAjax.php">
                            <input type="hidden" name="modulo_producto" value="actualizar">
                            <input type="hidden" name="producto_id_up" value="<?php echo $pagina[2]; ?>">
                            <fieldset class="mb-4">
                                <legend><i class="fas fa-barcode"></i> &nbsp; Código de barras y SKU</legend>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[a-zA-Z0-9- ]{1,49}" class="form-control"
                                                    name="producto_codigo_up"
                                                    value="<?php echo $campos['producto_codigo']; ?>"
                                                    id="producto_codigo" maxlength="49">
                                                <label for="producto_codigo" class="form-label">Código de barras
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[a-zA-Z0-9- ]{1,49}" class="form-control"
                                                    name="producto_sku_up"
                                                    value="<?php echo $campos['producto_sku']; ?>" id="producto_sku"
                                                    maxlength="49">
                                                <label for="producto_sku" class="form-label">SKU</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mb-4">
                                <legend><i class="fas fa-box"></i> &nbsp; Información del producto</legend>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\- ]{1,97}"
                                                    class="form-control" name="producto_nombre_up"
                                                    value="<?php echo $campos['producto_nombre']; ?>"
                                                    id="producto_nombre" maxlength="97">
                                                <label for="producto_nombre" class="form-label">Nombre
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9.]{1,25}" class="form-control"
                                                    name="producto_precio_compra_up"
                                                    value="<?php echo $campos['producto_precio_compra']; ?>"
                                                    id="producto_precio_compra" maxlength="25">
                                                <label for="producto_precio_compra" class="form-label">Precio de compra
                                                    (Con impuesto
                                                    incluido) <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9.]{1,25}" class="form-control"
                                                    name="producto_precio_venta_up"
                                                    value="<?php echo $campos['producto_precio_venta']; ?>"
                                                    id="producto_precio_venta" maxlength="25">
                                                <label for="producto_precio_venta" class="form-label">Precio de venta
                                                    (Con impuesto
                                                    incluido) <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9]{1,9}" class="form-control"
                                                    name="producto_stock_up"
                                                    value="<?php echo $campos['producto_stock']; ?>" id="producto_stock"
                                                    maxlength="9">
                                                <label for="producto_stock" class="form-label">Stock o existencias
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9]{1,9}" class="form-control"
                                                    name="producto_stock_minimo_up"
                                                    value="<?php echo $campos['producto_stock_minimo']; ?>"
                                                    id="producto_stock_minimo" maxlength="9">
                                                <label for="producto_stock_minimo" class="form-label">Stock mínimo
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9]{1,2}" class="form-control"
                                                    name="producto_descuento_up"
                                                    value="<?php echo $campos['producto_descuento']; ?>"
                                                    id="producto_descuento" maxlength="2">
                                                <label for="producto_descuento" class="form-label">Descuento
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,30}"
                                                    class="form-control" name="producto_marca_up"
                                                    value="<?php echo $campos['producto_marca']; ?>" id="producto_marca"
                                                    maxlength="30">
                                                <label for="producto_marca" class="form-label">Fabricante</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,40}"
                                                    class="form-control" name="producto_modelo_up"
                                                    value="<?php echo $campos['producto_modelo']; ?>"
                                                    id="producto_modelo" maxlength="40">
                                                <label for="producto_modelo" class="form-label">Modelo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mb-4">
                                <legend><i class="fas fa-parachute-box"></i> &nbsp; Tipo, Presentación, Categoría &
                                    Estado</legend>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-4">
                                                <label for="producto_tipo" class="form-label">Tipo de producto</label>
                                                <select class="form-control" name="producto_tipo_up" id="producto_tipo">
                                                    <?php
                                        $array_tipo=["Fisico","Digital"];
                                        echo $ins_login->generar_select($array_tipo,$campos['producto_tipo']);
                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-4">
                                                <label for="producto_presentacion" class="form-label">Presentación de
                                                    producto</label>
                                                <select class="form-control" name="producto_presentacion_up"
                                                    id="producto_presentacion">
                                                    <?php
                                        echo $ins_login->generar_select(PRODUTS_UNITS,$campos['producto_presentacion']);
                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-4">
                                                <label for="producto_categoria" class="form-label">Categoría de
                                                    producto</label>
                                                <select class="form-control" name="producto_categoria_up"
                                                    id="producto_categoria">
                                                    <?php
                                        $datos_categoria=$ins_login->datos_tabla("Normal","categoria WHERE categoria_estado='Habilitada'","categoria_id,categoria_nombre,categoria_estado",0);
                                        $cc=1;
                                        $txt_selected='';
                                        $txt_current='';
                                        while($campos_categoria=$datos_categoria->fetch()){

                                            if($campos['categoria_id']==$campos_categoria['categoria_id']){
                                                $txt_selected='selected=""';
                                                $txt_current=' (Actual)'; 
                                            }

                                            echo '<option value="'.$campos_categoria['categoria_id'].'" '.$txt_selected.' >'.$cc.' - '.$campos_categoria['categoria_nombre'].$txt_current.'</option>';

                                            $txt_selected='';
                                            $txt_current='';
                                            $cc++;
                                        }
                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-4">
                                                <label for="producto_estado" class="form-label">Estado de
                                                    producto</label>
                                                <select class="form-control" name="producto_estado_up"
                                                    id="producto_estado">
                                                    <?php
                                        $array_estado=["Habilitado","Deshabilitado"];
                                        echo $ins_login->generar_select($array_estado,$campos['producto_estado']);
                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mb-4">
                                <legend><i class="far fa-comment-dots"></i> &nbsp; Descripción</legend>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-outline mb-4">
                                                <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,520}"
                                                    class="form-control" name="producto_descripcion_up"
                                                    id="producto_descripcion" maxlength="520"
                                                    rows="7"><?php echo $campos['producto_descripcion']; ?></textarea>
                                                <label for="producto_descripcion" class="form-label">Descripción</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <p class="text-center" style="margin-top: 40px;">
                                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> &nbsp;
                                    ACTUALIZAR</button>
                            </p>
                            <p class="text-center">
                                <small>Los campos marcados con <?php echo FIELD_OBLIGATORY; ?> son obligatorios</small>
                            </p>
                        </form>
                        <?php
            }else{ include "./view/inc/error_alert.php";}
        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.card {
    background-color: var(--bg-card) !important;
    border-radius: 30px !important;
}

.navbar {
    position: fixed;
    width: 100%;
    right: 0;
    box-shadow: none !important;
    z-index: 3;
}

.navbar {
    position: fixed !important;
    background-color: var(--bg-light);
    backdrop-filter: blur(10px);
    box-shadow: 0 1px 4px var(--text-third) !important;
    top: 0;
    width: 100%;
    z-index: 2;
}
</style>