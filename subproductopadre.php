<?
$title = "QUIMUR :: Proveedores de soluciones industriales inteligentes para mejorar el medio ambiente :: QUIMUR";
$site_description = "";
$keywords = "";
	include 'head.php';
?>
	
<body>

	<!-- Style switcher start -->
	<? include "switcher.php";?>
	<!-- Style switcher end -->

	<div class="body-inner">

	<? include "redes_sociales.php";?>

	<!-- Header start -->
	<? include "header.php";?>
	<!--/ Header end -->

	<!-- Navigation start -->
	<? include "navbar.php";?>
	<!-- Navbar end -->
	<?php 
		$padre=$_GET["padre"];
		 $producto=$_GET["producto"];
		  if (!$enlace = mysql_connect('localhost','uquimurmx', 'Hv5ux9?7
		  	')) {
			    echo 'No pudo conectarse a mysql';
			    
				}
						if (!mysql_select_db('quimurmx_sibei', $enlace)) {
			    echo 'No pudo seleccionar la base de datos';
			    exit;
			}
			 $sql5  = 'SELECT * FROM categoria WHERE id ='.$padre;
					$resultado5 = mysql_query($sql5, $enlace);
						if (!$resultado5) {
							echo "Error de BD, no se pudo consultar la base de datos\n";
							echo "Error MySQL: " . mysql_error();    
										}			
										while ($fila5 = mysql_fetch_assoc($resultado5)) {
															  $imagen = $fila5['imagen'];
														      $nombre = $fila5['nombre'];
																}

																 $sql6  = 'SELECT * FROM producto WHERE  id ='.$producto;
																	$resultado6 = mysql_query($sql6, $enlace);
																		if (!$resultado6) {
																			echo "Error de BD, no se pudo consultar la base de datos\n";
																			echo "Error MySQL: " . mysql_error();    
																						}			
																						while ($fila6 = mysql_fetch_assoc($resultado6)) {
																						$descripcion2 = $fila6['descripcion'];
																					 $id_producto = $fila6['id'];
																					 $nombre_producto  = utf8_encode($fila6['producto']);
																										}

    ?>
	<section id="main-container">
	<div class="container">
		<!-- About us -->
		<div class="row">
			<div id="banner-area">
			<!-- Subpage title start -->
			<div class="banner-title-content">
				<div class="container">
		        	<ul class="breadcrumb">
			            <li>Productos</li>
			            <li><? echo $nombre; ?></li>
			          <li><a href="#"><? echo  $nombre_producto; ?></a></li>
		          	</ul>
	          	</div>
	        </div><!-- Subpage title end -->
			</div><!-- Banner area end -->
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					 	<h2 class="article-title"><? echo $nombre; ?></h2>
					<div class="service-items single">

								<div style="text-align:center; ">
									 <img class="" src="system/files/images/<?php echo $imagen; ?>"" alt="" width="500">
									  <br>
									  </div>
									  	<h3 ><? echo $nombre; ?></h3>
											<h4 ><? echo  $nombre_producto; ?></h4>
												<div class="content-list">
													<p>  <?php echo $descripcion2; ?>  </p>
														<div class="content-list">
												<ul class="list-arrow">
															<?php
													 $sql7  = 'SELECT * FROM relacion WHERE  id_producto ='.$id_producto;
													 $resultado7 = mysql_query($sql7, $enlace);
														if (!$resultado7) {
															echo "Error de BD, no se pudo consultar la base de datos\n";
															echo "Error MySQL: " . mysql_error();    
														}			
															while ($fila7 = mysql_fetch_assoc($resultado7)) {
																	 $valor = utf8_encode($fila7['valor']);
																	 $id_catalogo = $fila7['id_catalogo'];

																	 $sql8  = 'SELECT * FROM catalogo WHERE  id_catalogo ='.$id_catalogo;
																			 $resultado8 = mysql_query($sql8, $enlace);
																				if (!$resultado8) {
																					echo "Error de BD, no se pudo consultar la base de datos\n";
																					echo "Error MySQL: " . mysql_error();    
																				}			
																				while ($fila8 = mysql_fetch_assoc($resultado8)) {
																							$atributo = utf8_encode($fila8['atributo']);
																					}
																				echo '<li>'. $atributo.':'.$valor .'</li>';					 
															}
													?>		
												</ul>
											</div>
												</div>			
							
					</div><!--/ Service item single end -->

				</div><!--/ Content col 8 end -->


			<? include 'contact-us.php'; ?>
			
		</div><!--/ Content row end -->

	</div><!--/ container end -->
		
</section><!--/ Main container end -->


	<div class="gap-40"></div>

	<!-- Footer start -->
	<? include "footer.php";?>
	<!-- Footer end -->
	
	<!-- Javascript Files
	================================================== -->

	<? include "scripts.php";?>
	</div><!-- Body inner end -->
</body>


</html>