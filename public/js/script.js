let mostrador = document.getElementById("mostrador");
let seleccion = document.getElementById("seleccion");
let imgSeleccionada = document.getElementById("img");
let modeloSeleccionado = document.getElementById("modelo");
let descripSeleccionada = document.getElementById("descripcion");
let precioSeleccionado = document.getElementById("precio");
let precioMinimoSeleccionado = document.getElementById("precio_minimo");
let stockSeleccionado = document.getElementById("stock");
let precioMinimoMostrado = document.getElementById("precio-minimo-mostrado");
let stockMostrado = document.getElementById("stock-mostrado");
function cargar(item){
    quitarBordes();
    mostrador.style.width = "60%";
    seleccion.style.width = "40%";
    seleccion.style.opacity = "1";
    item.style.border = "0.5px solid black";
    imgSeleccionada.src = item.getElementsByTagName("img")[0].src;
    modeloSeleccionado.innerHTML =  item.getElementsByTagName("p")[0].innerHTML;
    precioSeleccionado.innerHTML =  item.getElementsByTagName("span")[0].innerHTML;
    precioMinimoMostrado.textContent = "Precio Minimo: " +precioMinimoSeleccionado.value;
    stockMostrado.textContent = "Stock: "+stockSeleccionado.value;

}
function cerrar(){
    mostrador.style.width = "100%";
    seleccion.style.width = "0%";
    seleccion.style.opacity = "0";
    quitarBordes();
}
function quitarBordes(){
    var items = document.getElementsByClassName("item");
    for(i=0;i <items.length; i++){
        items[i].style.border = "none";
    }
}