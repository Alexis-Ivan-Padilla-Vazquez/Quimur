<?
include'lib.php';
require_once('lib/controller.php');



				
								$extraConditions = array();
								$extraConditions[] = array('condition'=>'nombre = %s', 'condition_values'=>array("lavanderias") );
			                       $result22 = DB_INTERFACE_Select('categoria',array('*'), $extraConditions,
			                         array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ),
      									1, -1);
			                         foreach($result22 as $results22){

			                  								 	 }
			                  								 	 
			                  	$extraConditions1 = array();
								$extraConditions1[] = array('condition'=>'parent_id = %s', 'condition_values'=>array($results['parent_id']) );
			                       $result1 = DB_INTERFACE_Select('categoria',array('*'), $extraConditions1,
			                       array( 'order'=>'%s ASC' ),1, -1);
			                         foreach($result1 as $results1){
			                  								 	 	}

									$extraConditions2 = array();
									 $extraConditions2[] = array('condition'=>'categoria_producto_id = %s', 'condition_values'=>array($results['id']) );
				                       $result2 = DB_INTERFACE_Select('producto',array('*'), $extraConditions2,
				                       array( 'order'=>'%s ASC' ),1, -1);

				                         foreach($result2 as $results2){
				                         echo "<h3 class='title-border'>". $results2['producto']."<strong>". $results1['nombre']."</strong></h3>";
										echo "<div class='content-list'>";
													echo "<p>".  $results2['descripcion'] ."</p>";
												echo "<ul class='list-arrow'>";
												echo "<li>ver mas</li>"
												echo"</ul>";
											echo"</div>";
											
											
				                         }

				             ?>

			