<?php
require_once("lib/nusoap.php");
require_once("lib/class.wsdlcache.php");
$ns="http://uherederosw1617.hol.es/labWSDL/comprobarContrasena.php?wsdl";
$server= new soap_server();
$server->configureWSDL('comprobar',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
$server->register('comprobar',array('x'=>'xsd:string'),array('z'=>'xsd:string'),$ns);

function comprobar($x){
	$fp=fopen("toppasswords.txt","r");
	$resul="VALIDA";
	while(!feof($fp)){
		$linea=fgets($fp);
		if(strcasecmp($linea,$x)==0){
			$resul="INVALIDA";
		}
	}
	fclose($fp);
	return $resul;
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>