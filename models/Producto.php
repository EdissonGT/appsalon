<?php 

namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = 'producto';
    protected static $columnasDB = ['id', 'name_producto', 'id_marca_producto', 'id_promocion_producto', 'precio_producto', 'descripcion_producto', 'fecha_creacion_producto','stock_producto'];

    public $id;
    public $name_producto;
    public $id_marca_producto;
    public $id_promocion_producto;
    public $precio_producto;
    public $descripcion_producto;
    public $fecha_creacion_producto;
    //public $fecha_modificado_producto;
    public $stock_producto;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name_producto = $args['name_producto'] ?? '';
        $this->id_marca_producto = $args['id_marca_producto'] ?? '';
        $this->id_promocion_producto = $args['id_promocion_producto'] ?? '';
        $this->precio_producto = $args['precio_producto'] ?? '';
        $this->descripcion_producto = $args['descripcion_producto'] ?? '';
        $this->fecha_creacion_producto = $args['fecha_creacion_producto'] ?? '';
        //$this->fecha_modificado_producto = $args['fecha_modificado_producto'] ?? '';
        $this->stock_producto = $args['stock_producto'] ?? '';
    }

    public function validar() {
        self::$alertas = [];

        if (!$this->name_producto) {
            self::$alertas['error'][] = 'El nombre del producto es obligatorio';
        }
        if (!$this->id_marca_producto) {
            self::$alertas['error'][] = 'La marca del producto es obligatoria';
        }
        if (!$this->precio_producto) {
            self::$alertas['error'][] = 'El precio del producto es obligatorio';
        }
        if (!$this->stock_producto) {
            self::$alertas['error'][] = 'El stock del producto es obligatorio';
        }

        return self::$alertas;
    }
}
