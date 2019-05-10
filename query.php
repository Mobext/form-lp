<?php

get_data();

function get_data() {
 
 

  include_once("mysql_connect.php");

  if($con->connect_errno) {
    die("No se pudo conectar a la base de datos");
  }

  $jsondata = array();
 
  //Sanitize ipnut y preparar query
  // if( is_array($id) ) {
  //   $id = array_map('intval', $id);
  //   $querywhere = "WHERE `ID` IN (" . implode( ',', $id ) . ")";
  // } else {
  //   $id = intval($id);
  //   $querywhere = "WHERE `ID` = " . $id;
  // }
  $SQL = "SELECT * FROM participantes";
  $result = mysqli_query($con, $SQL)or die (mysqli_error($con));

  if ($result) {

  if( $result->num_rows > 0 ) {

    $jsondata["success"] = true;
    $jsondata["data"]["message"] = sprintf("Se han encontrado %d participantes", $result->num_rows);
    $jsondata["data"]["participantes"] = array();
    while( $row = $result->fetch_object() ) {
       //$jsondata["data"]["users"][] es un array no asociativo. Tendremos que utilizar JSON_FORCE_OBJECT en json_enconde
       //si no queremos recibir un array en lugar de un objeto JSON en la respuesta
       //ver http://www.php.net/manual/es/function.json-encode.php para más info
       $jsondata["data"]["participantes"][] = $row;
     }
 
   } else {
 
     $jsondata["success"] = false;
     $jsondata["data"] = array(
       'message' => 'No se encontró ningún resultado.'
     );
 
   }
 
   $result->close();
 
  } else {
 
    $jsondata["success"] = false;
    $jsondata["data"] = array(
      'message' => $con->error
    );
 
  }
 
  header('Content-type: application/json; charset=utf-8');

  echo json_encode($jsondata, JSON_FORCE_OBJECT);
 
  $con->close();
 
}

exit();