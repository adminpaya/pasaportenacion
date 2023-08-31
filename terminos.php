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
    <title>Términos y condiciones -  Pasaporte NACION</title>
    
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
    <div class="body_container">
        
        <!--Imagenes de foto-->
        <div class="container-left-login">
            <!--
            <img src="logopasaporte.png" width= "400px" height="250px"/>
            -->
            <img src="logopasaporte.png" />
             <p>
         
               <h2 style="color: white;">TÉRMINOS Y CONDICIONES</h2>
               <h3 style="color: white;">REGLAMENTACIÓN</h2>
             </p>
             <p>
            
   
                 <div class="terminos">
                     
                 <h5>
                     <p>
                        <ol>	<li>Para participar en la promoción, se debe registrar la factura de compra por un mínimo de Cincuenta Dólares Americanos (USD$50.00) en www.nacionsushi.com/pasaportenacion. Cuantas más facturas registre, más oportunidades tendrá de ganar.</li>
                                <li>El monto mínimo de Cincuenta Dólares (USD$50.00) por compra no incluye propina ni ITBMS y se basa en el subtotal de la factura.</li>
                                <li>La promoción es válida para compras realizadas en todos nuestros establecimientos en la República de Panamá. Aplica únicamente para consumo en el Restaurante, no aplica para Delivery ni Pick-Up.</li>
                                <li>El cliente está participando desde el primer registro de factura en la web que cumpla con los requisitos.</li>
                                <li>Solo se registrarán facturas emitidas del 1 de septiembre al 30 de octubre de 2023. Para hacer efectivo su premio, el cliente debe estar registrado en www.nacionsushi.com/pasaportenacion. El último día para registrarse en la página web será el día uno (30) de octubre del año dos mil veintitrés (2023).</li>
                                <li>El premio consiste en un viaje para dos (2) personas a Medellín – Colombia e incluye boletos de avión en clase económica, traslado aeropuerto-hotel-aeropuerto en Medellín, alojamiento por tres (3) días para dos (2) personas, Quinientos Dólares Americanos (USD$500.00) en efectivo al ganador y una experiencia de cena para dos (2) personas en Nacionsushi Medellín.</li>
                                <li>El premio es válido para viajar en clase económica. Si el ganador desea actualizar a una clase superior, podrá hacerlo al momento de realizar la reserva y deberá asumir todos los costos adicionales.</li>
                                <li>El premio debe ser utilizado para viajar del primero (1) de noviembre al treinta y uno (31) de diciembre de dos mil veintitrés (2023). Si no se utiliza durante el período especificado perderá su validez. </li>
                                <li>El premio no es reembolsable, transferible, ni endosable.</li>
                                <li>Se requiere que el ganador y su acompañante tengan un pasaporte con una vigencia mínima de 6 meses antes de la fecha de finalización del viaje y cuente con visa para entrar a Colombia, en caso tal su nacionalidad lo requiera. El número máximo de personas por habitación es de dos (2).</li>
                                <li>La promoción solo es aplicable para mayores de dieciocho (18) años.</li>
                                <li>Al participar en la promoción, el ganador otorga permiso a Nacionsushi para grabar y transmitir su experiencia en las redes sociales, el sitio web de Nacionsushi y, en fin, cualquier sitio publicitario. Además, se realizará una experiencia grabada de lo vivido con el premio. El ganador al aceptar el premio renuncia a cualquier cobro de derechos de imagen por este concepto.</li>
                                <li>El sorteo se llevará a cabo el martes 31 de octubre a las 3:00 P.M. de manera online y será transmitido a través de la cuenta de Instagram de @nacionsushi.</li>
                                <li>El participante debe tener un número de teléfono en la República de Panamá. </li>
                                <li>El ganador del premio será contactado vía telefónica al momento de realizar la tombola, sino contesta luego del tercer llamado, se efectuará un nuevo sorteo para las mismas circunstancias, hasta que alguien conteste.   </li>
                                <li>No podrán participar los empleados de los restaurantes NACIONSUSHI, ni del franquiciante MADE IN JAPAN, S.A.</li>
                                <li>El ganador deberá ponerse en contacto con la agencia de viaje junto con su cédula de identidad personal y pasaporte vigente con al menos seis (6) meses de vigencia para poder coordinar todo el viaje.</li>
                                <li>Los gastos de movilización al y desde el aeropuerto en la República de Panamá no están incluidos.</li>
                                <li>La empresa Nacionsushi y el franquiciante Made In Japan, S.A., no se hacen responsables de ningún asunto migratorio, robo, temas de salud y cualquier accidente o perjuicio que puedan sufrir como consecuencia del uso o disfrute del bien, servicios u obligaciones, derivados de la redención del premio.</li>
                                <li>No aplica con otras promociones o descuentos.</li>
                        </ol>
                    </p>
                    <p>Aprobado por la JCJ, mediante resolución No. MEF-RES-2023-2200 del  21 de agosto 2023.</p>
                <br>


                 </h5>
                 </div>
            <a href='index.php'><h2 style="color: white;">REGRESAR...</h2></a>
             </p>
        </div>
  
        
        <!--Tarjeta de Login-->
        <div class="container">
            
        </div>
        
        
<!--        
    </div>
 <div class="bottom-footer">
        <div>
        software de fidelización creado por Pa Yá
        <img src="paya.png" width="30px" height="15px"/>
        <div>
 </div>
 -->
</body>

</html>
