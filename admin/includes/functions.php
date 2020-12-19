<?php
	// gera senha
	function geraChave($tamanho){	  
	  $codigo = "";	  
	  for($x=1; $x <= $tamanho; $x++){	  
	  	$sec = rand(0,2);	  
	 	switch($sec){	  
			case 0: 
				$ri = 48; $rf = 57; 
			break;
	    	case 1: 
				$ri = 65; $rf = 90; 
			break;
	  		case 2: 
				$ri = 97; $rf = 122; 
			break;	  
	  		default: 
				$ri = 48; $rf = 57; 
			break;	  
		}	  
	  	$codigo .= chr(rand($ri,$rf));	  
	  }	  
	  return $codigo;
	}



	function converteUrl($texto){
		$texto = utf8_decode($texto);
		
		$acentos = array(
        'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
        'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
        'C' => '/&Ccedil;/',
        'c' => '/&ccedil;/',
        'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
        'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
        'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
        'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
        'N' => '/&Ntilde;/',
        'n' => '/&ntilde;/',
        'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
        'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
        'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
        'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
        'Y' => '/&Yacute;/',
        'y' => '/&yacute;|&yuml;/',
        '' => '/&ordf;/',
        '' => '/&ordm;/',
		'-' => '/&frasl;/',
		'' => '/&ordf;/'
);
		$texto = htmlentities($texto,ENT_NOQUOTES);
        $texto = preg_replace($acentos, array_keys($acentos), $texto);
		
		$texto = html_entity_decode($texto, ENT_NOQUOTES);
		
		$texto = str_replace('/', '-', $texto);	
	 	$texto = str_replace('\\', '-', $texto);		
		
	  	$texto = str_replace(array('?' , '\\' , '"' , '(' , ')' , '!' , '$' , '%' , '[' , ']' , '{' , '}' , '\/' , '°' , 'º' , 'ª' , '=' , '.' , ',' , ':' , ';' , '"', '\'', '#', 'ª', '<', '>', '^', '´', '`', '+', '•', '\'' ,'@', '¨', '&', '*', '²', '³', '£', '¢', '¬', '_' ), '', $texto);
	
		$texto = trim($texto);
		$texto = str_replace(" ","-",$texto);
		$texto = strtolower($texto);
		
		$texto = utf8_encode($texto);
		
		return $texto;
	}
	
	
	
	
	/* limita o numero de caraceteres que sera exibido, ele verifica se nao esta cortando uma palavra */
	function limitaCaracter($entrada, $tamanho='', $pontuacao='...'){
		if(!empty($tamanho)){
			$tam = strlen($entrada)-1;
			$tamanho = $tamanho > $tam ? $tam : $tamanho;
			if($tam > $tamanho){
				while($entrada[$tamanho] != ' ' && $tamanho < $tam){
					$tamanho++;	
				}
				if($entrada[$tamanho-1] == ',' || $entrada[$tamanho-1] == '.')
					$tamanho--;
				return substr($entrada, 0, $tamanho).$pontuacao;
			}
			else{
				return $entrada;
			}	
		}else{
			return $entrada;	
		}
	}
	
	function enviaEmail($dados){	
		include_once 'mail/class.phpmailer.php';
		
		$mail = new PHPMailer();
		@$mail->IsSMTP(); //ENVIAR VIA SMTP
		@$mail->Host = "mail.rcenter.com.br"; //SERVIDOR DE SMTP, USE smtp.SeuDominio.com OU smtp.hostsys.com.br
		@$mail->SMTPAuth = true; //ATIVA O /SMTP AUTENTICADO
		@$mail->Username = "enviosmtp@rcenter.com.br"; //EMAIL PARA SMTP AUTENTICADO (pode ser qualquer conta de email do seu domínio)
		@$mail->Password = "rcenter10"; //SENHA DO EMAIL PARA SMTP AUTENTICADO
		@$mail->From =  $dados['email_remetente'] ; //E-MAIL DO REMETENTE
		@$mail->FromName = utf8_decode($dados['nome_remetente']); //NOME DO REMETENTE
		
		foreach ($dados['destinatario'] as $k => $v){
			@$mail->AddAddress($v, utf8_decode($k)); //E-MAIL DO DESINATÁRIO, NOME DO DESINATÁRIO
		}
		
		if(isset($dados['anexo']) && is_array($dados['anexo'])){
			$mail->AddAttachment($dados['anexo']['pasta'], $dados['anexo']['arquivo']);
		}
		
		@$mail->WordWrap = 50; // ATIVAR QUEBRA DE LINHA
		@$mail->IsHTML(true); //ATIVA MENSAGEM NO FORMATO HTML
		@$mail->Subject = utf8_decode($dados['assunto']); //ASSUNTO DA MENSAGEM
		@$mail->Body = utf8_decode($dados['texto']); //MENSAGEM NO FORMATO HTML
		
		if(@$mail->Send()){
			return true;
		}else{
			return false;	
		}
	}
	
	function criaConsulta($texto){
		$texto = utf8_decode($texto);
		
		$acentos = array(
        'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
        'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
        'C' => '/&Ccedil;/',
        'c' => '/&ccedil;/',
        'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
        'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
        'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
        'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
        'N' => '/&Ntilde;/',
        'n' => '/&ntilde;/',
        'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
        'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
        'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
        'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
        'Y' => '/&Yacute;/',
        'y' => '/&yacute;|&yuml;/',
        '' => '/&ordf;/',
        '' => '/&ordm;/',
		'-' => '/&frasl;/',
		'' => '/&ordf;/'
		);
		
		$texto = htmlentities($texto,ENT_NOQUOTES);
        
		$texto = preg_replace($acentos, array_keys($acentos), $texto);
		
		$texto = html_entity_decode($texto, ENT_NOQUOTES);		
	
		$texto = trim($texto);

		$texto = utf8_encode($texto);
		
		return $texto;
	}
	
	function identifica_hyperlink($texto) {
		$texto = ereg_replace("[a-zA-Z]+://([.]?[a-zA-Z0-9_/-])*", "<a href=\"\\0\" target='_blank'>\\0</a>", $texto);
		$texto = ereg_replace("(^| )(www([.]?[a-zA-Z0-9_/-])*)", "\\1<a href=\"http://\\2\" target='_blank'>\\2</a>", $texto);
		return $texto;
	}


	

	function get_likes($url) {
	  // faz a requisição a API passando a URL como parametro
	  $json_string = file_get_contents('http://graph.facebook.com/?ids='.$url);
	 // usando a função json_decode e transformando em um array	  
	  $json = json_decode($json_string, true);
	  // retorna o número de likes
	  if(isset($json[$url]['shares'])){
	  	return intval( $json[$url]['shares'] );
	  }else{
	  	return 0;
	  }
	} 

	function mesNumerico($mes){
		
		switch($mes){
			case "01" : $mes = "Janeiro"; 
			break;
			case "02" : $mes = "Fevereiro"; 
			break;
			case "03" : $mes = "Março"; 
			break;
			case "04" : $mes = "Abril"; 
			break;
			case "05" : $mes = "Maio"; 
			break;
			case "06" : $mes = "Junho"; 
			break;
			case "07" : $mes = "Julho"; 
			break;
			case "08" : $mes = "Agosto"; 
			break;
			case "09" : $mes = "Setembro"; 
			break;
			case "10" : $mes = "Outubro"; 
			break;
			case "11" : $mes = "Novembro"; 
			break;
			case "12" : $mes = "Dezembro"; 
			break;
		}
		return $mes;
	}


	

	function ajustaData($data_geral){
		list($dia,$mes,$ano) = explode('/', $data_geral);

		switch($mes) {
			case '01': $mes_extenso = 'JAN'; break;
			case '02': $mes_extenso = 'FEV'; break;
			case '03': $mes_extenso = 'MAR'; break;
			case '04': $mes_extenso = 'ABR'; break;
			case '05': $mes_extenso = 'MAI'; break;
			case '06': $mes_extenso = 'JUN'; break;
			case '07': $mes_extenso = 'JUL'; break;
			case '08': $mes_extenso = 'AGO'; break;
			case '09': $mes_extenso = 'SET'; break;
			case '10': $mes_extenso = 'OUT'; break;
			case '11': $mes_extenso = 'NOV'; break;
			case '12': $mes_extenso = 'DEZ'; break;
		}

		$data_final = $dia." ".$mes_extenso." ".$ano;

		return($data_final);

	}

	function ajustaData2($data_geral){
		list($ano,$mes) = explode('-', $data_geral);

		switch($mes) {
			case '01': $mes_extenso = 'JANEIRO'; break;
			case '02': $mes_extenso = 'FEVEREIRO'; break;
			case '03': $mes_extenso = 'MAR&Ccedil;O'; break;
			case '04': $mes_extenso = 'ABRIL'; break;
			case '05': $mes_extenso = 'MAIO'; break;
			case '06': $mes_extenso = 'JUNHO'; break;
			case '07': $mes_extenso = 'JULHO'; break;
			case '08': $mes_extenso = 'AGOSTO'; break;
			case '09': $mes_extenso = 'SETEMBRO'; break;
			case '10': $mes_extenso = 'OUTUBRO'; break;
			case '11': $mes_extenso = 'NOVEMBRO'; break;
			case '12': $mes_extenso = 'DEZEMBRO'; break;
		}

		$data_final = $mes_extenso." ".$ano;

		return($data_final);

	}

	function resumo($texto, $tam){ 
		$tam = $tam;
		$total = strlen($texto);
		if($total > $tam){
			$palavras = explode(" ",$texto);
			$palavra = "";
			$texto = "";
			$aux = "";
			foreach($palavras as $k => $v){
				$palavra = $v;
				$aux .= " ".$palavra;
				$aux = trim($aux);
				if(strlen($aux) <= $tam){
					$texto = $aux;
				}else{
					$texto .= "...";
					break;
				}
			}  
		}
		return $texto;
	}



?>