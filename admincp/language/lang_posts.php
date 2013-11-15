<?php
class LANG_POSTS{
	var $pro=array(
			"LIST_MANAGER"=>"List Posts",
			"MANAGER_EDIT"=>"Edit Posts",
			"MANAGER_ADD"=>"Add Posts"
	);
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>