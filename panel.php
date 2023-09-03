<?php
session_start();
$test = " entra PHP ";

$resultado = "Sin resultado";

include_once 'opendb.php';

$updated ="NO";

$phone= 'OK';

$query='Empty';


if( !isset($_SESSION['user_id'])   ){
  session_destroy();
  header("location: index.php");
  die();
}

if(isset($_POST['addTelefono'])){

$phone= $_POST['addTelefono'];

}





if( isset($_GET['ses'])   ){

     session_destroy();

     header("location: index.php");

     die();

}



if( $_SERVER['REQUEST_METHOD'] === 'POST'   && isset($_POST['edit_nombre_usuario'])  && isset($_POST['edit_puntos_usuario'])   && isset($_POST['edit_telefono_usuario'])   && isset($_POST['edit_email_usuario'])   && isset($_POST['edit_tipo_usuario'])       ){

        

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

        //$query_update_producto = "UPDATE productos_nacion_externo SET nombre='".$_POST['nombre']."', precio='".$_POST['precio']."', inventario='".$_POST['inventario']."' WHERE id=".$_POST['identificador'].";"; 

        $query_update_factura = "UPDATE pasaporte_usuarios SET nombre = '".$_POST['edit_nombre_usuario']."', puntos = '".$_POST['edit_puntos_usuario']."' , telefono = '".$_POST['edit_telefono_usuario']."' , email = '".$_POST['edit_email_usuario']."' , tipo = '".$_POST['edit_tipo_usuario']."'  WHERE id = '".$_POST['edit_id_usuario']."' ;"; 

        if( $resulted_update= $conn->query( $query_update_factura ) ){

              $resultado= "Se actualizo correctamente!";

               // $resultado.= $query_update_factura;

          

        }

        else{

              $resultado= "NO actualizo correctamente!   ";

              $resultado.= $query_update_factura;

        }

        

        $conn -> close();

        $updated = "SI";

}





if( $_SERVER['REQUEST_METHOD'] === 'POST'   && isset($_POST['delete_id_usuario'])   ){

        

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

        //$query_update_producto = "UPDATE productos_nacion_externo SET nombre='".$_POST['nombre']."', precio='".$_POST['precio']."', inventario='".$_POST['inventario']."' WHERE id=".$_POST['identificador'].";"; 

        $query_delete_factura = "DELETE FROM pasaporte_usuarios WHERE id = '".$_POST['delete_id_usuario']."';"; 

        if( $resulted_delete= $conn->query( $query_delete_factura ) ){

              $resultado= "Se elimino correctamente!";

              //header("Location: index.php?reg=1");

              //exit();

        }

        else{

              $resultado= "NO se elimino correctamente!   ";

              $resultado.= $query_delete_factura;

        }

        

        $conn -> close();

        $updated = "SI";

}





if( $_SERVER['REQUEST_METHOD'] === 'POST'   && isset($_POST['edit_numero'])  && isset($_POST['edit_total'])){

        

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

        //$query_update_producto = "UPDATE productos_nacion_externo SET nombre='".$_POST['nombre']."', precio='".$_POST['precio']."', inventario='".$_POST['inventario']."' WHERE id=".$_POST['identificador'].";"; 

        $query_update_factura = "UPDATE pasaporte_facturas SET numero = '".$_POST['edit_numero']."', total = '".$_POST['edit_total']."' WHERE id = '".$_POST['edit_id']."' ;"; 

        if( $resulted_update= $conn->query( $query_update_factura ) ){

              $resultado= "Se actualizo correctamente!";

              //header("Location: index.php?reg=1");

              //exit();

        }

        else{

              $resultado= "NO actualizo correctamente!   ";

              $resultado.= $query_update_factura;

        }

        

        $conn -> close();

        $updated = "SI";

}





if( $_SERVER['REQUEST_METHOD'] === 'POST'   && isset($_POST['delete_numero'])   ){

        

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

        //$query_update_producto = "UPDATE productos_nacion_externo SET nombre='".$_POST['nombre']."', precio='".$_POST['precio']."', inventario='".$_POST['inventario']."' WHERE id=".$_POST['identificador'].";"; 

        $query_delete_factura = "DELETE FROM pasaporte_facturas WHERE id = '".$_POST['edit_id']."';"; 

        if( $resulted_delete= $conn->query( $query_delete_factura ) ){

              $resultado= "Se elimino correctamente!";

              //header("Location: index.php?reg=1");

              //exit();

        }

        else{

              $resultado= "NO se elimino correctamente!   ";

              $resultado.= $query_delete_factura;

        }

        

        $conn -> close();

        $updated = "SI";

}







if( $_SERVER['REQUEST_METHOD'] === 'POST'   && isset($_POST['addUsuario'])  ){

        

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

        //$query_update_producto = "UPDATE productos_nacion_externo SET nombre='".$_POST['nombre']."', precio='".$_POST['precio']."', inventario='".$_POST['inventario']."' WHERE id=".$_POST['identificador'].";"; 

        $query_insert_usuario = "INSERT INTO pasaporte_usuarios (nombre, contrasena , telefono, email) VALUES ('".$_POST['addUsuario']."', '".$_POST['addPassword']."','".$_POST['addTelefono']."','".$_POST['addEmail']."');"; 

        $query =  $query_insert_usuario;

        if( $resulted_insert= $conn->query( $query_insert_usuario ) ){

              $resultado= "Se actualizo correctamente!";

              header("Location: index.php?reg=1");

              exit();

        }

        else{

              $resultado= "NO actualizo correctamente!";

        }

        

        $conn -> close();

        $updated = "SI";

}



if( $_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['add_form']) && isset($_POST['nombre']) && isset($_POST['inventario']) && isset($_POST['precio'])  && $updated === 'NO'      ){

        

        $test .= " luego al POST ADD  ";

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

        $query_update_producto = "INSERT INTO productos_nacion_externo (nombre,precio,inventario) VALUES ('".$_POST['nombre']."', '".$_POST['precio']."',".$_POST['inventario'].");"; 



        if( $resulted_update= $conn->query( $query_update_producto ) ){

              //header("Location: niveles.php");

              $test .= " entra DB ";

              $resultado= "Se agrego correctamente!";

        }

        else{

            $sirve_nivel ="NO ENTRO BIEN A INSERT";

             $sirve_nivel .= $query_insert_nivel;

             $test .= " NO entra DB ";

             $test .= $query_update_producto;

             $resultado= "Ocurrio un error inesperado!";

        }

        

        $conn -> close();

        $updated = "SI";

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

</head>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  

<script>

    $(document).ready(function () {

        $('#table1').DataTable();

    });

    

     $(document).ready(function () {

        $('#table2').DataTable();

    });

    

</script>



    

    <style>

        body {font-family: Arial, Helvetica, sans-serif;}

        

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

          background-color: rgba(0,0,0,0.6); /* Black w/ opacity */

        }

        

        /* Modal Content (image) */

        .modal-content {

          margin: auto;

          padding-top: 0.5em; 

          display: block;

          text-align: left;

          width: 70%;

          max-width: 500px;

          height: auto;

          /*

          border: 3px solid #FFFFFF;

          */

        }

        

          .modal-content p{

          margin: .4em  .4em;

 

        }

         .modal-content form{

          margin: .2em  .2em;

          width: 90%;

 

        }

        

        /* Caption of Modal Image */

        #caption {

          margin: auto;

          display: block;

          width: 80%;

          max-width: 700px;

          text-align: left;

          color: #ccc;

          padding: 10px 0;

          height: auto;

        }

        

        /* Add Animation */

        .modal-content, #caption {  

          -webkit-animation-name: zoom;

          -webkit-animation-duration: 0.6s;

          animation-name: zoom;

          animation-duration: 0.6s;

        }

        

        .modal-container{

            border-radius: 1rem;

            border-style: dotted;

            border-color: blue;

            display: flex;

            flex-direction: column;

            width: 80%;

    	    background-color: white;

	        background-filter: blur(.4rem);

	        background-color: rgb(0,0,0); /* Fallback color */

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

        

        /* The Close Button */

        .closed {

          position: absolute;

          top: 15px;

          right: 35px;

          color: #f1f1f1;

          font-size: 40px;

          font-weight: bold;

          transition: 0.3s;

        }

        

        .closed:hover,

        .closed:focus {

          color: #bbb;

          text-decoration: none;

          cursor: pointer;

        }

        

        /* 100% Image Width on Smaller Screens */

        @media only screen and (max-width: 700px){

          .modal-content {

            width: 100%;

          }

        }

        

        /*   SECCION DE PULSAR */



        

        .pulse{

            position: relative;

            width: 200px;

            height: 200px;

            background: #0ef;

            border-radius: 50%;

        }

        

        .pulse span{

            position: relative;

            width: 200px;

            height: 200px;

            background: #0ef;

            border-radius: 50%;

        }



         #whatsapp {

             position: fixed;

             z-index:100;

             right: 80px;

             bottom: 50px;

             /*border: 3px solid #73AD21;*/

         }

                

        #whatsapp .wtsapp{

            

            position: relative;

            

            transform: all .5s ease;

            background-color: #e98731;

            

            display: block;

            padding: 2px 0;

            

            text-align: center;

            box-shadow: 0 0 20px rgba(0,0,0,0.15);

            border-radius: 50px;

            border-right: none;

            color: #fff;

            font-weight: 700;

            font-size: 30px;

            /*

            bottom: 70px;

            left: 20px;

            */

            border: 0;

            z-index: 9999;

            width: 68px;

            height: 68px;

            line-height: 50px;

        }

        

        #whatsapp .wtsapp:before{

            

            content: "";

            

            position: absolute;

            

            z-index: -1;

            

            left: 50%;

            top: 50%;

        

            /*

            transform: translateX(-50%) translateY(-50%);

            */

            /*

            display: block;

            width: 100px;

            height: 100px;

            background-color: #25d366;

            */

            

            display: block;

            

            background-color: #e98731;

            width: 68px;

            height: 68px;

            border-radius: 50%;

            -webkit-animation: pulse-border 1500ms ease-out infinite;

            animation: pulse-border 1500ms ease-out infinite;

            

        }

        

        #whatsapp .wtsapp:focus{

            border:none;

            outline:none;

        }

        

        #whatsapp .wtsapp i {

	        font-size: 4rem;

        }

        

        @keyframes pulse-border{

            0%{transform: translateX(-50%)  translateY(-50%)  translateZ(0) scale(1); opacity: 1;}

            100%{transform: translateX(-50%)  translateY(-50%)  translateZ(0) scale(1.5); opacity: 0;}

        }

        

        

        /*   SECCION DE PULSAR */

        

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

         width:fit-content;

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

         width:fit-content;

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

      

      .modal-content-img{

        width: 50%;

        height: auto;

      }

    



        

        

    </style>





<?php

/*

echo "test: ";

echo $phone;

echo "resultado: ";

echo $query;

*/

?>

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



    <div id="myModal" class="modal">

        <span id="close-modal" class="closed">&times;</span>

        <div class="modal-content">

          

            <div  id="caption"></div>

        </div>

    </div>

    

    <dialog id="dialogBox" data-modal>

      <header>

        <h2 class="header">EDITAR:</h2>

        <!--<button onclick="closeDialog()" id="closeDialogHeader">&#x2716</button>-->

      </header>

        <!--<button data-close-modal>CERRAR</button>-->

      <section>

        <div id="dialog_content">  

       

        </div>

      </section>

      <footer>

        <button data-close-modal class= 'button'>CERRAR</button>

      </footer>

    </dialog>

    

     

    <dialog id="dialogBox" data-modal-edit-factura >

      <header>

        <h2 class="header">EDITAR:</h2>

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

    

    

    

    <dialog id="imgBox" img-modal>

      <header>

        <h2 class="header">FOTO:</h2>

        <!--<button onclick="closeDialog()" id="closeDialogHeader">&#x2716</button>-->

      </header>

        <!--<button data-close-modal>CERRAR</button>-->

      <section>

        <div id="dialog_content_img">  

         <img class="modal-content-img" id="img01">

        </div>

      </section>

      <footer>

        <button img-close-modal class= 'button'>CERRAR</button>

      </footer>

    </dialog>

    



    

    





    

    <div class="container">

        <div class="card-panel">

		

			

			<div class="content-card-panel"  id= 'user_table' >

				

				<h1>DATOS REGISTRADOS  </h1>

			

				<div class="content-card-panel-menu">

				    <i  style='font-size:32px'  class='fa fa-trophy'  onclick='ShowmodalWinnerDialog()'></i>

				    <i  style='font-size:32px'  class='fa fa-book' onclick='displayToggle()'></i>

                    <a href="panel.php?ses=1"> <i  style='font-size:32px'  class='fa fa-sign-out'></i> </a>

				</div>

				<?php echo $resultado;?>

				<button data-open-modal class= 'button' style='display:none'>ABRIR</button>

				<div>

    				<?php

    				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

                    $query_select_usuario = "SELECT * FROM  pasaporte_usuarios;"; 

                    if( $resulted_select= $conn->query( $query_select_usuario ) ){

                        if ($resulted_select->num_rows > 0) {

                            echo "<table id='table1' class='content-table' ><thead><tr><th>Nombre</th><th>Telefono</th><th>Email</th><th>Estado</th><th>Tipo</th><th>Facturas</th><th>Editar</th><th>Borrar</th></tr></thead><tbody>";

                            while($row = $resulted_select->fetch_assoc()) { 

                                if($row['estado'] == "OK"){

                                    $status = "<i  style='font-size:24px'  class='fa fa-check-square'></i>";

                                }else {

                                    $status = "<i  style='font-size:24px'  class='fa fa-exclamation-triangle'></i>";

                                }

                                

                                

                                if($row['tipo']=='usuario'){

                                    echo "<tr><td>".$row['nombre']."</td><td>".$row['telefono']."</td><td>".$row['email']."</td><td>".$status."</td><td><i  style='font-size:24px'  class='fa fa-user'></i></td><td><i  style='font-size:24px' onclick='modalFunction(\"".$row['id']."\");'  class='fa fa-book'></i></td><td><i  onclick='ShowmodalUserDialog(\"".$row['id']."\",\"".$row['nombre']."\",\"".$row['puntos']."\",\"".$row['telefono']."\",\"".$row['email']."\",\"".$row['tipo']."\",\"edit\");' style='font-size:24px'  class='fa fa-pencil-square-o'></i></td><td><i  onclick='ShowmodalUserDialog(\"".$row['id']."\",\"".$row['nombre']."\",\"".$row['puntos']."\",\"".$row['telefono']."\",\"".$row['email']."\",\"".$row['tipo']."\",\"erase\");' style='font-size:24px'  class='fa fa-eraser'></i></td></tr>"; 

                                }else{

                                    echo "<tr><td>".$row['nombre']."</td><td>".$row['telefono']."</td><td>".$row['email']."</td><td>".$status."</td><td><i  style='font-size:24px'  class='fa fa-user-plus'></i></td><td><i  style='font-size:24px' onclick='modalFunction(\"".$row['id']."\");'  class='fa fa-book'></i></td><td><i  onclick='ShowmodalUserDialog(\"".$row['id']."\",\"".$row['nombre']."\",\"".$row['puntos']."\",\"".$row['telefono']."\",\"".$row['email']."\",\"".$row['tipo']."\",\"edit\");' style='font-size:24px'  class='fa fa-pencil-square-o'></i></td><td><i  onclick='ShowmodalUserDialog(\"".$row['id']."\",\"".$row['nombre']."\",\"".$row['puntos']."\",\"".$row['telefono']."\",\"".$row['email']."\",\"".$row['tipo']."\",\"erase\");' style='font-size:24px'  class='fa fa-eraser'></i></td></tr>"; 

                                }

                              //  echo "<tr  style='display:none' id='secret".$row['id']."'><td>OK".$row['nombre']."OK</td></tr>"; 

                            }

                            echo "</tbody></table>";

                        }

                    }

                    else{

                        $resultado= "NO actualizo correctamente!";

                    }

                    $conn -> close();

                    ?>

                </div>

  

			</div>

			

			

			

			<div class="content-card-panel"   id= "invoice_table"   style="display:none" >

				

				<h1>DATOS REGISTRADOS  </h1>

				<div class="content-card-panel-menu">

				    <i  style='font-size:32px'  class='fa fa-trophy' onclick='ShowmodalWinnerDialog()'></i>

				    <i  style='font-size:32px'  class='fa fa-user' onclick='displayToggle()'></i>

				</div>

				<?php echo $resultado;?>

				<button data-open-modal class= 'button' style='display:none'>ABRIR</button>

				<?php

				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname_paya);

                $query_select_usuario = "SELECT * FROM  pasaporte_facturas;"; 

                if( $resulted_select= $conn->query( $query_select_usuario ) ){

                    if ($resulted_select->num_rows > 0) {

                        echo "<table id='table2' class='content-table' ><thead><tr><th>Usuario</th><th>Fecha</th><th>Total</th><th>Numero</th><th>Foto</th><th>Borrar</th></tr></thead><tbody>";

                        while($row = $resulted_select->fetch_assoc()) { 

                            /*

                            if($row['estado'] == "OK"){

                                $status = "<i  style='font-size:24px'  class='fa fa-check-square'></i>";

                            }else {

                                $status = "<i  style='font-size:24px'  class='fa fa-exclamation-triangle'></i>";

                            }

                            

                            onclick='Showimg();'

                            */

                            

                            $status = "<i  style='font-size:24px'  class='fa fa-exclamation-triangle'></i>";

                            echo "<tr><td>".$row['usuario_id']."</td><td>".$row['fecha']."</td><td>".$row['total']."</td><td>".$row['numero']."</td><td><i  style='font-size:24px' onclick='Showimg(\"".$row['foto']."\");' class='fa fa-camera'></i></td><td><i  style='font-size:24px' onclick='ShowmodalDialogDelete(\"".$row['numero']."\",\"".$row['id']."\");' class='fa fa-eraser'></i></td></tr>"; 

                        

                            /*

                            if($row['tipo']=='usuario'){

                                echo "<tr><td>".$row['usuario_id']."</td><td>".$row['fecha']."</td><td>".$row['total']."</td><td>".$status."</td><td><i  style='font-size:24px'  class='fa fa-user'></i></td><td><i  style='font-size:24px' onclick='modalFunction(\"".$row['id']."\");'  class='fa fa-book'></i></td><td><i  onclick='ShowmodalUserDialog(\"".$row['id']."\",\"".$row['nombre']."\",\"".$row['puntos']."\",\"".$row['telefono']."\",\"".$row['email']."\",\"".$row['tipo']."\",\"edit\");' style='font-size:24px'  class='fa fa-pencil-square-o'></i></td><td><i  onclick='ShowmodalUserDialog(\"".$row['id']."\",\"".$row['nombre']."\",\"".$row['puntos']."\",\"".$row['telefono']."\",\"".$row['email']."\",\"".$row['tipo']."\",\"erase\");' style='font-size:24px'  class='fa fa-eraser'></i></td></tr>"; 

                            }else{

                                echo "<tr><td>".$row['nombre']."</td><td>".$row['telefono']."</td><td>".$row['email']."</td><td>".$status."</td><td><i  style='font-size:24px'  class='fa fa-user-plus'></i></td><td><i  style='font-size:24px' onclick='modalFunction(\"".$row['id']."\");'  class='fa fa-book'></i></td><td><i  onclick='ShowmodalUserDialog(\"".$row['id']."\",\"".$row['nombre']."\",\"".$row['puntos']."\",\"".$row['telefono']."\",\"".$row['email']."\",\"".$row['tipo']."\",\"edit\");' style='font-size:24px'  class='fa fa-pencil-square-o'></i></td><td><i  onclick='ShowmodalUserDialog(\"".$row['id']."\",\"".$row['nombre']."\",\"".$row['puntos']."\",\"".$row['telefono']."\",\"".$row['email']."\",\"".$row['tipo']."\",\"erase\");' style='font-size:24px'  class='fa fa-eraser'></i></td></tr>"; 

                            }

                            */

                          //  echo "<tr  style='display:none' id='secret".$row['id']."'><td>OK".$row['nombre']."OK</td></tr>"; 

                        }

                        echo "</tbody></table>";

                    }

                }

                else{

                    $resultado= "NO actualizo correctamente!";

                }

                $conn -> close();

                ?>

  

			</div>

	

			



            

        </div>

    </div>

    

    

    <script type='text/javascript'>

    

    const openButton = document.querySelector("[data-open-modal]");

    

    var display_toggle = 'false';

    

    // DATOS ventana MODAL----------------------------------------

    var modal = document.getElementById("myModal");

    



    var modalImg = document.getElementById("img01");

    var captionText = document.getElementById("caption");



    

    // Get the <span> element that closes the modal

    var spanned = document.getElementsByClassName("closed")[0];

    var spanner = document.getElementById("close-modal");

    

    // When the user clicks on <span> (x), close the modal

    

    spanned.onclick = () => { 

      console.log('close modal');    

      modal.style.display = "none";

    }

    // DATOS ventana MODAL----------------------------------------

    

    // DATOS dialog ----------------------------------------------

    var dialog_modal_edit_factura = document.querySelector("[data-modal-edit-factura]");

    var dialog_modal = document.querySelector("[data-modal]");

    var close_dialog = document.querySelector("[data-close-modal]");

    var close_img_modal = document.querySelector("[img-close-modal]");

    var data_close_modal_edit = document.querySelector("[data-close-modal-edit]");

    var img_modal = document.querySelector("[img-modal]");

    

    openButton.addEventListener("click", () =>{

        dialog_modal.showModal();

    })

    

    close_dialog.onclick = () => { 

      console.log('close modal');    

      dialog_modal.close();

    }

    

    data_close_modal_edit.onclick = () => { 

      console.log('close modal');    

      dialog_modal_edit_factura.close();

    }

    

    close_img_modal.onclick = () => { 

      console.log('close modal img');    

      img_modal.close();

    }

    

    // DATOS dialog ----------------------------------------------

    

    

    

      const ShowmodalWinnerDialog  = () => {

               var captionTextEdit = document.getElementById("dialog_edit_content");

               let innHTML = ''; 

               innHTML = "<div    id='factura_ganador'     style ='display : none' ><h1>Factura Ganadora: </h1></div>";

               innHTML += "<div  id='consulta_ganador'  style=\"text-align: center;\"><h1><p><i class=\"fa fa-trophy\" style=\"font-size:80px\"></i></p> Esta seguro que desea seleccionar al GANADOR? <br></h1><br></div>";

               innHTML += "<button  id='selecciona_ganador' onclick='SelectWinner()' class= 'button'>SELECCIONAR</button>";

              // innHTML += "<button onclick='SelectWinner()' class= 'button'>VER FOTO</button>";



               captionTextEdit.innerHTML = innHTML;

               dialog_modal_edit_factura.showModal();

      }

    

    

     const ShowmodalUserDialog  = (id,nombre,puntos,telefono,email,tipo,comando) => {

               console.log('ver objeto:' + nombre);

               var captionTextEdit = document.getElementById("dialog_edit_content");

                let innHTML = ''; 

               if(comando === 'edit'){

                  

                   innHTML = "<h1> Usuario: "+nombre +"</h1><br>";

                   innHTML += "<form action='panel.php' method='post'><label for='edit_nombre_usuario'>Nombre:</label><br>";

                   innHTML += "<input type='text' class='text' id='edit_nombre_usuario' name='edit_nombre_usuario' value='"+nombre+"'><br><br>";

                   innHTML += "<label for='edit_puntos_usuario'>Puntos:</label><br>";

                   innHTML += "<input type='text' class='text' id='edit_puntos_usuario' name='edit_puntos_usuario' value='"+puntos+"'><br><br>";

                   innHTML += "<label for=edit_telefono_usuario'>Telefono:</label><br>";

                   innHTML += "<input type='text' class='text' id='edit_telefono_usuario' name='edit_telefono_usuario' value='"+telefono+"'><br><br>";

                   innHTML += "<label for=edit_email_usuario'>Email:</label><br>";

                   innHTML += "<input type='text' class='text' id='edit_email_usuario' name='edit_email_usuario' value='"+email+"'><br><br>";

                   innHTML += "<label for=edit_tipo_usuario'>Tipo:</label><br>";

                   innHTML += "<select class='text' id='edit_tipo_usuario' name='edit_tipo_usuario'><option value='usuario'>usuario</option><option value='admin'>administrador</option></select><br><br>";

                   innHTML += "<input type='hidden' class='text' id='edit_id_usuario' name='edit_id_usuario' value='"+id+"'><br><br>";

                   innHTML += "<input type='submit' class= 'button' value='GUARDAR'></form>";

                   

               }

               

                if(comando === 'erase'){

                  

                   innHTML = "<div style=\"text-align: center;\"><h1><p><i class=\"fa fa-exclamation-triangle\" style=\"font-size:36px\"></i></p> Esta seguro que desea borrar al usuario? <br>"+nombre +"</h1><br></div>";

                   innHTML += "<form action='panel.php' method='post'>";

                   innHTML += "<input  type='hidden' class='text' id='delete_id_usuario' name='delete_id_usuario' value='"+id+"'><br><br>";

                   innHTML += "<input type='submit' class= 'button' value='BORRAR'></form>";

                   

               }

               captionTextEdit.innerHTML = innHTML;

               dialog_modal_edit_factura.showModal();

      }

    



      

      const ShowmodalDialog  = (id,numero,total,fecha,comando) => {

               console.log('ver objeto:' + numero);

               var captionTextEdit = document.getElementById("dialog_edit_content");

                let innHTML = ''; 

               if(comando === 'edit'){

                  

                   innHTML = "<h1> Facturas usuario: "+numero +"</h1><br>";

                   innHTML += "<form action='panel.php' method='post'><label for='nombre'>Numero:</label><br>";

                   innHTML += "<input type='text' class='text' id='edit_numero' name='edit_numero' value='"+numero+"'><br><br>";

                   innHTML += "<label for='nombre'>Total:</label><br>";

                   innHTML += "<input type='text' class='text' id='edit_total' name='edit_total' value='"+total+"'><br><br>";

                   innHTML += "<input type='hidden' class='text' id='edit_id' name='edit_id' value='"+id+"'>";

                   innHTML += "<input type='submit' class= 'button' value='GUARDAR'></form>";

               }

               

                if(comando === 'erase'){

                  

                   innHTML = "<div style=\"text-align: center;\"><h1><p><i class=\"fa fa-exclamation-triangle\" style=\"font-size:36px\"></i></p> Esta seguro que desea borrar la factura: <br>"+numero +"</h1><br></div>";

                   innHTML += "<form action='panel.php' method='post'>";

                   innHTML += "<input  type='hidden' class='text' id='delete_numero' name='delete_numero' value='"+numero+"'><br><br>";

                   innHTML += "<input type='hidden'  class='text' id='edit_total' name='edit_total' value='"+total+"'><br><br>";

                   innHTML += "<input type='hidden' class='text' id='edit_id' name='edit_id' value='"+id+"'>";

                   innHTML += "<input type='submit' class= 'button' value='BORRAR'></form>";

               }

               captionTextEdit.innerHTML = innHTML;

               dialog_modal_edit_factura.showModal();

      }

      

      

      const ShowmodalDialogDelete  = (numero,id) => {

               console.log('delete objeto:' + id);

               var captionTextEdit = document.getElementById("dialog_edit_content");

                let innHTML = ''; 

                /*

               if(comando === 'edit'){

                  

                   innHTML = "<h1> Facturas usuario: "+numero +"</h1><br>";

                   innHTML += "<form action='panel.php' method='post'><label for='nombre'>Numero:</label><br>";

                   innHTML += "<input type='text' class='text' id='edit_numero' name='edit_numero' value='"+numero+"'><br><br>";

                   innHTML += "<label for='nombre'>Total:</label><br>";

                   innHTML += "<input type='text' class='text' id='edit_total' name='edit_total' value='"+total+"'><br><br>";

                   innHTML += "<input type='hidden' class='text' id='edit_id' name='edit_id' value='"+id+"'>";

                   innHTML += "<input type='submit' class= 'button' value='GUARDAR'></form>";

               }

               

                if(comando === 'erase'){

                  */

                   innHTML = "<div style=\"text-align: center;\"><h1><p><i class=\"fa fa-exclamation-triangle\" style=\"font-size:36px\"></i></p> Esta seguro que desea borrar la factura: <br>"+ numero +"</h1><br></div>";

                   innHTML += "<form action='panel.php' method='post'>";

                   

                   innHTML += "<input  type='hidden' class='text' id='delete_numero' name='delete_numero' value='"+numero+"'><br><br>";

                  // innHTML += "<input type='hidden'  class='text' id='edit_total' name='edit_total' value='"+total+"'><br><br>";

                   innHTML += "<input type='hidden' class='text' id='edit_id' name='edit_id' value='"+id+"'>";

                   

                   innHTML += "<input type='submit' class= 'button' value='BORRAR'></form>";

          //     }

               captionTextEdit.innerHTML = innHTML;

               dialog_modal_edit_factura.showModal();

      }

      

     

      const Showmodal  = (val) => {

            var modal = document.getElementById("myModal");

            if(val==='true'){

                modal.style.display = "block";

            }else{

                modal.style.display = "none";

            }

      }

      

      const displayToggle = () =>{

            var user_table = document.getElementById("user_table");

            var invoice_table = document.getElementById("invoice_table");

            console.log('ver el toggle: ', display_toggle );

            

            if(  display_toggle === 'true'  ){

                invoice_table.style.display = "none";

                user_table.style.display = "block";

                display_toggle = 'false';

            }

            

            else {

                user_table.style.display = "none";

                invoice_table.style.display = "block";

                 display_toggle = 'true';

            }

            



      }

      

      const Showdialog  = (val) => {

            if(val==='true'){

                dialog_modal.showModal();

            }

      }

      

      const Showimg  = (val) => {

             var modalImg = document.getElementById("img01");

             console.log('log de la imagen: ', val )

             modalImg.src = val;

             if(val!='' && val!=undefined){

                img_modal.showModal();

             }

      }

      

      

      

     function  modalFunction(val){

        //alert("Se envio bien:  " + val);

        var captionText = document.getElementById("dialog_content");



        var peticion = new XMLHttpRequest();

        const regex = /[^0-9]/g;

        peticion.addEventListener("readystatechange", function () {

            if (this.readyState === 4) {

                //alert("Se guardo bien");

                console.log(this.responseText);

                const obj = JSON.parse(this.responseText);

                let innHTML2 = ''; 

                if(  obj[0]?.nombre != undefined && obj[0]?.nombre != '' ){

                    innHTML2 = "<h1> Facturas usuario: "+obj[0].nombre +"</h1><br>";

                    innHTML2 += "<table id='table_modal' class='content-table' ><thead><tr><th>numero</th><th>total</th><th>fecha</th><th>foto</th><th>editar</th><th>borrar</th></tr></thead><tbody>";

                    for (const key in obj) {

                        console.log( 'iterando el objeto: ',key);

                        console.log( 'iterando el nombre: ',obj[key]);

                        console.log( 'iterando el nombre - numero: ',obj[key].numero);

                        innHTML2 += "<tr><td>"+obj[key].numero+"</td><td>"+obj[key].total+"</td><td>"+obj[key].fecha+"</td><td onclick='Showimg(\""+obj[key].foto+"\");'><i class='fa fa-camera'></i></td><td><i onclick='ShowmodalDialog(\""+obj[key].id+"\",\""+obj[key].numero+"\",\""+obj[key].total+"\",\""+obj[key].fecha+"\",\"edit\");' class='fa fa-pencil'></i></td><td><i onclick='ShowmodalDialog(\""+obj[key].id+"\",\""+obj[key].numero+"\",\""+obj[key].total+"\",\""+obj[key].fecha+"\",\"erase\");' class='fa fa-eraser'></i></td></tr>"; 

    

                    }

                    console.log(' ver las edades: ' + obj.total);

                    innHTML2 += "</tbody></table>";

                }else{

                    innHTML2 = "<h1> El usuario no tiene facturas</h1><br>";

                }

 

                captionText.innerHTML = innHTML2;

                dialog_modal.showModal();

            }

        });

  

        peticion.open("POST", "data_user.php?user="+val,true);

        console.log("data_user.php?user="+val);

        peticion.onload = function () {

            // do something to response

            console.log('Esto respondio el servidor:  ', peticion.responseText);

        };     

        

        peticion.send();

        captionText.innerHTML = "<span>POR FAVOR ESPERE...</span>";

    }

    

    const SelectWinner  = () => {

        

        var anuncio = document.getElementById("factura_ganador");

        var label_anuncio = document.getElementById("consulta_ganador");

        var boton_seleccionar = document.getElementById("selecciona_ganador");

        anuncio.style.display = "block";

        label_anuncio.style.display = "none";

        boton_seleccionar.style.display = "none";

        

        var peticion = new XMLHttpRequest();

        peticion.addEventListener("readystatechange", function () {

           if (this.readyState === 4) {

               const obj = JSON.parse(this.responseText);

               let theHtml ='';

               theHtml = "<div  id='factura_ganador' ><h1>Factura Ganadora: "+obj.numero+" </h1></div>";

               theHtml += "<div  id='nombre_ganador' ><h1>Nombre del Ganador: "+obj.nombre+" </h1></div>";

               theHtml += "<button onclick='Showimg(\""+obj.foto+"\")' class= 'button'>VER FOTO</button>";

               anuncio.innerHTML= theHtml;

           }

        });

        peticion.open("POST", "winner.php",true);

        peticion.onload = function () {

        };     

        peticion.send();

               

        

        

    }

 

 

    </script>

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