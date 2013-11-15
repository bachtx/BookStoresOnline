<?php
class LANG_CATALOGS{
	var $pro=array(
				   "CATE_MANAGER"=>"Books Management",
				   "CATE_MANAGER_EDIT"=>"Edit Group Book",
				   "CATE_MANAGER_ADD"=>"Add Group Book"			   				  
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>