<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServicioController;
use Controllers\MarcaController;
use Controllers\TipoDescuentoController;
use Controllers\PromocionController;
use Controllers\ProductoController;
use MVC\Router;
$router = new Router();

// Iniciar Sesión
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// AREA PRIVADA
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

// API de Citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->get('/api/productos', [APIController::class, 'indexPro']);
$router->get('/api/promociones', [APIController::class, 'indexPromo']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

// CRUD de Servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

// CRUD de Servicios
$router->get('/marcas', [MarcaController::class, 'index']);
$router->get('/marcas/crear', [MarcaController::class, 'crear']);
$router->post('/marcas/crear', [MarcaController::class, 'crear']);
$router->get('/marcas/actualizar', [MarcaController::class, 'actualizar']);
$router->post('/marcas/actualizar', [MarcaController::class, 'actualizar']);
$router->post('/marcas/eliminar', [MarcaController::class, 'eliminar']);

// CRUD de Servicios
$router->get('/tipo_descuentos', [TipoDescuentoController::class, 'index']);
$router->get('/tipo_descuentos/crear', [TipoDescuentoController::class, 'crear']);
$router->post('/tipo_descuentos/crear', [TipoDescuentoController::class, 'crear']);
$router->get('/tipo_descuentos/actualizar', [TipoDescuentoController::class, 'actualizar']);
$router->post('/tipo_descuentos/actualizar', [TipoDescuentoController::class, 'actualizar']);
$router->post('/tipo_descuentos/eliminar', [TipoDescuentoController::class, 'eliminar']);

// CRUD de Servicios
$router->get('/promociones', [PromocionController::class, 'index']);
$router->get('/promociones/crear', [PromocionController::class, 'crear']);
$router->post('/promociones/crear', [PromocionController::class, 'crear']);
$router->get('/promociones/actualizar', [PromocionController::class, 'actualizar']);
$router->post('/promociones/actualizar', [PromocionController::class, 'actualizar']);
$router->post('/promociones/eliminar', [PromocionController::class, 'eliminar']);

// CRUD de Servicios
$router->get('/productos', [ProductoController::class, 'index']);
$router->get('/productos/crear', [ProductoController::class, 'crear']);
$router->post('/productos/crear', [ProductoController::class, 'crear']);
$router->get('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/eliminar', [ProductoController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();