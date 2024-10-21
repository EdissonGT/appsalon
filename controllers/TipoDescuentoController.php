<?php

namespace Controllers;

use Model\Tipo_descuento;
use MVC\Router;

class TipoDescuentoController {
    public static function index(Router $router) {
        session_start();

        isAdmin();

        $tipo_descuentos = Tipo_descuento::all();

        $router->render('tipo_descuentos/index', [
            'nombre' => $_SESSION['nombre'],
            'tipo_descuentos' => $tipo_descuentos
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAdmin();
        $tipo_descuento = new Tipo_descuento;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo_descuento->sincronizar($_POST);
            
            $alertas = $tipo_descuento->validar();

            if(empty($alertas)) {
                $tipo_descuento->guardar();
                header('Location: /tipo_descuentos');
            }
        }

        $router->render('tipo_descuentos/crear', [
            'nombre' => $_SESSION['nombre'],
            'tipo_descuento' => $tipo_descuento,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAdmin();

        if(!is_numeric($_GET['id'])) return;

        $tipo_descuento = Tipo_descuento::find($_GET['id']);
        $alertas = [];

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo_descuento->sincronizar($_POST);

            $alertas = $tipo_descuento->validar();

            if(empty($alertas)) {
                $tipo_descuento->guardar();
                header('Location: /tipo_descuentos');
            }
        }

        $router->render('tipo_descuentos/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'tipo_descuento' => $tipo_descuento,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        session_start();
        isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $tipo_descuento = Tipo_descuento::find($id);
            $tipo_descuento->eliminar();
            header('Location: /tipo_descuents');
        }
    }
}