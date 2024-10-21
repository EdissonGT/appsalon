<div class="campo">
    <label for="name_producto">Nombre</label>
    <input 
        type="text"
        id="name_producto"
        placeholder="Nombre Producto"
        name="name_producto"
        value="<?php echo $producto->name_producto; ?>"
    />
</div>

<div class="campo">
    <label for="id_marca_producto">Marca del Producto</label>
    <select id="id_marca_producto" name="id_marca_producto" required>
        <option value="">-- Selecciona una Marca --</option>
        <?php foreach ($marcas as $tipo) { ?>
            <option 
                value="<?php echo $tipo->id; ?>" 
                <?php echo $producto->id_marca_producto == $tipo->id ? 'selected' : ''; ?>>
                <?php echo $tipo->nombre_marca; ?>
            </option>
        <?php } ?>
    </select>
</div>


<div class="campo">
    <label for="descripcion_producto">Descripcion</label>
    <input 
        type="text"
        id="descripcion_producto"
        placeholder="Descripcion Producto"
        name="descripcion_producto"
        value="<?php echo $producto->descripcion_producto; ?>"
    />
</div>

<div class="campo">
    <label for="precio_producto">Precio Producto</label>
    <input 
        type="number"
        id="precio_producto"
        placeholder="Precio Producto"
        name="precio_producto"
        value="<?php echo $producto->precio_producto; ?>"
    />
</div>


<div class="campo">
    <label for="fecha_creacion_producto">Fecha Creacion Producto</label>
    <input
        id="fecha_creacion_producto"
        type="date"
        name="fecha_creacion_producto" 
        min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
        value="<?php echo $producto->fecha_creacion_producto; ?>"
    />
</div>

<div class="campo">
    <label for="stock_producto">Stock Producto</label>
    <input 
        type="number"
        id="stock_producto"
        placeholder="Stock Producto"
        name="stock_producto"
        value="<?php echo $producto->stock_producto; ?>"
    />
</div>
