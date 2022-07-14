let paso=1;const cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");const t=document.querySelector(".actual");t&&t.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function botonesPaginador(){const e=document.querySelector("#siguiente"),t=document.querySelector("#anterior");1===paso&&(t.classList.add("ocultar"),e.classList.remove("ocultar")),2===paso&&(t.classList.remove("ocultar"),e.classList.remove("ocultar")),3===paso&&(e.classList.add("ocultar"),t.classList.remove("ocultar"),mostrarResumen())}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",e=>{paso++,mostrarSeccion(),botonesPaginador()})}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",e=>{paso--,mostrarSeccion(),botonesPaginador()})}async function consultarAPI(){try{const e="http://localhost:3000/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:n}=e,a=document.createElement("P");a.classList.add("nombre-servicio"),a.textContent=o;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=n+"€";const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(a),r.appendChild(c),document.querySelector("#servicios").appendChild(r)})}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,n=document.querySelector(`[data-id-servicio="${t}"]`);o.includes(e)?(n.classList.remove("seleccionado"),cita.servicios=o.filter(e=>e.id!==t)):(cita.servicios=[...o,e],n.classList.add("seleccionado"))}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function idCliente(){cita.id=document.querySelector("#id").value,document.querySelector("#id").remove()}function seleccionarFecha(){const e=document.querySelector("#fecha");e.addEventListener("input",(function(t){const o=new Date(t.target.value).getUTCDay();if([6,0].includes(o))t.target.value="",mostrarAlerta("Fines de semana no permitidos","error",".formulario");else{const t=document.querySelector(".alerta");t&&t.remove(),cita.fecha=e.value}}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value,o=t.split(":")[0];if(o<9||o>21)mostrarAlerta("Hora fuera de horario","error",".formulario"),e.target.value="";else{const e=document.querySelector(".alerta");e&&e.remove(),cita.hora=t}}))}function mostrarAlerta(e,t,o){document.querySelectorAll(".alerta").forEach(e=>{e.textContent});const n=document.createElement("DIV");n.textContent=e,n.classList.add("alerta"),n.classList.add(t);document.querySelector(o).appendChild(n)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");e.innerHTML="";let t=!1;if(document.querySelectorAll(".alerta").forEach(e=>e.remove()),""===cita.hora&&(mostrarAlerta("Debe incluir la hora de su cita","error",".contenido-resumen"),t=!0),""===cita.fecha&&(mostrarAlerta("Debe incluir la fecha de su cita","error",".contenido-resumen"),t=!0),0===cita.servicios.length&&(mostrarAlerta("Debe incluir al menos un servicio","error",".contenido-resumen"),t=!0),!t){const{nombre:t,fecha:o,hora:n,servicios:a}=cita;let c=0;const r=document.createElement("H3");r.textContent="Resumen servicios:",e.appendChild(r),a.forEach(t=>{const{id:o,precio:n,nombre:a}=t,r=document.createElement("DIV");r.classList.add("contenedor-servicio");const i=document.createElement("P");i.textContent=a;const s=document.createElement("P");s.innerHTML=`<span>Precio:</span> ${n}€`,c+=parseInt(n),r.appendChild(i),r.appendChild(s),e.appendChild(r)});const i=document.createElement("H3");i.textContent="Resumen cita:",e.appendChild(i);const s=document.createElement("P");s.innerHTML="<span>Nombre:</span> "+t;const l=new Date(o),d=l.getMonth(),u=l.getDate()+2,m=l.getFullYear(),p=new Date(Date.UTC(m,d,u)).toLocaleDateString("es-ES",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),h=document.createElement("P");h.innerHTML="<span>Fecha:</span> "+p;const v=document.createElement("P");v.innerHTML="<span>Hora:</span> "+n;const f=document.createElement("P");f.innerHTML=`<span>Precio total:</span> ${c}€`;const S=document.createElement("BUTTON");S.classList.add("boton"),S.textContent="Reservar cita",S.onclick=reservarCita,e.appendChild(s),e.appendChild(h),e.appendChild(v),e.appendChild(f),e.appendChild(S)}}async function reservarCita(){const{id:e,fecha:t,hora:o,servicios:n}=cita,a=n.map(e=>e.id),c=new FormData;c.append("usuarioId",e),c.append("fecha",t),c.append("hora",o),c.append("servicios",a);try{const e="http://localhost:3000/api/citas",t=await fetch(e,{method:"POST",body:c});(await t.json()).resultado&&Swal.fire({icon:"success",title:"Cita creada",text:"Tu cita fue creada correctamente",button:"Ok"}).then(()=>{window.location.reload()})}catch(e){console.log(e),Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la cita",button:"Ok"}).then(()=>{window.location.reload()})}}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));