<?php

include_once 'opendb.php';

session_start();

if( !isset($_SESSION['user_nombre'])  ){

     

      header("location: index.php");

      die();

    

}



$username = $_SESSION['user_nombre'];

$telefono= $_SESSION['user_telefono'];

$id=       $_SESSION['user_id'];

$tipo=       $_SESSION['user_tipo'];

$foto =    $_SESSION['user_foto'];



if( $tipo == 'admin'  ){

     

      header("location: panel.php");

      die();

    

}



if( isset($_GET['ses'])   ){

     session_destroy();

     header("location: index.php");

     die();

}





$api_key = "K86142185888957";





$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

$query_select_usuario = "SELECT * FROM  pasaporte_usuarios WHERE nombre ='".$username."' ;"; 

$resultado .=  $query_select_usuario;

$resultado .= $_POST['txtUser'];

if( $resulted_select= $conn->query( $query_select_usuario ) ){

    if ($resulted_select->num_rows > 0) {

        while($row_desglose = $resulted_select->fetch_assoc()) {  

            $resultado= "Se actualizo correctamente!";

            $puntos = $row_desglose['puntos'];





        }

                          

                       

    }

    else{

                       $error =' El usuario o contraseña no existe ';

    }

}

        else{

              $resultado= "¡NO actualizo correctamente!";

        }

        

        $conn -> close();



?>







<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasaporte - Facturas Acumuladas</title>

    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="styles_animations.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    

    

    

    

    

</head>



<body>

    





    <!--

    <div class="body_container">

    -->

    

    <div id="whatsapp">

    <div id="toggle1" class="wtsapp">

        <!--<i class="fa fa-whatsapp"   onclick="ShowmodalWinnerDialog()" >  -->

        <a href="https://wa.me/68168297" target="_blank" id="toggle1" class="wtsapp">

            <i class="fab fa-whatsapp" ></i>

        </a>

        <!--</i>  -->

    </div>

    </div>

    

    

    <?php 

               if(!isset($_GET['point'])){?>

    <div  id="img-pasaporte-step1" class="img-pasaporte">

            <img src="pasaporte-maleta-stamp.png" width= "800px" height="800px" />

    </div>

    <?php }else{ ?>

    <div  id="img-pasaporte-step1" >

    </div>

    <?php } ?>

    

     <div id="img-pasaporte-step2" class="img-pasaporte" style ="display : none">

            <img src="pasaporte-logo.png" margin-right="15px" width= "500px" height="400px"/>

    </div>

    

    

      <div id="let_me_know" class="alert hide"  style ="display : none" >

         <span class="fas fa-lightbulb"></span>

         <div  id="let_me_know_mgs">

            <span class="msg" >Operacion realizada con EXITO</span>

         </div>

         <div class="close-btn">

            <span class="fas fa-times"></span>

         </div>

      </div>

      

      <div id="let_me_error" class="error hide"  style ="display : none" >

         <span class="fas fa-lightbulb"></span>

         <div  id="let_me_error_mgs">

            <span class="msg" >Ocurrio un ERROR</span>

         </div>

         <div class="close-btn">

            <span class="fas fa-times"></span>

         </div>

      </div>

      

      

    <div class = "modalred  closered"  style ="display : none">

        <div class = "contentred">

          <div class = "header-red">

            <h4>SIGUENOS EN NUESTRAS REDES SOCIALES</h4>

            <span class="close-modal-red">&times</span>

          </div>

          <div class = "body-red">

              

           		<div class= "networks">

           		    <!--<i class="fab fa-instagram"></i>-->

    				<a  href="https://www.instagram.com/nacionsushi/" target="_blank"><i class= "fab fa-instagram" aria-hidden="true" ></i></a>

    				<a  href="https://www.facebook.com/nacionsushipanama/?locale=es_LA" target="_blank"><i class= "fab fa-facebook" aria-hidden="true"></i></a>

    				

    				

    			</div>

          </div>

          <div class = "footer-red">

            <p>Factura Guardada correctamente!</p>

          </div> 

        

        </div>

    </div>  



    

    <dialog data-modal>

        <span>Prueba</span>

        <button data-close-modal>CERRAR</button>

    </dialog>

    

     <!-- The Modal -->

    <div id="myModal" class="modal">

        <span class="close">&times;</span>

        <img class="modal-content" id="img01">

        <div id="caption"></div>

    </div>

    

    

    <div class="top_bar">

        <p>

        <button    onclick="window.location.href='nacion.php';" >¿QUÉ ES PASAPORTE NACION?</button><button   onclick="window.location.href='terminos.php';"  >TÉRMINOS Y CONDICIONES</button>

        </p>

        <img src="nacionblanco.png" />

    </div>

    <!--

    <div class="body_container">

    -->

        <div class="container-pasaporte">     

            <div id="top-pasaporte-step1" class="container-top-pasaporte" >

                   <?php 

                   if(!isset($_GET['point'])){?>

                   <div style= "margin-left: -15px; ">

                   <h2 style="color: white; text-align: center;">¡BIENVENIDO A TU<br> PASAPORTE NACION DIGITAL!</h2>

                   <h4 style="color: white; text-align: center; line-height: .7em;">¡REGISTRA TUS FACTURAS Y LLEVA EL CONTEO<br> DE CUANTOS TICKETS TIENES PARTICIPANDO!</h4>

                   </div>

                   <?php    }   ?>

                  <img src="logopasaporte.png" />

            </div>

             <div id="top-pasaporte-step2" class="container-top-pasaporte" style ="display : none" >

                   <br><h3 style="color: white; text-align: center; font-size: 1.8em;">¡Hola viajero!<br>La factura ha sido registrada<br>de manera exitosa, recuerda apretar el botón de guardar</h3>

            </div>

        </div>

        

       <button type= "button" class= "open-modalred"   style ="display : none" >Modal</button>

                

        <div class="container">

           <!--

            <img src="pasaporte-maleta-stamp.png" width= "500px" height="500px" style="visibility: hidden"/>

            -->

            <?php 

                if(!isset($_GET['point'])){

                    echo "<div class='container-card-pasaporte'>";

                }else{

                    echo "<div class='container-card-pasaporte-center'>";

                }

                ?>

                <div id="loader"  style ="display : none" ></div>

                <div class="card-pasaporte">

        			<div class = "left-column background1-left-column">

        					<h6>pasaporte</h6>

        					<h2><?php echo $username;?></h2>

        					<!--

        					<i class="fa fa-user-circle-o" aria-hidden="true"></i>

        				

        					<i class="fas fa-user-circle"></i>

        					-->

        					<?php

        					if($foto =="N/A"){

        					?>    

        					<img   style ="display : none"  class="perfil-content" id="img_perfil">

        					<div id="pulsefoto" onclick="showSubmit();" >  

            				    <label for="my-profile-input" class="custom-file-upload pulsebutton"   >

                                     <i class="fas fa-user-circle"></i> <p>Sube tu foto</p>

                                </label>

                            </div>

                            <form  class="form-pasaporte"  id="envia_perfil"   onsubmit="procesarImagenPerfil(event)" >

        		            <input type="file" class="button background-top-row" id="my-profile-input" name="file" />

        		            <button style="display : none" id="submit-perfil" type="submit" class="button-simple" >Guardar</button> 

        		            </form>

        		            <?php

        					}else{

        					?>

        					<img   style ="display : none"  class="perfil-content" id="img_perfil">

        					<div id="pulsefoto" onclick="showSubmit();" >  

            				    <label for="my-profile-input" class="custom-file-upload pulsebutton"   >

                                     <img   src ="<?php echo $foto;?>"  class="perfil-content" >

                                </label>

                            </div>

                            <form  class="form-pasaporte"  id="envia_perfil"   onsubmit="procesarImagenPerfil(event)" >

        		            <input type="file" class="button background-top-row" id="my-profile-input" name="file" />

        		            <button style="display : none" id="submit-perfil" type="submit" class="button-simple" >Guardar</button> 

        		            </form>

        					

        					<?php    

        					}

        					?>

        		            

        					<a href="pasaporte.php?ses=1"> <h6>cerrar sesión</h6></a>

        				

        			</div>

        			

        			

        			<div id="step1" class = "right-column ">

        				

        				<!--<h4>Puntos Acumulados</h4> -->

        				<button onclick="modalAlert('Apretado en boton TEST');"  style="visibility: hidden">muestra Alert</button>

        				<button onclick="modalError('Apretado en boton ERROR');"  style="visibility: hidden">muestra Error</button>

        				<!--<h6> puntos</h6>  -->

        				<?php

        				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

                        $query_select_facturas = "SELECT * FROM  pasaporte_facturas WHERE usuario_id ='".$id."' ;"; 

                        if( $resulted_facturas= $conn->query( $query_select_facturas ) ){

                            $total_facturas = $resulted_facturas->num_rows;

                            ?>

                            <h2> Haz acumulado <?php echo $total_facturas;?> Facturas</h2>

                             <img id="blah" src="#" width ="400px" height="500px" alt="your image"  style ="display : none" />

        				    <div class="puntos-container">

                            <?php

                            $contador_facturas=0;

                            if ($total_facturas > 0) {

                                while($row_desglose = $resulted_facturas->fetch_assoc()) {  

                                         $contador_facturas++;

                                         ?>

                                         <div class="img-container">

        				                 <img src="puntos.png"  onclick="modalFunction('<?php echo $row_desglose["foto"]; ?>')" width= "60px" height="60px"/>   <?php echo mb_strimwidth($row["nombre"], 0, 10, "...");?>

        				                 <h6>Factura: <?php   echo mb_strimwidth($row_desglose["numero"],13,10,"...");  ?></h6>

        				                 </div>

        				                 <?php

        				                 if($contador_facturas % 3 ==0){

        				                     echo "</div><div class=\"puntos-container\">";

        				                 }

                                }

                            }

                            else{

                               $error =' El usuario o contraseña no existe ';

                            }

                        }

                        $conn -> close();

        		        ?>

        				</div>

        

        

        				<br>

        				<p>

        				¡Recuerda seguir participando con tus compras superiores a los US $50 en todas nuestras sucursales y acumula más puntos para que tengas más oportunidad de ganar!

        				</p>

        				

        				<div class="round-buttons">

            				<form onsubmit="procesarImagen(event)" class="form-pasaporte"  id="envia_factura" >

            					<div id="pulsebtn">  

                				    <label for="my-file-input" class="custom-file-upload pulsebutton" onclick="recoil()"  >

                                         <i class="fas fa-file-invoice"></i> <br>Subir factura

                                    </label>

                                </div>

            		            <input type="file" class="button background-top-row" id="my-file-input" name="file" />

            		            <div id="pulsebtnenviar"  style ="display : none">  

            	            	    <button type="submit" class="button background-top-row pulsebutton" ><i class="fas fa-cloud-upload-alt"></i>Enviar</button> 

            	            	    <button onclick="window.location.reload();" class="button background-top-row pulsebutton" ><i class="fas fa-sync-alt"></i>Reiniciar</button> 

            	            	</div>

                            </form>

                            <img src="nacionblanco.png"  width= "60px" height="60px" />

                        </div>

                        

                        

                    </div>    

        		

        			

        			

        			<div class = "right-column"  id="step2" style ="display : none" >

        			    <h2>Datos de la Factura</h2>    

        			    <form method="POST"   >

        				<label for="f-numero">número (debe coincidir con el número de la foto de la factura)</label>

                        <input type="text" name="f-numero" id="f-numero" value="" class="text" required>

                        <label for="f-fecha">fecha (solo facturas dentro del periodo del evento)</label>

                        <input type="date" name="f-fecha" id="f-fecha" class="text" required>

                        <label for="f-monto">monto (solo cuenta el monto sin ITBMS ni cargo de servicio)</label>

                        <input type="text" name="f-monto" id="f-monto" class="text" required>

                        <p><br></p>

                        <input class= "button background-top-row"  onclick='myFunction(event)' type="submit" value="Guardar">

                  

        				</form>

        				

        			</div>

        	

        			

        			

        

                </div>

                <div id="bottom-pasaporte-step1" style="color: white; text-align: center;" >

                    <?php

                    if(!isset($_GET['point'])){

                                //echo "<h8 style='color: white; text-align: center;'>¡REGISTRA TUS FACTURAS Y LLEVA EL CONTEO DE CUANTOS TICKETS DE VUELO TIENES PARTICIPANDO!</h2>";

                            }else{

                                echo "<h2 style='color: white; text-align: center;'>¡Sigamos descubriendo los tesoros culinarios de nuestras naciones y conectados en las redes sociales!</h2>";

                                echo "<h1><i class= 'fa fa-instagram' aria-hidden='true'></i>";

        				        echo "<i class= 'fa fa-facebook' aria-hidden='true'></i></h1>";

                            }

                     ?>

                    

                </div>

                <div id="bottom-pasaporte-step2" style ="display : none">

                    <h2 style='color: white; text-align: center;'>Ahora ya estás participando para ganar un viaje a Medellín.</h2>

                    <br><br>

                </div>

                <!--

                <div class="bottom-footer">

                <div>

                    software de fidelización creado por Pa Yá

                    <img src="paya.png" width="30px" height="15px"/>

                <div>

                </div> 

                -->

                

                

            </div>

            



        <!--    

        </div>

        -->

    



<script src="https://cdnjs.cloudflare.com/ajax/libs/heic2any/0.0.1/index.js" integrity="sha512-eEZcFEz8toxNm9+DHMf8Q3+wgZjU0no5THCktIEhCyKk3JEFhn/uUaDCXO5MP7VtvLJQ5/VcLZut7bAHQO1C8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">



    var leFile;

    

    //DATOS ventana Warning

    var elemento     = document.getElementById("let_me_know");

    var elemento_msg = document.getElementById("let_me_know_mgs");

    

    var elemento_error     = document.getElementById("let_me_error");

    var elemento_error_msg = document.getElementById("let_me_error_mgs");

    

    var closeWarning = document.getElementsByClassName("close-btn")[0];

   

    var perfilImg = document.getElementById("img_perfil");

    var submitPerfil = document.getElementById("submit-perfil");

    var pulseFoto = document.getElementById("pulsefoto");

      ///-------------- nuevo 29 octubre
    
      async function obtenerInformacionFactura(texto) {
      console.log("Dentro de obtener factura:");    
      try {
          
         const response = await axios.post(
          'openai_post.php',
          {
            text: texto,
          }
        );  
        console.log("Respuesta  de la IA completa: ", response);
        console.log("Respuesta  de la IA:", response.data);
        
        /*
        var jsonMatch = response.data.match(/\{[\s\S]*?\}/);

        if (jsonMatch) {
             var extractedJsonString = jsonMatch[0];
             var jsonObject = JSON.parse(extractedJsonString);
        }
        */
        return response.data;
        
        /*
        const mensajes = [
          { role: "system", content: "You are a helpful assistant." },
          { role: "user", content: `Por favor, extrae la información de factura, fecha (en formato dd-mm-yyyy) y subtotal del siguiente texto:\n${texto}, el subtotal puede presentarse como SUBTTL, SUBITL, Subtotal o SUBTIL, ejemplos de valores del Subtotal, 0001-102-0000001217, TFBX110050311-00408073, el numero esta precedido por No. y contiene cerca de 20 caracteres numericos, por favor devuelve la información en formato JSON con estos campos: factura - fecha -subtotal -numero` }
        ];
    
        const response = await axios.post(
          'https://api.openai.com/v1/chat/completions',
          {
            model: 'gpt-3.5-turbo', // El nombre del modelo a usar
            max_tokens: 300, // El número máximo de tokens a generar
            temperature: 0.3, // Un número entre 0 y 1 que indica la creatividad del modelo
            messages: mensajes,
          },
          {
            headers: {
              Authorization: `Bearer PONER EL KY`,
            },
          }
        );
    
        const respuestaIA = response.data.choices[0].message.content.trim();
        console.log("Respuesta de la IA:", respuestaIA);
        const jsonObject = JSON.parse(respuestaIA);
    
        const resultado = respuestaIA;
        return jsonObject;
        */
        
        
      } catch (error) {
        console.error('Hubo un error al interactuar con la API de OpenAI:', error);
      }
    }
    
    ///-------------- nuevo 29 octubre

   

   const showSubmit = () =>{

       console.log('showSubmit');

       submitPerfil.style.display = "block";

       pulseFoto.style.display ="none";

   }

   

    

    // DATOS ventana MODAL

    var modal = document.getElementById("myModal");

    var boton_imagen     = document.getElementById("pulsebtn");

    var boton_enviar     = document.getElementById("pulsebtnenviar");

    



    var modalImg = document.getElementById("img01");

    var captionText = document.getElementById("caption");



    

    // Get the <span> element that closes the modal

    var span = document.getElementsByClassName("close")[0];

    

    const modalRed= document.querySelector(".modalred");

    const openModalButton = document.querySelector(".open-modalred");

    const closeModalRed = document.querySelector(".close-modal-red");

    

    

    openModalButton.onclick = () => {

      modalRed.style.display = "block";

      console.log('abrimos la ultima ventana');    

      modalBox();

    };

    

    const recoil = () =>{

         

         boton_imagen.style.display = "none";

         boton_enviar.style.display = "block";

    };

    

    const modalRedes = () =>{

      modalRed.style.display = "block";

      console.log('abrimos la ultima ventana');    

      modalBox();

      

    };

    

    closeModalRed.onclick = () => {

    

      modalBox();

      setTimeout(function(){

            modalRed.style.display = "none";

            window.location.href = 'pasaporte.php?point=1';

      },1000);

    };

    

    modalRed.onclick = (event) => {

      if(event.target == modalRed){

        modalBox();

        setTimeout(function(){

            modalRed.style.display = "none";

            window.location.href = 'pasaporte.php?point=1';

        },1000);

      }

    };

    

    const modalBox = () =>{



      modalRed.classList.toggle("open");

      modalRed.classList.toggle("closered");

    };

    

    // When the user clicks on <span> (x), close the modal

    span.onclick = function() { 

      console.log('close modaler');    

      modal.style.display = "none";

      location.reload(true);

      refresh(1000);

    }

    

    function  modalAlert(val){     

        window.scrollTo(0, 0);

        elemento.style.display = "block";



        elemento_msg.innerHTML = "<span class='msg'  >"+val+"</span>";

        elemento.classList.add('showAlert');

        elemento.classList.add('show');

        elemento.classList.remove('hide');

        setTimeout(function(){

            elemento.classList.remove('show');

            elemento.classList.add('hide');

            setTimeout(function(){

                    elemento.style.display = "none";

            },1000);

        },5000);

         

     }

     

     

     function  modalError(val){     

        window.scrollTo(0, 0);

        elemento_error.style.display = "block";



        elemento_error_msg.innerHTML = "<span class='msg'  >"+val+"</span>";

        elemento_error.classList.add('showAlert');

        elemento_error.classList.add('show');

        elemento_error.classList.remove('hide');

        setTimeout(function(){

            elemento_error.classList.remove('show');

            elemento_error.classList.add('hide');

            setTimeout(function(){

                    elemento_error.style.display = "none";

            },1000);

        },5000);

         

     }

    

    

    function  modalFunction(val){

        //alert("Se envio bien:  " + val);

        

         modal.style.display = "block";

         modalImg.src = val;

         captionText.innerHTML = "<span>FOTO</span>";

         window.scrollTo(0, 0);

    }

    

    // FIN de datos MODAL

    

    const mindeeSubmit = (evt) => {

        //alert("Se apreto bien: ");



        

        

        evt.preventDefault()

        let myFileInput = document.getElementById('my-file-input');

        let myFile = myFileInput.files[0]

        leFile = myFileInput.files[0]

        if (!myFile) { return }

        let data = new FormData();

        data.append("document", myFile, myFile.name);

        let xhr = new XMLHttpRequest();

        xhr.addEventListener("readystatechange", function () {

            if (this.readyState === 4) {

                clearTimeout(myTimeout);

                document.getElementById("loader").style.display = "none";  /* img-pasaporte-step1   bottom-pasaporte-step2*/

                document.getElementById("bottom-pasaporte-step2").style.display = "block";

                document.getElementById("img-pasaporte-step2").style.display = "block";

                document.getElementById("top-pasaporte-step2").style.display = "block";

                document.getElementById("step2").style.display = "block";

                console.log(this.responseText);

                jsdecode(this.responseText,data);



            }

        });

        document.getElementById("step1").style.display = "none";

        document.getElementById("bottom-pasaporte-step1").style.display = "none";

        document.getElementById("top-pasaporte-step1").style.display = "none";

        document.getElementById("img-pasaporte-step1").style.display = "none";

        document.getElementById("loader").style.display = "block";

        console.log('se envia a : ' + 'https://api.mindee.net/v1/products/alonsoapplewhite/factura_nacion_sushi/v1/predict');

        

        //xhr.open("POST", "https://api.mindee.net/v1/products/alonsoapplewhite/factura_nacion_sushi/v1/predict");

        //xhr.open("POST", "https://api.mindee.net/v1/products/mindee/invoices/v4/predict");

        xhr.open("POST", "https://tamitut.com/PAYA/pasaporte/sample-data.json");

        

        xhr.setRequestHeader("Authorization", "Token b4d93570e81ea245327e1856ff0a2008");

        xhr.send(data);

        const myTimeout = setTimeout(myWatchDog, 10000);

        

        

    }

    

    const form_profile = document.getElementById("envia_perfil");

    form_profile.addEventListener("submit", procesarImagenPerfil);

    

    async function procesarImagenPerfil(event) {

          console.log('entramos a profile imagen');

          // Prevenir el comportamiento por defecto del formulario

          event.preventDefault();

          // Obtener el elemento del formulario

          var form = event.target;

          console.log(form.elements);

          // Obtener el elemento del campo de archivo

          var input = form.elements["file"];

          // Obtener el archivo seleccionado

          var archivo = input.files[0];

          

          //verificamos si es heic

          /*

          var fileNameExt = archivo.substr(archivo.lastIndexOf('.') + 1);

          if(fileNameExt == "heic") {

                alert('es HEIC')

          }

          */

          // Verificar si el archivo es una imagen válida (png, jpg, jpeg)

          

          // We compress the file by 50%

          const compressedFile = await compressImage(archivo, {

                        // 0: is maximum compression

                        // 1: is no compression

                        quality: 0.2,

        

                        // We want a JPEG file

                        type: 'image/jpeg',

          });

          

          /*

          document.getElementById("step1").style.display = "none";

          document.getElementById("bottom-pasaporte-step1").style.display = "none";

          document.getElementById("top-pasaporte-step1").style.display = "none";

          document.getElementById("img-pasaporte-step1").style.display = "none";

          */

          document.getElementById("loader").style.display = "block";

          

          

          

          if (compressedFile.type == "image/png" || compressedFile.type == "image/jpg" || compressedFile.type == "image/jpeg") {

            // Crear un objeto FormData para enviar los datos del formulario

            var formData = new FormData();

            // Agregar el archivo al objeto FormData

            formData.append("file", compressedFile);

            

            perfilImg.style.display = "block";

            perfilImg.src = URL.createObjectURL(compressedFile);

            

     

        

            fetch("https://nacionsushi.com/pasaportenacion/perfil_db.php?id=<?php echo $id; ?>", {

              method: "POST",

              body: formData,

            })

              .then((response) => {

                // Verificar si la respuesta es exitosa

                if (response.ok) {

                  // Convertir la respuesta a formato JSON

                  console.log("La respuesta es: ", response);

                  return response;

                } else {

                  // Mostrar un mensaje de error si la respuesta falla

                  alert("Error al subir imagen");

                }

              })

              .then((data) => {

                // Obtener el texto reconocido de los datos del API

                 console.log("El JSON reconocido es: ", data);

    

   

                

                

                document.getElementById("loader").style.display = "none";  



                

                submitPerfil.style.display = "none";

                modalAlert('Foto subida');

                  

                //jsdecode(myObj,Imgdata);

        



              })

              .catch((error) => {

                // Mostrar el error en la consola

                console.error(error);

                modalError('Error del sistema');

                

                setTimeout(function() {

                            location.reload(true);

                    }, 4000);

                    

              });

              

          } else {

            // Mostrar un mensaje de error si el archivo no es una imagen válida

            modalError('Solo se aceptan imagenes');

            alert("El tipo de archivo no es válido. Solo se aceptan imágenes png, jpg o jpeg.");

          }

          

    }

    

  

    

    function resolveAfter2Seconds() {

          return new Promise((resolve) => {

            setTimeout(() => {

              resolve('resolved');

            }, 10000);

          });

    }



    async function asyncCall() {

          console.log('calling');

          const result = await resolveAfter2Seconds();

          console.log(result);

          // Expected output: "resolved"

    }

    

    const convertHeicToJpg = async (input) =>{

        var fileName = input.name;

        console.log(fileName)

        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);

        if(fileNameExt == "heic" || fileNameExt == "HEIC") {

            console.log('estamos en convert to heic')

            console.log(input)

            const blob = new Blob([input],{type: "blob"})

            

            

            document.getElementById("step1").style.display = "none";

            document.getElementById("bottom-pasaporte-step1").style.display = "none";

            document.getElementById("top-pasaporte-step1").style.display = "none";

            document.getElementById("img-pasaporte-step1").style.display = "none";

            document.getElementById("loader").style.display = "block";

            

            

            //var blob = input; //ev.target.files[0];

            heic2any({

                blob: blob,

                toType: "image/jpg",

                quality: 0.2,

            }).then(function (resultBlob) {

                /*

                    console.log("added");

                    let theFile = new File([resultBlob], "heic"+".jpg",{type:"image/jpeg", lastModified:new Date().getTime()});

                    console.log(theFile)

                    console.log('el tipo de archivo convertido: ' + typeof theFile);

                    document.getElementById("blah").src = URL.createObjectURL(theFile)

                    return Promise.resolve(theFile)

                */

                

                 return new Promise( async (resolve) => {

                            console.log("added");

                            let theFile = new File([resultBlob], "heic"+".jpg",{type:"image/jpeg", lastModified:new Date().getTime()});

                            console.log(theFile)

                            console.log('el tipo de archivo convertido: ' + typeof theFile);

                            

                            const fileSize = theFile.size;

                            const maxSize = 1024 * 1024; // 1MB

                         //   if(fileSize > maxSize){

                                const compressedFile = await compressImage(theFile, {

                                    // 0: is maximum compression

                                    // 1: is no compression

                                    quality: 0.4,

                                    // We want a JPEG file

                                    type: 'image/jpeg',

                                });

                         //   }else {

                         //       const compressedFile = theFile

                         //   }

                            

                            

                              document.getElementById("blah").src = URL.createObjectURL(compressedFile)

                    

                              if (compressedFile.type == "image/png" || compressedFile.type == "image/jpg" || compressedFile.type == "image/jpeg") {

                                // Crear un objeto FormData para enviar los datos del formulario

                                var formData = new FormData();

                                // Agregar la clave del API al objeto FormData

                                formData.append("apikey", "<?php echo $api_key; ?>");

                                // Agregar el archivo al objeto FormData

                                formData.append("file", compressedFile);

                                leFile = compressedFile;

                                // Agregar el idioma al objeto FormData

                                formData.append("language", "spa");

                                // Agregar el motor de OCR al objeto FormData

                                formData.append("OCREngine", "2");

                                // Enviar el objeto FormData al API de ocr-space usando fetch

                                fetch("https://api.ocr.space/parse/image", {

                                  method: "POST",

                                  body: formData,

                                })

                                  .then((response) => {

                                    // Verificar si la respuesta es exitosa

                                    if (response.ok) {

                                      // Convertir la respuesta a formato JSON

                                      console.log("La respuesta es: ", response);

                                      return response.json();

                                    } else {

                                      // Mostrar un mensaje de error si la respuesta falla

                                      alert("Error al comunicarse con el API de ocr-space");

                                    }

                                  })

                                  .then((data) => {

                                    // Obtener el texto reconocido de los datos del API

                                     console.log("El JSON reconocido es: ", data);

                                    var text = data.ParsedResults[0].ParsedText;

                                    // Mostrar el texto reconocido en la consola

                                    console.log("El texto reconocido es: ", text);

                                    

                                    

                                    // Definir las expresiones regulares para extraer los datos

                                    const facturaRegex = /[A-Z]{2,}\d+-\d+/;

                                    const fechaRegex = /FECHA:\s*(\S+)/;

                                    const maxRegex = /B\/\.\s*(\d+(\.\d+)?)/g;

                                    const cargoServicio = /CARGO SERVICIO:\s*(\d+\.\d+)/;

                            

                                    // Buscar los datos en el texto usando las expresiones regulares

                                    //const totalMatch = text.match(totalRegex);

                                    const facturaMatch = text.match(facturaRegex);

                                    const fechaMatch = text.match(fechaRegex);

                                    const maxMatch = text.matchAll(maxRegex);

                                    const cargoServicioMatch = text.match(cargoServicio);

                            

                                    // Extraer los datos de los resultados de las expresiones regulares

                                    //const total = totalMatch ? totalMatch[2] : null; // Usa el segundo grupo de captura para el número

                                    const factura = facturaMatch ? facturaMatch[0] : "no se pudo leer"; // Usa el primer resultado que coincida con la cadena

                                    const fecha = fechaMatch ? fechaMatch[1] : "no se pudo leer"; // Usa el primer grupo de captura para la fecha

                                    const max = maxMatch

                                      ? Math.max(...Array.from(maxMatch).map((m) => m[1]))

                                      : "no se pudo leer"; // Usa Math.max y el operador spread para obtener el número más alto

                                    const servicio = cargoServicioMatch ? cargoServicioMatch[1] : 'no se pudo leer o no hay cargo de servicio';

                                    const textoFactura = 'Factura:' + factura + ' Fecha:' + fecha + ' Total:' + max + ' Bs' + ' Cargo Servicio:' + servicio;  

                                      

                                    let Imgdata = new FormData();

                                    Imgdata.append("document", compressedFile, compressedFile.name);

                                    

                                    let myObj ={

                                        numero: factura,

                                        fecha: fecha,

                                        total: max,

                                    }

                                      ///-------------- nuevo 29 octubre
                                      if(factura ==='no se pudo leer'  || fecha ==='no se pudo leer' || max ==='no se pudo leer'  ){
                                                    obtenerInformacionFactura(text).then(result =>{
                                                        const {factura, fecha, subtotal, numero} = result;
                                                        console.log(' el subtotal que regresa la IA: ' + subtotal);
                                                        console.log(' el numero que regresa la IA: ' + numero);
                                                        console.log(' el dato de la factura que regresa la IA: ' + factura);
                                                        myObj.numero = factura;
                                                        myObj.fecha = fecha;
                                                        myObj.total = subtotal;
                                                        if(myObj.total < 50 ){
                                                             modalError('Solo valen facturas superiores a 50.00USD');
                                                             setTimeout(function() {
                                                                //    location.reload(true);
                                                            }, 4000);
                                                             
                                                        }
                                                        document.getElementById("loader").style.display = "none";  
                                                        document.getElementById("bottom-pasaporte-step2").style.display = "block";
                                                        document.getElementById("img-pasaporte-step2").style.display = "block";
                                                        document.getElementById("top-pasaporte-step2").style.display = "block";
                                                        document.getElementById("step2").style.display = "block";
                                                        modalAlert('Factura escaneada');
                                                        jsdecode(myObj,Imgdata);
                                                    }).catch(error =>{
                                                        
                                                    })
                                                } else{
                                                     if(max < 50 ){
                                                         modalError('Solo valen facturas superiores a 50.00USD');
                                                         setTimeout(function() {
                                                            //    location.reload(true);
                                                        }, 4000);
                                                    }
                                                    document.getElementById("loader").style.display = "none";  
                                                    document.getElementById("bottom-pasaporte-step2").style.display = "block";
                                                    document.getElementById("img-pasaporte-step2").style.display = "block";
                                                    document.getElementById("top-pasaporte-step2").style.display = "block";
                                                    document.getElementById("step2").style.display = "block";
                                                    modalAlert('Factura escaneada');
                                                    jsdecode(myObj,Imgdata);
                                                }
                                                ///-------------- nuevo 29 octubre


                                  })

                                  .catch((error) => {

                                    // Mostrar el error en la consola

                                    console.error(error);

                                    modalError('Error del sistema');

                                    

                                    setTimeout(function() {

                                                location.reload(true);

                                        }, 8000);

                                        

                                  });

                              } else {

                                // Mostrar un mensaje de error si el archivo no es una imagen válida

                                modalError('Solo se aceptan imagenes');

                                alert("El tipo de archivo no es válido. Solo se aceptan imágenes png, jpg o jpeg.");

                              }

                              

                             

                              

                              resolve(theFile)

                         })

                        

                })

                .catch(function (x) {

                    console.log(x.code);

                    console.log(x.message);

                });

        }

    }



    

    async function procesarImagen(event) {

          // Prevenir el comportamiento por defecto del formulario

          event.preventDefault();

          // Obtener el elemento del formulario

          var form = event.target;

          // Obtener el elemento del campo de archivo

          var input = form.elements["file"];

          // Obtener el archivo seleccionado

          var archivo = input.files[0];

          

          //verificar si el archivo es heic

            //verificamos si es heic

          //var fileNameExt = archivo.substr(archivo.lastIndexOf('.') + 1);

          

          console.log(archivo.name)

          

          var fileName = archivo.name

          var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);

          

          

          

          if(fileNameExt  === "heic" || fileNameExt === "HEIC" ) {

               // alert('es HEIC')

               // convertHeicToJpg(archivo);

               console.log('el tipo de archivo: ' + typeof archivo);

               const  convertedFile = await convertHeicToJpg(archivo);

                setTimeout(() => {

              console.log('esperamos')

            }, 10000);

               

                

                

                

                

                

                

          }else{

          

              console.log(archivo)

              const fileSize = archivo.size;

              const maxSize = 1024 * 1024; // 1MB

           //   if(fileSize > maxSize){

                  const compressedFile = await compressImage(archivo, {

                                // 0: is maximum compression

                                // 1: is no compression

                                quality: 0.2,

                

                                // We want a JPEG file

                                type: 'image/jpeg',

                  });

        //      }else {

        //         const compressedFile = archivo

         //     }

        

          

          document.getElementById("step1").style.display = "none";

          document.getElementById("bottom-pasaporte-step1").style.display = "none";

          document.getElementById("top-pasaporte-step1").style.display = "none";

          document.getElementById("img-pasaporte-step1").style.display = "none";

          document.getElementById("loader").style.display = "block";

          

          

          

          if (compressedFile.type == "image/png" || compressedFile.type == "image/jpg" || compressedFile.type == "image/jpeg") {

            // Crear un objeto FormData para enviar los datos del formulario

            var formData = new FormData();

            // Agregar la clave del API al objeto FormData

            formData.append("apikey", "<?php echo $api_key; ?>");

            // Agregar el archivo al objeto FormData

            formData.append("file", compressedFile);

            leFile = compressedFile;

            // Agregar el idioma al objeto FormData

            formData.append("language", "spa");

            // Agregar el motor de OCR al objeto FormData

            formData.append("OCREngine", "2");

            // Enviar el objeto FormData al API de ocr-space usando fetch

            

   

            

            

            fetch("https://api.ocr.space/parse/image", {

              method: "POST",

              body: formData,

            })

              .then((response) => {

                // Verificar si la respuesta es exitosa

                if (response.ok) {

                  // Convertir la respuesta a formato JSON

                  console.log("La respuesta es: ", response);

                  return response.json();

                } else {

                  // Mostrar un mensaje de error si la respuesta falla

                  alert("Error al comunicarse con el API de ocr-space");

                }

              })

              .then((data) => {

                // Obtener el texto reconocido de los datos del API

                 console.log("El JSON reconocido es: ", data);

                var text = data.ParsedResults[0].ParsedText;

                // Mostrar el texto reconocido en la consola

                console.log("El texto reconocido es: ", text);

            

                // Definir las expresiones regulares para extraer los datos

                const facturaRegex = /[A-Z]{2,}\d+-\d+/;

                const fechaRegex = /FECHA:\s*(\S+)/;

                const maxRegex = /B\/\.\s*(\d+(\.\d+)?)/g;

                const cargoServicio = /CARGO SERVICIO:\s*(\d+\.\d+)/;

                            

                // Buscar los datos en el texto usando las expresiones regulares

                //const totalMatch = text.match(totalRegex);

                const facturaMatch = text.match(facturaRegex);

                const fechaMatch = text.match(fechaRegex);

                const maxMatch = text.matchAll(maxRegex);

                const cargoServicioMatch = text.match(cargoServicio);

                            

                // Extraer los datos de los resultados de las expresiones regulares

                //const total = totalMatch ? totalMatch[2] : null; // Usa el segundo grupo de captura para el número

                const factura = facturaMatch ? facturaMatch[0] : "no se pudo leer"; // Usa el primer resultado que coincida con la cadena

                const fecha = fechaMatch ? fechaMatch[1] : "no se pudo leer"; // Usa el primer grupo de captura para la fecha

                const max = maxMatch

                      ? Math.max(...Array.from(maxMatch).map((m) => m[1]))

                      : "no se pudo leer"; // Usa Math.max y el operador spread para obtener el número más alto

                const servicio = cargoServicioMatch ? cargoServicioMatch[1] : 'no se pudo leer o no hay cargo de servicio';

                const textoFactura = 'Factura:' + factura + ' Fecha:' + fecha + ' Total:' + max + ' Bs' + ' Cargo Servicio:' + servicio;  

                

     

                  

                let Imgdata = new FormData();

                Imgdata.append("document", compressedFile, compressedFile.name);

                

                let myObj ={

                    numero: factura,

                    fecha: fecha,

                    total: max,

                }

                              ///-------------- nuevo 29 octubre
                 
                              if(factura ==='no se pudo leer'  || fecha ==='no se pudo leer' || max ==='no se pudo leer'  ){
                    console.log('no se pudo leer nos apoyamos en la IA');
                    obtenerInformacionFactura(text).then(result =>{
                        const {factura, fecha, subtotal, numero} = result;
                        console.log(' el subtotal que regresa la IA: ' + subtotal);
                        console.log(' el numero que regresa la IA: ' + numero);
                        console.log(' el dato de la factura que regresa la IA: ' + factura);
                        myObj.numero = factura;
                        myObj.fecha = fecha;
                        myObj.total = subtotal;
                        if(myObj.total < 50 ){
                             modalError('Solo valen facturas superiores a 50.00USD');
                             setTimeout(function() {
                                //    location.reload(true);
                            }, 4000);
                             
                        }
                        document.getElementById("loader").style.display = "none";  
                        document.getElementById("bottom-pasaporte-step2").style.display = "block";
                        document.getElementById("img-pasaporte-step2").style.display = "block";
                        document.getElementById("top-pasaporte-step2").style.display = "block";
                        document.getElementById("step2").style.display = "block";
                        modalAlert('Factura escaneada');
                        jsdecode(myObj,Imgdata);
                    }).catch(error =>{
                        
                    })
                } else{
                      console.log('se pudo leer seguimos el estandar');
                     if(max < 50 ){
                         modalError('Solo valen facturas superiores a 50.00USD');
                         setTimeout(function() {
                            //    location.reload(true);
                        }, 4000);
                    }
                    document.getElementById("loader").style.display = "none";  
                    document.getElementById("bottom-pasaporte-step2").style.display = "block";
                    document.getElementById("img-pasaporte-step2").style.display = "block";
                    document.getElementById("top-pasaporte-step2").style.display = "block";
                    document.getElementById("step2").style.display = "block";
                    modalAlert('Factura escaneada');
                    jsdecode(myObj,Imgdata);
                }
                ///-------------- nuevo 29 octubre

                


              })

              .catch((error) => {

                // Mostrar el error en la consola

                console.error(error);

                modalError('Error del sistema - por favor intentalo de nuevo con una foto formato JPG');

                

                setTimeout(function() {

                            location.reload(true);

                    }, 4000);

                    

              });

          } else {

            // Mostrar un mensaje de error si el archivo no es una imagen válida

            modalError('Solo se aceptan imagenes');

            alert("El tipo de archivo no es válido. Solo se aceptan imágenes png, jpg o jpeg.");

          }

          }

            

    }

    

    

    const compressImage = async (file, { quality = 1, type = file.type }) => {

        const fileSize = file.size;

        const maxSize = 1024 * 1024; // 1MB

        if (fileSize > maxSize) {

            // Get as image data

            const imageBitmap = await createImageBitmap(file);

    

            // Draw to canvas

            const canvas = document.createElement('canvas');

            canvas.width = imageBitmap.width;

            canvas.height = imageBitmap.height;

            const ctx = canvas.getContext('2d');

            ctx.drawImage(imageBitmap, 0, 0);

    

            // Turn into Blob

            const blob = await new Promise((resolve) =>

                canvas.toBlob(resolve, type, quality)

            );

            

            // Turn Blob into File

            return new File([blob], file.name, {

                type: blob.type,

            });

        }else{

            return file

        }

    };

    

    

    

    

    function myWatchDog() {

        //alert("Ocurrio un error - intente de nuevo");

        modalError('Ocurrio un error - intente de nuevo');

        location.reload(true);

    }

    

    

    async function  getProduct(key,contador,precio,func){

         

         var data = new FormData();

         data.append('checkElement', key);

         data.append('checkPrice', precio);

         data.append('checkContador', contador);

         

         console.log(' EL PRECIO!!!!!!:     ' + precio);

         





        var peticion = new XMLHttpRequest();

        peticion.addEventListener("readystatechange", function () {

            if (this.readyState === 4) {

                //alert("Se guardo bien");

                //window.location.href = 'proveedores.php';

            }

        });





       if(func === 'GET')

            peticion.open("POST", "https://nacionsushi.com/pasaportenacion/nacion_crear_productos_externos_db.php?is=GET",true);

       if(func === 'PUT')

            peticion.open("POST", "https://tamitut.com/PAYA/facturas/nacion_crear_productos_externos_db.php?is=PUT",true);

       if(func === 'POST')

            peticion.open("POST", "https://tamitut.com/PAYA/facturas/nacion_crear_productos_externos_db.php?is=POST",true);

        

       peticion.onload = function () {

            

            console.log('Esto respondio el servidor:  ', peticion.responseText);

            console.log('El contador va asi:  ', contador);

            var element_estado = document.getElementById('addEstado' + contador);

            element_estado.innerHTML = peticion.responseText;

            console.log('El ID va asi:  ', element_estado.innerHTML);

    

       };     

        

       peticion.send(data);

     

    

    }

    

    

    function  addElementNew(contador){

        console.log("Se recibio: " +contador);

        var elemento = document.createElement("tabla");

        elemento.innerHTML += "<tr><td>-----------------------------------------------</td></tr>";

        elemento.innerHTML += "<tr><td><br><div id='addEstado"+contador+"' >Estado del elemento:  "+  contador +": </div></td></tr>";

        elemento.innerHTML += "<tr><td><br>Cantidad elemento "+contador+": </td></tr>";

        elemento.innerHTML += "<tr><td><br><input name='addCantidad"+contador+"' id='addCantidad"+contador+"' type='cantidad"+contador+"' value='1'/><br></td></tr>";

                      

        elemento.innerHTML += "<tr><td><br>Descripcion elemento "+contador+": </td></tr>";

        elemento.innerHTML += "<tr><td><br><input name='addDescripcion"+contador+"' id='addDescripcion"+contador+"' type='descripcion"+contador+"' placeholder='descripcion' value=''/><br></td></tr>";

                      

        elemento.innerHTML += "<tr><td><br>Precio elemento "+contador+": </td></tr>";

        elemento.innerHTML += "<tr><td><br><input name='addPrecio"+contador+"' id='addPrecio"+contador+"' type='precio"+contador+"' placeholder='0' value=''/><br></td></tr>";

                      

        elemento.innerHTML += "<tr><td><br>Total elemento "+contador+": </td></tr>";

        elemento.innerHTML += "<tr><td><br><input name='addTotal"+contador+"' id='addTotal"+contador+"' type='total"+contador+"' placeholder='0' value=''/><br></td></tr>";

        

        elemento.innerHTML += "<tr><br></tr><tr><td><button id='addNewElementButton"+ (contador+1) +"' onclick='addElementNew("+(contador+1)+")' class='btn btn-primary rounded submit p-3 px-5'> + AGREGAR ELEMENTO</button></td></tr>";

        elemento.innerHTML += "<tr><td><div style='display:none;' id='addNewElement"+(contador+1)+"'></div></td></tr>";

        

          // DESGLOSE: addButtonSend

          console.log('el elemento: '+ 'addNewElement'+contador);

      //    document.getElementById('addButtonSend').onclick= myFunction(7) ;

          document.getElementById( 'addButtonSend' ).setAttribute( "onclick", "myFunction("+(contador+1)+");" );

          document.getElementById('addNewElement'+contador).style.display= "";  

          document.getElementById('addNewElementButton'+contador).style.display= "none"; 

          document.getElementById('addNewElement'+contador).appendChild(elemento);   

    

    }

    

    

    

    function  myFunction(event){

        event.preventDefault();

        var contador =1;



        console.log('ok');

        

       

  

        console.log('el contador',contador);

        if (!leFile) { 

             alert("No hay FILE");

             modalError('Error de la foto - intente de nuevo');

            return;

            

        }

        console.log('el read File =>', leFile.name);

        var data = new FormData();

        data.append("file", leFile);

        console.log('la data =>', data);

        console.log('el File =>', leFile.name);

        data.append('addFecha', document.getElementById('f-fecha').value);

        data.append('addTotal', document.getElementById('f-monto').value);

        data.append('addNumero', document.getElementById('f-numero').value);





        var peticion = new XMLHttpRequest();

        peticion.addEventListener("readystatechange", function () {

            if (this.readyState === 4) {

                 console.log(this.responseText);

                 if(this.responseText == "OK"){

                     /*

                        modalAlert('Se guardo bien!');

                         setTimeout(function(){

                            

                         },5000);

                         */

                          modalRedes();

                        //alert("Se guardo bien");

                 }

                 if(this.responseText === "EXISTE"){

                        modalError('ERROR - Esta factura ya se registro: ' + this.responseText );

                        //alert("Ya existe factura");

                 }

                

                //modalAlert();

                setTimeout(function(){

                    window.location.href = 'pasaporte.php?point=1';

                },6000);

                

            }

        });

  



       

       // peticion.open("GET", "https://tamitut.com/PAYA/facturas/rdm_db.php?addRuc="+ ruc_send +"&addTotal="+ document.getElementById('addTotal').value +"&addFecha=" + document.getElementById('addFecha').value + "&addDate=" + document.getElementById('addDate').value + "&addNumero=" + document.getElementById('addNumero').value);

 

        peticion.open("POST", "https://nacionsushi.com/pasaportenacion/pasaporte_db.php",true);

        peticion.onload = function () {

            // do something to response

            console.log('Esto respondio el servidor:  ', peticion.responseText);

        };     

        

        peticion.send(data);

     

    

    }

    

     

    

    

    

    

   async function jsdecode(objeto,data) {

          console.log(objeto);

          

          /*

          const obj = JSON.parse(objeto);

          if (obj !== undefined) {

               console.log('Documento: ' + obj.document);

          }

          */

          

          

          var dateVar ='';

          var fechaVar = '';

          var numeroVar = '';

          var rucVar = '';

          var totalVar = '';

      

  

          

          // Datos de la factura original:

          /*

          dateVar = obj?.document?.inference?.pages[0]?.prediction?.fecha?.value  ?? '';

          fechaVar = obj?.document?.inference?.pages[0]?.prediction?.fecha?.values[0]?.content    ??  '';

          numeroVar = obj?.document?.inference?.pages[0]?.prediction?.numero?.values[0]?.content ?? '';

          totalVar = obj?.document?.inference?.pages[0]?.prediction?.total?.values[0]?.content  ?? '';

          */

          

          

          dateVar = objeto?.fecha ?? '';

          fechaVar = objeto?.fecha ?? '';

          numeroVar = objeto?.numero ?? '';

          totalVar = objeto?.total ?? '';

          

          

          var dateObject = convertDate(fechaVar);

          

          //Arreglo de items de la factura:

          

          //const factura_items = [];

          console.log('Fecha de la factura: ' + fechaVar);

          console.log('Fecha de la factura: ' + dateObject);

          

          document.getElementById("f-numero").value = numeroVar;

          document.getElementById("f-fecha").value =  dateObject;

          document.getElementById("f-monto").value =  totalVar;

		  

          var elemento = document.createElement("tabla");



 

    }

    

    function convertDate(date){

          var d_arr = date.split("-");

          var newdate = d_arr[2] + '-' + d_arr[1] + '-' + d_arr[0];

          return newdate;

   }

</script>







  

</body>



</html>