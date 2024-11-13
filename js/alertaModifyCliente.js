const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('success') && urlParams.get('success') === 'true') {
    alert('Cliente actualizado exitosamente');
    
    // Redirige a la misma página sin el parámetro 'success=true'
    window.history.replaceState({}, '', 'modificarcliente.php');
}