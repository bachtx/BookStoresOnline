<?php
class CLS_CATALOGS{
	private $objmysql=null;
	public function CLS_CATALOGS(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql="SELECT `cat_id`,`name`,`intro` FROM `tbl_catalog`  WHERE isactive=1 ".$where; 
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
    public function getListCatalogs(){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `cat_id`,`name` FROM `tbl_catalog`  WHERE isactive=1 AND par_id='0' "; 
		$objdata->Query($sql);
		if($objdata->Num_rows()>0){			
			while($row=$objdata->Fetch_Assoc()){
                $id=$row['cat_id'];
				echo "<h4><a href='#' title='".$row['name']."'><span>".$row['name']."</span></a></h4>";		   
                    echo '<ul>';
                        $sql="SELECT `cat_id`,`name` FROM `tbl_catalog`  WHERE isactive=1 AND par_id='$id'";
                        $obj_sub=new CLS_MYSQL;
                        $obj_sub->Query($sql);						
                        $n=$obj_sub->Num_rows();
                        for($i=0;$i<$n;$i++)
                        {
                            $row1=$obj_sub->Fetch_Assoc();
							$cat_id=$row1['cat_id'];
?>
							<li <?php if((isset($_GET['cat_id']))&& ($_GET['cat_id'] == $cat_id)) echo "class='hover'"?>><a href="<?php echo $row1['name']."-cat".$row1['cat_id'].'.html'?>" title="<?php echo $row1['name']?>"><span><?php echo $row1['name']?></span></a></li>
<?php 
                       	    
                        }                        
                    echo '</ul>';
			}
		}
	}
    	
	public function getNameById($cat_id){
		$sql="SELECT `par_id`,`name` FROM `tbl_catalog`  WHERE isactive=1 AND `cat_id` = '$cat_id'";
		return $this->objmysql->Query($sql);
	}
	public function getParNameById($cat_id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_catalog`  WHERE isactive=1 AND `cat_id` = '$cat_id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
}
?>