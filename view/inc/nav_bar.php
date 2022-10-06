<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid m-xxl-3">
        <button class="navbar-toggler" type="button"><i class="fas fa-bars"></i></button>
        <div class="d-flex align-items-center ms-auto me-3">
            <div class="profile ms-2">
                <p class="mb-0"><?php echo $_SESSION['nombre_sto'];?></p>
                <span class="ms-auto "><?php echo $_SESSION['cargo_sto'];?></span>
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow ps-2" href="#"
                    id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <?php if (is_file("./public/assets/img/users/avatar/" . $_SESSION['foto_sto'])) { ?>
                    <img class="rounded-circle" height="40" width="40" alt="" title="user_photo"
                        src="<?php echo URL . "public/assets/img/users/avatar/" . $_SESSION['foto_sto']; ?>">
                    <?php } else { ?>
                    <img src="<?php echo URL; ?>public/assets/img/users/avatar/default.jpg" class="rounded-circle"
                        height="30" width="30">
                    <?php } ?>
                </a>
                <ul class="dropdown-menu dropdown-profile dropdown-menu-end mt-xxl-3"
                    aria-labelledby="navbarDropdownMenuAvatar" style="right:2%;">
                    <li>
                        <a class="dropdown-item"
                            href="<?php echo URL.DASHBOARD."/admin-profile/".$ins_login->encryption($_SESSION['id_sto']); ?>/"
                            title="Cuenta"><img src="https://i.postimg.cc/DmgqqfnH/profile.webp" width="14"
                                height="auto" class="img-fluid me-1"> Perfil</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="cerrar_sesion_administrador()"><img
                                src="https://i.postimg.cc/tYqNfZB9/exit.webp" width="14" height="auto"
                                class="img-fluid me-1"> Cerrar Sesión</a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>