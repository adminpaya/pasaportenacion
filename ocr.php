<?php
// Definir la clave del API de ocr-space
$api_key = "K86142185888957";
?>

<html>
<head>
<script>
// Definir una función que se ejecute cuando se envíe el formulario
async function procesarImagen(event) {
  // Prevenir el comportamiento por defecto del formulario
  event.preventDefault();
  // Obtener el elemento del formulario
  var form = event.target;
  // Obtener el elemento del campo de archivo
  var input = form.elements["imagen"];
  // Obtener el archivo seleccionado
  var archivo = input.files[0];
  // Verificar si el archivo es una imagen válida (png, jpg, jpeg)
  
  // We compress the file by 50%
  const compressedFile = await compressImage(archivo, {
                // 0: is maximum compression
                // 1: is no compression
                quality: 0.2,

                // We want a JPEG file
                type: 'image/jpeg',
  });
  
  
  
  if (compressedFile.type == "image/png" || compressedFile.type == "image/jpg" || compressedFile.type == "image/jpeg") {
    // Crear un objeto FormData para enviar los datos del formulario
    var formData = new FormData();
    // Agregar la clave del API al objeto FormData
    formData.append("apikey", "<?php echo $api_key; ?>");
    // Agregar el archivo al objeto FormData
    formData.append("file", compressedFile);
    // Agregar el idioma al objeto FormData
    formData.append("language", "spa");
    // Agregar el motor de OCR al objeto FormData
    formData.append("OCREngine", "2");
    // Enviar el objeto FormData al API de ocr-space usando fetch
    fetch("https://api.ocr.space/parse/image", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        // Verificar si la respuesta es exitosa
        if (response.ok) {
          // Convertir la respuesta a formato JSON
          console.log("La respuesta es: ", response);
          return response.json();
        } else {
          // Mostrar un mensaje de error si la respuesta falla
          alert("Error al comunicarse con el API de ocr-space");
        }
      })
      .then((data) => {
        // Obtener el texto reconocido de los datos del API
         console.log("El JSON reconocido es: ", data);
        var text = data.ParsedResults[0].ParsedText;
        // Mostrar el texto reconocido en la consola
        console.log("El texto reconocido es: ", text);
        // Definir las expresiones regulares para extraer los datos
        //const totalRegex = /(TOT|TOTAL)\D+(\d+(\.\d+)?)/; // Busca el número en la línea de TOT o TOTAL
        const facturaRegex = /TFHKC\d{8}-\d{8}/; // Busca la cadena de 12 letras mayúsculas seguida de un guión y 8 números
        const fechaRegex = /FECHA:\s*(\S+)/; // Busca la fecha después de FECHA:
        const maxRegex = /B\/\.\s*(\d+(\.\d+)?)/g; // Busca los números que siguen a B/. con la bandera g

        // Buscar los datos en el texto usando las expresiones regulares
        //const totalMatch = text.match(totalRegex);
        const facturaMatch = text.match(facturaRegex);
        const fechaMatch = text.match(fechaRegex);
        const maxMatch = text.matchAll(maxRegex);

        // Extraer los datos de los resultados de las expresiones regulares
        //const total = totalMatch ? totalMatch[2] : null; // Usa el segundo grupo de captura para el número
        const factura = facturaMatch ? facturaMatch[0] : "no se pudo leer"; // Usa el primer resultado que coincida con la cadena
        const fecha = fechaMatch ? fechaMatch[1] : "no se pudo leer"; // Usa el primer grupo de captura para la fecha
        const max = maxMatch
          ? Math.max(...Array.from(maxMatch).map((m) => m[1]))
          : "no se pudo leer"; // Usa Math.max y el operador spread para obtener el número más alto

        textoFactura =
          "Factura:" + factura + " Fecha:" + fecha + " Total:" + max + " Bs";

        // Mostrar los datos extraídos en el elemento con id="resultado"
        var resultado = document.getElementById("resultado");
        resultado.textContent = textoFactura;
      })
      .catch((error) => {
        // Mostrar el error en la consola
        console.error(error);
      });
  } else {
    // Mostrar un mensaje de error si el archivo no es una imagen válida
    alert("El tipo de archivo no es válido. Solo se aceptan imágenes png, jpg o jpeg.");
  }
}

const compressImage = async (file, { quality = 1, type = file.type }) => {
        // Get as image data
        const imageBitmap = await createImageBitmap(file);

        // Draw to canvas
        const canvas = document.createElement('canvas');
        canvas.width = imageBitmap.width;
        canvas.height = imageBitmap.height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(imageBitmap, 0, 0);

        // Turn into Blob
        const blob = await new Promise((resolve) =>
            canvas.toBlob(resolve, type, quality)
        );
        
        // Turn Blob into File
        return new File([blob], file.name, {
            type: blob.type,
        });
};


</script>
</head>
<body>
<h1>Procesar imagen con OCR</h1>
<form id="formulario" onsubmit="procesarImagen(event)">
  Selecciona una imagen para subir:
  <input type="file" name="imagen" id="imagen" required>
  <input type="submit" value="Procesar imagen">
</form>
<div id="resultado"></div>
</body>
</html>