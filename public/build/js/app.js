let paso=1;const pasoInicial=1,pasoFinal=5,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[],productos:[],promociones:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),consultarProductosAPI(),consultarPromocionesAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),seleccionarTipoPago(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const o=`#paso-${paso}`;document.querySelector(o).classList.add("mostrar");const t=document.querySelector(".actual");t&&t.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(function(e){e.preventDefault(),paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))}))}function botonesPaginador(){const e=document.querySelector("#anterior"),o=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),o.classList.remove("ocultar")):5===paso?(e.classList.remove("ocultar"),o.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),o.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=pasoInicial||(paso--,botonesPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=pasoFinal||(paso++,botonesPaginador())}))}async function consultarAPI(){try{const e="http://3.19.158.127/api/servicios",o=await fetch(e);mostrarServicios(await o.json())}catch(e){console.log(e)}}async function consultarProductosAPI(){try{const e="http://3.19.158.127/api/productos",o=await fetch(e);mostrarProductos(await o.json())}catch(e){console.log(e)}}async function consultarPromocionesAPI(){try{const e="http://3.19.158.127/api/promociones",o=await fetch(e);mostrarPromociones(await o.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach((e=>{const{id:o,nombre:t,precio:n}=e,c=document.createElement("P");c.classList.add("nombre-servicio"),c.textContent=t;const a=document.createElement("P");a.classList.add("precio-servicio"),a.textContent=`Q. ${n}`;const i=document.createElement("DIV");i.classList.add("servicio"),i.dataset.idServicio=o,i.onclick=function(){seleccionarServicio(e)},i.appendChild(c),i.appendChild(a),document.querySelector("#servicios").appendChild(i)}))}function seleccionarServicio(e){const{id:o}=e,{servicios:t}=cita,n=document.querySelector(`[data-id-servicio="${o}"]`);t.some((e=>e.id===o))?(cita.servicios=t.filter((e=>e.id!==o)),n.classList.remove("seleccionado")):(cita.servicios=[...t,e],n.classList.add("seleccionado"))}function mostrarProductos(e){e.forEach((e=>{const{id:o,name_producto:t,precio_producto:n}=e,c=document.createElement("P");c.classList.add("name-producto"),c.textContent=t;const a=document.createElement("P");a.classList.add("precio-producto"),a.textContent=`Q.${n}`;const i=document.createElement("DIV");i.classList.add("producto"),i.dataset.idProducto=o,i.onclick=function(){seleccionarProducto(e)},i.appendChild(c),i.appendChild(a),document.querySelector("#productos").appendChild(i)}))}function seleccionarProducto(e){const{id:o}=e,{productos:t}=cita,n=document.querySelector(`[data-id-producto="${o}"]`);t.some((e=>e.id===o))?(cita.productos=t.filter((e=>e.id!==o)),n.classList.remove("seleccionado")):(cita.productos=[...t,e],n.classList.add("seleccionado"))}async function mostrarPromociones(e){try{const o="http://3.19.158.127/api/productos",t="http://3.19.158.127/api/servicios",[n,c]=await Promise.all([fetch(o),fetch(t)]),a=await n.json(),i=await c.json();e.forEach((e=>{const{id:o,descripcion_promocion:t,producto_id:n,servicio_id:c,precio_promocion:r}=e,s=a.find((e=>e.id===n)),d=i.find((e=>e.id===c)),l=document.createElement("P");l.classList.add("name-promocion"),l.textContent=t;const u=document.createElement("P");u.classList.add("nombre-producto"),u.textContent=s?s.name_producto:"Producto no disponible";const p=document.createElement("P");p.classList.add("nombre-servicio"),p.textContent=d?d.nombre:"Servicio no disponible";const m=document.createElement("P");m.classList.add("precio-promocion"),m.textContent=`Q.${r}`;const h=document.createElement("DIV");h.classList.add("promocion"),h.dataset.idPromocion=o,h.onclick=function(){seleccionarPromocion(e)},h.appendChild(l),h.appendChild(u),h.appendChild(p),h.appendChild(m),document.querySelector("#promociones").appendChild(h)}))}catch(e){console.log("Error al mostrar promociones:",e)}}function seleccionarPromocion(e){const{id:o}=e,{promociones:t}=cita,n=document.querySelector(`[data-id-promocion="${o}"]`);t.some((e=>e.id===o))?(cita.promociones=t.filter((e=>e.id!==o)),n.classList.remove("seleccionado")):(cita.promociones=[...t,e],n.classList.add("seleccionado"))}function idCliente(){cita.id=document.querySelector("#id").value}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const o=new Date(e.target.value).getUTCDay();[0].includes(o)?(e.target.value="",mostrarAlerta("Los domingos no estamos atendiendo","error",".formulario")):cita.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const o=e.target.value.split(":")[0];o<10||o>18?(e.target.value="",mostrarAlerta("Hora No Válida","error",".formulario")):cita.hora=e.target.value}))}function mostrarAlerta(e,o,t,n=!0){const c=document.querySelector(".alerta");c&&c.remove();const a=document.createElement("DIV");a.textContent=e,a.classList.add("alerta"),a.classList.add(o);document.querySelector(t).appendChild(a),n&&setTimeout((()=>{a.remove()}),3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);const{nombre:o,fecha:t,hora:n,servicios:c,productos:a,promociones:i}=cita;if(c.length>0){const o=document.createElement("H3");o.textContent="Resumen de Servicios",e.appendChild(o),c.forEach((o=>{const{id:t,precio:n,nombre:c}=o,a=document.createElement("DIV");a.classList.add("contenedor-servicio");const i=document.createElement("P");i.textContent=c;const r=document.createElement("P");r.innerHTML=`<span>Precio:</span> Q${n}`,a.appendChild(i),a.appendChild(r),e.appendChild(a)}))}if(a.length>0){const o=document.createElement("H3");o.textContent="Resumen de Productos",e.appendChild(o),a.forEach((o=>{const{id:t,name_producto:n,precio_producto:c}=o,a=document.createElement("DIV");a.classList.add("contenedor-producto");const i=document.createElement("P");i.textContent=n;const r=document.createElement("P");r.innerHTML=`<span>Precio:</span> Q${c}`,a.appendChild(i),a.appendChild(r),e.appendChild(a)}))}if(i.length>0){const o=document.createElement("H3");o.textContent="Resumen de Promociones",e.appendChild(o),i.forEach((o=>{const{id:t,descripcion_promocion:n,fecha_inicio_promocion:c,fecha_fin_promocion:a,id_tipo_descuento:i,producto_id:r,servicio_id:s,precio_promocion:d}=o,l=document.createElement("DIV");l.classList.add("contenedor-promocion");const u=document.createElement("P");u.textContent=n;const p=document.createElement("P");p.innerHTML=`<span>Precio:</span> Q${d}`,l.appendChild(u),l.appendChild(p),e.appendChild(l)}))}const r=document.createElement("H3");r.textContent="Resumen de Cita",e.appendChild(r);const s=document.createElement("P");s.innerHTML=`<span>Nombre:</span> ${o}`;const d=new Date(t),l=d.getMonth(),u=d.getDate(),p=d.getFullYear(),m=new Date(Date.UTC(p,l,u)).toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),h=document.createElement("P");h.innerHTML=`<span>Fecha:</span> ${m}`;const f=document.createElement("P");f.innerHTML=`<span>Hora:</span> ${n} Horas`;const C=document.createElement("BUTTON");C.classList.add("boton"),C.textContent="Reservar Cita",C.onclick=reservarCita,e.appendChild(s),e.appendChild(h),e.appendChild(f),e.appendChild(C)}function seleccionarTipoPago(){document.querySelector("#tipoPagoId").addEventListener("change",(function(e){cita.tipoPagoId=e.target.value}))}async function reservarCita(){const{nombre:e,fecha:o,hora:t,servicios:n,productos:c,id:a,tipoPagoId:i,promociones:r}=cita,s=n.map((e=>e.id)),d=c.map((e=>e.id)),l=r.map((e=>e.id)),u=new FormData;u.append("fecha",o),u.append("hora",t),u.append("usuarioId",a),u.append("tipoPagoId",i),s.length>0&&s.forEach((e=>u.append("servicios[]",e))),d.length>0&&d.forEach((e=>u.append("productos[]",e))),l.length>0&&l.forEach((e=>u.append("promociones[]",e)));try{const e="/api/citas",o=await fetch(e,{method:"POST",body:u}),t=await o.json();console.log(t),t.resultado&&Swal.fire({icon:"success",title:"Cita Creada",text:"Tu cita fue creada correctamente",button:"OK"}).then((()=>{setTimeout((()=>{window.location.reload()}),3e3)}))}catch(e){Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la cita"})}}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));