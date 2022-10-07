<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">
                    Encuentra lo mejor en calzado para todo tipo de evento
                </h1>
                <h2 data-aos="fade-up" data-aos-delay="400">
                    Damas, Caballeros, niños y niñas.
                </h2>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="<?php echo URL; ?>public/assets/img/bg/hero/hero.png" class="img-fluid" alt="" />
            </div>
        </div>
    </div>
</section>
<!-- End Hero -->
<style>
@media (min-width:991.8px) {
    main {
        overflow-y: hidden !important;
    }
}
</style>
<main id="main">
    <!-- ======= Brands Section ======= -->
    <section id="brands" class="brands">
        <div class="container" data-aos="fade-up">
            <div class="brands-slider swiper-container">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide">
                        <img src="<?php echo URL; ?>public/assets/img/brands/client-1.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo URL; ?>public/assets/img/brands/client-2.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo URL; ?>public/assets/img/brands/client-3.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo URL; ?>public/assets/img/brands/client-4.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo URL; ?>public/assets/img/brands/client-5.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo URL; ?>public/assets/img/brands/client-6.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo URL; ?>public/assets/img/brands/client-7.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo URL; ?>public/assets/img/brands/client-8.png" class="img-fluid" alt="" />
                    </div>
                </div>
                <div class="swiper-pagination d-none"></div>
            </div>
        </div>
    </section>
    <!-- End Brands Section -->
    <!-- ======= Promotions Section ======= -->
    <section id="promotions" class="promotions">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Promociones
                </h2>
                <p>Consulta nuestras promociones
                </p>
            </header>
            <?php
            require_once "./controller/promotions/promotionsController.php";
            $ins_promocion = new promocionControlador();

            echo
            $ins_promocion->promocion_paginador_producto_controlador();
            ?>
        </div>
    </section>
    <!-- End Promotions Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>testimonios</h2>
                <p>¿Qué dicen de nosotros?</p>
            </header>
            <?php 
            $campos="com.id_comentarios, com.detalle_comentario, com.fecha_comentario, cl.cliente_nombre,
            cl.cliente_apellido, cl.cliente_foto";
            $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM comentario_empresa as com INNER JOIN cliente as cl ON
            com.id_cliente = cl.cliente_id";
            $conexion = mainModel::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();?>

            <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper">
                    <?php foreach($datos as $rows){?>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <?php echo $rows['detalle_comentario']?>
                            </p>
                            <div class="profile mt-auto">
                                <img src="<?php echo URL;?>public/assets/img/customers/avatar/<?php echo $rows['cliente_foto']?>"
                                    class=" testimonial-img" alt="" />
                                <h3><?php echo $rows['cliente_nombre'].' '.$rows['cliente_apellido'] ?></h3>
                                <h4><?php echo $rows['fecha_comentario']?></h4>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
    <!-- End Testimonials Section -->
    <!-- ======= Comments Users ======= -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="poppins-regular text-uppercase text-center">Califícanos</h5>
                    <h4 class="poppins-regular fw-bolder text-center">¿De cuánta utilidad te ha parecido este
                        contenido?</h4>
                    <div class="p-5 text-center">
                        <button class="p-0 border-0 bg-transparent"><i class="bi-star h4 text-black-50"></i></button>
                        <button class="p-0 border-0 bg-transparent"><i class="bi-star h4 text-black-50"></i></button>
                        <button class="p-0 border-0 bg-transparent"><i class="bi-star h4 text-black-50"></i></button>
                        <button class="p-0 border-0 bg-transparent"><i class="bi-star h4 text-black-50"></i></button>
                        <button class="p-0 border-0 bg-transparent"><i class="bi-star h4 text-black-50"></i></button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo URL; ?>ajax/comentarioAjax.php" class="FormularioAjax"
                                method="POST" data-form="save" data-lang="es">
                                <input type="hidden" name="modulo_comentario" value="comentario">
                                <div class="row">
                                    <div>
                                        <input type="hidden" name="">
                                    </div>
                                    <?php date_default_timezone_set('America/Guayaquil');$fecha_actual = date('Y-m-d',); ?>
                                    <div><input type="hidden" name="comment_fecha" value="<?php echo $fecha_actual ?>">
                                        <input type="hidden" name="user_comment"
                                            value="<?php echo $_SESSION['id_cust']?>">
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-outline mb-3">
                                            <input class="form-control" name="user_comment" id="user_comment" disabled
                                                value="<?php echo $_SESSION['nombre_cust'].' '. $_SESSION['apellido_cust']?>">
                                            <label class="form-label" for="user_comment">Nombre usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-outline mb-3">
                                            <input class="form-control" name="user_comment_email"
                                                id="user_comment_email" disabled
                                                value="<?php echo $_SESSION['correo_cust']?>">
                                            <label class="form-label" for="user_comment">Correo
                                                electrónico</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline mb-3">
                                    <textarea class="form-control" name="comment" id="comment" cols="5" rows="5"
                                        required></textarea>
                                    <label class="form-label" for="comment">Comentario</label>
                                </div>
                                <button class="btn btn-success">Enviar comentario</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <h5 class="poppins-regular text-uppercase" style="padding-top: 70px;">
                        Comentarios</h5>
                    <hr>
                </div>
            </div>
        </div>

    </section>
</main>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>