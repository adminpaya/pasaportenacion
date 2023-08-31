<?php
include_once 'opendb.php';
session_start();

if( !isset($_SESSION['user_nombre'])  ){
     
      header("location: index.php");
      die();
    
}


$user     = $_SESSION['user_nombre'];
$telefono = $_SESSION['user_telefono'];
$email    = $_SESSION['user_email'];
$id       = $_SESSION['user_id'];


$test = " entra PHP ";
include_once 'opendb.php';
$test .= " luego al include ";
$file = fopen('logFacturas.txt','w');
fwrite($file, '  Inicio de registros:  ');
$existente ='';



if( $_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['addFecha']) && isset($_POST['addNumero'])  && isset($_POST['addTotal'])        ){
        $ImageName = $_FILES['file']['name'];
        $fileElementName = 'photo';
        $path = 'images/'; 
        
        $path_parts = pathinfo($_FILES["file"]["name"]);
        $image_path = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
        $location = $path . $image_path; 
        
        move_uploaded_file($_FILES['file']['tmp_name'], $location); 
        $test .= " entra POST ";
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
        $query_select_facturas = "SELECT * FROM  pasaporte_facturas WHERE numero ='".$_POST['addNumero']."' ;"; 
        if( $resulted_facturas= $conn->query( $query_select_facturas ) ){
            $total_facturas = $resulted_facturas->num_rows;
            if ($total_facturas > 0) {
                $existente = "OK";
                echo "EXISTE";
                /*
                while($row_desglose = $resulted_facturas->fetch_assoc()) { 
                }
                */
                
            }
        }
        
        if($existente ==''){
            echo $_GET['addNumero'];
            $query_insert_nivel = "INSERT INTO pasaporte_facturas (usuario_id,fecha,total,numero,foto) VALUES (".$id.",'".date("Y-m-d h:i:s", strtotime($_POST['addFecha']))."','".$_POST['addTotal']."','".$_POST['addNumero']."','". $location."');";
            fwrite($file, $query_insert_nivel);
            //$query_insert_nivel = "INSERT INTO factura_api (nombre_cliente,ruc_proveedor,nombre_proveedor,total,fecha,date) VALUES ('Nacion',121245,'RiquezasDelMar',200,333333);";
            if( $resulted_nivel= $conn->query( $query_insert_nivel ) ){
                  //header("Location: niveles.php");
                  $test .= " entra DB ";
                  echo "OK";
                  
            }
            else{
                $sirve_nivel ="NO ENTRO BIEN A INSERT";
                 $sirve_nivel .= $query_insert_nivel;
                 $test .= " NO entra DB ";
            }
        }
        $conn -> close();
}



?>