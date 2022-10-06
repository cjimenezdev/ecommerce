<?php if(isset($_SESSION['nombre_cust'])){

echo '<script>window.location.href="./home/"</script>;';

}else{?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">
                    Encuentra lo mejor en calzado para todo tipo de evento
                </h1>
                <h2 data-aos="fade-up" data-aos-delay="400">
                    Ven y se parte de nuestra tienda online
                </h2>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                        <a href="#about"
                            class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Empezar</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
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
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row gx-0">
                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <h3>¿Quiénes somos?</h3>
                        <h2>
                            Expedita voluptas omnis cupiditate totam eveniet nobis sint
                            iste. Dolores est repellat corrupti reprehenderit.
                        </h2>
                        <p>
                            Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt
                            et. Inventore et et dolor consequatur itaque ut voluptate sed
                            et. Magnam nam ipsum tenetur suscipit voluptatum nam et est
                            corrupti.
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="<?php echo URL;?>about/"
                                class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>leer más</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center justify-content-center" data-aos="zoom-out"
                    data-aos-delay="200">
                    <img src="<?php echo URL; ?>public/assets/img/products/banner1.png" class="img-fluid" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="bi bi-emoji-smile"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Happy Clients</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="bi bi-journal-richtext" style="color: #ee6c20"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Projects</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="bi bi-headset" style="color: #15be56"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Hours Of Support</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="bi bi-people" style="color: #bb0852"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Hard Workers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Counts Section -->

    <!-- ======= Promotions Section ======= 
    <section id="promotions" class="promotions">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Promociones
                </h2>
                <p>Consulta nuestras promociones
                </p>
            </header>
            <?php /*
            require_once "./controller/promotions/promotionsController.php";
            $ins_promocion = new promocionControlador();

            echo
            $ins_promocion->promocion_paginador_producto_controlador();
            */?>
        </div>
    </section>-->
    <!-- End Promotions Section -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Servicios</h2>
                <p>Si necesita información o ayuda, por favor contáctenos</p>
            </header>

            <div class="row gy-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-box blue">
                        <i class="fa-solid fa-truck icon"></i>
                        <h3>Tiempos y gastos de envió</h3>
                        <p>+ Envío terrestre de cortesía dentro de 1 a 7 días hábiles</p>
                        <p>+ Recogida en tienda disponible en un plazo de 1 a 7 días laborables</p>
                        <p>+ Opciones de entrega Express y al día siguiente también disponibles </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-box orange">
                        <i class="fa-solid fa-money-check-dollar icon"></i>
                        <h3>Métodos de pago</h3>
                        <p>
                            Aceptamos los siguientes métodos de pago:
                        </p>
                        <p>
                            + Tarjeta de crédito: Visa, MasterCard.
                            El total se cargará en su tarjeta cuando se envíe el pedido.
                        </p>
                        <p> + Depósito - Transferencia: compre fácilmente en línea sin tener que ingresar los datos de
                            su
                            tarjeta
                            de
                            crédito en el sitio web.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-box green">
                        <i class="fa-sharp fa-solid fa-box icon"></i>
                        <h3>Cambios, devoluciones y rembolsos</h3>
                        <p>
                            + Los artículos devueltos dentro de los 14 días de su fecha de envío original en las
                            mismas condiciones que los nuevos serán elegibles para un reembolso completo o
                            crédito
                            de la tienda.</p>
                        <p> + Los reembolsos se cargarán a la forma de pago original utilizada para la compra.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Section -->

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

    <!-- ======= Brands Section ======= -->
    <section id="brands" class="brands">
        <div class="container" data-aos="fade-up">
            <div class="brands-slider swiper-container">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide">
                        <img src="./public/assets/img/brands/client-1.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="./public/assets/img/brands/client-2.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="./public/assets/img/brands/client-3.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="./public/assets/img/brands/client-4.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="./public/assets/img/brands/client-5.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="./public/assets/img/brands/client-6.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="./public/assets/img/brands/client-7.png" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="./public/assets/img/brands/client-8.png" class="img-fluid" alt="" />
                    </div>
                </div>
                <div class="swiper-pagination d-none"></div>
            </div>
        </div>
    </section>
    <!-- End Brands Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Contacto</h2>
                <p>Contáctanos</p>
            </header>

            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Dirección</h3>
                                <p>4ta Calle y 5ta Avenida,<br />6-02 Zona 1, Uspatan Quinche</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-telephone"></i>
                                <h3>Llámenos</h3>
                                <p>33094207<br>0000000000</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-envelope"></i>
                                <h3>Correo</h3>
                                <p>Heidy Urizar<br />luxwilmer5@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-clock"></i>
                                <h3>Horario Atención</h3>
                                <p>Lunes - Sabado | Domingo<br />8:00AM - 17:30PM | 7:00AM - 14:00PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <form action="forms/contact.php" method="post" class="php-email-form">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nombre y Apellido"
                                    required />
                            </div>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Correo electrónico"
                                    required />
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Asunto" required />
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Mensaje"
                                    required></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">
                                    Your message has been sent. Thank you!
                                </div>

                                <button type="submit">Enviar Mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
/*---------- Scripts ----------*/
<?php  include "./view/inc/scripts.php"; ?>

<?php } ?>
