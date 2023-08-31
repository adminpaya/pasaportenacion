<?php

$test = " entra PHP ";

$resultado = "";

include_once 'opendb.php';

$updated ="NO";

$phone= 'OK';

$query='Empty';

if(isset($_POST['addTelefono'])){

$phone= $_POST['addTelefono'];

$mensaje_enviar = "Este telefono no existe en nuestros sistema, registrate en: https://nacionsushi.com/pasaportenacion/ ";

}



if( $_SERVER['REQUEST_METHOD'] == 'POST'   &&  isset($_POST['addTelefono']) ){

    

     $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

     

     $now =  date('Y-m-d H:i:s');

     $time   = strtotime($now);

     $time   = $time - (60*60*5); //one hour

     $beforeFiveHour = date("Y-m-d H:i:s", $time);

     

     $telefono= $_POST['addTelefono'];

     $telefono = stripcslashes($telefono);

     $phone = mysqli_real_escape_string($conn, $telefono);

     $query_select_usuario = "SELECT * FROM  pasaporte_usuarios WHERE telefono ='".$phone."' ;"; 

     if( $resulted_select= $conn->query( $query_select_usuario ) ){

               if ( ($resulted_select->num_rows > 0) ) {

                   $token = openssl_random_pseudo_bytes(4);

                   //Convert the binary data into hexadecimal representation.

                   $token = bin2hex($token);

                   $mensaje_enviar = "Para recuperar tu cuenta haz click en este link: https://nacionsushi.com/pasaportenacion/reset.php?tok=".$token;

                   $query_insert_token = "INSERT INTO  pasaporte_token (token, time, telefono) VALUES ('$token','".$beforeFiveHour."','".$phone."') ;"; 

                   if( $resulted_token= $conn->query( $query_insert_token ) ){

                       

                   }

               }

         

     }

     

    $phone = $phone. " - " .$query_select_usuario;  

    // date("Y-m-d H:i:s")

    //  ".date("H",strtotime('-5 hours')).

    /*

    $now =  date('Y-m-d H:i:s');

    $time   = strtotime($now);

    $time   = $time - (60*60*5); //one hour

    $beforeFiveHour = date("Y-m-d H:i:s", $time);

    */

    //$query = "INSERT INTO  control_log (cuenta,fecha) VALUES  ('".$obj->modulo."','".$beforeFiveHour."');";

    

    

    $telefono = "507".$_POST['addTelefono'];

    

    

    

    

    

    $curl = curl_init();

    curl_setopt_array($curl, array(

    CURLOPT_URL => 'https://bot.pidepaya.com/pasaporte',

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_ENCODING => '',

    CURLOPT_MAXREDIRS => 10,

    CURLOPT_TIMEOUT => 0,

    CURLOPT_FOLLOWLOCATION => true,

    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

    CURLOPT_CUSTOMREQUEST => 'POST',

    CURLOPT_POSTFIELDS =>'{

        "Phone": '.$telefono.',

        "Message": "'.$mensaje_enviar.'"

    }',

    CURLOPT_HTTPHEADER => array(

        'Content-Type: application/json'

      ),

    ));

    $response = curl_exec($curl);

    curl_close($curl);

    header("Location: index.php");

    exit();

}



if( $_SERVER['REQUEST_METHOD'] == 'POST'   && isset($_POST['addPassword2']) && isset($_POST['addPassword']) && isset($_GET['tok']) ){

        $resultado .="Entramos al POST";

     

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

        $token= $_GET['tok'];

        $token= stripcslashes($token);

        $token = mysqli_real_escape_string($conn, $token);

        

        $query_select_token = "SELECT * FROM  pasaporte_token WHERE token ='".$token."' ;"; 

        if( $resulted_select_token = $conn->query( $query_select_token ) ){

              if ( ($resulted_select_token->num_rows > 0) ) {

                   while($row_token = $resulted_select_token->fetch_assoc()) {

                       $telefono_reset = $row_token['telefono'];

                       $resultado .="  Encontramos el telefono ";

                       break;

                   }  

                  

              }else{

                  $resultado .="  NO Encontramos el telefono ";

              }

        }

        $password= $_POST['addPassword'];

        $password2= $_POST['addPassword2'];

        

        $password  = stripcslashes($password);

        $password2 = stripcslashes($password2);

        

        $password = mysqli_real_escape_string($conn, $password);

        $password2 = mysqli_real_escape_string($conn, $password2);

        



        if( $_POST['addPassword'] != $_POST['addPassword2'] ){

            

            $resultado = "Las contraseñas no coinciden";

        }

        

        else{

          

            //$query_update_producto = "UPDATE productos_nacion_externo SET nombre='".$_POST['nombre']."', precio='".$_POST['precio']."', inventario='".$_POST['inventario']."' WHERE id=".$_POST['identificador'].";"; 

            $query_update_usuario = "UPDATE pasaporte_usuarios SET contrasena = '".$password."' WHERE telefono = '".$telefono_reset."';"; 

            $query =  $query_update_usuario;

            if( $resulted_update= $conn->query( $query_update_usuario ) ){

                  $resultado= "OK";

                  //header("Location: index.php?reg=1");

                  //exit();

            }

            else{

                  $resultado= "OCURRIO un error inténtalo de nuevo!";

            }

            

           

            $updated = "SI";

        }

        $conn -> close();

    

}







?>





<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro PASAPORTE NACION</title>

    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    

    

    	<style>

        

        

         /*    DIALOG MODAL        */  

          #dialogBox::backdrop {

            opacity: .3;

            background-color: rgb(25, 25, 170);

            backdrop-filter: blur(5px);

          }

          #dialogBox {

             

             border-radius: 1rem;

             box-shadow: 0 1rem 1rem rgba(0,0,0,0.2);

             background-color: rgba(255,255,255,0.2);

             backdrop-filter: blur(1rem);

             color: #ffffff;

             display:bock;

             padding: 12px 32px;

             width:500px;

             margin:auto;

     

          }

          #dialogBox header {

            display: flex;

            align-items: center;

            justify-content: space-between;

          }

          #deleteButton {

            background-color: red;

            border: none;

            color: white;

            padding: 12px 32px;

            font-size: 16px;

            margin: 4px 2px;

            cursor: pointer;

          }

          #closeDialogFooter {

            background-color: gray;

            border: none;

            color: white;

            padding: 12px 32px;

            font-size: 16px;

            margin: 4px 2px;

            cursor: pointer;

          }

          

           #imgBox::backdrop {

            opacity: .3;

            background-color: rgb(25, 25, 170);

            backdrop-filter: blur(5px);

          }

          #imgBox {

             

             border-radius: 1rem;

             box-shadow: 0 1rem 1rem rgba(0,0,0,0.2);

             background-color: rgba(255,255,255,0.2);

             backdrop-filter: blur(1rem);

             color: #ffffff;

             display:bock;

             padding: 12px 32px;

             width:50%;

             margin:auto;

     

          }

          #imgBox header {

            display: flex;

            align-items: center;

            justify-content: space-between;

          }

          #dialog_content_img {

            display: flex;

            align-items: center;

            justify-content: center;

          }

          #imgButton {

            background-color: red;

            border: none;

            color: white;

            padding: 12px 32px;

            font-size: 16px;

            margin: 4px 2px;

            cursor: pointer;

          }

          #imgDialogFooter {

            background-color: gray;

            border: none;

            color: white;

            padding: 12px 32px;

            font-size: 16px;

            margin: 4px 2px;

            cursor: pointer;

          }

        /*    DIALOG MODAL        */  

        

        

        body {font-family: Arial, Helvetica, sans-serif;}

        

        /* Center the loader */

         #loader {

            

          position: fixed;

          

          left: 50%;

          top: 50%;

          z-index: 1;

          width: 200px;

          height: 200px;

          margin: -76px 0 0 -76px;

          border: 16px solid #f3f3f3;

          border-radius: 50%;

          border-top: 16px solid #3498db;

          -webkit-animation: spin 2s linear infinite;

          animation: spin 2s linear infinite;

        }

        

        @-webkit-keyframes spin {

          0% { -webkit-transform: rotate(0deg); }

          100% { -webkit-transform: rotate(360deg); }

        }

        

        @keyframes spin {

          0% { transform: rotate(0deg); }

          100% { transform: rotate(360deg); }

        }

        

        /* Add animation to "page content" */

        .animate-bottom {

          position: relative;

          -webkit-animation-name: animatebottom;

          -webkit-animation-duration: 1s;

          animation-name: animatebottom;

          animation-duration: 1s

        }

        

        @-webkit-keyframes animatebottom {

          from { bottom:-100px; opacity:0 } 

          to { bottom:0px; opacity:1 }

        }

        

        @keyframes animatebottom { 

          from{ bottom:-100px; opacity:0 } 

          to{ bottom:0; opacity:1 }

        }



        

        

        #myImg {

          border-radius: 5px;

          cursor: pointer;

          transition: 0.3s;

        }

        

        #myImg:hover {opacity: 0.7;}

        

        .right_fac {

          float: right;

          width: 300px;

          border: 3px solid #73AD21;

          padding: 10px;

        }

        .left_fac {

          float: left;

          width: 300px;

          border: 3px solid #73AD21;

          padding: 10px;

        }

        

        /* The Modal (background) */

        .modal {

          display: none; /* Hidden by default */

          position: fixed; /* Stay in place */

          z-index: 1; /* Sit on top */

          padding-top: 100px; /* Location of the box */

          left: 0;

          top: 0;

          width: 100%; /* Full width */

          height: 100%; /* Full height */

          overflow: auto; /* Enable scroll if needed */

          background-color: rgb(0,0,0); /* Fallback color */

          background-color: rgba(0,0,0,0.9); /* Black w/ opacity */

        }

        

        /* Modal Content (image) */

        .modal-content {

          margin: auto;

          display: block;

          width: 80%;

          max-width: 700px;

        }

        

        /* Caption of Modal Image */

        #caption {

          margin: auto;

          display: block;

          width: 80%;

          max-width: 700px;

          text-align: center;

          color: #ccc;

          padding: 10px 0;

          height: 150px;

        }

        

        /* Add Animation */

        .modal-content, #caption {  

          -webkit-animation-name: zoom;

          -webkit-animation-duration: 0.6s;

          animation-name: zoom;

          animation-duration: 0.6s;

        }

        

        @-webkit-keyframes zoom {

          from {-webkit-transform:scale(0)} 

          to {-webkit-transform:scale(1)}

        }

        

        @keyframes zoom {

          from {transform:scale(0)} 

          to {transform:scale(1)}

        }

        

        /* The Close Button */

        .close {

          position: absolute;

          top: 15px;

          right: 35px;

          color: #f1f1f1;

          font-size: 40px;

          font-weight: bold;

          transition: 0.3s;

        }

        

        .close:hover,

        .close:focus {

          color: #bbb;

          text-decoration: none;

          cursor: pointer;

        }

        

        /* 100% Image Width on Smaller Screens */

        @media only screen and (max-width: 900px){

              .modal {

          display: none; /* Hidden by default */

          position: fixed; /* Stay in place */

          z-index: 1; /* Sit on top */

          padding-top: 100px; /* Location of the box */

          left: 0;

          top: 0;

          width: 100vw; /* Full width */

          height: 100%; /* Full height */

            overflow: hidden;

        overflow: auto; /* Enable scroll if needed */

          background-color: rgb(0,0,0); /* Fallback color */

          background-color: rgba(0,0,0,0.9); /* Black w/ opacity */

        }

            

        .modal-content {

            width: 300px;

        }

        

     

        

      

  

}

    </style>

    

    

</head>

<?php

/*

echo "test: ";

echo $phone;

echo "resultado: ";

echo $query;

*/

?>

<body>

    

     <dialog id="dialogBox" data-modal-edit-factura >

      <header>

        <h2 style="text-align: center;" class="header">IMPORTANTE:</h2>

        <!--<button onclick="closeDialog()" id="closeDialogHeader">&#x2716</button>-->

      </header>

        <!--<button data-close-modal>CERRAR</button>-->

      <section>

        <div id="dialog_edit_content">  

       

        </div>

      </section>

      <footer>

        <button data-close-modal-edit class= 'button'>CERRAR</button>

      </footer>

    </dialog>

    

    



    

    

    

    

    <div class="container">

        <div class="card-registro">

			<div class="top-row">  </div>

			<div class="content">

				<h2 style="color:red;" ><?php echo $resultado; ?></h2>

			

				    

				<?php 

				//echo $phone;

				echo $resultado;

			    if(isset($_GET['tok'])){

			    ?>

			    

				<form   method='post' action='<?php echo $_SERVER['PHP_SELF']."?tok=".$_GET['tok'];?>' >

				    <h2>COLOCA TU NUEVA CONTRASEÑA</h2>

				<p>contraseña</p>

				<input type="password" name="addPassword" id="addPassword" class="text">

				<p> repetir contraseña</p>

				<input type="password" name="addPassword2" id="addPassword2" class="text">

				<?php

			    } else{

			    ?>

			    

				<form   method='post' action='<?php echo $_SERVER['PHP_SELF'];?>' >

				    <h2>COLOCA TU TELÉFONO </h2>

				<p>teléfono</p>

				<input type="text" name="addTelefono" id="addTelefono" class="text">

			    <?php

			    }

			    ?>

				<p></p>

				<input  class= "button" type="submit" value="Reiniciar contraseña">

				<p><a   href="index.php" >Regresar</a></p>

				</form>

				

			</div>

			



            

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

    

    <script type='text/javascript'>

    var data_close_modal_edit = document.querySelector("[data-close-modal-edit]");

    var dialog_modal_edit_factura = document.querySelector("[data-modal-edit-factura]");

    

    data_close_modal_edit.onclick = () => { 

      console.log('close modal');    

      dialog_modal_edit_factura.close();

      window.location.href = 'index.php?reg=1';

    }

    

    const ShowmodalWinnerDialog  = () => {

         var captionTextEdit = document.getElementById("dialog_edit_content");

         let innHTML = ''; 

         innHTML = "<div    id='factura_ganador'     style ='display : none' ><h1>Te has registrado correctamente, debe llegarte un mensaje a tu telefono para concluir tu registro satisfactoriamente </h1></div>";

         innHTML += "<div  id='consulta_ganador'  style=\"text-align: center;\"><h1><p><i class=\"fa fa-exclamation-triangle\" style=\"font-size:80px\"></i></p> Te has registrado correctamente, debe llegarte un mensaje a tu telefono para concluir tu registro satisfactoriamente <br></h1><br></div>";

         captionTextEdit.innerHTML = innHTML;

         dialog_modal_edit_factura.showModal();

         SendMessage();

    }

    

    

     const SendMessage  = () => {

        /*

        var anuncio = document.getElementById("factura_ganador");

        var label_anuncio = document.getElementById("consulta_ganador");

        anuncio.style.display = "block";

        label_anuncio.style.display = "none";

        */

        //".$_POST['addTelefono']."

        var data = new FormData();

        

        data.append('Phone', '67784790');

        data.append('Message', 'Registro Exitoso');

        

        var peticion = new XMLHttpRequest();

    

        peticion.addEventListener("readystatechange", function () {

           if (this.readyState === 4) {

               //anuncio.innerHTML= "<div  id='factura_ganador' ><h1>Factura Ganadora: "+this.responseText+" </h1></div>";

           }

        });

        peticion.open("POST", "https://bot.pidepaya.com/pasaporte",true);

        peticion.setRequestHeader('Content-type', 'application/json');

        peticion.onload = function () {

        };     

        peticion.send(data);

               

        

        

    }

    

      

    </script>

    <?php

    if( $_SERVER['REQUEST_METHOD'] == 'POST'  && $resultado =="OK"){

        $telefono = "507".$_POST['addTelefono'];

        $curl = curl_init();

        curl_setopt_array($curl, array(

          CURLOPT_URL => 'https://bot.pidepaya.com/pasaporte',

          CURLOPT_RETURNTRANSFER => true,

          CURLOPT_ENCODING => '',

          CURLOPT_MAXREDIRS => 10,

          CURLOPT_TIMEOUT => 0,

          CURLOPT_FOLLOWLOCATION => true,

          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

          CURLOPT_CUSTOMREQUEST => 'POST',

          CURLOPT_POSTFIELDS =>'{

            "Phone": '.$telefono.',

            "Message": "Su telefono se registro correctamente"

        }',

          CURLOPT_HTTPHEADER => array(

            'Content-Type: application/json'

          ),

        ));

        

        $response = curl_exec($curl);

        

        curl_close($curl);

        

        

        if($response =="Número en WhatsApp, enviando mensaje"){

            $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

   

            $query_update_usuario = "UPDATE pasaporte_usuarios SET estado = 'OK'  WHERE telefono='".$_POST['addTelefono']."';"; 



            if( $resulted_insert= $conn->query( $query_update_usuario ) ){

                  $resultado= "OK";

            }

            else{

                  $resultado= "NO actualizo correctamente!";

            }

            

            $conn -> close();

        } else {

            $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

   

            $query_update_usuario = "UPDATE pasaporte_usuarios SET estado = 'FAIL'  WHERE telefono='".$_POST['addTelefono']."';"; 



            if( $resulted_insert= $conn->query( $query_update_usuario ) ){

                  $resultado= "OK";

            }

            else{

                  $resultado= "NO actualizo correctamente!";

            }

            

            $conn -> close();

        }

        

    ?>

    } 

    <script type='text/javascript'>

            ShowmodalWinnerDialog();

    </script>

    <?php

    }

    ?>

    

   

</body>



</html>