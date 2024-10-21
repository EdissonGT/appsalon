USE salon_marleny;
SELECT * FROM usuarios;

CREATE TABLE marca (
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre_marca VARCHAR(300) NOT NULL, 
    imagen_marca VARCHAR(300), 
    fecha_marca DATE
);
SELECT * FROM marca;

CREATE TABLE tipo_descuento (
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
    descripcion_descuento VARCHAR(300) NOT NULL
);
SELECT * FROM tipo_descuento;


CREATE TABLE promocion (
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
    descripcion_promocion VARCHAR(300) NOT NULL,
	fecha_inicio_promocion DATE,
	fecha_fin_promocion DATE,
	id_tipo_descuento INT(11),
	activo_descuento VARCHAR(1) DEFAULT 'A',
    CONSTRAINT fk_descuento_promocion FOREIGN KEY (id_tipo_descuento) REFERENCES tipo_descuento(id)
);
SELECT * FROM promocion;

CREATE TABLE producto (
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name_producto VARCHAR(300),
    id_marca_producto INT(11) ,
	id_promocion_producto INT(11),
	precio_producto DECIMAL(5,2),
	descripcion_producto VARCHAR(300),
	fecha_creacion_producto DATE,
	fecha_modificado_producto DATE,
	stock_producto NUMERIC(11),
	CONSTRAINT fk_producto_marca FOREIGN KEY (id_marca_producto) REFERENCES marca(id),
    CONSTRAINT fk_producto_promocion FOREIGN KEY (id_promocion_producto) REFERENCES promocion(id)
);
SELECT * FROM producto;
drop table producto
