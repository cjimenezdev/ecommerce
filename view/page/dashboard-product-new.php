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
                        <form class="dashboard-container FormularioAjax" method="POST" data-form="save"
                            data-lang="<?php echo LANG; ?>" autocomplete="off"
                            action="<?php echo URL;?>ajax/productoAjax.php" enctype="multipart/form-data">
                            <input type="hidden" name="modulo_producto" value="registro">
                            <fieldset class="mb-4">
                                <legend><i class="fas fa-barcode"></i> &nbsp; Código de barras y SKU</legend>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[a-zA-Z0-9- ]{1,49}" class="form-control"
                                                    name="producto_codigo_reg" id="producto_codigo" maxlength="49">
                                                <label for="producto_codigo" class="form-label">Código de barras
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[a-zA-Z0-9- ]{1,49}" class="form-control"
                                                    name="producto_sku_reg" id="producto_sku" maxlength="49">
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
                                                    class="form-control" name="producto_nombre_reg" id="producto_nombre"
                                                    maxlength="97">
                                                <label for="producto_nombre" class="form-label">Nombre
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9.]{1,25}" class="form-control"
                                                    name="producto_precio_compra_reg" id="producto_precio_compra"
                                                    maxlength="25">
                                                <label for="producto_precio_compra" class="form-label">Precio de compra
                                                    (Con impuesto
                                                    incluido) <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9.]{1,25}" class="form-control"
                                                    name="producto_precio_venta_reg" id="producto_precio_venta"
                                                    maxlength="25">
                                                <label for="producto_precio_venta" class="form-label">Precio de venta
                                                    (Con impuesto
                                                    incluido) <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9]{1,9}" class="form-control"
                                                    name="producto_stock_reg" id="producto_stock" maxlength="9">
                                                <label for="producto_stock" class="form-label">Stock o existencias
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9]{1,9}" class="form-control"
                                                    name="producto_stock_minimo_reg" id="producto_stock_minimo"
                                                    maxlength="9">
                                                <label for="producto_stock_minimo" class="form-label">Stock mínimo
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[0-9]{1,2}" class="form-control"
                                                    name="producto_descuento_reg" value="0" id="producto_descuento"
                                                    maxlength="2">
                                                <label for="producto_descuento" class="form-label">Descuento
                                                    <?php echo FIELD_OBLIGATORY; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,30}"
                                                    class="form-control" name="producto_marca_reg" id="producto_marca"
                                                    maxlength="30">
                                                <label for="producto_marca" class="form-label">Fabricante</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-outline mb-4">
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,40}"
                                                    class="form-control" name="producto_modelo_reg" id="producto_modelo"
                                                    maxlength="40">
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
                                                <select class="form-control" name="producto_tipo_reg"
                                                    id="producto_tipo">
                                                    <option value="" selected="">** Tipo de producto **</option>
                                                    <option value="Fisico">Fisico</option>
                                                    <option value="Digital">Digital</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="mb-4">
                                                <label for="producto_presentacion" class="form-label">Presentación de
                                                    producto</label>
                                                <select class="form-control" name="producto_presentacion_reg"
                                                    id="producto_presentacion">
                                                    <option value="" selected="">** Presentación de producto **</option>
                                                    <?php
                                    echo $ins_login->generar_select(PRODUTS_UNITS,"");
                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-4">
                                                <label for="producto_categoria" class="form-label">Categoría de
                                                    producto</label>
                                                <select class="form-control" name="producto_categoria_reg"
                                                    id="producto_categoria">
                                                    <option value="" selected="">** Categoría de producto **</option>
                                                    <?php
                                    $datos_categoria=$ins_login->datos_tabla("Normal","categoria WHERE categoria_estado='Habilitada'","categoria_id,categoria_nombre,categoria_estado",0);
                                    $cc=1;
                                    while($campos_categoria=$datos_categoria->fetch()){
                                        echo '<option value="'.$campos_categoria['categoria_id'].'">'.$cc.' - '.$campos_categoria['categoria_nombre'].'</option>';
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
                                                <select class="form-control" name="producto_estado_reg"
                                                    id="producto_estado">
                                                    <option value="" selected="">** Estado de producto **</option>
                                                    <option value="Habilitado">Habilitado</option>
                                                    <option value="Deshabilitado">Deshabilitado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Producto-Género
                                                </label>
                                                <div class="p-2">
                                                    <div class="form-check form-check-inline mb-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="producto_genero_reg" value="Masculino"
                                                            id="producto_genero" checked />
                                                        <label class="form-check-label"
                                                            for="producto_genero">Masculino</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="producto_genero_reg" value="Femenino"
                                                            id="producto_genero" />
                                                        <label class="form-check-label"
                                                            for="producto_genero">Femenino</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-4">
                                                <label>
                                                    Producto-Tipo-Persona
                                                </label>
                                                <div class="p-2">
                                                    <div class="form-check form-check-inline mb-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="producto_tipo_persona_reg" value="Dama"
                                                            id="producto_tipo_persona_dama" checked />
                                                        <label class="form-check-label"
                                                            for="producto_tipo_persona_dama">Dama</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="producto_tipo_persona_reg" value="Caballero"
                                                            id="producto_tipo_persona_caballero" />
                                                        <label class="form-check-label"
                                                            for="producto_tipo_persona_caballero">Caballero</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="producto_tipo_persona_reg" value="Niña"
                                                            id="producto_tipo_persona_niña" />
                                                        <label class="form-check-label"
                                                            for="producto_tipo_persona_niña">Niña</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="producto_tipo_persona_reg" value="Niño"
                                                            id="producto_tipo_persona_niño" />
                                                        <label class="form-check-label"
                                                            for="producto_tipo_persona_niño">Niño</label>
                                                    </div>
                                                </div>
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
                                                    class="form-control" name="producto_descripcion_reg"
                                                    id="producto_descripcion" maxlength="520" rows="7"></textarea>
                                                <label for="producto_descripcion" class="form-label">Descripción</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mb-4">
                                <legend><i class="far fa-file-image"></i> &nbsp; Foto o portada de producto</legend>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <label for="producto_portada" class="form-label">Tipos de archivos
                                                permitidos: JPG, JPEG,
                                                PNG.
                                                Tamaño máximo <?php echo COVER_PRODUCT; ?>MB. Resolución recomendada
                                                500px X 500px o
                                                superior manteniendo el aspecto cuadrado (1:1)</label>
                                            <input class="form-control form-control-sm" id="producto_portada"
                                                name="producto_portada" type="file" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <p class="text-center" style="margin-top: 40px;">
                                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> &nbsp;
                                    GUARDAR</button>
                            </p>
                            <p class="text-center">
                                <small>Los campos marcados con <?php echo FIELD_OBLIGATORY; ?> son obligatorios</small>
                            </p>
                        </form>
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