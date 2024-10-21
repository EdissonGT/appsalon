<h1 class="nombre-pagina">Marcas</h1>
<p class="descripcion-pagina">Administración de Marcas</p>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<div class="marcas-contenedor">
    <?php foreach($marcas as $marca) { ?>
        <div class="marca">
            <h3><span><?php echo $marca->nombre_marca; ?></span></h3>
            <br>
            <div class="marca-detalle">
                <!-- Mostrar imagen de la marca -->
                <?php if(!empty($marca->imagen_marca)) { ?>
                    <div class="marca-imagen">
                        <img src="/build/img/marcas/<?php echo $marca->imagen_marca; ?>" 
                            alt="Imagen de la marca <?php echo $marca->nombre_marca; ?>">
                    </div>
                <?php } else { ?>
                    <p>Sin imagen disponible</p>
                <?php } ?>

                <div class="marca-info">
                    <p>Nombre: <span><?php echo $marca->nombre_marca; ?></span></p>

                    <div class="acciones">
                        <a class="boton" href="/marcas/actualizar?id=<?php echo $marca->id; ?>">Actualizar</a>

                        <!-- <form action="/marcas/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $marca->id; ?>">
                            <input type="submit" value="Borrar" class="boton-eliminar">
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<style>
/* Estilos globales */
body {
    font-family: 'Arial', sans-serif;
    background-color: #1d1d1d; /* Fondo de la página */
    color: #f1f1f1; /* Texto claro */
}

/* Contenedor de las marcas */
.marcas-contenedor {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Diseño en columnas */
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Tarjeta de marca */
.marca {
    background-color: #fff; /* Fondo blanco para las tarjetas */
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    color: #000 !important; /* Texto negro */
}

/* Título de marca */
.marca h3 {
    font-size: 20px;
    color: #000; /* Texto negro */
    margin-bottom: 20px;
}

/* Imagen de la marca */
.marca-imagen img {
    width: 150px;  /* Ancho fijo para las imágenes */
    height: 150px; /* Altura fija para las imágenes */
    object-fit: contain; /* Contener la imagen sin deformarla */
    margin-bottom: 15px;
}

/* Detalles de la marca */
.marca-info {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
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

.boton-eliminar {
    background-color: #ff4c4c;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.boton-eliminar:hover {
    background-color: #cc0000;
}

/* Estilos responsivos */
@media (max-width: 768px) {
    .marcas-contenedor {
        grid-template-columns: 1fr; /* Una columna en pantallas pequeñas */
    }
}


</style>