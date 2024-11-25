document.getElementById("buscador").addEventListener("input", function() {
    const valorDeTabla = this.value.toLowerCase();
    const filas = document.querySelectorAll("#tablaCampanias tbody tr");
    
    filas.forEach(function(fila) {
        const columnas = fila.querySelectorAll("td");
        const nombre_campania = columnas[0].innerText.toLowerCase();

        if (nombre_campania.includes(valorDeTabla)) {
            fila.style.display = "";
        } else {
            fila.style.display = "none";
        }
    });
});