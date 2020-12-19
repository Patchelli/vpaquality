<?php  

	$seo["title"] = "Vpa Quality | "; 
	$seo["description"]= "Quality.";  
	$seo["keywords"] = "Quality.";   
	 
	$isiPad = (bool) strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'ipad'); 
	$isiPhone = (bool) strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'iphone');
	$isAndroid = (bool) strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'android');
	 
	//Titulo que aparecera no celular e tablets
	if($isiPad || $isiPhone || $isAndroid){
	    $seo['title'] = "Quality | ";
	} 
?>