<?php

namespace Controllers;

use Model\TipoPago;
use MVC\Router;

class TipoPagoController {
    public static function index(Router $router) {
        session_start();

        isAdmin();

        $tipopago = TipoPago::all();
    }
}