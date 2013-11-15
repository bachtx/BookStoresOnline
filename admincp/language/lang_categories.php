<?php
class LANG_CATEGORIES{
	var $pro=array(
			"CATE_MANAGER"=>"Group Posts Management",
			"CATE_MANAGER_EDIT"=>"Edit Group Posts",
			"CATE_MANAGER_ADD"=>"Add Group Posts"
	);
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>