function carouselProductUpdateViewer(event) {
    var carouselImages = document.getElementById("carousel-product-update-images");
    carouselImages.innerHTML = ""; // Limpiar el contenedor antes de agregar nuevas imágenes

    var files = event.target.files; // Obtener todos los archivos seleccionados
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.onload = (function (file, index) {
            return function (e) {
                // Crear un nuevo elemento de imagen
                var carouselItem = document.createElement("div");
                carouselItem.className =
                    "carousel-item" + (index === 0 ? " active" : "");

                var img = document.createElement("img");
                img.src = e.target.result;
                img.className = "d-block"; // Clase Bootstrap para imágenes en carrusel
                img.style.width = "100%"; // Ajusta el ancho automáticamente
                img.style.height = "275px"; // Ocupa toda la altura del contenedor
                img.style.maxHeight = "275px"; // Limita la altura máxima al 90%
                img.style.objectFit = "contain"; // Asegura que la imagen se ajuste sin deformarse
                img.style.margin = "auto"; // Centra horizontalmente
                img.style.display = "block"; // Centra verticalmente

                // Agregar evento de clic para abrir la vista previa
                img.onclick = function () {
                    document.getElementById("previewUpdateImage").src = e.target.result;
                    var modal = new bootstrap.Modal(document.getElementById('imagePreviewUpdateModal'));
                    modal.show();
                };

                carouselItem.appendChild(img);
                carouselImages.appendChild(carouselItem);
            };
        })(file, i);

        reader.readAsDataURL(file);
    }
}