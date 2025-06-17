const form = document.getElementById('registerForm');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');

const nameError = document.getElementById('nameError');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');
const confirmPasswordError = document.getElementById('confirmPasswordError');

form.addEventListener('submit', e => {
  e.preventDefault();

  let valid = true;

  // Nombre no vacío
  if (nameInput.value.trim() === '') {
    nameError.style.display = 'block';
    valid = false;
  } else {
    nameError.style.display = 'none';
  }

  // Email válido
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailInput.value.trim())) {
    emailError.style.display = 'block';
    valid = false;
  } else {
    emailError.style.display = 'none';
  }

  // Contraseña al menos 6 caracteres
  if (passwordInput.value.length < 6) {
    passwordError.style.display = 'block';
    valid = false;
  } else {
    passwordError.style.display = 'none';
  }

  // Confirmar contraseña coincide
  if (passwordInput.value !== confirmPasswordInput.value || confirmPasswordInput.value.length < 6) {
    confirmPasswordError.style.display = 'block';
    valid = false;
  } else {
    confirmPasswordError.style.display = 'none';
  }

  if (valid) {
    alert('¡Registro exitoso! Aquí enviarías los datos al servidor.');
    // Aquí pondrías la lógica real para registrar (Firebase, backend, etc)
    form.reset();
  }
});
