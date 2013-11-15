<?php
    defined("ISHOME") or die("Can't acess this page, please come back!");
    define('COMS','content');
    define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
    include_once(LAG_PATH.'lang_content.php');
    include_once(libs_path.'cls.content.php');
    include_once(libs_path.'cls.categories.php');
    
    $obj=new CLS_CONTENT;
    if(!isset($objlang)) $objlang = new LANG_CONTENT;
	   $title_manager = $objlang->LIST_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
	   $title_manager = $objlang->MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
	   $title_manager = $objlang->MANAGER_EDIT;	        
    require_once(incl_path_admin.'toolbar.php');
    
    if(isset($_POST["cmdsave"])){
		$obj->cat_id=(int)$_POST["cbo_cate"];
		$obj->code =addslashes(un_unicode($_POST["txtcode"]));
		$obj->title=addslashes($_POST["txtname"]);
		$obj->intro=addslashes($_POST["txtintro"]);
		$obj->fulltext=	addslashes($_POST['txtfulltext']);
		$obj->thumb=addslashes($_POST["txtthumb"]);
		$obj->author = addslashes($_POST['txtauthor']);
		
		if(isset($_POST["txtcreadate"])){ // ngay tao lap
			$txtjoindate=trim($_POST["txtcreadate"]);
			$joindate = mktime(0,0,0,substr($txtjoindate,3,2),substr($txtjoindate,0,2),substr($txtjoindate,6,4));
			$obj->cdate = date("Y-m-d",$joindate);
		}
			
		$obj->isactive=	(int)$_POST["optactive"];

		if(isset($_POST["txtid"])){
			$obj->con_id=(int)$_POST["txtid"];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!="")
	{
		$ids=$_POST["txtids"];
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"])
		{
			case "public": 		$obj->setActive($ids,1); 		break;
			case "unpublic": 	$obj->setActive($ids,0); 		break;
			case "edit": 	
				$id=explode("','",$ids);
				echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
				exit();
				break;
			case "order"	: include(THIS_COM_PATH."tem/order.php"); break;	
			case "delete": 		$obj->Delete($ids); 		break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
    //default
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
    unset($task);unset($ids); unset($obj); unset($objlang);
?>