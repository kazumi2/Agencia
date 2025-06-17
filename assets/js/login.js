document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("loginForm");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const email = emailInput.value.trim();
    const password = passwordInput.value;

    let valid = true;

    if (!email.includes("@")) {
      emailError.style.display = "block";
      valid = false;
    } else {
      emailError.style.display = "none";
    }

    if (password.length < 6) {
      passwordError.style.display = "block";
      valid = false;
    } else {
      passwordError.style.display = "none";
    }

    if (!valid) return;

    fetch("php/login.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`,
    })
      .then(response => response.text())
      .then(data => {
        if (data.includes("Login exitoso")) {
          window.location.href = "index.html";
        } else {
          alert("Error: " + data);
        }
      })
      .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Hubo un problema al intentar iniciar sesión.");
      });
  });
});
