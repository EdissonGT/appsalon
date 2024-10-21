<?php

namespace Controllers;

use MVC\Router;
use Model\TipoPago;  // Importación del modelo

class CitaController {
    public static function index( Router $router ) {

        session_start();

        isAuth();

        // Obtener los Metodos de Pago
        $tipopagos = TipoPago::all();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'tipopagos' => $tipopagos
        ]);
    }
}