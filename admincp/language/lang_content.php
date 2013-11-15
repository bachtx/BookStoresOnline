<?php
class LANG_CONTENT{
	var $posts=array(
			"POST_MANAGER"=>"Posts Management",
			"POST_MANAGER_EDIT"=>"Edit Posts",
			"POST_MANAGER_ADD"=>"Add Posts"
	);
	function __get($postsname){
		if(isset($this->posts[$postsname]))
			return $this->posts[$postsname];
		else
			return "";
	}
}
?>