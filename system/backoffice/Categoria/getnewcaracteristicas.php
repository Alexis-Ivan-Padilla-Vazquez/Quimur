<?php

require_once('../../lib.php');
require_once('../../lib/controller.php');

$ca = empty($ca) ? array() : $ca;

$res = $_GET['valor'];
//$form2 = array();
//$items2 = array();

if(!empty($res) ){

for ($i = 1; $i <= $res; $i++) {

$items2[] = array('text'=>'Nombre del atributo', 'type'=>'text',  'name'=>'entity2[atributo]', 'value'=> $data['atributo'], id =>'nombre_atributo', 'class' => 'col-md-3');

$items2[] = array('text'=>'Unidad', 'type'=>'text',  'name'=>'entity2[unidad]', 'value'=> $data['unidades'], id =>'unidades', 'class' => 'col-md-3');

$option = array("Selecciona"=>"Selecciona", "text"=> "text","select" =>"select");

$items2[] = array('text'=>'Type', 'type'=>select,'options'=>$option,  'name'=>'entity2[type]', 'value'=>$option, 'id' =>'type', 'class' => 'col-md-3');

$items2[] = array('text'=>'*Options', 'type'=>'text',  'name'=>'entity2[option]', 'value'=> $data['option'], id =>'option', 'class' => 'col-md-3');

}

}else{}

 $form2['items'] = $items2;
                                 displayForm( $form2);
                                
?>
