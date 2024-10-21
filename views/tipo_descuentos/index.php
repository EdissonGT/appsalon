<h1 class="nombre-pagina">Tipo de Descuentos</h1>
<p class="descripcion-pagina">Administración de Tipo de Descuentos</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<div class="row">
    <?php foreach($tipo_descuentos as $tipo_descuento) { ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Código Descuento: <span><?php echo $tipo_descuento->id; ?></span></h5>
                    <p class="card-text">Descripción Descuento: <span><?php echo $tipo_descuento->descripcion_descuento; ?></span></p>

                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary" href="/tipo_descuentos/actualizar?id=<?php echo $tipo_descuento->id; ?>">Actualizar</a>

                        <!--<form action="/tipo_descuentos/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $tipo_descuento->id; ?>">
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
    height: 250px; /* Fijar altura para que las tarjetas sean uniformes */
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
    margin-bottom: 20px;
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