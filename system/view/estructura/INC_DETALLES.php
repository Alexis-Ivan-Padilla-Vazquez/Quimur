<?php
$extraConditions = array();
$extraConditions[] = array('condition'=>'%s IS NULL OR %s = 0', 'condition_values'=>array('m_cart_categoria_parent_id','m_cart_categoria_parent_id') );
$results = DB_INTERFACE_Select('m_cart_categoria',array('*'), $extraConditions, 'nombre ASC', 1, -1);

$htmlSelect = '<div class="wrapper">';
foreach($results as $result){
	$extraConditions = array();
	$extraConditions[] = array('condition'=>'m_cart_categoria_parent_id = %s', 'condition_values'=>array($result['m_cart_categoria_id']) );
	$results2 = DB_INTERFACE_Select('m_cart_categoria',array('*'), $extraConditions,
			array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ), 
		1, -1);

	$htmlSelect .= '<br /><strong>' . $result['nombre'].'</strong>';
	foreach($results2 as $result2){
		$extraConditions = array();
		$extraConditions[] = array('condition'=>'m_cart_categoria_parent_id = %s', 'condition_values'=>array($result2['m_cart_categoria_id']) );
		$results3 = DB_INTERFACE_Select('m_cart_categoria',array('*'), $extraConditions,
				array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ), 
			1, -1);
		
		if(empty($results3)){
			$htmlSelect .= '<br />> <a href="MCartProducto.php?categoriaId=' . $result2['m_cart_categoria_id'].'">' . $result2['nombre'].'</a>';
		}else{
			//$htmlSelect .= '<br />+<a href="MCartProducto.php?categoriaId=' . $result2['m_cart_categoria_id'].'">' . $result2['nombre'].'</a>';
			$htmlSelect .= '<br />+' . $result2['nombre'].'';
			foreach($results3 as $result3){
				$htmlSelect .= '<br />&nbsp;&nbsp;&nbsp;><a href="MCartProducto.php?categoriaId=' . $result3['m_cart_categoria_id'].'">' . $result3['nombre'].'</a>';
			}
		}
	}
	$htmlSelect .= '<br />';
}
$htmlSelect .= '</div>';

	

?>
<div class="col-2"><h2 style="margin-bottom:0px;">Categorias</h2>

<?php echo $htmlSelect; ?>