<?php 

include_once("mysql_connect.php");
// require ReCaptcha class
require('recaptcha-master/src/autoload.php');

$dni = isset($_POST['dni']) ? $_POST['dni'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$recaptcha = isset($_POST['recaptcha']) ? $_POST['recaptcha'] : null;

$SQL = "SELECT * FROM participantes WHERE dni = '".$dni."'";
$resultado = $con->query($SQL)or die (mysqli_error($con));
$mensaje = "";
$opc = 0;


if ($resultado->num_rows > 0) {
	
	$opc = 1;
}

	
	// configure
	// an email address that will be in the From field of the email.
	$from = 'Demo contact form <demo@domain.com>';

	// an email address that will receive the email with the output of the form
	$sendTo = 'Demo contact form <demo@domain.com>';

	// subject of the email
	$subject = 'New message from contact form';

	// form field names and their translations.
	// array variable name => Text to appear in the email
	$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');

	// message that will be displayed when everything is OK :)
	$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';

	// If something goes wrong, we will display this message.
	$errorMessage = 'There was an error while submitting the form. Please try again later';

	// ReCaptch Secret
	$recaptchaSecret = '6Ld8OXgUAAAAAK4CAQcJAKo_tisiL01AmJfFAvKV';

	// let's do the sending

	// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
	error_reporting(E_ALL & ~E_NOTICE);

	// echo("A todo : "+$_POST);

	// echo json_encode($_POST);exit;


	// $return = array('');
		// $return = array("dni" => $opc, "email" => $email,'type' => 'success', 'message' => 'mensajes', 'recaptcha' => $recaptcha);

		// echo json_encode($return);
	try {
	    if (!empty($_POST)) {

	        // validate the ReCaptcha, if something is wrong, we throw an Exception,
	        // i.e. code stops executing and goes to catch() block
	        
	        if (!isset($_POST['recaptcha'])) {
	            throw new \Exception('ReCaptcha no es valido.');
	        }

	        // do not forget to enter your secret key from https://www.google.com/recaptcha/admin
	        
	        $recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\CurlPost());
	        
	        // we validate the ReCaptcha field together with the user's IP address
	        
	        $response = $recaptcha->verify($_POST['recaptcha'], $_SERVER['REMOTE_ADDR']);


	        // echo "HOla ".$response;

	        if (!$response->isSuccess()) {
	            throw new \Exception('ReCaptcha no fue validado.');

	        }
	        $return = array("dni" => $opc, "email" => $email,'type' => 'success', 'message' => $okMessage);
	        
	    }
	} catch (\Exception $e) {
	    $return = array("dni" => $opc, "email" => $email, "type" => "danger", "message" => $e->getMessage());
	}

	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	    $encoded = json_encode($return);
	    header('Content-Type: application/json');
		// $return = array("dni" => $opc, "email" => $email,'type' => NULL, 'message' => NULL);

		echo $encoded;

	    // echo $encoded;
	} else {
	    echo $return['message'];
	}







?>