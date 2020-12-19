<?php 
include __DIR__.'/../admin/banner_class.php';
include __DIR__.'/../admin/features_class.php';
include __DIR__.'/../admin/includes/functions.php';


$MODULO = strtolower($MODULO);

if (empty($MODULO))
{
    $MODULO = 'home';
    $interna = false;
    $urlrewrite = "";
    $banners = buscaBanner(array('status'=>'1','ordem'=>'ordem', "dir"=> "asc"));
   
    // $galerias = buscaGaleria(array("ordem"=>"ordem", "status" => "A",   "dir"=> "asc"));
    // echo "<pre>";
    // var_dump($galerias);exit;
    // echo "</pre>";
    // $features_curiosidades = buscaFeaturesCuriosidades(array("ordem" => "ordem", "dir" => "asc"));
    // $features = buscaFeatures(array("ordem" => "ordem", "dir" => "asc"));

    // foreach($features as $key => $feat){
    //     if(strlen($features[$key]['icone']) < 4){
    //         $features[$key]['icone'] = buscaFW3(array("idfw"=>$feat['icone']));
    //     }else{
    //         $features[$key]['icone'] = array(array("idfw" => 0,"nome" => $features[$key]['icone']));
    //     }
    // }
    

    // foreach($features_curiosidades as $key => $feat){
    //     if(strlen($features_curiosidades[$key]['icone']) < 4){
    //         $features_curiosidades[$key]['icone'] = buscaFW3(array("idfw"=>$feat['icone']));
    //     }else{
    //         $features_curiosidades[$key]['icone'] = array(array("idfw" => 0,"nome" => $features_curiosidades[$key]['icone']));
    //     }
    // }

}