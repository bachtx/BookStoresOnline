<?php
session_start();
ob_start();
// include config
define('incl_path','includes/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinnit.php');
require_once(incl_path.'gffunction.php');
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.catalogs.php');
require_once(libs_path.'cls.products.php');
require_once(libs_path.'cls.template.php');

$templates= new CLS_TEMPLATE();
define('THIS_TEM_PATH',ROOT_PATH.'templates/');
$templates->WapperTem();
?>