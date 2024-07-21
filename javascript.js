function validateForm() {
    // Validaciones básicas con JavaScript
    var origen = document.forms["vueloForm"]["origen"].value;
    var destino = document.forms["vueloForm"]["destino"].value;
    var fecha = document.forms["vueloForm"]["fecha"].value;
    var plazas_disponibles = document.forms["vueloForm"]["plazas_disponibles"].value;
    var precio = document.forms["vueloForm"]["precio"].value;
    if (origen == "" || destino == "" || fecha == "" || plazas_disponibles == "" || precio == "") {
        alert("Todos los campos deben ser completados");
        return false;
    }
    return true;
}
