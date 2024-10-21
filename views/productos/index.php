<h1 class="nombre-pagina">Productos</h1>
<p class="descripcion-pagina">Administración de Productos</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
    use Model\Marca;  // Importación del modelo
?>

<div class="row">
    <?php foreach($productos as $producto) { 
        // OBTENER LA MARCA
        $marca = Marca::find($producto->id_marca_producto);
    ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Código Producto: <span><?php echo $producto->id; ?></span></h5>
                    <p class="card-text">Nombre Producto: <span><?php echo $producto->name_producto; ?></span></p>
                    <p class="card-text">Marca: <span><?php echo $marca->nombre_marca; ?></span></p>
                    <p class="card-text">Precio: <span>Q. <?php echo $producto->precio_producto; ?></span></p>
                    <p class="card-text">Descripción: <span><?php echo $producto->descripcion_producto; ?></span></p>
                    <p class="card-text">Fecha de Creación: <span><?php echo $producto->fecha_creacion_producto; ?></span></p>
                    <p class="card-text">Stock Disponible: <span><?php echo $producto->stock_producto; ?></span></p>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary" href="/productos/actualizar?id=<?php echo $producto->id; ?>">Actualizar</a>

                        <!-- <form action="/productos/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                            <input type="submit" value="Borrar" class="btn btn-danger">
                        </form>-->
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