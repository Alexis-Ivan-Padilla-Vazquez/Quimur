<header class="clearfix">
        <div class="logo">
        <img src="<?=ABS_HTTP_URL?>images/logo.png" alt="Logo emprendiendomex">
        </div>
        <div class="pull-right">
            <ul id="header-actions" class="clearfix">
               
                <li class="list-box user-admin dropdown">
                    <div class="admin-details">
                        <div class="name"><?=$user_name?></div>
                        <div class="designation"><?=$user_rol?></div>
                    </div>
                    <a id="drop4" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-account_circle"></i>
                    </a>
                    <ul class="dropdown-menu sm">
                        <li class="dropdown-content">
                            <!--<a href="#">
                            <i class="icon-warning2"></i>Update Password<br><span>Your password will expire in 7 days.</span></a>
                            <a href="profile.html">Edit Profile</a>
                            <a href="forgot-pwd.html">Change Password</a> <a href="validations.html">Settings</a>-->
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <a href="comments.html" class="support">Soporte</a>
        <div class="custom-search">
            <input type="text" class="search-query" placeholder="Buscar ...">
             <i class="icon-search4"></i>
        </div>
</header>