<?php
	require_once "./config/app.php";
	require_once "./controller/config/viewsController.php";

	$plantilla = new vistasControlador();
	$plantilla->obtener_plantilla_controlador();