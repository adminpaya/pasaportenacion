<?php
header('Content-Type: application/json');
$total_facturas_user ='0';


$message = file_get_contents('php://input'); 



if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $file = fopen('log/datos-api-ocr'.time().'.txt','w');
    fwrite( $file ,  $message );
    fwrite($file, ' -API DATOS RECIBIDOS - ');
    $obj = json_decode($message);
    fwrite( $file ,  $obj );
    

    
    include_once 'opendb.php';
    $test .= " luego al include ";
    $file = fopen('logFacturas.txt','w');
    fwrite($file, '  Inicio de registros:  ');
    $existente ='';
    $usuario_id = "";
    $location ="N/A";
    
    
    
    if( $_SERVER['REQUEST_METHOD'] === 'POST'  && isset($obj->factura)  && isset($obj->fecha) && isset($obj->telefono) && isset($obj->max)  ){
            fwrite($file, '  Factura registrada:  '.$obj->factura);
           
           // $real_phone = substr($obj->telefono,3);
            $real_phone = $obj->telefono;
            
            if( substr($obj->telefono,0,3) == "507"  ){
                $real_phone = substr($obj->telefono,3);
            }
            
 
            
            $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
            $query_select_usuario = "SELECT * FROM  pasaporte_usuarios WHERE telefono ='".$real_phone."' ;"; 
            if( $resulted_usuarios= $conn->query( $query_select_usuario ) ){
                if($resulted_usuarios->num_rows > 0){
                     while($row_usuarios = $resulted_usuarios->fetch_assoc()) {  
                        // echo $row_usuarios['id'];
                         $usuario_id= $row_usuarios['id'];
                         fwrite($file, ' el query no encontro:  '. $query_select_usuario);
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
                        echo "EXISTE-";
                        $connex = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
                        $query_select_facturas_user = "SELECT * FROM  pasaporte_facturas WHERE usuario_id ='".$usuario_id."' ;"; 
                        if( $resulted_puntos= $connex->query( $query_select_facturas_user ) ){
                             $total_facturas_user = $resulted_puntos->num_rows;
                        }
                        echo $total_facturas_user;
                        $connex -> close();
                        exit();
                    }
                    else{
                        //echo "NO EXISTE";
                    }
                }
            }
            
             if($existente ==''  && $obj->max > 50){
                //echo $_GET['addNumero'];
                $query_insert_nivel = "INSERT INTO pasaporte_facturas (usuario_id,fecha,total,numero,foto) VALUES (".$usuario_id.",'".date("Y-m-d h:i:s", strtotime($obj->fecha))."','".$obj->max."','".$obj->factura."','". $obj->urlFactura."');";
                fwrite($file, $query_insert_nivel);
                if( $resulted_nivel= $conn->query( $query_insert_nivel ) ){
                      //header("Location: niveles.php");
                      $test .= " entra DB ";
                      echo "GUARDADO-";
                      $connex = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
                      $query_select_facturas_user = "SELECT * FROM  pasaporte_facturas WHERE usuario_id ='".$usuario_id."' ;"; 
                      if( $resulted_puntos= $connex->query( $query_select_facturas_user ) ){
                           $total_facturas_user = $resulted_puntos->num_rows;
                          
                            
                      }
                      echo $total_facturas_user;
                      $connex -> close();
                      
                }
                else{
                    $sirve_nivel ="NO ENTRO BIEN A INSERT";
                     $sirve_nivel .= $query_insert_nivel;
                     $test .= " NO entra DB ";
                }
            }
            $conn -> close();
            
        
    } elseif( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($obj->telefono) )  {
        
            $real_phone = $obj->telefono;
             $real_phone = $obj->telefono;
            
            if( substr($obj->telefono,0,3) == "507"  ){
                $real_phone = substr($obj->telefono,3);
            }
            
            
            $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
            $query_select_usuario = "SELECT * FROM  pasaporte_usuarios WHERE telefono ='".$real_phone."' ;"; 
            if( $resulted_usuarios= $conn->query( $query_select_usuario ) ){
                if($resulted_usuarios->num_rows > 0){
                     while($row_usuarios = $resulted_usuarios->fetch_assoc()) {  
                        // echo $row_usuarios['id'];
                         $usuario_id= $row_usuarios['id'];
                         fwrite($file, ' el query no encontro:  '. $query_select_usuario);
                     }
                    
                }else{
                    echo "NO EXISTE USUARIO ";
                }
            }else{
                echo "error de query usuarios";
                //echo $query_select_usuario;
            }
 
            $connex = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
            $query_select_facturas_user = "SELECT * FROM  pasaporte_facturas WHERE usuario_id ='".$usuario_id."' ;"; 
            if( $resulted_puntos= $connex->query( $query_select_facturas_user ) ){
                $total_facturas_user = $resulted_puntos->num_rows;
            }
            echo "PUNTOS -";
            echo $total_facturas_user;
            $connex -> close();
            $conn -> close();
        
    }
    
 
}