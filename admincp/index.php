<?php
session_start();
define('incl_path','../includes/');
define('incl_path_admin','includes/');
define('libs_path','libs/');
define('ISHOME',true);
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinnit.php');
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.users.php');

require_once(incl_path.'gffunction.php');
$UserLogin=new CLS_USERS();
?>
<!DOCTYPE html>
<html>
<header>
	<meta charset='utf-8'/>
	<title>Control Cpanel Bookonline</title>
	<link type="text/css" rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all" /> <!-- css cho calendar -->
	<link rel="stylesheet" href="css/ui.theme.css" type="text/css"/>
    <script type="text/javascript" src="js/checkForm.js"></script>
    <script type="text/javascript" src="../<?php echo JSC_PATH;?>jquery-1.8.2.min.php"></script>
	<script type="text/javascript" src="../<?php echo JSC_PATH;?>jquery-ui-1.8.24.custom.min.php"></script>
	<script language="javascript" src="../<?php echo JSC_PATH;?>gfscript.php"></script>
    <script type='text/javascript' src="extensions/editor/innovar/scripts/innovaeditor.php"></script>
    <script language="javascript" src="../<?php echo JSC_PATH;?>jquery.validate.php"></script>
	<script type="text/javascript" src="../js/calendar_vi.php"></script>
</header>
<body>
<div id='container'>
    <div id='header'><!-- Start header-->
        <div class="navitor">
            <?php require_once(MOD_PATH.'mod_mainmenu/layout.php');?>
        </div>
	</div><!-- End header -->				
	<div id='main'><!-- Start Main -->
        <div class="cpanel_main">
            <?php
        	if($UserLogin->isLogin()!=true){
    			include_once(COM_PATH."com_users/task/login.php");
    		}
    		else{
            ?>
            <div id="path"><strong>Chào:</strong> <?php echo $_SESSION["IGFUSERLOGIN"];?></div>
            <div class="content">
            <?php
                $com='';
                if(isset($_GET['com']))
                    $com=$_GET['com'];
                if(!is_file(COM_PATH."com_".$com."/layout.php"))
                    $com='fronpage';
                include(COM_PATH."com_".$com."/layout.php");
            ?>
            </div>
            <?php } ?>                  
        </div>
	</div><!-- End Main -->
	<div id='footer'><!-- Start footer-->
	   <?php require_once(MOD_PATH."mod_footer/layout.php");?>
	</div><!-- End Footer -->
</div>
</body>
</html>
