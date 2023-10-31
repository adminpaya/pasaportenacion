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
        
        $username= $_POST['name'];
        $password= $_POST['password'];
        
        $username = stripcslashes($username);
        $password = stripcslashes($password);
        
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        
        $query_select_usuario = "SELECT * FROM  pasaporte_usuarios WHERE nombre ='".$username."' AND  contrasena ='".$password."' ;"; 
        
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
                              $_SESSION['user_tipo']         = $row_desglose['tipo'];
                              $_SESSION['user_foto']         = $row_desglose['perfil'];
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
    <title>Registro Pasaporte NACION</title>
    
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles_animations.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">		<!-- Google tag (gtag.js) --><script async src="https://www.googletagmanager.com/gtag/js?id=G-YL475TZGJC"></script><script>  window.dataLayer = window.dataLayer || [];  function gtag(){dataLayer.push(arguments);}  gtag('js', new Date());  gtag('config', 'G-YL475TZGJC');</script>
</head>

<body>
    
    
    <div id="whatsapp">
    <div id="toggle1" class="wtsapp">
        <!--<i class="fa fa-whatsapp"   onclick="ShowmodalWinnerDialog()" >  -->
        <a href="https://wa.me/68168297" target="_blank" id="toggle1" class="wtsapp">
            <i class="fa fa-whatsapp" ></i>
        </a>
        <!--</i>  -->
    </div>
    </div>
    
    
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
            <img  src="logopasaporte.png" />
             <p>
               <h1>¡GÁNATE UN VIAJE PARA DOS<br>A MEDELLÍN COLOMBIA!</h1>
               <!-- <h1>A MEDELLÍN COLOMBIA!</h1> -->
             </p>
             <p>
                 <!--
                 <h3>Primera parada:</h3>
                 <h4>MEDELLÍN, COLOMBIA</h4>
                 -->
                 <div class="instrucciones">
                     
                 <h5>
                     1. Realiza una compra mínima de US $50.<br>
                     2. Registra tu usuario y factura.<br>
                     3. Estás participando en una tómbola electrónica que te lleva a Medellín a ti y un acompañante con todos los gastos pagos + US $500 en efectivo.<br>
                 </h5>
                 </div>
            
             </p>
        </div>
        
        <div class="middle">
            <img src="medellin-avion.png" width= "220px" height="180px"/>
        </div>
        
        <!--Tarjeta de Login-->
        <div class="container">
            <div class="card">
    			<div class="top-row "> <img src="NacionSushiRound.png" width= "100px" height="100px"/> </div>
    			
    			<div class="content">
    				
    				<h1>PASAPORTE NACION</h1>
    				<?php echo $error; ?>
    				<form method="POST"   action="index.php">
    				<p>Usuario</p>
                    <input type="text" name="name" id="name" class="text" >
                    <p>Contraseña</p>
                    <input type="password" name="password" id="password" class="text" >
                    <p></p>
                    <input class= "button background-top-row" type="submit" value="Entrar">
                    <?php
    					if(  !isset($_GET['reg'])    ){
    					    echo "<p>¿No tienes un usuario? <a   href=\"registro.php\">Regístrate aquí.</a></p>";
    					}
    				?>
    				<p><a href="reset.php">¿Olvidaste tus datos? Haz click acá</a></p>
    				</form>
    				
    				
    					<!--
    				
    							<form method="POST" action="index.php">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name">
    
      <label for="email">Email:</label>
      <input type="email" name="email" id="email">
    
      <input type="submit" value="Submit">
    </form>
    				-->	
    		<!--		
    				<form    method='post' action='index.php'>
    				<p>usuario</p>
        			<input type="text"  name="textUser" id="textUser" class="text">
    				<p>contraseña</p>
    				<input type="password" name="textPassword" id="textPassword" class="text">
    				<div class="button-container">
    				<input  class= "button" type="submit" value="Entrar">
    					<?php
    					if(  !isset($_GET['reg'])    ){
    					    //echo "<a  class= \"button\" href=\"registro.php\">Registrese</a>";
    					}
    					?>
    				</form>
    				</div>
    					-->
    			</div>
    			
    
    			
    			
    			<div class= "networks">
    				<a  href="https://www.instagram.com/nacionsushi/" target="_blank"><i class= "fa fa-instagram" aria-hidden="true" ></i></a>
    				<a  href="https://www.facebook.com/nacionsushipanama/?locale=es_LA" target="_blank"><i class= "fa fa-facebook" aria-hidden="true"></i></a>
    				
    			</div>
    			
                
            </div>
        </div>
        
        
        
    </div>
    <!--Tarjeta de Bottom-->
    <div class="container-down">
           
            
                 <h3>Primera parada:</h3>
                 <h4>MEDELLÍN, COLOMBIA</h4>
                 <div class="instrucciones_down">
                     
                 <h5>
                     1. Realiza una compra mínima de $50<br>
                     2. Registra tu usuario y factura<br>
                     3. Estás participando en una tómbola electrónica que te lleva a Medellín a ti y un acompañante con todos los gastos pagos + 500 en efectivo.<br>
                 </h5>
                 <br><br>
                 </div>
            
             
    </div>
    
     <div class="bottom-footer">
        <div>
        Aprobado por la JCJ, mediante resolución No. MEF-RES-2023-2200 del 21 de agosto 2023.
        <div>
    </div>
    
</body>

</html>
