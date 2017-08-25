<?php 
$params = Controller_GetViewParams();
$data = $params['data'];
include('header.php'); 
$items = MCart_getItems(); //obtiene los prodcutos de la secino del carrito
?>
<div class="content clearfix">
    <div class="left_column">
     <? include "product_menu.php";?>
      
      <? include "box_newsletter_box.php";?>
      
      <? include "payment_box.php";?>
    </div>
    
    	<div class="main_content">
      <div class="bredcrum"><a href="#">Lista de cotización</a></div>
      <h1 class="page_title">Cotizador</h1>
      <!--<div class="basket_options">
      	<a href="productos/" style="text-decoration:none;">Continuar cotizando</a>        
      </div>-->
	  
      <? if(empty($items)){ ?>
      	
        <div class="clearfix basket_list">
                    <img src="images/empty-cart.png" height="80" width="92" alt="Carrito vacio" border="0" /><br />                    
                    	<span class="gris14" >El carrito de Compras esta Vacío !</span><br /><br /><a href="<?=ABS_HTTP_URL?>productos/" class="gris11">Ver Productos</a>                   
                                    
        </div>
      
      <? }else{?>
      
      
			  <form action="" method="post">
						<table cellpadding="0" cellspacing="0" align="left" border="0" width="100%" class="gris11">
                        	<tr><td colspan="7" style="border-bottom:solid #167A3E;" height="1"></td></tr>
							<tr><td colspan="7" align="right">&nbsp;</td></tr>
                            <tr align="left">
                            	<th width="50"><b>Quitar</b></th>
                                <th width="110"></th>
                                <th width="200"><b>Producto</b></th>
                                <th width="180"><b>Cantidad</b></th>
                                <th width="245"><b>Descripción</b></th>
                                <th width="245"><b>Tiempo</b></th>
                                <th width="245"><b>Lugar</b></th>
                                <!--<th width="120">Precio unitario</th>
                                <th width="120">Subtotal</th>-->
                            </tr>
							<tr><td colspan="7" align="right">&nbsp;</td></tr>
						<?php 
						
							foreach($items as $item){
									echo '<tr><td colspan="6" align="right">&nbsp;</td></tr>';
									echo '<tr align="left" height="60"><td><img src="images/x.png" border="0" alt="eliminar" title="eliminar" width="13" />&nbsp;<input type="checkbox" name="eliminar[]" value="'.$item['m_cart_producto_id'].'" /></td>
									<td>';
									if( !empty($item['imagen'])){
										echo '<a href="MCartProducto.php?cmd=view&id='.$item['m_cart_producto_id'].'"><img '.getSrcImgScaleParams(getImgDir('m_cart_producto','imagen',70,0,false) . $item['imagen'],70,0 ) .' alt="" border="0"></a>';
									}
									echo '
									</td>
											<td><a href="MCartProducto.php?cmd=view&id='.$item['m_cart_producto_id'].'" style="text-decoration:none;">'.$item['titulo'].'</a>'.(!empty($item['peso_grs']) ?
			"<BR /><strong>Peso: ".number_format($item['peso_grs'],2,'.',',')." grs.</strong>" : "" ).'</td>
											<td><input type="text" class="gris11" style="width:50px" name="qty_'.$item['m_cart_producto_id'].'" value="'.$item['cantidad'].'" /></td>
											<td>'.$item['des'].'</td>
											<td>'.$item['tmp'].'</td>
											<td>'.$item['etd'].'</td>
											<!--<td>'.formatNumber($item['precio']).'</td>
											<td>'.formatNumber($item['total']).'</td>-->
									</tr>';
								?>
								<tr><td colspan="7" style="border-bottom:solid #167A3E;" height="1"></td></tr>
							<? 	} ?>
						  <tr><td colspan="7" align="right">&nbsp;</td></tr>
						  <!--<tr><td colspan="5" align="right">Subtotal&nbsp;&nbsp;</td><td><?php //echo formatNumber(MCart_getTotalItems()); ?></td></tr>-->
						  <tr><td colspan="7"><br /><br />
                          <input type="submit" name="button" value="Actualizar Cotización" class="silver_btn remove_btn"><input type="hidden" name="cmd" value="Actualizar_Carrito">
						  <input type="button" onclick="document.location.href='MCartPurchase.php'" value="Iniciar Proceso de Cotizacion" class="silver_btn remove_btn" >
						  <BR /><BR /><BR />* Precios no incluyen IVA
						  </td></tr>
						  </table>
		
						</form>	
              
      <? } ?>
      
      <div class="basket_options">
      	<a href="productos/" class="silver_btn remove_btn">Continuar cotizando</a>        
      </div>
     
    </div>
    
    <div class="right_column">
      <? include "customer_nav.php"?>
      
      <? include "product_guide.php";?>
      
      <? include "store_locator.php";?>
      
      <? include "products_box.php";?>
    </div>
  </div>
<?php include('footer.php'); ?>