<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';
	$parid='';
	$level=0;
	
	if(isset($_POST['txtkeyword'])){
		$keyword=$_POST['txtkeyword'];
	}
	$strwhere='';
	if($keyword!='' && $keyword!='Keyword'){
		$strwhere.="AND ( `name` like N'%$keyword%')";
	}

	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_CAT']))
		$_SESSION['CUR_PAGE_CAT']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_CAT']=$_POST['txtCurnpage'];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_CAT']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_CAT']=ceil($total_rows/MAX_ROWS);
	$cur_page=$_SESSION['CUR_PAGE_CAT'];
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
        <td><?php echo 'Search'?>:
            <input type="text" name="txtkeyword" id="txtkeyword" value="<?php echo $keyword;?>" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" />
            <input type="submit" name="button" id="button" value="Search" class="button" />
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <td width="30" align="center">#</td>
        <td width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></td>
        <td width="50" align="center">Par_id</td>
        <td align="center">Name</td>
        <td align="center" width="400">Description</td>
        <td width="50" align="center">Public</td>
        <td width="50" align="center">Edit</td>
        <td width="50" align="center">Delete</td>
      </tr>
      <?php
	  $obj->listTableCate($strwhere,$cur_page,$parid,$level,0);
	  ?>
      
    </table>
  </form>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
      <tr>
        <td align="center">	  
        <?php 
            paging($total_rows,MAX_ROWS,$cur_page);
        ?>
        </td>
      </tr>
  </table>
</div>
<?php //----------------------------------------------?>