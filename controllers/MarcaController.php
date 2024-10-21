<?php

namespace Controllers;

use Model\Marca;
use MVC\Router;

class MarcaController {
    public static function index(Router $router) {
        session_start();

        isAdmin();

        $marcas = Marca::all();

        $router->render('marcas/index', [
            'nombre' => $_SESSION['nombre'],
            'marcas' => $marcas
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAdmin();
        $marca = new Marca;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca->sincronizar($_POST);
            
            $alertas = $marca->validar();

            if(empty($alertas)) {
                $marca->guardar();
                header('Location: /marcas');
            }
        }

        $router->render('marcas/crear', [
            'nombre' => $_SESSION['nombre'],
            'marca' => $marca,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAdmin();

        if(!is_numeric($_GET['id'])) return;

        $marca = Marca::find($_GET['id']);
        $alertas = [];

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca->sincronizar($_POST);

            $alertas = $marca->validar();

            if(empty($alertas)) {
                $marca->guardar();
                header('Location: /marcas');
            }
        }

        $router->render('marcas/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'marca' => $marca,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        session_start();
        isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $marca = Marca::find($id);
            $marca->eliminar();
            header('Location: /marcas');
        }
    }
}