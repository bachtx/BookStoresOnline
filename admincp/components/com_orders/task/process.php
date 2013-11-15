<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';	$action='';	$catid='';
	
	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_CON']))
		$_SESSION['CUR_PAGE_CON']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_CON']=$_POST['txtCurnpage'];
	}
	//$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_CON']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_CON']=ceil($total_rows/MAX_ROWS);
	$cur_page=($_SESSION['CUR_PAGE_CON']<1)?1:$_SESSION['CUR_PAGE_CON'];
?>
<div id="list">
<H1 align='center'>List Order Process</H1>
  <form id="frm_list" name="frm_list" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        
      </tr>
    </table>
	
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <th width="30" align="center">#</th>
        <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
        <th width="50">OrderID</th>
        <th>Custommer</th>
        <th>Mobile</th>
        <th>Email</th>
        <th align="center">Amount</th>
		<th width="100" align="center">Join Date</th>
        <th width="50" align="center">Status</th>
        <th width="50" align="center">Detail</th>
        <th width="30" align="center">Del</th>
      </tr>
      <?php 
	  $obj->getList(" WHERE `status`='1'",' ORDER BY `cdate` DESC ','');
	  $total_rows=$obj->Num_rows();
	  $num=0;
	  while($row=$obj->Fetch_Assoc()){$num++;
	  ?>
	  <tr>
		<td align='center'><?php echo $num;?></td>
		<td align='center'><input type="checkbox" name="chkall" id="chkall" value="<?php echo $row['id'];?>"/></td>
		<td align='center'>HD<?php echo $row['id'];?></td>
		<td><?php echo $row['cname'];?></td>
		<td><?php echo $row['cphone'];?></td>
		<td><?php echo $row['cemail'];?>&nbsp;</td>
		<td align='center'><?php echo $row['totalmoney'];?> $</td>
		<td align='center'><?php echo date('d/m/Y',strtotime($row['cdate']));?></td>
		<td align='center'><span style='color:#0033ff;'>Processing</span></td>
		<td align='center'><a href='index.php?com=orders&task=detail&id=<?php echo $row['id'];?>' title='Detail'><?php showIconFun('edit','');?></td>
		<td align='center'><a href='index.php?com=orders&task=delete&id=<?php echo $row['id'];?>' onclick='return confirm("Bạn chắc chắn muốn xóa hóa đơn này?");'><?php showIconFun('delete','');?></a></td>
	  </tr>
	  <?php
	  }
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