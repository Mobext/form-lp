<?php


include_once("mysql_connect.php");

  // var_dump($_POST['nombre']);
  // die();
 $nombre         =  mysqli_real_escape_string($con, $_POST['nombre']);
 $apellido         =  mysqli_real_escape_string($con, $_POST['apellido']);
 $telefono        =  mysqli_real_escape_string($con, $_POST['telefono']);
 $mail        =  mysqli_real_escape_string($con, $_POST['email']);
 $localidad     =  mysqli_real_escape_string($con, $_POST['localidad']);
 $modelo     =  mysqli_real_escape_string($con, $_POST['modelo']);
 $transformacion     =  mysqli_real_escape_string($con, $_POST['transformacion']);
 $mensaje     =  mysqli_real_escape_string($con, $_POST['mensaje']);
 $consecionario = mysqli_real_escape_string($con, $_POST['sucursal']);

 // $nombre         =  "Robert";
 // $apellido         =  "Sanchez";
 // $telefono        =  "234234234";
 // $mail        =  "jpapa@gmail.com";
 // $localidad     =  "san luis";
 // $modelo     =  "estambul";
 // $transformacion     =  "SI";
 // $mensaje     =  "Hola";



	$SQL = "INSERT INTO participantes (
	            nombre,
	            apellido,
              mail,
	            telefono,
              localidad,
              modelo,
              transformacion,
              mensaje )
	          VALUES (
                '".$nombre."',
                '".$apellido."',
                '".$mail."',
                '".$telefono."',
                '".$localidad."',
                '".$modelo."',
                '".$transformacion."',
                '".$mensaje."'

	            )";


                    

              // )";
	$RESULTADO = mysqli_query($con, $SQL)or die (mysqli_error($con));

  if ($RESULTADO) {
      	header("Location: gracias.php");
    	  die();
    # code...
  }else{

    echo "Error";
    die();
  }


?>

