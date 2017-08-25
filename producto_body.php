	<?php
	header('Content-Type: text/html; charset=ISO-8859-1');
if (!$enlace = mysql_connect('localhost','uquimurmx', 'Hv5ux9?7')) {
			    echo 'No pudo conectarse a mysql';
			    
				}
						if (!mysql_select_db('quimurmx_sibei', $enlace)) {
			    echo 'No pudo seleccionar la base de datos';
			    exit;
			}

 $str = <<<EOF
     "$producto"
EOF;
		 $sql  = 'SELECT * FROM categoria WHERE nombre ='.$str;
			$resultado = mysql_query($sql, $enlace);
			if (!$resultado) {
			    echo "Error de BD, no se pudo consultar la base de datos\n";
			    echo "Error MySQL: " . mysql_error();    
			}
				while ($fila = mysql_fetch_assoc($resultado)) {
				     $id = $fila['id'];
				    $imagen = $fila['imagen'];
				    $nom = utf8_encode($fila['nombre']);
				 }
				  $sql2  = 'SELECT * FROM categoria WHERE parent_id ='.$id;
					$resultado2 = mysql_query($sql2, $enlace);
						if (!$resultado2) {
						    echo "Error de BD, no se pudo consultar la base de datos\n";
						    echo "Error MySQL: " . mysql_error();    
						}
							while ($fila2 = mysql_fetch_assoc($resultado2)) {
							    $parent_id = $fila2['id'];
							     $subclase = utf8_encode($fila2['nombre']);
							     
							 	
						 	  $sql3  = 'SELECT * FROM producto WHERE categoria_producto_id ='.$parent_id;
								$resultado3 = mysql_query($sql3, $enlace);
									if (!$resultado3) {
									    echo "Error de BD, no se pudo consultar la base de datos\n";
									    echo "Error MySQL: " . mysql_error();    
									}
							
										while ($fila3 = mysql_fetch_assoc($resultado3)) {
										     $nombrehijos = utf8_encode($fila3['producto']);
										      $descripcion = utf8_encode($fila3['descripcion']);
												$id_producto = $fila3['id'];
										     ?>
												
												<br>
						                        <h3 class="title-border"><?php echo $nombrehijos; ?>  <strong>[<?php echo $subclase; ?>] </strong></h3>
						                        
												<div class="content-list">
														 <p><?php echo $descripcion; ?></p>
														<ul class="list-arrow">
														<li><a href="subproducto.php?producto=<? echo $id_producto;?>&padre=<? echo $id;?>&sub=<? echo $subclase;?> ">VER MÁS</a></li>
													
														</ul>
													</div>	
										     <?php
										}
							}
														 $sql4  = 'SELECT * FROM producto WHERE categoria_producto_id ='.$id;
															$resultado4 = mysql_query($sql4, $enlace);
																if (!$resultado4) {
																    echo "Error de BD, no se pudo consultar la base de datos\n";
																    echo "Error MySQL: " . mysql_error();    
																}
														
																	while ($fila4 = mysql_fetch_assoc($resultado4)) {
																	     $nombrepadres = utf8_encode($fila4['producto']);
																	      $descripcions = $fila4['descripcion'];
																	     $id_productos = $fila4['id'];

																	     		if($id_productos){
																			?>
																		
														                        <h3 class="title-border"><?php echo $nombrepadres; ?>  <strong> [<?php echo  $nom; ?>] </strong></h3>

																				<div class="content-list">
																						 <p><?php echo $descripcions; ?></p>
																						<ul class="list-arrow">
																						<li><a href="subproductopadre.php?producto=<? echo  $id;?>&padre=<? echo $id;?>
																						">VER MÁS</a></li>
																					
																						</ul>
																					</div>
													<?php
																		}
																		}
								                         	?>
				                        	
																	
														
				                        	
							
			           											
							