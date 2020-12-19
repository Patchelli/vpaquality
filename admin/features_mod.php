<?php 
	 // Versao do modulo: 3.00.010416
	 include __DIR__.'/../admin/includes/functions.php';
	include_once "features_class.php";
    $icone = buscaFW3(array('ordem' => 'nome', 'dir' => 'asc'));
	if(!isset($_REQUEST['acao']))
		$_REQUEST['acao'] = ""; 
     
?>
<link rel="stylesheet" type="text/css" href="features_css.css" />
<script type="text/javascript" src="features_js.js"></script>

<!--************************************
                                         _ _ _
                                        | (_) |
 _ __   _____   _____     ___    ___  __| |_| |_ __ _ _ __
| '_ \ / _ \ \ / / _ \   / _ \  / _ \/ _` | | __/ _` | '__|
| | | | (_) \ V / (_) | |  __/ |  __/ (_| | | || (_| | |
|_| |_|\___/ \_/ \___/   \___|  \___|\__,_|_|\__\__,_|_|
								*******************************-->


<?php if($_REQUEST['acao'] == "formFeatures"){
	if($_REQUEST['met'] == "editFeatures"){
		if(!verificaPermissaoAcesso($MODULOACESSO['modulo'].'_editar', $MODULOACESSO['usuario'])) {
			header('Location:index.php?mod=home&mensagemalerta='.urlencode('Voce nao tem privilegios para acessar este modulo!'));
			exit;
		}
		$action = "features_script.php?opx=editFeatures";
		$metodo_titulo = "Editar Features";
		$idFeatures = (int) $_GET['idu'];
		$features = buscaFeatures(array('idfeatures'=>$idFeatures));

		if (count($features) != 1) exit;
		$features = $features[0];

        $StringIcone = strlen($features['icone']);
        if ($StringIcone > 3) {
            $FontAwesome = false;
        } else {
            $FontAwesome = true;
            $icones_Edit = buscaFW3(array('idfw' => $features['icone']));
            $icones_Edit = $icones_Edit[0];
        }
	}
?>

	<div id="titulo">
		<i class="fa fa-asterisk" aria-hidden="true"></i>
		<span><?php print $metodo_titulo; ?></span>
		<ul class="other_abs">
			<li class="other_abs_li"><a href="index.php?mod=features&acao=listarFeatures">Listagem</a></li>
		</ul>
	</div>
  
	<div id="principal">
		<form class="form" name="formFeatures" id="formFeatures" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">

			<div id="informacaoFeatures" class="content">
				<div class="content_tit">Dados Features:</div>
                    <!-- ========== Upload Icone ========== -->
                    <div class="box_ip" style="width:100%">
                        <ul class="tabs">
                            <li class="tab-link <?= $FontAwesome ? 'current' : ''; ?>" data-tab="tab-1">Escolher um Ícone</li>
                            <li class="tab-link <?= !$FontAwesome ? 'current' : ''; ?>" data-tab="tab-2">Anexar um Ícone</li>
                        </ul>
                        <div id="tab-1" class="tab-content <?= $FontAwesome ? 'current' : ''; ?>">
                            <span class='labeltxt' for="pesquisar_icone" style="margin-bottom:15px"><strong>Ícone</strong></span>
                            <?php if ($_GET['met'] == 'editFeatures') : ?>
                                <div id="mostrar_icone" style="margin: 15px">
                                    <i class='fa fa-<?= $icones_Edit['nome']; ?> fa-2x '></i>
                                    <input type="hidden" name="icone" value="<?= $FontAwesome ? $icones_Edit['idfw'] : $features['icone']; ?>" id="imagem_icone">
                                </div>
                            <?php else : ?>
                                <div id="mostrar_icone" style="margin: 15px">
                                    <input type="hidden" name="icone" id="imagem_icone">
                                </div>
                            <?php endif; ?>
                            <input type="text" name="pesquisar_icone" id="pesquisar_icone" placeholder="Pesquise um icone" style="margin-bottom: 10px">
                            <div id="icone_pai">
                                <?php foreach ($icone as $key => $i) : ?>
                                    <div style="width:6%; display: inline-block;" data-toggle="tooltip" title="<?= $i['nome']; ?>">
                                        <i class="fa fa-<?= $i['nome']; ?> icone_icone" data-id="<?= $i['idfw']; ?>" data-nome="<?= $i['nome']; ?>" style="padding:11px; cursor: pointer;"></i>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-content <?= !$FontAwesome ? 'current' : ''; ?>">
                            <?php $caminho = "files/features/"; ?>
                            <div class="content_tit" style="margin-left:0; padding-left:0;">Ícone</div>
                            <span class="botaoArquivo" id="inputArquivoBotao">Anexar Ícone <i class="fa fa-paperclip" aria-hidden="true"></i></span>
                            <input type="file" name="icone" id="icone_upload" class="all_imagens" data-tipo='1'><br>
                            <img class="pump" src="<?= $caminho . $features['icone']; ?>" height='87' id="icone" style="margin-top: 10px;display: <?= $_GET['met'] == 'editFeatures' ? (!empty($features['icone'] && !$FontAwesome) ? 'initial' : 'none') : 'none'; ?>"><br>
                            <p class="pre">Tamanho recomendado: 78x78 (ou maior proporcional) - Extensão recomendada: jpg, png</p>
                            <span>O arquivo não pode ser maior que:
                                <?php
                                $tamanho = explode('M', ini_get('upload_max_filesize'));
                                $tamanho = $tamanho[0];
                                echo $tamanho . 'MB';
                                ?>
                            </span>
                            <input type="hidden" name="maxFileSize" id="maxFileSize" value="<?php echo $tamanho; ?>" />
                        </div>
                    </div>
                    <script>
                        var div = document.getElementsByClassName("botaoArquivo")[0];
                        var input = document.getElementById("icone_upload");

                        div.addEventListener("click", function() {
                            input.click();
                        });
                        input.addEventListener("change", function() {
                            var nome = "sem arquivos...";
                            if (input.files.length > 0) nome = input.files[0].name;
                            div.innerHTML = nome;
                        });
                    </script>
                    <!-- ========== Fim Upload Icone ========== -->
					<div class="box_ip" style='width:100%'>
						<label for="nome">Título</label>
						<input type="text" name="titulo" id="nome" size="30" maxlength="255" value="<?php echo $features['titulo']; ?>"/>
					</div>
					<div class="box_ip box_txt">
						<label for="descricao">Descricao</label>
						<textarea name="descricao" id="descricao" cols="34" rows="4" ><?php echo $features['descricao']; ?></textarea>
					</div>
			</div> 

			<input type="hidden" name="idfeatures" id="idfeatures" value="<?= $idFeatures; ?>" />
			<input type="submit" value="Salvar" class="bt_save salvar" />
			<input type="button" value="Cancelar" class="bt_cancel cancelar" />
		</form>
	</div>
	 
<?php } ?>



<!--************************************
     _       _        _        _     _
    | |     | |      | |      | |   | |
  __| | __ _| |_ __ _| |_ __ _| |__ | | ___
 / _` |/ _` | __/ _` | __/ _` | '_ \| |/ _ \
| (_| | (_| | || (_| | || (_| | |_) | |  __/
 \__,_|\__,_|\__\__,_|\__\__,_|_.__/|_|\___|
					*******************************-->


<?php if($_REQUEST['acao'] == "listarFeatures"){ ?><?php
	if(!verificaPermissaoAcesso($MODULOACESSO['modulo'].'_visualizar', $MODULOACESSO['usuario']))
		header('Location:index.php?mod=home&mensagemalerta='.urlencode('Voce nao tem privilegios para acessar este modulo!'));
?>
 
	<div id="titulo">
		<i class="fa fa-asterisk" aria-hidden="true"></i>
		<span>Listagem de Features</span>
		<ul class="other_abs">
			<li class="other_abs_li"><a href="index.php?mod=features&acao=listarFeatures">Listagem</a></li>
		</ul>
	</div>
	<div class="search">
		<form name="formbusca" method="post" action="#" onsubmit="return false">
			<input type="text" name="buscarapida" value="Buscar" onblur="campoBuscaEscreve(this);" onfocus="campoBuscaLimpa(this);" id="buscarapida" />
		</form>
		<a href="" class="search_bt">Busca Avançada</a>
	</div>
	<div class="advanced">
		<form name="formAvancado" id="formAvancado" method="post" action="#" onsubmit="return false">
			<p class="advanced_tit">Busca Avançada</p>
			<img class="advanced_close" src="images/ico_close.png" height="10" width="11" alt="ico" />
			<div class="box_ip"><label for="adv_nome">Título</label><input type="text" name="titulo" id="adv_nome"></div> 
            <!-- <div class="box_ip" style="width:32%;"> 
                <div class="box_sel" style="width:100%;margin:0;padding:0px;">
                  <label for="">Status</label>
                  <div class="box_sel_d">
                     <select name="status" id="status" class='required' style="width:100%;margin:0;">
                            <option></option>
                            <option value="A"> Ativo </option>
                            <option value="I"> Inativo </option>
                      </select>
                  </div>
               </div>
            </div> -->
			<a href="" class="advanced_bt" id="filtrar">Filtrar</a>
		</form>
	</div>
 
	<div id="principal" >
		<div id="abas"> 
			<ul class="abas_list">
				<li class="abas_list_li action"><a href="javascript:void(0)">Features</a></li>
			</ul>
			<ul class="abas_bts">
				<li class="abas_bts_li"><a href="javascript:void(0)" onclick="popUp('relatorio_class.php?modulo=features&output=print&'+queryDataTable);"><img src="images/imprimir.png" alt="Imprimir listagem" title="Imprimir listagem"></a></li>
				<li class="abas_bts_li"><a href="javascript:void(0)" onclick="popUp('relatorio_class.php?modulo=features&output=xls&'+queryDataTable);"><img src="images/excel.png" alt="Exportar para o Excel" title="Exportar para o Excel"  ></a></li>
			</ul>
		</div>
		<table class="table" cellspacing="0" cellpadding="0" id="listagem">
			<thead>
			</thead>
			<tbody>
			</tbody>
		</table>
		<?php include_once("paginacao/paginacao.php"); ?> 
 

		<?php
			$dados = isset($_POST) ? $_POST : array();
			$buscar = '';
			foreach($dados as $k=>$v){
				if(!empty($v)){
					$buscar .= $k.'='.$v.'&';
				}
			}
		?>


		<script type="text/javascript">
			queryDataTable = '<?php print $buscar; ?>';
			requestInicio = "tipoMod=features&p="+preventCache+"&";
			ordem = "ordem";
			dir = "asc";
			$(document).ready(function(){
				preTableFeatures();
			});
			dataTableFeatures('<?php print $buscar; ?>');
			columnFeatures();
		</script> 

	</div>

<?php } ?>



<!--/////////////////////////////////////////////////////////-->
<!--////////////// FORMULARIOS PARA A GALERIA ////////////////-->
<!--////////////////////////////////////////////////////////-->

<!--Inicio dialog descrição-->
<div id="boxDescricao" style="display:none;">													
	<div id="principal">
		<form class="form" name="formDescricaoImagem" id="formDescricaoImagem" method="post" action="">
			<div id="informacaoGaleria" class="content">								
				<div class="content_tit"></div>		
			   	<div class="box_ip" >
					<label  for="descricao_imagem">Descrição</label>
					<input type="text" name="descricao_imagem" id="descricao_imagem"   />
					<input type="hidden" id="idImagem" value="" /> 
					<input type="hidden" id="posImagem" value="" />
				</div>
				<input type="submit" value="Salvar" class="btSaveDescricao button" />
			</div>
		</form>
	</div>
</div>	
<!--Fim dialog descrição-->	

<!--Inicio dialog exclusão de imagem-->
<div id="excluirImagem" style="display:none;">													
	<div id="principal">
		<form class="form" name="formDeleteImagem" id="formDeleteImagem" method="post" action="">
			<div id="informacaoGaleria" class="content">								
				<div class="content_tit"></div>	 
				<input type="hidden" id="idPosicao" value="" />  
				<input type="button" value="NÃO" id="cancelar" class="btCancelarExclusao button cancel" />							   	
				<input type="submit" value="SIM" class="btExcluirImagem button"/>
			</div>
		</form>
	</div>
</div>	
<!--Fim dialog exclusão de imagem-->
<input type="hidden" value="<?= ENDERECO ?>admin/" name="_endereco" id="_endereco" />






