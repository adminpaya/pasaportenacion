<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$message = file_get_contents('php://input'); 
include_once 'opendb.php';
$break = 0;

$horas = array();
$horas_items = array();

$conn = new mysqli('localhost', 'tamitutc_mapa', 'medica011','tamitutc_amigo');
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $file = fopen('logregistro/datos-api-registro'.time().'.txt','w');
    fwrite($file, ' -API DATOS RECIBIDOS - ');
    fwrite( $file ,  $message );
  //  fwrite( $file ,  var_dump(json_decode($message)) );
    
    //fwrite($file, ' -API DATOS RECIBIDOS - ');
    $obj = json_decode($message);
    fwrite( $file ,  $obj->sitio );
    //echo $obj->nombre;
    fwrite($file, '-API FIN - ');
}

if( isset($obj->telefono)   &&  isset($obj->nombre) && isset($obj->contrasena) && isset($obj->email) ){

    if( $_SERVER['REQUEST_METHOD'] === 'POST'   ){
        
            
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
        
        $query_find_usuario = "SELECT * FROM  pasaporte_usuarios WHERE nombre ='".$obj->nombre."' AND  telefono ='".$obj->telefono."'  ;";
         if( $resulted_select= $conn->query( $query_find_usuario ) ){
               if ($resulted_select->num_rows > 0) {
                        while($row_desglose = $resulted_select->fetch_assoc()) {  
                            echo "ERROR: TELEFONO ".$obj->telefono." ya existe";
                        }
               } else{
                      $query_insert_usuario = "INSERT INTO pasaporte_usuarios (nombre, contrasena , telefono, email) VALUES ('".$obj->nombre."', '".$obj->contrasena."','".$obj->telefono."','".$obj->email."');"; 
                      $query =  $query_insert_usuario;
                      if( $resulted_insert= $conn->query( $query_insert_usuario ) ){
                            echo "OPERACION REALIZADA CON EXITO";
                      }
                      else{
                            echo "ERROR: ERROR DE BASE DE DATOS";
                      }
                      $conn -> close();
               }
         }
        
     
            
    } else {
        echo "ERROR: NO ES EL METODO CORRECTO";
    }

} else {
    
    echo "ERROR: DATOS INCOMPLETOS";
}




/*
if( isset($_POST['telefono'])   &&  isset($_POST['nombre']) && isset($_POST['contrasena']) && isset($_POST['email']) ){

    if( $_SERVER['REQUEST_METHOD'] === 'POST'   ){
        
            
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
        
        $query_find_usuario = "SELECT * FROM  pasaporte_usuarios WHERE nombre ='".$_POST['nombre']."' AND  telefono ='".$_POST['telefono']."'  ;";
         if( $resulted_select= $conn->query( $query_find_usuario ) ){
               if ($resulted_select->num_rows > 0) {
                        while($row_desglose = $resulted_select->fetch_assoc()) {  
                            echo "ERROR: TELEFONO ".$row_desglose['telefono']." ya existe";
                        }
               } else{
                      $query_insert_usuario = "INSERT INTO pasaporte_usuarios (nombre, contrasena , telefono, email) VALUES ('".$_POST['nombre']."', '".$_POST['contrasena']."','".$_POST['telefono']."','".$_POST['email']."');"; 
                      $query =  $query_insert_usuario;
                      if( $resulted_insert= $conn->query( $query_insert_usuario ) ){
                            echo "OPERACION REALIZADA CON EXITO";
                      }
                      else{
                            echo "ERROR: ERROR DE BASE DE DATOS";
                      }
                      $conn -> close();
               }
         }
        
     
            
    } else {
        echo "ERROR: NO ES EL METODO CORRECTO";
    }

} else {
    
    echo "ERROR: DATOS INCOMPLETOS";
}

*/

?>
