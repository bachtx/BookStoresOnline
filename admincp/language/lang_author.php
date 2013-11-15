<?php
class LANG_AUTHOR{
	var $pro=array(
				   "CATE_MANAGER"=>"Author Management",
				   "CATE_MANAGER_EDIT"=>"Edit Author",
				   "CATE_MANAGER_ADD"=>"Add Author"			   				  
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>