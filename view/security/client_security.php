<?php 
    if($_SESSION['id_cust']!=""){
        $ins_login->cierre_cliente_sesion_controlador();
        exit();
    }