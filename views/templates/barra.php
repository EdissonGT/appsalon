<div class="barra">
    <p>Hola: <?php echo $nombre ?? ''; ?></p>
    <a class="boton-logout" href="/logout">Cerrar Sesión</a>
</div>

<?php if(isset($_SESSION['admin'])) { ?>
    <nav class="navbar">
        <ul class="navbar-menu">
            <li>
                <a href="#">Citas</a>
                <ul class="submenu">
                    <li><a href="/admin">Ver Citas</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Servicios</a>
                <ul class="submenu">
                    <li><a href="/servicios">Ver Servicios</a></li>
                    <li><a href="/servicios/crear">Nuevo Servicio</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Marcas</a>
                <ul class="submenu">
                    <li><a href="/marcas/crear">Nueva Marca</a></li>
                    <li><a href="/marcas">Ver Marcas</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Descuentos</a>
                <ul class="submenu">
                    <li><a href="/tipo_descuentos/crear">Nuevo Descuento</a></li>
                    <li><a href="/tipo_descuentos">Ver Descuentos</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Promociones</a>
                <ul class="submenu">
                    <li><a href="/promociones/crear">Nueva Promoción</a></li>
                    <li><a href="/promociones">Ver Promociones</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Productos</a>
                <ul class="submenu">
                    <li><a href="/productos/crear">Nuevo Producto</a></li>
                    <li><a href="/productos">Ver Productos</a></li>
                </ul>
            </li>
        </ul>
    </nav>
<?php } ?>

<style>
    /* Estilo para la barra de sesión */
.barra {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    padding: 10px;
}

.barra p {
    color: white;
    margin: 0;
}

.barra a.boton-logout {
    background-color: #ff4c4c;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.barra a.boton-logout:hover {
    background-color: #cc0000;
}

/* Estilo para el navbar */
.navbar {
    background-color: #007bff;
    padding: 15px 0;
    text-align: center;
}

.navbar-menu {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 20px;
}

.navbar-menu li {
    position: relative;
    display: inline-block;
}

.navbar-menu a {
    background-color: white;
    color: #007bff;
    padding: 10px 30px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    transition: background-color 0.3s ease, color 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar-menu a:hover {
    background-color: #0056b3;
    color: white;
}

/* Estilo para los submenús */
.submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: white;
    padding: 0;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.submenu li {
    margin: 0;
}

.submenu li a {
    padding: 10px;
    width: 200px;
    display: block;
    text-align: left;
    background-color: white;
    color: #333;
    border-bottom: 1px solid #ddd;
    border-radius: 0;
}

.submenu li a:hover {
    background-color: #0056b3;
    color: white;
}

/* Mostrar el submenú cuando el ratón pasa sobre el menú principal */
.navbar-menu li:hover .submenu {
    display: block;
}

.navbar-menu li:hover a {
    background-color: #0056b3;
    color: white;
}

/* Responsivo: ajustar para pantallas pequeñas */
@media (max-width: 768px) {
    .navbar-menu {
        flex-direction: column;
    }
    
    .navbar-menu li {
        margin-bottom: 10px;
    }
}

</style>