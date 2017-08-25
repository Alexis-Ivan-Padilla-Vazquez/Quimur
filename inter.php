
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
			          <li><a href="#"><? echo $producto; ?></a></li>
		          	</ul>
	          	</div>
	        </div><!-- Subpage title end -->
			</div><!-- Banner area end -->
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							 	<h2 class="article-title"><? echo $producto; ?></h2>
							<div class="service-items single">
							<?php
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
				    
				    $imagen = $fila['imagen'];
				  
				 }		
				 ?>	
				 			<div style="text-align:center; ">
							<img class="" src="system/files/images/<?php echo $imagen; ?>"" alt="" width="500">
							</div>
											<? include "producto_body.php";?>
						
					</div><!--/ Service item single end -->

				</div><!--/ Content col 8 end -->


			<? include 'contact-us.php'; ?>
			
		</div><!--/ Content row end -->

	</div><!--/ container end -->
		
</section><!--/ Main container end -->