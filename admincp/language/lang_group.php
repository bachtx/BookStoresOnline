<?php
class LANG_GROUP{
	var $pro=array(
				   "MANAGER"=>"Group Management",
				   "MANAGER_EDIT"=>"Edit Group Member",
				   "MANAGER_ADD"=>"Add Group Member"			   				  
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>