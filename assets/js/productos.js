document.querySelectorAll(".btn-agregar").forEach((btn, index) => {
  btn.addEventListener("click", () => {
    const tarjetas = document.querySelectorAll(".card");
    const tarjeta = tarjetas[index];
    const nombre = tarjeta.querySelector(".card-title").textContent;
    const precio = tarjeta.querySelector(".precio").textContent.replace("$", "").replace(" ARS", "");
    const imagen = tarjeta.querySelector("img").src;

    const nuevoItem = { nombre, precio, imagen };

    const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    carrito.push(nuevoItem);
    localStorage.setItem("carrito", JSON.stringify(carrito));
    alert("Producto agregado al carrito 🧳");
  });
});
