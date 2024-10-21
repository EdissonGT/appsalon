<?php 

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index( Router $router ) {
        session_start();

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        if( !checkdate( $fechas[1], $fechas[2], $fechas[0]) ) {
            header('Location: /404');
        }

        // Consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, citas.fecha,  CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, promocion.descripcion_promocion, promocion.precio_promocion,";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio, producto.name_producto AS nombrePro, producto.precio_producto AS precioPro ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " LEFT OUTER JOIN producto ";
        $consulta .= " ON producto.id = citasServicios.productoId ";
        $consulta .= " LEFT OUTER JOIN promocion ";
        $consulta .= " ON promocion.id = citasServicios.promocionId ";
        $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas = AdminCita::SQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas, 
            'fecha' => $fecha
        ]);
    }
}