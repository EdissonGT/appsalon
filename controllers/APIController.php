<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;
use Model\Producto;
use Model\Promocion;

class APIController {

    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
        
    }

    public static function indexPro() {
        $productos = Producto::all();
        echo json_encode($productos);
    }

    public static function indexPromo() {
        $promociones = Promocion::all();
        echo json_encode($promociones);
    }

    public static function guardar() {
        // Almacena la Cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado['id'];

        // Agregar tipoPagoId en la cita
        if (isset($_POST['tipoPagoId'])) {
            $cita->tipoPagoId = $_POST['tipoPagoId'];
            $cita->guardar();
        }

    
        // Almacena los Servicios con el ID de la Cita, si existen
        if (isset($_POST['servicios']) && !empty($_POST['servicios'])) {
            foreach ($_POST['servicios'] as $idServicio) {
                if (!empty($idServicio)) { // Solo guarda si el idServicio no está vacío
                    $args = [
                        'citaId' => $id,
                        'servicioId' => $idServicio,
                        'productoId' => null,  // Deja productoId como nulo para servicios
                        'promocionId' => null  // Deja productoId como nulo para servicios
                    ];
                    $citaServicio = new CitaServicio($args);
                    $citaServicio->guardar();
                }
            }
        }
    
        // Almacena los Productos con el ID de la Cita, si existen
        if (isset($_POST['productos']) && !empty($_POST['productos'])) {
            foreach ($_POST['productos'] as $idProducto) {
                if (!empty($idProducto)) { // Solo guarda si el idProducto no está vacío
                    $args = [
                        'citaId' => $id,
                        'servicioId' => null, // Deja servicioId como nulo para productos
                        'productoId' => $idProducto,
                        'promocionId' => null
                    ];
                    $citaProducto = new CitaServicio($args);
                    $citaProducto->guardar();
                }
            }
        }

        // Almacena las promociones con el ID de la Cita, si existen
        if (isset($_POST['promociones']) && !empty($_POST['promociones'])) {
            foreach ($_POST['promociones'] as $idPromocion) {
                if (!empty($idPromocion)) { // Solo guarda si el idPromocion no está vacío
                    $args = [
                        'citaId' => $id,
                        'servicioId' => null, // Deja servicioId como nulo para promociones
                        'productoId' => null,
                        'promocionId' => $idPromocion,  // Asegúrate de que este campo sea correcto
                    ];
                    $citaPromocion = new CitaServicio($args);
                    $citaPromocion->guardar();
                }
            }
        }


    
        // Enviar respuesta en formato JSON
        echo json_encode(['resultado' => $resultado]);
    }
    
    
    
    
    

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}