<?php 

namespace Model;

class TipoPago extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'tipopago';
    protected static $columnasDB = ['id', 'nombre_tipopago'];

    public $id;
    public $nombre_tipopago;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_tipopago = $args['nombre_tipopago'] ?? '';

    }
}