<?php @session_start();
require_once('../lib.php');
require_once('pasaporte.php');
$sec            = $_REQUEST['sec'];
$profile        = $_SESSION['Usuario'];
$user_name      = $profile['nombre'];
$user_apellidos = $profile['apellidos'];
$user_user      = $profile['usuario'];
$user_pswd      = $profile['password'];
$user_email     = $profile['email'];
$user_rol       = $profile['rol'];
$user_imagen    = $profile['imagen'];
$user_status    = $profile['status'];
?>
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