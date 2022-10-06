<script>
function cerrar_sesion_cliente() {
    /*let titulo_alerta;
    let btn_confirm_alerta;
    let btn_cancel_alerta;
    let texto_alerta;
    let lang = "<?php echo LANG; ?>";


    texto_alerta = "Cerrando Sesión";

    Swal.fire({
        text: texto_alerta,
        icon: 'question',
        showCancelButton: false,
        showDenyButton: false,
        showConfirmButton: false,
        timer: 1300
    }).then((result) => {*/

    let datos = new FormData();
    datos.append("token", "<?php echo $ins_login->encryption($_SESSION['token_cust']); ?>");
    datos.append("nombre", "<?php echo $ins_login->encryption($_SESSION['nombre_cust']); ?>");
    datos.append("modulo_login", "logout_cliente");

    fetch("<?php echo URL; ?>ajax/loginAjax.php", {
        method: 'POST',
        body: datos
    }).then(respuesta => respuesta.json()).then(respuesta => {
        return alertas_ajax(respuesta);
    });
    /*});*/
}
</script>