<?php
$test = " entra PHP ";
$resultado = "Sin resultado - ";
include_once 'opendb.php';
session_start();
$updated ="NO";
$phone= 'OK';
$query='Empty';

$error ='';

$resultado .= $_POST['name'];

if( $_SERVER['REQUEST_METHOD'] === 'POST'   && !isset($_POST['txtUser'])  ){
        $resultado .= " SI ENTRO a POST ";
        $resultado .= $_POST['txtUser'];
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);
        //$query_update_producto = "UPDATE productos_nacion_externo SET nombre='".$_POST['nombre']."', precio='".$_POST['precio']."', inventario='".$_POST['inventario']."' WHERE id=".$_POST['identificador'].";"; 
        $query_select_usuario = "SELECT * FROM  pasaporte_usuarios WHERE nombre ='".$_POST['name']."' AND  contrasena ='".$_POST['password']."' ;"; 
        $resultado .=  $query_select_usuario;
        $resultado .= $_POST['txtUser'];
        if( $resulted_select= $conn->query( $query_select_usuario ) ){
               if ($resulted_select->num_rows > 0) {
                        while($row_desglose = $resulted_select->fetch_assoc()) {  
                              $resultado= "Se actualizo correctamente!";
                              $_SESSION['user_nombre']       = $row_desglose['nombre'];
                              $_SESSION['user_telefono']     = $row_desglose['telefono'];
                              $_SESSION['user_email']        = $row_desglose['email'];
                              $_SESSION['user_id']           = $row_desglose['id'];
                              header("Location: pasaporte.php");
                              exit();
                        }
                      
                   
               }
               else{
                   $error =' El usuario o contraseña no existe ';
               }
            
            
        }
        else{
              $resultado= "NO actualizo correctamente!";
        }
        
        $conn -> close();
        $updated = "SI";
}
else{
      $resultado .= " NO ENTRO a POST ";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qué es Pasaporte NACION</title>
    
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
   
    <div class="top_bar">
      <p>
        <button    onclick="window.location.href='nacion.php';" >¿QUÉ ES PASAPORTE NACION?</button><button   onclick="window.location.href='terminos.php';"  >TÉRMINOS Y CONDICIONES</button>
      </p>
      <img src="nacionblanco.png" />
    </div>
    <div class="footer">
        <img src="pasaporte.png" width= "300px" height="300px"/>
        <img src="maleta.png" width= "350px" height="350px"/>
    </div>  

    <div class="body_container">
     
        <!--Imagenes de foto-->
        <div class="container-left-login">
            <!--
            <img src="logopasaporte.png" width= "400px" height="250px"/>
            -->
            
            <img src="logopasaporte.png" />
             <p>
         
               <h2 style="color: white;">¿QUÉ ES PASAPORTE NACION?</h2>
             </p>
             <p>
                  
   
   
                 <div class="nacion">
                     
                 <h5>
                   ¡Bienvenidos a Pasaporte Nacion! 
Prepárate para embarcarte en un viaje culinario que comienza en la ciudad de Medellín, Colombia con todos los gastos para ti y un acompañante + US $500 en efectivo. 

¿Cómo participas?
1.Realiza una compra mínima de US $50 en cualquiera de nuestros establecimientos en Panamá. 
2.Registra tu factura en: www.nacionsushi/pasaportenacion.com

Una vez te registres, podrás visualizar tus facturas y estarás listo para participar en esta gran aventura.

Aplican términos y condiciones

                 </h5><br>
                  <div style="text-align: center; line-height: .4;">
                  <h7 style="color: white;">¡NO PIERDAS ESTA OPORTUNIDAD DE GANARTE UN VIAJE CON SABORES!</h7>
                  </div>

                 </div>
                
            <a href='index.php'><h2 style="color: white;">REGRESAR...</h2></a>
             </p>
        </div>
 
        <!--Tarjeta de Login-->
        <div class="container">
            
        </div>
        
        
     
  
    </div>
<!--
 <div class="bottom-footer">
        <div>
        software de fidelización creado por Pa Yá
        <img src="paya.png" width="30px" height="15px"/>
        <div>
 </div>  
 -->
</body>

</html>
