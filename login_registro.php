<?php


include_once("mysql_connect.php");

 session_start(); 

 $USUARIO  =  mysqli_real_escape_string($con, $_POST['usuario']);
 $PASSWORD =  mysqli_real_escape_string($con, $_POST['password']);


 

// $sql="insert invitaciones (nombre, apellido ,email , telefono, dni, vin, evento, fecha) values 
//     ( '".$_POST["nombre"]."' , '".$_POST["apellido"]."'  , '".$_POST["email"]."' , 
// 	'".$_POST["telefono"]."' , '".$_POST["dni"]."' , '".$_POST["vin"]."' , '".$_POST["evento"]."', now())";

 	$SQL = "SELECT * FROM usuarios WHERE usuario = '".$USUARIO."' AND password = '".$PASSWORD."' LIMIT 1";
 	$resultado = $con->query($SQL)or die (mysqli_error($con));

 	
 	

	if($resultado->num_rows > 0 ){


			$row  = mysqli_fetch_assoc($resultado);
			if ($row['password'] == $PASSWORD) {

				
				$_SESSION['isAdmin'] = $row['rol'];
				
				header("Location: participantes.php");
			}
	
			

	}else{
    
    echo "email or password does not exist."; // wrong details 
    header("Location: login.php");
   }


?>

	

