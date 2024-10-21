<h1 class="nombre-pagina">Promociones</h1>
<p class="descripcion-pagina">Administración de Promociones</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
    use Model\Tipo_descuento;  // Asegúrate de importar el modelo aquí
    use Model\Servicio;  // Asegúrate de importar el modelo aquí
    use Model\Producto;  // Asegúrate de importar el modelo aquí
?>

<div class="row">
    <?php foreach($promociones as $promocion) { 
        // Obtener el tipo de descuento correspondiente a la promoción
        $tipoDescuento = Tipo_descuento::find($promocion->id_tipo_descuento);
        $producto = Producto::find($promocion->producto_id);
        $servicio = Servicio::find($promocion->servicio_id);
    ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Código Promoción: <span><?php echo $promocion->id; ?></span></h5>
                    <p class="card-text">Descripción Promoción: <span><?php echo $promocion->descripcion_promocion; ?></span></p>
                    <p class="card-text">Fecha Inicio: <span><?php echo $promocion->fecha_inicio_promocion; ?></span></p>
                    <p class="card-text">Fecha Fin: <span><?php echo $promocion->fecha_fin_promocion; ?></span></p>
                    <p class="card-text">Tipo Descuento: <span><?php echo $tipoDescuento->descripcion_descuento; ?></span></p>
                    <p class="card-text">Producto: <span><?php echo $producto->name_producto; ?></span></p>
                    <p class="card-text">Servicio: <span><?php echo $servicio->nombre; ?></span></p>
                    <p class="card-text">Estado: 
                        <span><?php echo $promocion->activo_descuento === 'A' ? 'Activo' : 'Inactivo'; ?></span>
                    </p>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary" href="/promociones/actualizar?id=<?php echo $promocion->id; ?>">Actualizar</a>

                        <form action="/promociones/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $promocion->id; ?>">
                            <input type="submit" value="Borrar" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<style>
    /* Contenedor de las tarjetas en filas */
.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin: 20px 0;
    padding: 0;
}

/* Estilos de las columnas */
.col-md-4 {
    flex: 0 0 30%;
    max-width: 30%;
    margin: 10px 0;
}

/* Estilos de la tarjeta */
.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease-in-out;
    height: 350px; /* Fijar altura para que las tarjetas sean uniformes */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card:hover {
    transform: translateY(-5px);
}

/* Contenido de la tarjeta */
.card-body {
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Título dentro de la tarjeta */
.card-title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
    text-align: center;
}

/* Texto descriptivo dentro de la tarjeta */
.card-text {
    font-size: 14px;
    color: #666;
    text-align: center;
    margin-bottom: 10px;
}

/* Estilo para los botones dentro de la tarjeta */
.btn {
    display: inline-block;
    padding: 10px 15px;
    font-size: 14px;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.2s ease;
    width: 100%;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Espaciado entre los botones */
.d-flex {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.mb-4 {
    margin-bottom: 20px;
}

/* Ajustes para dispositivos más pequeños */
@media (max-width: 768px) {
    .col-md-4 {
        flex: 0 0 45%;
        max-width: 45%;
    }
}

@media (max-width: 576px) {
    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

</style>