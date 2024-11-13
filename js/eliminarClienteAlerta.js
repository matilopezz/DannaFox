const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('success') && urlParams.get('success') === 'true') {
    alert('Cliente eliminado exitosamente');
    
    window.history.replaceState({}, '', 'clientes.php');
}