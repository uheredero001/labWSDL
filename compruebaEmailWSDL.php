<FORM NAME="datos" ID="datos" ACTION= "compruebaEmailWSDL.php" METHOD="POST"> 
<input type='text' name='email'></input>
<input type='submit' name='enviar' value='COMPROBAR'></input>
</form>


<?php
require_once("lib/nusoap.php");
require_once("lib/class.wsdlcache.php");
$client = new nusoap_client( 'http://cursodssw.hol.es/comprobarmatricula.php?wsdl',true);
if(isset($_POST['email'])){
	$response=$client->call('comprobar',array(x=>$_POST['email']));
	echo "Respuesta: ";
	echo $response;
	$err = $client->getError();
	if ($err) {
    	echo '<p><b>Constructor error: ' . $err . '</b></p>';
	}
	echo '<h2>Request</h2>';
	echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
	echo '<h2>Response</h2>';
	echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
	echo htmlspecialchars($client->response, ENT_QUOTES) . '</b></p>';
	echo '<p><b>Debug: <br>';
	echo htmlspecialchars($client->debug_str, ENT_QUOTES) .'</b></p>';
	//Comentar hasta aquí
 
	if($client->fault){
    	echo "FAULT: <p>Code: (".$client->faultcode.")</p>";
    	echo "String: ".$client->faultstring;
	}
	else{
    	//var_dump ($response);
    	echo "Codigo: ".$response['Codigo'];
	}
	
}
?>