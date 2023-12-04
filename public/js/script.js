let mostrador = document.getElementById("mostrador");
let seleccion = document.getElementById("seleccion");
let imgSeleccionada = document.getElementById("img");
let modeloSeleccionado = document.getElementById("modelo");
let descripSeleccionada = document.getElementById("descripcion");
let precioSeleccionado = document.getElementById("precio");
let precioMinimoSeleccionado = document.getElementById("precio_minimo");
let stockSeleccionado = document.getElementById("stock");
let precioMinimoMostrado = document.getElementById("precio_minimo");
let stockMostrado = document.getElementById("stock");
let idMostrado = document.getElementById("id");
function cargar(item,producto) {
    quitarBordes();
    console.log(producto);
    mostrador.style.width = "60%";
    seleccion.style.width = "40%";
    seleccion.style.opacity = "1";
    item.style.border = "0.5px solid black";
    imgSeleccionada.src = item.getElementsByTagName("img")[0].src;
    modeloSeleccionado.innerHTML = item.getElementsByTagName("p")[0].innerHTML;
    precioSeleccionado.innerHTML = item.getElementsByTagName("span")[0].innerHTML;
    stockMostrado.innerHTML = "Stock: "+producto.stock;
    precioMinimoMostrado.innerHTML = "Precio Minimo: "+producto.precio_minimo;
    idMostrado.innerHTML = producto.id;

    //document.getElementById('id').value = idSeleccionado.value;
}
function cerrar() {
    mostrador.style.width = "100%";
    seleccion.style.width = "0%";
    seleccion.style.opacity = "0";
    quitarBordes();
}
function quitarBordes() {
    var items = document.getElementsByClassName("item");


    for (i = 0; i < items.length; i++) {
        items[i].style.border = "none";
    }
}