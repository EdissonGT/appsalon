let paso = 1;
const pasoInicial = 1;
const pasoFinal = 5;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: [],
    productos: [],
    promociones: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // Cambia la sección cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente(); 
    paginaAnterior();


    consultarAPI(); // Consulta la API en el backend de PHP
    consultarProductosAPI(); // Consulta la API en el backend de PHP
    consultarPromocionesAPI(); // Consulta la API en el backend de PHP

    idCliente();
    nombreCliente(); // Añade el nombre del cliente al objeto de cita
    seleccionarFecha(); // Añade la fecha de la cita en el objeto
    seleccionarHora(); // Añade la hora de la cita en el objeto\
    seleccionarTipoPago();

    mostrarResumen(); // Muestra el resumen de la cita
}

function mostrarSeccion() {

    // Ocultar la sección que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    // Seleccionar la sección con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs() {

    // Agrega y cambia la variable de paso según el tab seleccionado
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach( boton => {
        boton.addEventListener('click', function(e) {
            e.preventDefault();

            paso = parseInt( e.target.dataset.paso );
            mostrarSeccion();

            botonesPaginador(); 
        });
    });
}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 5) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');

        mostrarResumen();
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function() {

        if(paso <= pasoInicial) return;
        paso--;
        
        botonesPaginador();
    })
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function() {

        if(paso >= pasoFinal) return;
        paso++;
        
        botonesPaginador();
    })
}

async function consultarAPI() {
    try {
        const url = '/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        
        mostrarServicios(servicios);
    
    } catch (error) {
        console.log(error);
    }
}


async function consultarProductosAPI() {
    try {
        const url = '/api/productos'; // URL para la API de productos
        const resultado = await fetch(url);
        const productos = await resultado.json();
        mostrarProductos(productos); // Llama a una función para mostrar los productos
    
    } catch (error) {
        console.log(error);
    }
}

async function consultarPromocionesAPI() {
    try {
        const url = '/api/promociones'; // URL para la API de productos
        const resultado = await fetch(url);
        const promociones = await resultado.json();
        mostrarPromociones(promociones); // Llama a una función para mostrar los productos
    
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach( servicio => {
        const { id, nombre, precio } = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `Q. ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function() {
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);

    });
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    // Identificar el elemento al que se le da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    // Comprobar si un servicio ya fue agregado 
    if( servicios.some( agregado => agregado.id === id ) ) {
        // Eliminarlo
        cita.servicios = servicios.filter( agregado => agregado.id !== id );
        divServicio.classList.remove('seleccionado');
    } else {
        // Agregarlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }
    // console.log(cita);
}


// RELACIOADO CON LOS PRODUCTOS 
function mostrarProductos(productos) {
    productos.forEach( producto => {
        const { id, name_producto, precio_producto } = producto;

        const nombreProducto = document.createElement('P');
        nombreProducto.classList.add('name-producto');
        nombreProducto.textContent = name_producto;

        const precioProducto = document.createElement('P');
        precioProducto.classList.add('precio-producto');
        precioProducto.textContent = `Q.${precio_producto}`;

        const productoDiv = document.createElement('DIV');
        productoDiv.classList.add('producto');
        productoDiv.dataset.idProducto = id;
        productoDiv.onclick = function() {
            seleccionarProducto(producto);
        }

        productoDiv.appendChild(nombreProducto);
        productoDiv.appendChild(precioProducto);

        document.querySelector('#productos').appendChild(productoDiv);

    });
}

function seleccionarProducto(producto) {
    const { id } = producto;
    const { productos } = cita;

    // Identificar el elemento al que se le da click
    const divProducto = document.querySelector(`[data-id-producto="${id}"]`);

    // Comprobar si un servicio ya fue agregado 
    if( productos.some( agregado => agregado.id === id ) ) {
        // Eliminarlo
        cita.productos = productos.filter( agregado => agregado.id !== id );
        divProducto.classList.remove('seleccionado');
    } else {
        // Agregarlo
        cita.productos = [...productos, producto];
        divProducto.classList.add('seleccionado');
    }
    // console.log(cita);
}


// RELACIOADO CON LOS PROMOCIONES 
async function mostrarPromociones(promociones) {
    try {
        // Obtener productos y servicios de sus respectivas APIs
        const urlProductos = '/api/productos';
        const urlServicios = '/api/servicios';

        // Obtener los productos y servicios
        const [productosRes, serviciosRes] = await Promise.all([
            fetch(urlProductos),
            fetch(urlServicios)
        ]);

        const productos = await productosRes.json();
        const servicios = await serviciosRes.json();

        // Mostrar las promociones
        promociones.forEach(promocion => {
            const { id, descripcion_promocion, producto_id, servicio_id,  precio_promocion } = promocion;

            // Buscar el producto y servicio por ID
            const producto = productos.find(prod => prod.id === producto_id);
            const servicio = servicios.find(serv => serv.id === servicio_id);

            // Crear elementos para mostrar la promoción
            const nombrePromo = document.createElement('P');
            nombrePromo.classList.add('name-promocion');
            nombrePromo.textContent = descripcion_promocion;

            const nombreProducto = document.createElement('P');
            nombreProducto.classList.add('nombre-producto');
            nombreProducto.textContent = producto ? producto.name_producto : 'Producto no disponible';

            const nombreServicio = document.createElement('P');
            nombreServicio.classList.add('nombre-servicio');
            nombreServicio.textContent = servicio ? servicio.nombre : 'Servicio no disponible';

            const precioPromocion = document.createElement('P');
            precioPromocion.classList.add('precio-promocion');
            precioPromocion.textContent = `Q.${precio_promocion}`;

            const promocionDiv = document.createElement('DIV');
            promocionDiv.classList.add('promocion');
            promocionDiv.dataset.idPromocion = id;
            promocionDiv.onclick = function() {
                seleccionarPromocion(promocion);
            }

            promocionDiv.appendChild(nombrePromo);
            promocionDiv.appendChild(nombreProducto);
            promocionDiv.appendChild(nombreServicio);
            promocionDiv.appendChild(precioPromocion);

            document.querySelector('#promociones').appendChild(promocionDiv);
        });
    } catch (error) {
        console.log('Error al mostrar promociones:', error);
    }
}


function seleccionarPromocion(promocion) {
    const { id } = promocion;
    const { promociones } = cita;

    // Identificar el elemento al que se le da click
    const divPromocion = document.querySelector(`[data-id-promocion="${id}"]`);

    // Comprobar si un servicio ya fue agregado 
    if( promociones.some( agregado => agregado.id === id ) ) {
        // Eliminarlo
        cita.promociones = promociones.filter( agregado => agregado.id !== id );
        divPromocion.classList.remove('seleccionado');
    } else {
        // Agregarlo
        cita.promociones = [...promociones, promocion];
        divPromocion.classList.add('seleccionado');
    }
    // console.log(cita);
}

function idCliente() {
    cita.id = document.querySelector('#id').value;
}
function nombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e) {

        const dia = new Date(e.target.value).getUTCDay();

        if( [0].includes(dia) ) {
            e.target.value = '';
            mostrarAlerta('Los domingos no estamos atendiendo', 'error', '.formulario');
        } else {
            cita.fecha = e.target.value;
        }
        
    });
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e) {


        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if(hora < 10 || hora > 18) {
            e.target.value = '';
            mostrarAlerta('Hora No Válida', 'error', '.formulario');
        } else {
            cita.hora = e.target.value;

            // console.log(cita);
        }
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {

    // Previene que se generen más de 1 alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    }

    // Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(desaparece) {
        // Eliminar la alerta
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
}


function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');

    // Limpiar el Contenido de Resumen
    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    const { nombre, fecha, hora, servicios, productos, promociones } = cita;

    // Verificar si se seleccionaron servicios o productos
    /*if (Object.values(cita).includes('') || (servicios.length === 0 && productos.length === 0 && promociones.length === 0)) {
        mostrarAlerta('Debes seleccionar al menos un servicio o producto, y completar fecha y hora', 'error', '.contenido-resumen', false);
        return;
    }*/

    // Mostrar resumen de Servicios si hay alguno
    if (servicios.length > 0) {
        const headingServicios = document.createElement('H3');
        headingServicios.textContent = 'Resumen de Servicios';
        resumen.appendChild(headingServicios);

        servicios.forEach(servicio => {
            const { id, precio, nombre } = servicio;
            const contenedorServicio = document.createElement('DIV');
            contenedorServicio.classList.add('contenedor-servicio');

            const textoServicio = document.createElement('P');
            textoServicio.textContent = nombre;

            const precioServicio = document.createElement('P');
            precioServicio.innerHTML = `<span>Precio:</span> Q${precio}`;

            contenedorServicio.appendChild(textoServicio);
            contenedorServicio.appendChild(precioServicio);

            resumen.appendChild(contenedorServicio);
        });
    }

    // Mostrar resumen de Productos si hay alguno
    if (productos.length > 0) {
        const headingProductos = document.createElement('H3');
        headingProductos.textContent = 'Resumen de Productos';
        resumen.appendChild(headingProductos);

        productos.forEach(producto => {
            const { id, name_producto, precio_producto } = producto;
            const contenedorProducto = document.createElement('DIV');
            contenedorProducto.classList.add('contenedor-producto');

            const textoProducto = document.createElement('P');
            textoProducto.textContent = name_producto;

            const precioProducto = document.createElement('P');
            precioProducto.innerHTML = `<span>Precio:</span> Q${precio_producto}`;

            contenedorProducto.appendChild(textoProducto);
            contenedorProducto.appendChild(precioProducto);

            resumen.appendChild(contenedorProducto);
        });
    }

    // Mostrar resumen de Promociones si hay alguno
    if (promociones.length > 0) {
        const headingPromociones = document.createElement('H3');
        headingPromociones.textContent = 'Resumen de Promociones';
        resumen.appendChild(headingPromociones);

        promociones.forEach(promocion => {
            const { id, descripcion_promocion, fecha_inicio_promocion,  fecha_fin_promocion, id_tipo_descuento, producto_id, servicio_id, precio_promocion } = promocion;
            const contenedorPromocion = document.createElement('DIV');
            contenedorPromocion.classList.add('contenedor-promocion');

            const textoPromocion = document.createElement('P');
            textoPromocion.textContent = descripcion_promocion;

            const precioPromocion = document.createElement('P');
            precioPromocion.innerHTML = `<span>Precio:</span> Q${precio_promocion}`;


            contenedorPromocion.appendChild(textoPromocion);
            contenedorPromocion.appendChild(precioPromocion);

            resumen.appendChild(contenedorPromocion);
        });
    }

    // Mostrar resumen de Cita
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    // Formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate();
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));
    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opciones);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    // Boton para Crear una cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    resumen.appendChild(botonReservar);
}


function seleccionarTipoPago() {
    const inputTipoPago = document.querySelector('#tipoPagoId');
    inputTipoPago.addEventListener('change', function(e) {
        cita.tipoPagoId = e.target.value; // Guardar el tipo de pago en el objeto cita
    });
}



async function reservarCita() {
    const { nombre, fecha, hora, servicios, productos, id, tipoPagoId, promociones } = cita;

    const idServicios = servicios.map(servicio => servicio.id);
    const idProductos = productos.map(producto => producto.id);
    const idPromociones = promociones.map(promocion => promocion.id);  // Asegúrate de usar `promocion.id`

    const datos = new FormData();
    
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);
    datos.append('tipoPagoId', tipoPagoId); // Agregar tipo de pago

    // Enviar servicios como un array
    if (idServicios.length > 0) {
        idServicios.forEach(servicioId => datos.append('servicios[]', servicioId));
    }

    // Enviar productos como un array
    if (idProductos.length > 0) {
        idProductos.forEach(productoId => datos.append('productos[]', productoId));
    }

    // Enviar promociones como un array
    if (idPromociones.length > 0) {
        idPromociones.forEach(promocionId => datos.append('promociones[]', promocionId));  // Cambiado a `promocionId`
    }

    try {
        const url = '/api/citas';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado);
        
        if (resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Cita Creada',
                text: 'Tu cita fue creada correctamente',
                button: 'OK'
            }).then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar la cita'
        });
    }
}

