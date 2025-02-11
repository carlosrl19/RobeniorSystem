function carouselProfileViewer(event) {
    var files = event.target.files; // Obtener todos los archivos seleccionados
    var profilePhoto = document.getElementById("profilePhoto"); // Obtener el elemento de la imagen

    // Solo cambiar la imagen con el primer archivo seleccionado
    if (files.length > 0) {
        var file = files[0]; // Tomar solo el primer archivo
        var reader = new FileReader();

        reader.onload = function(e) {
            // Cambiar la fuente de la imagen existente
            profilePhoto.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
}