const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('success') && urlParams.get('success') === 'true') {
    alert('Cliente creado exitosamente');
    
    window.history.replaceState({}, '', 'crearcliente.php');
}