<script type="text/javascript" src="<?=ENDERECO?>js/script.js"></script> 
<?php $filename = $endereco.".js";

if(file_exists("js/".$filename)) { ?>
	<script type="text/javascript" src="<?=ENDERECO?>js/<?php echo $endereco ?>.js"></script>
<?php } ?>