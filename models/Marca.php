<?php 

namespace Model;

class Marca extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'marca';
    protected static $columnasDB = ['id', 'nombre_marca', 'imagen_marca', 'url_marca'];

    public $id;
    public $nombre_marca;
    public $imagen_marca;
    public $url_marca;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_marca = $args['nombre_marca'] ?? '';
        $this->imagen_marca = $args['imagen_marca'] ?? '';
        $this->url_marca = $args['url_marca'] ?? '';
    }

    public function validar() {
        if(!$this->nombre_marca) {
            self::$alertas['error'][] = 'El Nombre de la Marca es Obligatorio';
        }
        if(!$this->url_marca) {
            self::$alertas['error'][] = 'La Pagina de la Marca es Obligatorio';
        }

        return self::$alertas;
    }
}