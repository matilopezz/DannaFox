
const emailInput = document.getElementById('email');
const errorSpan = document.getElementById('error');

document.getElementById('formCliente').addEventListener('submit', function (event) {   //obtengo el ID del formulario para impulsar el evento
  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  
  if (!emailPattern.test(emailInput.value)) {
    event.preventDefault(); // Evita el envío del formulario
    errorSpan.style.display = 'block'; // Muestra el mensaje de error
  } else {
    errorSpan.style.display = 'none';
  }
});