<?php @ob_start();
    @session_start(); 
    
    $postArray = isset($_REQUEST['p']) ? explode("/",$_REQUEST['p']) : array();
    $testa =  getcwd();
    
    if($testa == "/home/admin/web/in.falamaiscoda.br/public_html/vpaquality"){
        @define('ENDERECO', 'http://'.$_SERVER['HTTP_HOST'].'/vpaquality/');
    }else{
        @define('ENDERECO', 'http://'.$_SERVER['HTTP_HOST'].'/');
    }

    
	$_SESSION['modulo'] = isset($postArray[0]) ? $postArray[0] : '';
	$_SESSION['idu'] = isset($postArray[1]) ? $postArray[1] : '';
	$_SESSION['extra'] = isset($postArray[2]) ? $postArray[2] : '';
	$_SESSION['extra2'] = isset($postArray[3]) ? $postArray[3] : '';
	$MODULO = $_SESSION['modulo'];
	 
	switch($_SESSION['modulo']){
		default :
			$PAGINA = 'index';
		break;
	}

      
?>