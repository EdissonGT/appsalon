<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<div class="servicios-contenedor">
    <?php foreach($servicios as $servicio) { ?>
        <div class="servicio">
            <h3>Información del Servicio</h3>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span>Q <?php echo $servicio->precio; ?></span></p>

            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>

                <!-- <form action="/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <input type="submit" value="Borrar" class="boton-eliminar">
                </form> -->
            </div>
        </div>
    <?php } ?>
</div>

<style>
    /* Estilos globales */
body {
    font-family: 'Arial', sans-serif;
    background-color: #1d1d1d; /* Fondo oscuro */
    color: #f1f1f1; /* Texto claro */
}

/* Contenedor de los servicios */
.servicios-contenedor {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Distribución en columnas */
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Tarjeta de servicio */
.servicio {
    background-color: #fff; /* Fondo blanco */
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    color: #000; /* Texto negro */
}

/* Título de la tarjeta */
.servicio h3 {
    font-size: 1.5rem;
    color: #000; /* Texto negro */
    margin-bottom: 20px;
}

/* Detalles del servicio */
.servicio p {
    color: #000; /* Texto negro */
    font-size: 1rem;
    margin: 10px 0;
}

/* Botones de acciones */
.acciones {
    margin-top: 15px;
}

.boton {
    display: inline-block;
    background-color: #00aaff;
    color: white;
    padding: 10px 20px;
    margin-right: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s;
}

.boton:hover {
    background-color: #008fcc;
}

/* Botones de acciones con el mismo tamaño */
.boton,
.boton-eliminar {
    display: inline-block;
    background-color: #00aaff;
    color: white;
    padding: 10px 20px;
    width: 45%;  /* Ambos botones ocuparán el 45% del ancho del contenedor */
    text-align: center;
    margin-right: 5%;
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s;
}

/* Botón de eliminar con fondo rojo */
.boton-eliminar {
    background-color: #ff4c4c;
    margin-right: 0;  /* Elimina el margen derecho solo para el botón de eliminar */
}

/* Hover en botones */
.boton:hover {
    background-color: #008fcc;
}

.boton-eliminar:hover {
    background-color: #cc0000;
}

</style>