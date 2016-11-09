<span><a href='layout.html'>Inicio</a></spam>
<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
$cliente=new nusoap_client('http://cursodssw.hol.es/comprobarmatricula.php?wsdl',true);
$connect=mysqli_connect("mysql.hostinger.es","u906430108_u","4QYzSiq7","u906430108_quiz");
if ($connect) {
		
		echo "conexion exitosa. <br />";
		
		
	
		$nombre=$_POST["nombre"];
		$apellidos=$_POST["apellidos"];
		$email=$_POST["email"];
		$password=$_POST["password"];
		$telefono=$_POST["telefono"];
		$especialidad=$_POST["especialidad"];
		$resultado=$cliente->call('comprobar',array('x'=>$email));
		echo $resultado;
		if(strcmp($resultado,"SI")!=0){
			echo "Error: hay algun dato invalido <br />";
		
		}
		else{
		
			$sql="INSERT INTO Usuario(Nombre,Apellidos,Email,Password,Telefono,Especialidad) VALUES ('$nombre','$apellidos','$email','$password','$telefono','$especialidad')";
		
			if(!mysqli_query($connect,$sql)){
		
				die('Error: ' .mysqli_error($connect));
			}
			else{
				echo " 1 fila introducida. <br />";
			}	
		
		}


mysqli_close($connect);
}
?>