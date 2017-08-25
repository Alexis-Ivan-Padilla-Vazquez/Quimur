<?php 
require_once('../lib.php');
if( $_REQUEST['cmd'] == 'login')
{

    $r =DB_INTERFACE_Select('usuario',array('*'),
            array(
                array('condition'=>'usuario = "%s"',
                      'condition_values'=>array($_REQUEST["usuario"])
                )
            )
        );
    $r = $r[0];
    if( !empty($r) && $r["password"] == $_REQUEST["password"] ){
        $_SESSION['pasaporte'] = 1;
        $_SESSION['Usuario'] = $r;
        header('location:main.php');
        die();
        
    }else{
        $msjErr = '¡Usuario o Contraseña Incorrectos!';
    }
    
    
}?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="SiFrame Admin Panel">
<meta name="keywords" content="Admin, Dashboard, Bootstrap3, Sass, transform, CSS3, HTML5, Web design, UI Design, Responsive Dashboard, Responsive Admin, Admin Template, Best Admin UI, Bootstrap Template, Wrapbootstrap, Bootstrap">
<meta name="author" content="Bootstrap Gallery">
<link rel="shortcut icon" href="assets/img/favicon.ico">
<title>Backoffice :: <?=PROJECT_NAME?></title>
<link href="assets/css/login.css" rel="stylesheet" media="screen">
<link href="assets/fonts/icomoon/icomoon.css" rel="stylesheet">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="assets/css/main.css" rel="stylesheet" media="screen">
<link href="assets/css/heatmap/cal-heatmap.css" rel="stylesheet">
<link href="assets/css/c3/c3.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/datepicker.css">
<link href="assets/css/datatables/dataTables.bs.min.css" rel="stylesheet">
<link href="assets/css/datatables/autoFill.bs.min.css" rel="stylesheet">
<link href="assets/css/datatables/fixedHeader.bs.css" rel="stylesheet">
        
        <script language="javascript" type="application/javascript">
            function Confirmar()
            {
                if(confirm('¿Estas seguro que deseas eliminar este registro?'))
                {
                    return true;
                }
                else
                {
                    return false;
                }   
            }
        </script>
    </head>
<form action="index.php" method="post">
	<div id="login-wrapper">
		<div id="login_header">
			<img src="assets/img/logo.png" class="logo" alt="Admin Dashboard">
		</div>	
		<h5>Inicia sesión para acceder a tu panel de administración.</h5>
		<?if($msjErr != ''){?><h5 style="color: #E20606;"><i><?=$msjErr?></i></h5><?}?>
		<div id="inputs">	
			<div class="form-block">
				 <input type="text" placeholder="Usuario" name="usuario" style="height: 50px">
				 <i class="icon-user"></i>
			</div>
			<div class="form-block">
				<input type="password" name="password" placeholder="Password" style="height: 50px">
			</div>
			<input type="submit" value="Enviar">
			</div>
		</div>
	<input type='hidden' name='cmd' value='login' />
</form>
</body>
</html>