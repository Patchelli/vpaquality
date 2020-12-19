<?php 
	 // Versao do modulo: 3.00.010416


	/**
	 * <p>salva autores no banco</p>
	 */
	function cadastroAutores($dados)
	{
		include "includes/mysql.php";

		foreach ($dados AS $k => &$v) {
			if (is_array($v)) continue;
			if (get_magic_quotes_gpc()) $v = stripslashes($v);
			$v = mysqli_real_escape_string($conexao, utf8_decode($v));
		}

		$dados['titulo'] = trim($dados['titulo']);

		$sql = "INSERT INTO autores(titulo, imagem) VALUES (
						'".$dados['titulo']."',
						'".$dados['imagem']."')";
		if (mysqli_query($conexao, $sql)) {
			$resultado = mysqli_insert_id($conexao);
			return $resultado;
		} else {
			return false;
		}
	}

	/**
	 * <p>edita autores no banco</p>
	 */
	function editAutores($dados)
	{
		include "includes/mysql.php";

		foreach ($dados AS $k => &$v) {
			if (is_array($v)) continue;
			if (get_magic_quotes_gpc()) $v = stripslashes($v);
			$v = mysqli_real_escape_string($conexao, utf8_decode($v));
		}

		$dados['titulo'] = trim($dados['titulo']);

		$sql = "UPDATE autores SET
						titulo = '".$dados['titulo']."',
						imagem = '".$dados['imagem']."'
					WHERE idautores = " . $dados['idautores'];

		if (mysqli_query($conexao, $sql)) {
			return $dados['idautores'];
		} else {
			return false;
		}
	}

	/**
	 * <p>busca autores no banco</p>
	 */
	function buscaAutores($dados = array())
	{
		include "includes/mysql.php";

		foreach ($dados AS $k => &$v) {
			if (is_array($v) || $k == "colsSql") continue;
			if (get_magic_quotes_gpc()) $v = stripslashes($v);
			$v = mysqli_real_escape_string($conexao, utf8_decode($v));
		}

		//busca pelo id
		$buscaId = '';
		if (array_key_exists('idautores',$dados) && !empty($dados['idautores']) )
			$buscaId = ' and idautores = '.intval($dados['idautores']).' '; 

		//busca pelo titulo
		$buscaTitulo = '';
		if (array_key_exists('titulo',$dados) && !empty($dados['titulo']) )
			$buscaTitulo = ' and titulo LIKE "%'.$dados['titulo'].'%" '; 


		//busca pelo imagem
		$buscaImagem = '';
		if (array_key_exists('imagem',$dados) && !empty($dados['imagem']) )
			$buscaImagem = ' and imagem LIKE "%'.$dados['imagem'].'%" '; 

        //ordem
        $orderBy = "";
        if (isset($dados['ordem']) && !empty($dados['ordem']) && isset($dados['dir'])){
			$orderBy = ' ORDER BY '.$dados['ordem'] ." ". $dados['dir'];
        }

        //busca pelo limit
		$buscaLimit = '';
		if (array_key_exists('limit',$dados) && !empty($dados['limit']) && array_key_exists('pagina',$dados)) {
            $buscaLimit = ' LIMIT '.($dados['limit'] * $dados['pagina']).','.$dados['limit'].' ';
        } elseif (array_key_exists('limit',$dados) && !empty($dados['limit']) && array_key_exists('inicio',$dados)){
            $buscaLimit = ' LIMIT '.$dados['limit'].','.$dados['inicio'].' ';
        } elseif (array_key_exists('limit',$dados) && !empty($dados['limit'])){
            $buscaLimit = ' LIMIT '.$dados['limit'];
        }

		//colunas que serão buscadas
		$colsSql = '*';
		if (array_key_exists('totalRecords',$dados)){
			$colsSql = ' count(idautores) as totalRecords';
            $buscaLimit = '';
            $orderBy = '';
        } elseif (array_key_exists('colsSql',$dados)) {
			$colsSql = ' '.$dados['colsSql'].' ';
		}

		$sql = "SELECT $colsSql FROM autores WHERE 1  $buscaId  $buscaTitulo  $buscaImagem  $orderBy $buscaLimit ";

		$query = mysqli_query($conexao, $sql);
		$resultado = array();
		while ($r = mysqli_fetch_assoc($query)){
			$r = array_map('utf8_encode', $r);
			!empty($r['imagem']) ? $r['imagem-caminho'] = '<img class="card-autor-adm" src="files/autores/'.$r['imagem'].'" class="img-depoimento"/>' : $r['imagem-caminho'] = 'SEM IMAGEM';
			$resultado[] = $r;
		}
		return $resultado; 
 	}

	/**
	 * <p>deleta autores no banco</p>
	 */
	function deletaAutores($dados)
	{
		include "includes/mysql.php";

		$sql = "DELETE FROM autores WHERE idautores = $dados";
		if (mysqli_query($conexao, $sql)) {
			return mysqli_affected_rows($conexao);
		} else {
			return FALSE;
		}
	}

	function editOrdemAutores($dados)
	{
	    include "includes/mysql.php";
	   
	    $sql = "UPDATE autores SET					
						ordem = '".$dados['ordem']."'						
					WHERE idautores = " . $dados['idautores'];
	    
	    if (mysqli_query($conexao, $sql)) {
	        return $dados['idautores'];
	    } else {
	        return false;
	    }
	}

	function apagarImagemAutores($imgs) {
        $path = 'files/autores/';
        if(file_exists($path)){
            //apaga os arquivos que foram salvos
            if(is_array($imgs)){
                foreach ($imgs as $img) {
                    //imagem fundo
                    $arquivo = $img['imagem_old'];
                    $arquivo2 = str_replace('_', '', $arquivo);
                    $original = "original_".$arquivo;

                    if(file_exists($path.$arquivo)){
                        unlink($path.$arquivo);
                    }
                    if(file_exists($path.$arquivo2)){
                        unlink($path.$arquivo2);
                    }
                    if(file_exists($path.$original)){
                        unlink($path.$original);
                    }

                    //imagem fundo
                    $arquivo = $img['imagem_old'];
                    $original = "original_".$arquivo;

                    if(file_exists($path.$arquivo)){
                        unlink($path.$arquivo);
                    }
                    if(file_exists($path.$original)){
                        unlink($path.$original);
                    }
                }
            }else{
                $arquivo = $imgs;
                $arquivo2 = str_replace('_', '', $arquivo);
                $original = "original_".$arquivo;

                if(file_exists($path.$arquivo)){
                    unlink($path.$arquivo);
                }
                if(file_exists($path.$arquivo2)){
                    unlink($path.$arquivo2);
                }
                if(file_exists($path.$original)){
                    unlink($path.$original);
                }
            }
        }
        return true;
    }

?>