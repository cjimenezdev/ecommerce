<?php
    include "./view/security/admin_security.php";
?>

<div class="container-fluid h-100 w-100 mt-5 d-flex flex-column justify-content-center">

    <!-- Modal -->
    <div class="pt-18">
        <nav class="d-flex ms-2">
            <h6 class="mb-2">
                <a href="<?php echo URL.DASHBOARD; ?>/home/" style="color:var(--text-primary);">Home</a>
                <span>/</span>
                <a href="<?php echo URL.DASHBOARD; ?>/order-new/"
                    class="text-primary text-decoration-underline">Pedidos</a>
            </h6>
        </nav>
    </div>
    <!-- Modal -->

    <script>
    $(document).ready(function() {
        $("#txtbuscaUsuario").keyup(function() {
            var parametros = "txtbuscaUsuario=" + $(this).val()
            $.ajax({
                data: parametros,
                url: '../../ajax/buscadorUsuarioAjax.php',
                type: 'post',
                beforeSend: function() {},
                success: function(response) {
                    $(".salida").html(response);
                },
                error: function() {
                    alert("error")
                }
            });
        })
    })
    </script>
    <div class="row pb-4">
        <div class="col-12">
            <div class="p-md-3 pb-0">
                <?php
            require_once "./controller/order/orderController.php";
            $list_user = new pedidoControlador();

            echo $list_user->paginador_pedido_controlador($pagina[2], 5, $pagina[1], "");
            ?>
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