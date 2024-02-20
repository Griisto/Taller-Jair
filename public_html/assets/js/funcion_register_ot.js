//Bloque para crear elementos input
const agregarNuevoInput = (datos) => {
    let NuevoRepuesto = document.createElement("select");
    NuevoRepuesto.name = "Newspare[]";
    NuevoRepuesto.id = "Nuevorepuesto";
    NuevoRepuesto.className = "input-repuesto";

    for (let i = 0; i < datos.length; i++) {
        const optionRepuesto = document.createElement("option");
        optionRepuesto.value = datos[i].id;
        optionRepuesto.text = datos[i].nombre;
        NuevoRepuesto.appendChild(optionRepuesto);
    }
    let Cantidad = document.createElement("input");
    Cantidad.name = "Newquantity[]";
    Cantidad.type = "number";
    Cantidad.id = "NuevaCantidad";
    Cantidad.className = "input-precio"
    Cantidad.placeholder = "Cantidad";

    let br = document.createElement("br");
    br.id = "br-repuesto";

    document.getElementById("contenedorrepuestos").appendChild(NuevoRepuesto);
    document.getElementById("contenedorrepuestos").appendChild(Cantidad);
    document.getElementById("contenedorrepuestos").appendChild(br);
}
//Fin bloque

//Bloque para borrar elementos input
const borrarNuevoInput = () => {
    let repuesto = document.getElementById("Nuevorepuesto");
    let cantidad = document.getElementById("NuevaCantidad");
    let br = document.getElementById("br-repuesto");
    

    repuesto.remove();
    cantidad.remove()
    br.remove()

}
//Fin bloque

const agregarManoDeObra = (option) => {
    if (!option) {
        console.error('Error: opcionesManoDeObra no está definido');
        return;
    }
    else {
        let nuevoManoDeObra = document.createElement("select");
        nuevoManoDeObra.name = "Manodeobra[]";
        nuevoManoDeObra.id = "Manodeobra";
        nuevoManoDeObra.className = "select-Manodeobra";

        for (let i = 0; i < option.length; i++) {
            let optionManodeobra = document.createElement("option");
            optionManodeobra.className = "option-Manodeobra";
            optionManodeobra.value = option[i].id;
            optionManodeobra.text = `${option[i].trabajo} Marca: ${option[i].marca}`;
            nuevoManoDeObra.appendChild(optionManodeobra);
        }

        let salto = document.createElement("br");
        salto.id = "br";

        document.getElementById("contenedor-manodeobra").appendChild(nuevoManoDeObra);
        document.getElementById("contenedor-manodeobra").appendChild(salto);

    }

}
const borrarManoDeObra = () => {
    let Manodeobra = document.getElementById("Manodeobra");
    let br = document.getElementById("br");

    Manodeobra.remove();
    br.remove()

}