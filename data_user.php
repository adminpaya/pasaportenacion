<?php
include_once 'opendb.php';
session_start();
if( !isset($_SESSION['user_nombre'])  ){
      header("location: index.php");
      die();
    
}
$user_nombre = $_SESSION['user_nombre'];

if(isset(	$_GET['user']) 	)
	{
		$user= $_GET['user'];
	}
	
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

$resolucion_unica = array();
$senales = array();
$row_senal = "";
$timestamp ="";
$direccion ="";
$deviceid ="";
$datasource="";
$rawdata="";
$titulo ="";
$zona ="";
$dato = "";
$telefono = "";
$telefono1 = "";
$telefono2 = "";
$telefono3 = "";
$telefono4 = "";
$telefono5 = "";
$protocolo = "";
$link="";
$detalle = "";


$punto_individual = array();
$grupo_puntos = array();

// SACAMOS DATA del USUARIO
$query_select_usuario = "SELECT * FROM  pasaporte_facturas WHERE usuario_id ='".$user."' ;"; 
if( $result_get_data = $conn->query( $query_select_usuario) ){
        if ($result_get_data->num_rows > 0) {
            while($row = $result_get_data->fetch_assoc()) {
                $punto_individual['fecha'] =$row['fecha'];
                $punto_individual['total'] = $row['total'];
                $punto_individual['numero'] = $row['numero'];
                $punto_individual['foto'] = $row['foto'];
                $punto_individual['id'] = $row['id'];
                $punto_individual['nombre'] = $user_nombre;
                array_push($grupo_puntos, $punto_individual);
            }
        }
}else{
        printf("Error message: %s\n", $conn->error);
}
    
$conn -> close(); 
 

echo json_encode($grupo_puntos);
 
 //echo "{$idresolver}";
 //echo "{$detalle}";