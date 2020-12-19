<?php
	session_start();
	$chavex = isset($_SESSION["sgc_OPaSDKPOaSKDPOAoKAPSD"]) ? $_SESSION["sgc_OPaSDKPOaSKDPOAoKAPSD"] : '';
	
	if((empty($chavex)) || ($chavex != "OihfOFYW89FYP9WEHtjcrjOSGcO3FJH8EHFW8F")){
		header("location:login.php?msg=".urlencode('Acesso Negado!'));
		exit;
	}else{
		include_once 'usuario_class.php';		
		salvaUltimaAcao($_SESSION['sgc_idusuario']);
				
		$tmpQuery = explode('&', str_replace('mod=', '', $_SERVER['QUERY_STRING']));
		$MODULOACESSO['modulo'] = $tmpQuery[0];
		$MODULOACESSO['usuario'] = $_SESSION['sgc_idusuario'];
	}
?>