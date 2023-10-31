<?php
header('Content-Type: application/json');
$message = file_get_contents('php://input'); 
$participantes = array();
$ganador_unico = array();
$ganador_final = array();

include_once 'opendb.php';
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
$query_select_ganador = "SELECT * FROM  pasaporte_facturas;"; 
if( $resulted_ganador = $conn->query( $query_select_ganador ) ){
    if($resulted_ganador->num_rows > 0){
        while($row_usuarios = $resulted_ganador->fetch_assoc()) {
            $ganador_unico['numero'] = $row_usuarios['numero'];
            $ganador_unico['usuario'] = $row_usuarios['usuario_id'];
            $ganador_unico['foto'] = $row_usuarios['foto'];
            $conn2 = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
            $query_select_ganador_nombre = "SELECT * FROM  pasaporte_usuarios WHERE id=". $row_usuarios['usuario_id'].";"; 
            if( $resulted_ganador_nombre = $conn2->query( $query_select_ganador_nombre ) ){
                while($row_usuarios_nombre = $resulted_ganador_nombre->fetch_assoc()) {
                    $ganador_unico['nombre'] = $row_usuarios_nombre['nombre'];
					$ganador_unico['nombre_usuario'] = $row_usuarios_nombre['nombre_usuario'];
					$ganador_unico['email'] = $row_usuarios_nombre['email'];
					$ganador_unico['telefono'] = $row_usuarios_nombre['telefono'];
                }
            }
            array_push($ganador_final, $ganador_unico);
            array_push($participantes, $row_usuarios['numero']);
        }
    }
}

$rand_keys = array_rand($participantes, 1);

for ($i = 0; $i < count($ganador_final); $i++) {

    if($ganador_final[$i]['numero']  ==   $participantes[$rand_keys]){
        //echo $ganador_final[$i]['numero'];
        echo json_encode($ganador_final[$i]);
        
    }
}



//echo $participantes[$rand_keys];



/*
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $file = fopen('log/datos-api-ocr'.time().'.txt','w');
    fwrite( $file ,  $message );
    fwrite($file, ' -API DATOS RECIBIDOS - ');
    $obj = json_decode($message);
    fwrite( $file ,  $obj );
    fwrite($file, ' \n-API FIN - ');

    
    include_once 'opendb.php';
    $test .= " luego al include ";
    $file = fopen('logFacturas.txt','w');
    fwrite($file, '  Inicio de registros:  ');
    $existente ='';
    $usuario_id = "";
    $location ="N/A";
    
    
    
    if( $_SERVER['REQUEST_METHOD'] === 'POST'  && isset($obj->factura)  && isset($obj->fecha) && isset($obj->telefono) && isset($obj->max)  ){
            fwrite($file, '  Factura registrada:  '.$obj->factura);
            //echo $obj->factura;
            $real_phone = substr($obj->telefono,3);
            //echo " - ";
            //echo $real_phone;
            
            $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
            $query_select_usuario = "SELECT * FROM  pasaporte_usuarios WHERE telefono ='".$real_phone."' ;"; 
            if( $resulted_usuarios= $conn->query( $query_select_usuario ) ){
                if($resulted_usuarios->num_rows > 0){
                     while($row_usuarios = $resulted_usuarios->fetch_assoc()) {  
                        // echo $row_usuarios['id'];
                         $usuario_id= $row_usuarios['id'];
                     }
                    
                }else{
                    echo "NO EXISTE USUARIO";
                }
            }else{
                echo "error de query usuarios";
                //echo $query_select_usuario;
            }
            
            if($usuario_id != ''){
                $query_select_facturas = "SELECT * FROM  pasaporte_facturas WHERE numero ='".$obj->factura."' ;"; 
                if( $resulted_facturas= $conn->query( $query_select_facturas ) ){
                    $total_facturas = $resulted_facturas->num_rows;
                    if ($total_facturas > 0) {
                        $existente = "OK";
                        echo "EXISTE";
                    }
                    else{
                        //echo "NO EXISTE";
                    }
                }
            }
            
             if($existente ==''){
                //echo $_GET['addNumero'];
                $query_insert_nivel = "INSERT INTO pasaporte_facturas (usuario_id,fecha,total,numero,foto) VALUES (".$usuario_id.",'".date("Y-m-d h:i:s", strtotime($obj->fecha))."','".$obj->max."','".$obj->factura."','". $obj->urlFactura."');";
                fwrite($file, $query_insert_nivel);
                if( $resulted_nivel= $conn->query( $query_insert_nivel ) ){
                      //header("Location: niveles.php");
                      $test .= " entra DB ";
                      echo "GUARDADO";
                      
                }
                else{
                    $sirve_nivel ="NO ENTRO BIEN A INSERT";
                     $sirve_nivel .= $query_insert_nivel;
                     $test .= " NO entra DB ";
                }
            }
            $conn -> close();
            

    }
 
}

*/