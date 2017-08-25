<? 
$params = Controller_GetViewParams();
$data = $params['data'];
$hiddenFields = array();
$hiddenFields['total'] = $_total_data;
$hiddenFields['k'] = $config['k'];
$hiddenFields['p'] = $config['p'];
$hiddenFields['q'] = $config['q'];
$hiddenFields['o'] = $config['o'];
if(empty($data)){
    $no_data =  'Actualmente no hay registros encontrados';
}
$title = "Blogs ::";
$site_description = "";
require "head.php";
?>
<body class="home">
<? include "nav.php";?>
<? include "header_interior.php";?>

<section class="row content-wrap">
    <div class="container">
        <div class="row" id="post-masonry">
           
            <!--Blog Post-->

            <?
            if(!empty($data)){ 
                
                    $extraConditions = array();     
                    $extraConditions[] = array('condition'=>"status = '%s'", 'condition_values'=>array('Activo'));          
                    //debug($extraConditions);
                    $videos = DB_INTERFACE_Select('video',array('*'), $extraConditions, array( 'order'=>'fecha %s', 'order_values'=>array('DESC') ), 1, 1); 
                    //debug($videos_recomendados);

                foreach ($videos as $key => $video) { ?>

                <article class="col-sm-4 post post-masonry post-format-image">
                        <div class="post-wrapper row">
                            <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$video['url']?>"></iframe>
                            </div>
                            <div class="post-excerpt row">
                                <h5 class="post-meta">
                                    <a href="#" class="date"><?=returnDate($video['fecha'])?></a>
                                    <!--<span class="post-author"><i>by</i><a href="#">Mark Sanders</a></span>-->
                                </h5>
                                <h3 class="post-title"><?=$video['nombre']?></h3>
                                 <p><?=f_cut_string($video['descripcion'], 100)?>...</p>
                               
                            </div>
                        </div>
                </article>

               <? }

                foreach ($data as $post) {
                   $usuario =  DB_INTERFACE_LoadById('usuario','id',$post['user_id']);
                   $url = getFriendlyNameUrl($post['id'],"blog",$post['titulo']); 
                   ?>
                    <article class="col-sm-4 post post-masonry post-format-image">
                        <div class="post-wrapper row">
                            <div class="featured-content row">
                                <a href="<?=$url?>">
                                <img src="<?=ABS_HTTP_URL?>system/files/images/<?=$post['imagen']?>" alt="<?=$post['titulo']?>" class="img-responsive"></a>
                            </div>
                            <div class="post-excerpt row">
                                <h5 class="post-meta">
                                    <a href="<?=$url?>" class="date"><?=returnDate($post['fecha'])?></a>
                                    <span class="post-author"><i>by</i><a href="#"><? echo ($post['publicado'] != '')? $post['publicado'] : "Emprendiendo México";?></a></span>
                                </h5>
                                <h3 class="post-title"><a href="<?=$url?>"><?=$post['titulo']?></a></h3>
                                <p><?=f_cut_string($post['subtitulo'], 100)?>...</p>
                                <footer class="row">
                                    <h5 class="taxonomy">#<i><?=$post['tags']?></i></h5>
                                    <!--<div class="response-count"><img src="images/comment-icon-gray.png" alt="">5</div>-->
                                </footer>
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