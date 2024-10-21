<?php

namespace Model;

class AdminCita extends ActiveRecord {
    protected static $tabla = 'citasServicios';
    protected static $columnasDB = ['id', 'hora','fecha', 'cliente', 'email', 'telefono', 'servicio', 'precio', 'nombrePro', 'precioPro', 'descripcion_promocion', 'precio_promocion'];

    public $id;
    public $hora;
    public $fecha;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;
    public $nombrePro;
    public $precioPro;
    public $descripcion_promocion;
    public $precio_promocion;

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->nombrePro = $args['nombrePro'] ?? '';
        $this->precioPro = $args['precioPro'] ?? '';
        $this->descripcion_promocion = $args['descripcion_promocion'] ?? '';
        $this->precio_promocion = $args['precio_promocion'] ?? '';
    }
}