document.getElementById("buscador").addEventListener("input", function() {
    const valorDeTabla = this.value.toLowerCase();
    const tabla = document.querySelectorAll("#tablaClientes tr");

    tabla.forEach(function(columnas) {
        const columna = columnas.querySelectorAll("td");
        const nombre = columna[1].innerText.toLowerCase();
        const apellido = columna[2].innerText.toLowerCase();
        const cuil_cuit = columna[3].innerText.toLowerCase();
        const razonSocial = columna[4].innerText.toLowerCase();

        if (nombre.includes(valorDeTabla) || apellido.includes(valorDeTabla) || cuil_cuit.includes(valorDeTabla) || razonSocial.includes(valorDeTabla)) {
            columnas.style.display = "";
        } else {
            columnas.style.display = "none";
        }
    });
});
