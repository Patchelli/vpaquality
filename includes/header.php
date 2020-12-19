<?php include 'includes/topo.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php print $seo['title']; ?></title>
  <meta name="author" content="<?php print $head['author']; ?>" />
  <meta name="description" content="<?php print $seo['description']; ?>" />
  <meta name="keywords" content="<?php print $seo['keywords']; ?>" />
  <meta name="copyright" content="<?php print $head['copyright']; ?>" />
  <meta name="title" content="<?php print $seo['title']; ?>" />
  <meta name="robots" content="index,follow" />
  <!-- <base href="<?php print ENDERECO; ?>" property="og:title" />   -->
  <meta property="og:type" content="article">
  <meta property="og:url" content="<?php echo ENDERECO.$_REQUEST['p']; ?>"/>    
  <meta property="og:title" content="<?php print $seo['title']; ?>"/>
  <meta property="og:image" content="<?php print ENDERECO; ?><?php echo !empty($seo['imagem']) ? $seo['imagem'] : "images/assets/bg-logo.png"?>"/>    
  <meta property="og:description" content="<?php echo ((isset($seo['resumo']))? $seo['resumo']:$seo['description']) ?>" /> 


  <link type="text/css" rel="stylesheet" href="<?=ENDERECO?>css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="<?=ENDERECO?>css/style.min.css">
  <?php if ($endereco == "home"): ?>
    <link type="text/css" rel="stylesheet" href="<?=ENDERECO?>css/planos.css">
  <?php endif; ?>  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="shortcut icon" href="images/icons/favicon.png">
  
    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!--CSS-->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/home.css">
    <!--SLICK-->
    <link rel="stylesheet" href="./css/slick.min.css">
</head>
<body>