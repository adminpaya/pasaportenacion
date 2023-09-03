<?php
// Incluye el archivo de conexión a la base de datos
include_once 'opendb.php';

// Configura las cabeceras de CORS para permitir peticiones desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

//Esto es un ejemplo:
$toggle = " se debe ";

// Obtiene el valor de la fecha de inicio a filtrar del parámetro GET
$fecha_inicio_a_filtrar = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;

// Obtiene el valor de la fecha de fin a filtrar del parámetro GET
$fecha_fin_a_filtrar = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;

// Obtiene el valor de la sucursal a filtrar del parámetro GET (por defecto, muestra todas las sucursales)
$sucursal_a_filtrar = isset($_GET['sucursal']) ? $_GET['sucursal'] : null;

// Inicializa un array para almacenar los datos de todos los proveedores
$resultados = array();

// Realiza la consulta en la base de datos para obtener los datos de los proveedores
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
$conn->set_charset("utf8");

$query = "SELECT * FROM pasaporte_usuarios";
$result = $conn->query($query);
$total_usuarios = $result->num_rows;
if($total_usuarios > 0){

    $resultados['total'] = $total_usuarios;
    while ($row = $result->fetch_assoc()) {
        
    }
}else{

}

$query = "SELECT * FROM pasaporte_usuarios where cast(date as Date) = cast(curdate() as Date)";
$result = $conn->query($query);
$total_usuarios_hoy = $result->num_rows;
if($total_usuarios_hoy > 0){

    $resultados['hoy'] = $total_usuarios_hoy;
    while ($row = $result->fetch_assoc()) {
        
    }
}else{

}

// Devuelve la respuesta como un objeto JSON con los proveedores
$conn->close();
echo json_encode($resultados);
//echo $promt_ia;