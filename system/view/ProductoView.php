<?php 
$params = Controller_GetViewParams();
$data = $params['data'];
 
//debug($data);
$nombre_producto 	  = empty($data['producto']) ? '' : $data['producto'];
$precio				      = formatNumber($data['precio']);
$clave 				      = empty($data['codigo']) ? '' : formatStr($data['codigo']);
$descripcion 		    = empty($data['descripcion']) ? '' : '<p align="justify">'.$data['descripcion'].'</p>';
$medida 			      = empty($data['medida']) ? '' : nl2br($data['medida']);
$tipo 				      = empty($data['tipo']) ? '' : nl2br($data['tipo']);
//marca
$marca_id		 	    =  $data['marca_id'];
$marca			 	    =  DB_INTERFACE_LoadById('marca','id',$marca_id);	
$marca_nombre	 	  =  $marca['nombre'];

//categoria
$id		 	             =  $data['categoria_producto_id'];
$categoria			 	   =  DB_INTERFACE_LoadById('categoria_producto','id',$id);		

$categoria_hijo			 =  $categoria['nombre'];
$categoria_padre_id  =  $categoria['parent_id'];
//debug($categoria_hijo);
$categoria_padre		 =  DB_INTERFACE_LoadById('categoria_producto','id',$categoria_padre_id);		
$categoria_padre		 =  $categoria_padre['nombre'];							

if(!empty($categoria_hijo)){
  $cat_cad .= " | ".$categoria_hijo;
}

if(!empty($categoria_padre)){
  $cat_cad .= " | ".$categoria_padre." | ";
}

$title = $nombre_producto.$cat_cad;

require "head.php";
?>
<body class="home">
<? include "nav_store.php";?>
<? include "header_interior.php";?>
<section class="row content-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8 single-post-contents">
                <article class="single-post-content row m0 post">
                    <header class="row">                        
                        <h5 class="post-meta">
                            <!--<a href="#" class="date"><?=returnDate($data['fecha'])?></a>-->
                            <!--<span class="post-author"><i>tags #</i><a href="#"><?=$data['tags']?></a></span>-->
                        </h5>                        
                        <h2 class="post-title"><?=$data['producto']?></h2>
                        <div class="row">
                            <h5 class="taxonomy pull-left"><i>by</i> <span><?=$marca_nombre?></span></h5>
                            <div class="response-count pull-right" style="font-size: 22px; font-style: italic;">
                            <p>$<?=number_format($data['precio_venta'],2)?></p>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="business" value="hola@emprendiendomex.com">
                                <input type="hidden" name="lc" value="MX">
                                <input type="hidden" name="item_name" value="<?=$data['producto']?>">
                                <input type="hidden" name="item_number" value="<?=$data['id']?>">
                                <input type="hidden" name="amount" value="<?=number_format($data['precio_venta'],2)?>">
                                <input type="hidden" name="currency_code" value="MXN">
                                <input type="hidden" name="button_subtype" value="products">
                                <input type="hidden" name="no_note" value="0">
                                <input type="hidden" name="add" value="1">
                                <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHostedGuest">
                                <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                                <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
                            </form>

                            </div>
                        </div>
                    </header>
                    <div class="featured-content row m0">
                        <a href="#"><img src="<?=ABS_HTTP_URL?>system/files/images/<?=$data['imagen']?>" alt="<?=$data['titulo']?>"></a>
                    </div>
                    <div class="post-content row">
                        
                        <!--<h3><?=nl2br($data['subtitulo'])?></h3>
                        <br>-->
                        <p><?=nl2br($data['descripcion'])?></p>
                        <br>
                        <div class="addthis_inline_share_toolbox"></div>
                        <br />
                        <!-- 16:9 aspect ratio -->
                        <? if($data['video']!= ''){?>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$data['video']?>"></iframe>
                        </div>
                        <br>
                        <? } ?>
                        
                     
                    <? 
                    $extraConditions = array();     
                    $extraConditions[] = array('condition'=>"status = '%s'", 'condition_values'=>array('Activo'));          
                    //debug($extraConditions);
                    $productos_recomendados = DB_INTERFACE_Select('producto',array('*'), $extraConditions, array( 'order'=>'RAND()', 'order_values'=>array('DESC') ), 1, 2); 
                    //debug($blogs_recomendados);?>
                    <h4 class="response-count">Productos Recomendados</h4>
                    <ul class="pager">
                    <? foreach ($productos_recomendados as $key => $producto) {
                        $categoria = DB_INTERFACE_LoadById('categoria','id',$producto['id']);
                        $url = getFriendlyNameUrl($producto['id'],"producto",$producto['producto']); 
                        ?>

                        <li>
                            <h4><?=$producto['producto']?></h4>
                            
                            <a href="<?=$url?>"><img src="<?=ABS_HTTP_URL?>system/files/images/<?=$producto['imagen']?>" alt="<?=$producto['producto']?>" style="width:150px;"></a>
                        </li>                        

                    <? }?>
                    </ul>
                   
                    <div class="fb-comments" data-href="<?=$url?>" data-width="720" data-numposts="100"></div>
                </article>
            </div>
            <? include "producto_main_side_bar.php";?>
        </div>
    </div>
</section>
<? include "footer.php";?>
<!--========== jQuery (necessary for Bootstrap's JavaScript plugins) ==========-->
<? include "js.php";?>
</body>
<!-- Mirrored from wrappixel.com/demos/html-templates/Chivalric/single.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Feb 2017 23:52:12 GMT -->
</html>