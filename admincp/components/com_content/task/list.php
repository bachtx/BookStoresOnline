<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';	$action='';	$catid='';
	
	if(!isset($_SESSION['EDU_CONTENT_CATID'])) $_SESSION['EDU_CONTENT_CATID']='';
	if(!isset($_SESSION['EDU_CONTENT_ACT'])) $_SESSION['EDU_CONTENT_ACT']='';
	
	if(isset($_POST['txtkeyword'])){
		$keyword=trim($_POST['txtkeyword']);
		$_SESSION['EDU_CONTENT_ACT']=$_POST['cbo_active'];
		$_SESSION['EDU_CONTENT_CATID']=$_POST['cbo_cont'];
	}
	$catid = $_SESSION['EDU_CONTENT_CATID'];
	$action = $_SESSION['EDU_CONTENT_ACT'];
	
	$strwhere='';
	if($keyword!='' && $keyword!='Keyword')
		$strwhere.="AND ( `name` like '%$keyword%' OR `code` like '%$keyword%')";
	if($catid!='' && $catid!='all')
		$strwhere.="AND `cat_id` = '$catid' ";
	if($action!='' && $action!='all' )
		$strwhere.="AND `isactive` = '$action'";
	if($strwhere!='') $strwhere=' WHERE 1=1 '.$strwhere;
	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_PRO']))
		$_SESSION['CUR_PAGE_PRO']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_CON']=$_POST['txtCurnpage'];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_PRO']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_PRO']=ceil($total_rows/MAX_ROWS);
	$cur_page=($_SESSION['CUR_PAGE_PRO']<1)?1:$_SESSION['CUR_PAGE_PRO'];
?>
<div id="list">
<script language="javascript">
  function checkinput()
  {
	  var strids=document.getElementById("txtids");
	  if(strids.value=="")
	  {
		  alert('You are select once record to action');
		  return false;
	  }
	  return true;
  }
</script>
  <form id="frm_list" name="frm_list" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td>Search:
            <input type="text" name="txtkeyword" id="txtkeyword" value="<?php echo $keyword;?>" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" />
            <input type="submit" name="button" id="button" value="Search" class="button" />
        </td>
        <td align="right">
        <label>
        <select name="cbo_cont" id="cbo_cont" onchange="document.frm_list.submit();">
          <option value="all">Select once category</option>
              <?php 
			  if(!isset($objcata))
			  	$objcata=new CLS_CATEGORIES();
			  	echo $objcata->getListCate(0,"");
			  ?>
          <script language="javascript">
			cbo_Selected('cbo_cont','<?php echo $catid;?>');
            </script>
        </select>
        </label>
        <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
          <option value="all"><?php echo 'All';?></option>
          <option value="1"><?php echo 'Public';?></option>
          <option value="0"><?php echo 'Unpublic';?></option>
          <script language="javascript">
			cbo_Selected('cbo_active','<?php echo $action;?>');
            </script>
        </select></td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <th width="30" align="center">#</th>
        <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
        <th align="center">Posts name</th>
        <th align="center">Image</th>
		<th align="center">Category</th>
		<th align="center">Intro</th>
        <th width="150" align="center">Author</th>
        <th align="center">Date</th>
        <th width="30" align="center"><?php echo 'Public';?></th>
        <th width="30" align="center"><?php echo 'Edit';?></th>
        <th width="30" align="center"><?php echo 'Del';?></th>
      </tr>
      <?php 
	  $obj->listTablePro($strwhere,$cur_page);
	  ?>
    </table>
</form>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
      <tr>
        <td align="center">
        <?php 
           // paging($total_rows,MAX_ROWS,$cur_page);
        ?>
        </td>
      </tr>
  </table>
</div>
<?php //----------------------------------------------?>