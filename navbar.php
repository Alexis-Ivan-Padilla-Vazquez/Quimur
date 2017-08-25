<div class="navbar ts-mainnav">
		<div class="container">
		    <? include "navbar_toggle.php";?>

			<nav class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown active">
                   		<a href="index.php">Home<i class="fa fa-angle-down"></i></a>
                   		<!--<div class="dropdown-menu">
							<ul>
	                            <li><a href="index-2.html">Home 1</a></li>
	                            <li><a href="index-3.html">Home 2</a></li>
	                            <li><a href="index-4.html">Home 3</a></li>
	                            <li class="active"><a href="index-5.html">Home 4</a></li>
	                        </ul>
                    	</div>-->
                    </li>

                   	<li class="dropdown">
                   		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Compañia <i class="fa fa-angle-down"></i></a>
                   		<div class="dropdown-menu">
							<ul>
	                            <li><a href="about.php">Sobre nosotros</a></li>
	                            <li><a href="mision.php">Misión, Visión y Valores</a></li>
	                            <!--<li><a href="vision.php">Visión</a></li>
	                            <li><a href="valores.php">Valores</a></li>-->
	                        </ul>
                    	</div>
                    </li>

                    <li class="dropdown">
                   		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Industrias <i class="fa fa-angle-down"></i></a>
                   		<div class="dropdown-menu">
							<ul>
	                            <li><a href="metal-mecanica.php">Metal-mecanica</a></li>
				                <li><a href="sanitizacion-portatil.php">Sanitización portatil</a></li>
				                <li><a href="alimentos-bebidas.php">Industria de Alimentos y Bebidas<</a></li>
				                <li><a href="lavanderia.php">Lavanderías</a></li>
				                <li><a href="ensayos-no-destructivos.php">Ensayos No destructivos</a></li>
				                <li><a href="aereonautica.php">Aereonáutica</a></li>
	                        </ul>
                    	</div>
                    </li>

                    <li class="dropdown visible-lg visible-md">
                   		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Productos <i class="fa fa-angle-down"></i></a>
                   		<div class="dropdown-menu">
							<ul>

	                            <li><a href="productos.php?producto=<?php echo base64_encode('METAL-MECANICA')?>">Metal-mecanica</a></li>

				                <li><a href="productos.php?producto=<?php echo base64_encode('SANITIZACION PORTATIL')?>">Sanitización portatil</a></li>
				                <li><a href="productos.php?producto=<?php echo base64_encode('INDUSTRIA DE ALIMENTOS Y BEBIDAS')?>">Industria de Alimentos y Bebidas</a></li>
				                <li><a href="productos.php?producto=<?php echo base64_encode('LIMPIEZA BIODEGRADABLE A CIENCIA CIERTA')?>">Lavanderías</a></li>
				                <li><a href="productos.php?producto=<?php echo base64_encode('ENSAYOS NO DESTRUCTIVOS')?>">Ensayos No destructivos</a></li>
				                <li><a href="productos.php?producto=<?php echo base64_encode('ESPECIALIDADES AEREONAUTICAS')?>">Aereonáutica</a></li>
	                        </ul>
                    	</div>
                    </li>

                    <li class="dropdown">
                   		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Certificaciones <i class="fa fa-angle-down"></i></a>
                   		<div class="dropdown-menu">
							<ul>
	                            <li><a href="">ISO9000</a></li>
	                            <li><a href="">NSF</a></li>
	                            <li><a href="">AMS</a></li>
	                        </ul>
                    	</div>
                    </li>

                    <li><a href="">Politicas</a></li>
                    <li><a href="">Contacto</a></li>
                    <li><img src="images/gb.png" style="width: 32px; padding: 18px 0 0; cursor: pointer;"></li>
                    <li><img src="images/ru.png" style="width: 32px; padding: 18px 0 0; cursor: pointer;"></li>
				</ul><!--/ Navbar-nav end -->
			</nav>
			<!--/ Navigation end -->

			<!-- Search start -->
			<div id="head-search" class="head-search input-group">
				<form id="searchform" action="#">
					<div class="search">
						<input class="search-field form-control" placeholder="Escribe tu busqueda" type="search">
						<i class="fa fa-search"></i>
					</div>
				</form>
			</div>
			<!-- Search end -->

		</div><!--/ Container end -->
	</div> 