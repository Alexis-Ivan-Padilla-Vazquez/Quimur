<?php include "head.php";?>
<body>
	<?php include "header.php";?>
	<div class="container-fluid">
		<div class="dashboard-wrapper";>
			<?php include "navbar.php";?>
			<?php include "top_bar.php";?>
			<?php
			if(empty($sec)){
				include "main_conteiner.php";
			}else{
				include ucfirst($sec).".php";
			}
			?>
			<?php include "footer.php";?>
		</div>
		<?php include "right_sidebar.php";?>
	</div>
	<?php include "scripts.php";?>
</body>
</html>