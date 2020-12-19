<?php	@session_start();
	
	$opx = $_REQUEST["opx"];
	
	define('ENDERECO', 'http://'.$_SERVER['HTTP_HOST'].'/dev/planofacil/');
	
	//define('ENDERECO', 'http://'.$_SERVER['HTTP_HOST'].'/');
		
	switch ($opx) {
		case 'contato':
			include_once 'includes/functions.php';
			include_once 'mail/class.phpmailer.php';
	
			$dados = $_POST;		
			
			$texto = '<p>Contato do Site</p>';
			$texto .= '<p>Nome: '.ucwords($dados['nome']).'<br />';
			$texto .= 'Telefone: '.$dados['fone'].'<br />';
			$texto .= 'Email: '.strtolower($dados['email']).'</p>';
			$texto .= '<p>Mensagem</p>';
			$texto .= '<p>'.nl2br($dados['mensagem']).'</p>';
			
			
			
			/*******************************************************
			****		    Script de Envio de Email 			****
			********************************************************/
			
			$email = array();	
			
			$email['nome_remetente'] = ucwords($dados['nome']);
			$email['email_remetente'] = strtolower($dados['email']);
				
			$email['destinatario'] = array(
				'Gustavo' => 'gustavo@rcenter.com.br'
			 );
				
			$email['assunto'] = 'Email vindo do site';
			
			$email['texto'] = $texto;		
			
			if(enviaEmail($email)){
				echo '{"status" : true}';
			}else{
				echo '{"status" : false}';	
			}
			
			/*******************************************************
			****		Fim do Script de Envio de Email			****
			********************************************************/
		break;
		

		case 'informativos':
			include_once 'includes/functions.php';
			include_once 'mail/class.phpmailer.php';
			
			$dados = $_POST;
			
			$texto = '<p>Solicitou o recebimento de informativos </p>';
			$texto .= '<p>Email: '.strtolower($dados['email_destinatario']).'</p>';
			
		
			/*******************************************************
			****		    Script de Envio de Email 			****
			********************************************************/
			
			$email = array();	
						
			$email['nome_remetente'] = strtolower($dados['email_destinatario']);
			$email['email_remetente'] = strtolower($dados['email_destinatario']);		
			
			$email['destinatario'] = array(
				'Gustavo' => 'gustavo@rcenter.com.br'
			 );
			
			$email['assunto'] = 'Email vindo do site';
			
			$email['texto'] = $texto;		
			
			if(enviaEmail($email)){
				echo '{"status" : true}';
			}else{
				echo '{"status" : false}';	
			}
			
			/*******************************************************
			****		Fim do Script de Envio de Email			****
			********************************************************/
		break;

	}			
	
?>

