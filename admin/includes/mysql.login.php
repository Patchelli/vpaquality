<?php

	$host = "localhost";

	$user = "root";
	$password = "";
	//NOME DATABASE DO PROJETO
	$database = "vpaquality";

	//$ENDERECO = 'http://'.$_SERVER['HTTP_HOST'].'/';
	$ENDERECO = 'http://'.$_SERVER['HTTP_HOST'].'/vpaquality/admin/';

	$conexao = mysqli_connect($host, $user, $password) or exit(mysqli_connect_error());

	mysqli_select_db($conexao, $database) || exit(mysqli_error($conexao));

	defined('ENDERECO') || define('ENDERECO', $ENDERECO);
