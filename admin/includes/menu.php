<aside class="menu bg <?=(!isset($_SESSION['lateral']) ? "open" : $_SESSION['lateral'] );?>">
  <div class="bg_menu bg <?=(!isset($_SESSION['lateral']) || $_SESSION['lateral'] == "open" ? "" : 'close' );?>"></div>
  <h1 class="menu_logo"><a href="<?=ENDERECO?>" class="menu_logo_a">
      <img src="" width="143" alt="ico" />
      <img class="logo_close" src="" height="39" width="30" alt="ico" />
    </a></h1>
  <h2 class="menu_tit">Sistema de Gestão Web</h2>
  <div class="menu_bts">
    <div class="menu_bts_inner">
      <a href="" class="menu_bts_li" target="_blank"><img src="images/doubt.png" height="30" width="55" alt="ico" /></a>
      <a href="?mod=usuario&acao=formUsuario&met=editaUsuario&idu=<?=$_SESSION['sgc_idusuario'];?>"
        class="menu_bts_li"><img src="images/key.png" height="30" width="55" alt="ico" /></a>
      <a href="" id="logoffBtn" class="menu_bts_li"><img src="images/off.png" height="30" width="55" alt="ico" /></a>

      <!-- ADD ICON MENU -->

      <a href='#' id='mobHambBtn' onclick="showMenuMob(this)" class='menu_bts_li'><img src='css/menumob.png' height='30'
          width='55' alt='ico'></a>
      <script>
        function showMenuMob() {
          $(".menu_ul, .menu_user, .menu_sec").fadeToggle();

        }
      </script>

      <!-- STOP ICON MENU -->


    </div>
  </div>
  <div class="menu_user">
    <div class="menu_user_inner">
      <img
        src="<?= !empty($_SESSION['sgc_foto'])? "files/images/thumbs2/".$_SESSION['sgc_foto'] : "http://placehold.it/36x36" ?>"
        alt="img" class="alteraImagem" />
      <span><?=ucwords($_SESSION['sgc_nome'])?></span>
      <ul class="huser_menu">
        <li class="huser_menu_li"><a
            href="?mod=usuario&acao=formUsuario&met=editaUsuario&idu=<?=$_SESSION['sgc_idusuario'];?>">Meus Dados</a>
        </li>
        <li class="huser_menu_li"><a href="javascript:void(0)" class="alteraImagem">Alterar Foto</a></li>
        <!-- <li class="huser_menu_li"><a href="">Alterar Senha</a></li> -->
        <li class="huser_menu_li"><a href="usuario_script.php?opx=logout">Sair</a></li>
      </ul>
    </div>
  </div>
  <div class="menu_sec">
    <input type="text" class="menu_sec_ip" placeholder="Buscar" />
  </div>
  <ul class="menu_ul">
    <li class="menu_ul_li none"><a class="menu_ul_li_a" href="index.php"><img width="18" height="14" alt="ico"
          src="images/ico_house.png">Home</a></li>


    <!-- NAO APAGAR!!! INSERIR OPCAO DE MENU AQUI -->

    <?php if(
              verificaPermissaoAcesso('configuracoes_listagem_usuarios', $MODULOACESSO['usuario']) ||
              verificaPermissaoAcesso('configuracoes_cadastro_usuarios', $MODULOACESSO['usuario']) ||
              verificaPermissaoAcesso('configuracoes_permissao', $MODULOACESSO['usuario'])         ||
              verificaPermissaoAcesso('configuracoes_log', $MODULOACESSO['usuario'])
            ){ ?>



    <li class="menu_ul_li">
      <a class="menu_ul_li_a"><i class="fa fa-image" aria-hidden="true"></i>Banner</a>
      <ul>
        <?php if(verificaPermissaoAcesso('banner_visualizar', $MODULOACESSO['usuario'])){ ?>
        <li class="menu_ul_li">

          <ul>
            <li><a href="index.php?mod=banner&amp;acao=listarBanner">• Listagem</a></li>
            <li><a href="index.php?mod=banner&amp;acao=formBanner&amp;met=cadastroBanner">• Cadastro</a></li>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </li>


    <li class="menu_ul_li">
      <a class="menu_ul_li_a"><img width="15" height="16" alt="ico" src="images/ico_conf.png">Configuração</a>
      <ul>
        <?php if( verificaPermissaoAcesso('configuracoes_listagem_usuarios', $MODULOACESSO['usuario']) ){ ?>
        <li><a href="index.php?mod=usuario&acao=listarUsuario">• Listagem Usuários</a></li>
        <?php } ?>
        <?php if( verificaPermissaoAcesso('configuracoes_cadastro_usuarios', $MODULOACESSO['usuario']) ){ ?>
        <li><a href="index.php?mod=usuario&acao=formUsuario&met=novaUsuario">• Cadastro Usuário</a></li>
        <?php } ?>
        <?php if( verificaPermissaoAcesso('configuracoes_permissao', $MODULOACESSO['usuario']) ){ ?>
        <li><a href="index.php?mod=permissao&acao=listarPermissao">• Permissão</a></li>
        <?php } ?>
        <?php if( verificaPermissaoAcesso('configuracoes_log', $MODULOACESSO['usuario']) ){ ?>
        <li><a href="index.php?mod=log&acao=listarLog">• Log</a></li>
        <?php } ?>
      </ul>
    </li>
    <?php } ?>

  </ul>
  <a href="" class="menu_close"></a>
</aside>