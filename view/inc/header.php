<!-- ======= Header ======= -->
<header id="header" class="header fixed-top pb-2 pt-2" style="background:#111;">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="<?php echo URL; ?>" class="logo d-flex align-items-center">
            <img src="<?php echo URL; ?>public/assets/img/logo.png" alt="" />
            <span>WILLIAM'S</span>
        </a>

        <nav id="navbar" class="navbar">
            <?php if(isset($_SESSION['nombre_cust'])){ ?>
            <ul class="overflow-hidden">
                <li><a class="nav-link scrollto active" href="<?php echo URL;?>">Inicio</a></li>
                <li><a class="nav-link scrollto " href="<?php echo URL?>women/all/">Damas</a></li>
                <li><a class="nav-link scrollto " href="<?php echo URL?>men/all/">Caballeros</a></li>
                <li><a class="nav-link scrollto " href="<?php echo URL;?>boy/all/">Niños</a></li>
                <li><a class="nav-link scrollto " href=" <?php echo URL;?>girl/all/">Niñas</a></li>
                <li><a class="nav-link scrollto " href="<?php echo URL?>services/">Servicios</a></li>
                <li><a class="nav-link scrollto " href="<?php echo URL?>contact/">Contactos</a></li>
                <li>
                    <a class="nav-link d-block d-lg-flex scrollto" href="<?php echo URL; ?>bag/">
                        <i class="fa-solid fa-cart-shopping" style="font-size:15px;"></i>
                        <span class="badge bg-primary rounded-pill bag-count text-wrap">
                            <?php if(!isset($_SESSION['nombre_cust'])){
                                $cont =0;
                                printf("%d",$cont);
                            }else{
                                echo (empty($_SESSION['Carrito']))?0:count($_SESSION['Carrito']);
                            }
                            ?>
                            <style>
                            .bag-count {
                                position: absolute;
                                font-size: 10px;
                                top: -12px;
                            }

                            @media(max-width:991.8px) {
                                .bag-count {
                                    position: relative;
                                    right: 0;
                                }
                            }
                            </style>
                        </span>
                    </a>
                </li>
            </ul>
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow ms-lg-1 ps-lg-3">
                    <?php if (is_file("./public/assets/img/customers/avatar/" . $_SESSION['foto_cust'])) { ?>
                    <img class="rounded-circle position-relative" height="30" width="30" alt="" title="user_photo"
                        src="<?php echo URL . "public/assets/img/customers/avatar/" . $_SESSION['foto_cust']; ?>">
                    <?php } else { ?>
                    <img src="<?php echo URL; ?>public/assets/img/customers/avatar/default.jpg"
                        class="rounded-circle position-relative" height="30" width="30">
                    <?php } ?>
                    <span style="top:70%;"
                        class="position-absolute start-100 translate-middle p-1 bg-success border border-light rounded-circle ">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-profile dropdown-menu-end mt-xxl-3 end-0"
                    aria-labelledby="navbarDropdownMenuAvatar">
                    <li>
                        <a class="dropdown-item"
                            href="<?php echo URL."profile/".$ins_login->encryption($_SESSION['id_cust']); ?>/"
                            title="Cuenta"><img src="https://i.postimg.cc/DmgqqfnH/profile.webp" width="14"
                                height="auto" class="img-fluid me-1"> Perfil</a>
                    </li>
                    <?php

                    $cliente= $_SESSION['id_cust'];
                    
                    $consulta="SELECT COUNT(*) as pedidos FROM `pedido` WHERE id_cliente='$cliente'";
                    $conexion = mainModel::conectar();
                    $datos = $conexion->query($consulta);
                    $datos = $datos->fetchAll();?>
                    <li><a class="dropdown-item" href="<?php echo URL;?>order/"><img
                                src="https://i.postimg.cc/Fz31gvBx/order.png" width="14" height="auto"
                                class="img-fluid me-1">Pedidos <strong class="badge badge-primary"><?php foreach($datos as $rows){ echo
                                $rows['pedidos'];}?></strong></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="cerrar_sesion_cliente()"><img
                                src="https://i.postimg.cc/tYqNfZB9/exit.webp" width="14" height="auto"
                                class="img-fluid me-1">
                            Cerrar Sesión</a>

                    </li>
                </ul>
            </div>
            <?php }else{ ?>
            <ul>
                <li><a class="nav-link scrollto" href="<?php echo URL;?>">Inicio</a></li>
                <li><a class="nav-link scrollto" href="#about">¿Quiénes somos?</a></li>
                <li><a class="nav-link scrollto" href="#promotions">Promociones</a></li>
                <li><a class="nav-link scrollto" href="#services">Servicios</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contactos</a></li>
                <li><a class="nav-link scrollto" href="<?php echo URL;?>catalogue/">Catálogo</a></li>
                <li>
                    <a class="nav-link d-block d-lg-flex scrollto" href="<?php echo URL; ?>bag/">
                        <i class="fa-solid fa-cart-shopping" style="font-size:15px;"></i>
                        <span class="badge bg-primary rounded-pill bag-count text-wrap">
                            <?php if(!isset($_SESSION['Carrito'])){
                                $cont =0;
                                printf("%d",$cont);
                            }else{
                                echo (empty($_SESSION['Carrito']))?0:count($_SESSION['Carrito']);
                            }
                            ?>
                            <style>
                            .bag-count {
                                position: absolute;
                                font-size: 10px;
                                top: -12px;
                            }

                            @media(max-width:991.8px) {
                                .bag-count {
                                    position: relative;
                                    right: 0;
                                }
                            }
                            </style>
                        </span>
                    </a>
                </li>
                <li><a class=" getstarted" href="<?php echo URL;?>signin/">Login</a></li>
            </ul>
            <?php } ?>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
    </div>
</header>
<!-- End Header -->