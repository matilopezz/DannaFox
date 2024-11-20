const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('success') && urlParams.get('success') === 'true') {
    const operacion = urlParams.get('operation')

    if(operacion === 'update'){
        Swal.fire({
            title: 'Cliente Actualizado',
            text: 'El cliente ha sido actualizado exitosamente.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            // Limpia los parámetros de la URL
            window.history.replaceState(null, '', window.location.pathname);
        });
    }else if(operacion === 'delete'){
        Swal.fire({
            title: 'Cliente Eliminado',
            text: 'El cliente ha sido eliminado exitosamente.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            // Limpia los parámetros de la URL
            window.history.replaceState(null, '', window.location.pathname);
        });
    }else if(operacion === 'create'){
        Swal.fire({
            title: 'Cliente Añadido',
            text: 'El cliente ha sido añadido exitosamente.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            // Limpia los parámetros de la URL
            window.history.replaceState(null, '', window.location.pathname);
        });
    }


}



