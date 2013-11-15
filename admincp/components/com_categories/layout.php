<?php
	define('COMS','categories');
	// Begin Toolbar
	require_once(LAG_PATH.'lang_categories.php');
	require_once(libs_path.'cls.categories.php');
	
	if(!isset($objlang)) $objlang = new LANG_CATEGORIES;
	
	$title_manager = $objlang->CATE_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = $objlang->CATE_MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = $objlang->CATE_MANAGER_EDIT;
		
	require_once('includes/toolbar.php');
	// End toolbar
?>
<?php
	$obj=new CLS_CATEGORIES();
	if(isset($_POST['cmdsave'])) // them hoac sua 
	{
		$obj->cat_id=(int)$_POST['cbo_cat'];
		$obj->name=addslashes($_POST['txtname']);
		
		$sContent=addslashes($_POST['txt_metadesc']);
		$obj->desc=encodeHTML($sContent);
		
		$obj->isactive=(int)$_POST['optactive'];
		if(isset($_POST['txtid'])){
			$obj->id=(int)$_POST['txtid'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&mess=U01'</script>";
	}
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!="")
	{
		$ids=trim($_POST["txtids"]);
		if($ids!='')
			$ids = substr($ids,0,strlen($ids)-1);
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"]){
			case "public": 		$obj->setActive($ids,1); 		break;
			case "unpublic": 	$obj->setActive($ids,0); 		break;
			case "delete": 		$obj->Delete($ids); 			break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	///
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($task); unset($ids); unset($obj); unset($objlang);
?>