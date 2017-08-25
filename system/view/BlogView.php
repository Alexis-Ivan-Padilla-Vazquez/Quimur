<?php
$params = Controller_GetViewParams();
$data = $params['data'];
$title = $data['titulo'];
$categoria_detalle = DB_INTERFACE_LoadById('categoria','id',$data['categoria_id']);

require "head.php";
?>
<body class="home">
<? include "nav.php";?>
<? include "header_interior.php";?>
<section class="row content-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8 single-post-contents">
                <article class="single-post-content row m0 post">
                    <header class="row">                        
                        <h5 class="post-meta">
                            <a href="#" class="date"><?=returnDate($data['fecha'])?></a>
                            <!--<span class="post-author"><i>tags #</i><a href="#"><?=$data['tags']?></a></span>-->
                        </h5>
                        <h2 class="post-title"><?=$data['titulo']?></h2>
                        <div class="row">
                            <h5 class="taxonomy pull-left"><a href="#"><?=$categoria_detalle['nombre']?></a></h5>                            
                        </div>
                    </header>

                    <? 
                    $extraConditions = array();     
                    $extraConditions[] = array('condition'=>"sec_id = '%s'", 'condition_values'=>array($data['id']));          
                    //debug($extraConditions);
                    $imagenes = DB_INTERFACE_Select('imas',array('*'), $extraConditions, array( 'order'=>'id', 'order_values'=>array('DESC') ), 1, -1); 
                    //debug($imagenes);
                    ?>

                    <!-- Place somewhere in the <body> of your page -->
                        <div class="thumbCarousel row m0">
                            <div id="slider" class="flexslider">
                                <ul class="slides">
                                    <? foreach ($imagenes as $key => $img){ ?>
                                        <li><img src="<?=ABS_HTTP_URL?>system/files/images/<?=$img['nombre']?>" alt="<?=$img['section']?>"></li>    
                                    <? } ?>
                                </ul>
                            </div>
                            <div id="carousel" class="flexslider">
                                <ul class="slides">
                                <? foreach ($imagenes as $key => $img){ ?>
                                    <li><img src="<?=ABS_HTTP_URL?>system/files/images/<?=$img['nombre']?>" alt="<?=$img['section']?>" style="cursor: pointer;"></li>
                                <? } ?>
                                </ul>
                            </div>
                        </div>


                    <!--<div class="featured-content row m0">
                        <a href="#"><img src="<?=ABS_HTTP_URL?>system/files/images/<?=$data['imagen']?>" alt="<?=$data['titulo']?>"></a>
                    </div>-->
                    
                    <div class="post-content row">
                        
                        <h3><?=nl2br($data['subtitulo'])?></h3>
                        <br>
                        <p><?=nl2br($data['contenido'])?></p>
                        <br>
                        
                        
                        <!-- 16:9 aspect ratio -->
                        <? if($data['video']!= ''){?>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$data['video']?>"></iframe>
                        </div>
                        <br>
                        <? } ?>
                        <div class="response-count pull-right">
                                <div class="addthis_inline_share_toolbox"></div>
                    </div>
                      <?
                      $tags_exp = explode(',',$data['tags']);
                      //debug($tags_exp);
                      ?>  
                    <div class="row m0 tags">
                       <? foreach($tags_exp as $key => $value){?>
                        <a href="#" class="tag"><?=$value?></a>
                       <? }?>
                    </div>
                    
                    <? 
                    $extraConditions = array();     
                    $extraConditions[] = array('condition'=>"status = '%s'", 'condition_values'=>array('Activo'));          
                    //debug($extraConditions);
                    $blogs_recomendados = DB_INTERFACE_Select('blog',array('*'), $extraConditions, array( 'order'=>'RAND()', 'order_values'=>array('DESC') ), 1, 2); 
                    //debug($blogs_recomendados);?>
                    <h4 class="response-count">Otros Blogs</h4>
                    <ul class="pager">
                    <? foreach ($blogs_recomendados as $key => $blog) {
                        $categoria = DB_INTERFACE_LoadById('categoria','id',$blog['id']);
                         $url = getFriendlyNameUrl($blog['id'],"blog",$blog['titulo']); 
                         ?>

                        <li>
                            <h4><a href="<?=$url?>" style="font-size: 16px;"><?=f_cut_string($blog['titulo'],100)?></a></h4>
                            <!--<h2 class="post-title"><a href="blog.php?cmd=view&id=<?=$blog['id']?>"><?=f_cut_string($blog['contenido'],80)?>...</a></h2>-->
                            <!--<h5 class="taxonomy pull-left"><i>in</i> <a href="#">image</a>, <a href="#">entertainment</a></h5>-->
                        </li>                        

                    <? }?>
                    </ul>
                    
                    <div class="fb-comments" data-href="<?=$url?>" data-width="720" data-numposts="100"></div>
                </article>
            </div>
            <? include "blog_main_side_bar.php";?>
        </div>
    </div>
</section>
<? include "footer.php";?>
<!--========== jQuery (necessary for Bootstrap's JavaScript plugins) ==========-->
<? include "js.php";?>
</body>
<!-- Mirrored from wrappixel.com/demos/html-templates/Chivalric/single.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Feb 2017 23:52:12 GMT -->
</html>