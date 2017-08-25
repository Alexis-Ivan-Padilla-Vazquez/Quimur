<?php
$params = Controller_GetViewParams();
$data = $params['data'];

if(empty($data)){
    $no_data =  'Actualmente no hay registros encontrados';
}

$hiddenFields = array();
$hiddenFields['total'] = $_total_data;
$hiddenFields['k'] = $config['k'];
$hiddenFields['p'] = $config['p'];
$hiddenFields['q'] = $config['q'];
$hiddenFields['o'] = $config['o'];
$hiddenFields['categoriaId'] = $_REQUEST['categoriaId'];
$categoriaActual = MCart_GetCategoriaById($_REQUEST['categoriaId']);


//cateforia
$categoria_id		 	=  $_REQUEST['categoriaId'];
$categoria			 	=  DB_INTERFACE_LoadById('m_cart_categoria','m_cart_categoria_id',$categoria_id);		
$categoria_hijo			=  $categoria['nombre'];

$categoria_padre_id = 		$categoria['m_cart_categoria_parent_id'];
$categoria_padre		=   DB_INTERFACE_LoadById('m_cart_categoria','m_cart_categoria_id',$categoria_padre_id);		
$categoria_padre		=	$categoria_padre['nombre'];	



 if($categoriaActual['nombre'] == ''){
		$title = " Tienda | Productos | ";
		}else{
		$title = $categoriaActual['nombre']." | ";  
		}

//$title = "Blogs ::";
//$site_description = "";

require "head.php";
?>
<body class="home">
<? include "nav_store.php";?>
<? include "header_interior.php";?>

<section class="row content-wrap">
    <div class="container">
        <div class="row" id="post-masonry">

                <article class="col-sm-4 post post-masonry post-format-image">
                        <div class="post-wrapper row">
                        <img src="<?=ABS_HTTP_URL?>images/instagram2.jpg" style="width:379px;">  
                            <div class="embed-responsive embed-responsive-16by9" style="height:390px;">
                            
                            <!-- LightWidget WIDGET -->
                            <script src="//lightwidget.com/widgets/lightwidget.js"></script>
                            <iframe src="//lightwidget.com/widgets/04329f1486f75047a788b811ed091424.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
                            
                            </div>
                            <div class="post-excerpt row">
                                  
                                <h3 class="post-title">emprendiendomex</h3>
                                 <p>Emprendiendo México Promote and spread the talent of Mexican entrepreneurs.Compártan sus cuentas mexicanas favoritas con nosotros usando el HT #emprendiendoméxico</p>
                               
                            </div>
                        </div>
                </article>
           
            <!--Blog Post-->
            <?
            if(!empty($data)){

                foreach ($data as $post) {
                   $marca =  DB_INTERFACE_LoadById('marca','id',$post['marca_id']);
                   $url = getFriendlyNameUrl($post['id'],"producto",$post['producto']); 
                   ?>
                    <article class="col-sm-4 post post-masonry post-format-image">
                        <div class="post-wrapper row">
                            <div class="featured-content row">
                                <a href="<?=$url?>">
                                <img src="<?=ABS_HTTP_URL?>system/files/images/<?=$post['imagen']?>" alt="<?=$post['producto']?>" class="img-responsive"></a>
                            </div>
                            <div class="post-excerpt row">
                                <h5 class="post-meta">
                                    <a href="<?=$url?>" class="date" style="font-size: 16px; font-weight: 300;"><?=$post['producto']?></a>
                                    <span class="post-author"><i>by</i><a href=""><?=$marca['nombre']?></a></span>
                                </h5>
                                <h3 class="post-title">
                                  <a href="<?=$url?>">$<?=number_format($post['precio_venta'],2)?></a>
                                  <!--<span style="font-size: 14px; font-style: italic;"><?=$post['precio_venta']?></span>-->
                                </h3>
                                <!--<p></p>-->
                                <!--<footer class="row">
                                    <h5 class="taxonomy">#<i><?=$post['tags']?></i></h5>
                                    <div class="response-count"><img src="images/comment-icon-gray.png" alt="">5</div>
                                </footer>-->
                            </div>
                        </div>
                    </article>
                <? } 
                }else{?>

                    <article class="col-sm-4 post post-masonry post-format-image">
                        <div class="post-wrapper row" style="text-align: center;">
                            <div class="featured-content row">
                                <p style="text-align: center;"><?=$no_data?></p>
                            </div>
                           
                        </div>
                    </article>

                <? } ?>
                
           <!--
            <aside class="col-sm-4 widget widget-twitter widget-with-posts post">
                <div class="widget-twitter-inner">
                    <h5 class="widget-meta"><i class="fa fa-twitter"></i>Twitter feed <a href="http://twitter.com/chivalricblog">@chivalricblog</a></h5>
                    <div class="row tweet-texts">
                        <p>Check out new post on my blog <a href="http://twitter.com/#natureshot">#natureshot</a> <a href="http://bit.ly/blog">http://bit.ly/blog</a></p>
                    </div>
                    <div class="row timepast">1 day ago</div>
                </div>
            </aside>
           
            <aside class="col-sm-4 widget widget-instagram widget-with-posts post">
                <div class="widget-instagram-inner">
                    <h5 class="widget-meta"><i class="fa fa-twitter"></i>instagram feed <a href="http://twitter.com/chivalricblog">@chivalricblog</a></h5>
                    <div id="instafeed"></div>
                </div>
            </aside>
            -->
        </div>
    </div>
</section>
<!--Footer-->
<? include "footer.php";?>
<!--========== jQuery (necessary for Bootstrap's JavaScript plugins) ==========-->
<? include "js.php";?>
</body>
<!-- Mirrored from wrappixel.com/demos/html-templates/Chivalric/index5.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Feb 2017 23:51:34 GMT -->
</html>