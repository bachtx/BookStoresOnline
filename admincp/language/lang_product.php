<?php
class LANG_PRODUCTS{
	var $pro=array(
       "LIST_MANAGER"=>"List Book",
       "MANAGER_EDIT"=>"Edit Book",
       "MANAGER_ADD"=>"Add Book"
       );
    function __get($proname){
        if(isset($this->pro[$proname]))
        	return $this->pro[$proname];
        else
        	return "Không tim thấy ngôn ngữ mặc định!";
    } 
}
?>