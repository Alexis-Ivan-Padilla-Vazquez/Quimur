<?php
require_once('../lib.php');
if( $_REQUEST['cmd'] == 'login')
{
    require_once('../lib.php');
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
    
    
}
include "header_login.php";
?>
    <body>
        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="wrapper-page">
                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h2 class="text-uppercase m-t-0 m-b-30">
                                        <a href="index-2.html" class="text-success">
                                            <span><img src="assets/images/logo_dark.png" alt="" height="30"></span>
                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" action="" method="post">
                                    <input value="login" name="do" type="hidden">
									<input type='hidden' name='cmd' value='login' />
										<? if($msjErr != ''){?>
								        <div class="messages_wrapper">
													<table class="message_box" align="center" border="0" width="400px">
								                        <tbody>
								                            <tr>
								                                <td class="message_text" style="padding:5px;">
								                                    <span style="color: #FF0000">
                                                                        <?=$msjErr?>
                                                                    </span>
								                                </td>
								                            </tr>
								                        </tbody>
								                    </table>
												<br>		
										</div>
										<? } ?>
                                        
                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="emailaddress">Usuario</label>
                                                <input class="form-control" type="text" id="usuario" name="usuario" required="" placeholder="Ingresa tu usuario">
                                            </div>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <!--<a href="pages-forget-password.html" class="text-muted pull-right font-14">Olvidaste tu password?</a>-->                                                <label for="password">Password</label>
                                                <input class="form-control" type="password" required="" name="password" id="password" placeholder="Ingres tu password">
                                            </div>
                                        </div>
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- end card-box-->
                            <!--<div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-dark m-l-5">Sign Up</a></p>
                                </div>
                            </div>-->
                        </div>
                        <!-- end wrapper -->
                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>
        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>
    </body>
<!-- Mirrored from coderthemes.com/simple_1.1/dark/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Feb 2017 00:48:08 GMT -->
</html>