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

            <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Proin iaculis purus consequat sem cure digni ssim donec
                                porttitora entum suscipit rhoncus. Accusantium quam,
                                ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                risus at semper.
                            </p>
                            <div class="profile mt-auto">
                                <img src="<?php echo URL; ?>public/assets/img/testimonials/testimonials-1.jpg"
                                    class="testimonial-img" alt="" />
                                <h3>Saul Goodman</h3>
                                <h4>Ceo &amp; Founder</h4>
                            </div>
                        </div>
                    </div>
                    <!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Export tempor illum tamen malis malis eram quae irure esse
                                labore quem cillum quid cillum eram malis quorum velit fore
                                eram velit sunt aliqua noster fugiat irure amet legam anim
                                culpa.
                            </p>
                            <div class="profile mt-auto">
                                <img src="<?php echo URL; ?>public/assets/img/testimonials/testimonials-2.jpg"
                                    class="testimonial-img" alt="" />
                                <h3>Sara Wilsson</h3>
                                <h4>Designer</h4>
                            </div>
                        </div>
                    </div>
                    <!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Enim nisi quem export duis labore cillum quae magna enim
                                sint quorum nulla quem veniam duis minim tempor labore quem
                                eram duis noster aute amet eram fore quis sint minim.
                            </p>
                            <div class="profile mt-auto">
                                <img src="<?php echo URL; ?>public/assets/img/testimonials/testimonials-3.jpg"
                                    class="testimonial-img" alt="" />
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                            </div>
                        </div>
                    </div>
                    <!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Fugiat enim eram quae cillum dolore dolor amet nulla culpa
                                multos export minim fugiat minim velit minim dolor enim duis
                                veniam ipsum anim magna sunt elit fore quem dolore labore
                                illum veniam.
                            </p>
                            <div class="profile mt-auto">
                                <img src="<?php echo URL; ?>public/assets/img/testimonials/testimonials-4.jpg"
                                    class="testimonial-img" alt="" />
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                            </div>
                        </div>
                    </div>
                    <!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Quis quorum aliqua sint quem legam fore sunt eram irure
                                aliqua veniam tempor noster veniam enim culpa labore duis
                                sunt culpa nulla illum cillum fugiat legam esse veniam culpa
                                fore nisi cillum quid.
                            </p>
                            <div class="profile mt-auto">
                                <img src="<?php echo URL; ?>public/assets/img/testimonials/testimonials-5.jpg"
                                    class="testimonial-img" alt="" />
                                <h3>John Larson</h3>
                                <h4>Entrepreneur</h4>
                            </div>
                        </div>
                    </div>
                    <!-- End testimonial item -->
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
                            <form action="">
                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-outline mb-3">
                                            <input class="form-control" name="user_comment" id="user_comment" disabled
                                                value="<?php echo $_SESSION['nombre_cust'].' '. $_SESSION['apellido_cust']?>">
                                            <label class="form-label" for="user_comment">Nombre usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-outline mb-3">
                                            <input class="form-control" name="user_comment" id="user_comment" disabled
                                                value="<?php echo $_SESSION['correo_cust']?>">
                                            <label class="form-label" for="user_comment">Correo
                                                electrónico</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline mb-3">
                                    <textarea class="form-control" name="comment" id="comment" cols="5"
                                        rows="5"></textarea>
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