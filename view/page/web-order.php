<div class="container h-100">
    <div class="row h-100 align-items-center pt-5">
        <div class="col-12">
            <?php
            require_once "./controller/order/orderController.php";
            $ins_pedido= new pedidoControlador();
            echo $ins_pedido->pedido_paginador_producto_controlador();
            ?>
            <div class="mt-2">
                <hr>
                <p>En esta sección podrá visualizar todos los pedidos pendientes y así mismo cerrar la compra de cada
                    uno o puede eliminar algún pedido, todo esto asegurando que los datos enviados para un pedido serán
                    actualizados o eliminados, según la desición del cliente.</p>
                <hr>
            </div>
        </div>

    </div>
</div>