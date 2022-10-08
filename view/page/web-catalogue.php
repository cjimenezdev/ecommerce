<div class="container-fluid pt-5">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Catálogo</h2>
                <p>Lo más destacado en nuestro catálogo</p>
            </header>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="gallery-flters" class="p-0">
                        <li data-filter="*" class="filter-active mb-0 ms-0">Todo</li>
                        <li data-filter=".Caballero" class="mb-0">Caballeros</li>
                        <li data-filter=".Dama" class="mb-0">Damas</li>
                        <li data-filter=".Niños" class="mb-0">Niños</li>
                    </ul>
                </div>
            </div>
            <?php 
            
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM catalogo WHERE id_catalogo!='1' ORDER BY fecha_catalogo";

            $conexion = mainModel::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();?>

            <div class="row gy-4 gallery-container" data-aos="fade-up" data-aos-delay="200">
                <?php foreach($datos as $rows){?>
                <div class="col-lg-4 col-md-6 gallery-item <?php echo $rows['identificador']?>">
                    <div class="gallery-wrap">
                        <img src="<?php echo URL; ?>public/assets/img/catalogue/<?php echo $rows['foto_catalogo'] ?>"
                            style="height:450px; width:100%;" class="img-fluid" alt="" />
                        <div class="gallery-info">
                            <h4><?php echo $rows['identificador'] ?></h4>
                            <p><?php echo $rows['detalle_catalogo'] ?></p>
                            <div class="gallery-links">
                                <a href="<?php echo URL; ?>public/assets/img/catalogue/<?php echo $rows['foto_catalogo'] ?>"
                                    data-gallery="galleryGallery" class="gallery-lightbox" title="App 1"><i
                                        class="bi bi-plus"></i></a>
                                <a href="gallery-details.html" title="More Details"><i class="bi bi-info"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- End Gallery Section -->
</div>