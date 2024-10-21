<?php 

namespace Model;

class Tipo_descuento extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'tipo_descuento';
    protected static $columnasDB = ['id', 'descripcion_descuento'];

    public $id;
    public $descripcion_descuento;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['descripcion_descuento'] ?? '';
    }

    public function validar() {
        if(!$this->descripcion_descuento) {
            self::$alertas['error'][] = 'La Descripcion del Descuento es Obligatorio';
        }

        return self::$alertas;
    }
}