<?php

namespace Controllers;

use Model\Promocion;
use Model\Tipo_descuento;  // Importación del modelo
use Model\Producto;  // Importación del modelo
use Model\Servicio;  // Importación del modelo
use MVC\Router;

class PromocionController {
    public static function index(Router $router) {
        session_start();
        isAdmin();

        $promociones = Promocion::all();

        $router->render('promociones/index', [
            'nombre' => $_SESSION['nombre'],
            'promociones' => $promociones
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAdmin();
        $promocion = new Promocion;
        $alertas = [];

        // Obtener los tipos de descuentos
        $tiposDescuentos = Tipo_descuento::all();
        $Productos = Producto::all();
        $Servicios = Servicio::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $promocion->sincronizar($_POST);

            $alertas = $promocion->validar();

            if (empty($alertas)) {
                $promocion->guardar();
                header('Location: /promociones');
            }
        }

        $router->render('promociones/crear', [
            'nombre' => $_SESSION['nombre'],
            'promocion' => $promocion,
            'tiposDescuentos' => $tiposDescuentos,
            'productos' => $Productos,
            'servicios' => $Servicios,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAdmin();

        if (!is_numeric($_GET['id'])) return;

        $promocion = Promocion::find($_GET['id']);
        $alertas = [];

        // Obtener los tipos de descuentos
        $tiposDescuentos = Tipo_descuento::all();
        $Productos = Producto::all();
        $Servicios = Servicio::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $promocion->sincronizar($_POST);

            $alertas = $promocion->validar();

            if (empty($alertas)) {
                $promocion->guardar();
                header('Location: /promociones');
            }
        }

        $router->render('promociones/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'promocion' => $promocion,
            'tiposDescuentos' => $tiposDescuentos,
            'productos' => $Productos,
            'servicios' => $Servicios,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        session_start();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $promocion = Promocion::find($id);
            $promocion->eliminar();
            header('Location: /promociones');
        }
    }
}
