const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('success') && urlParams.get('success') === 'true') {
    const operacion = urlParams.get('operation')

    if(operacion === 'update'){
        alert('Cliente actualizado exitosamente');
    }else if(operacion === 'delete'){
        alert('Cliente eliminado exitosamente');
    }else if(operacion === 'create'){
        alert('Cliente creado exitosamente');
    }

    window.history.replaceState({}, '', window.location.pathname);
}