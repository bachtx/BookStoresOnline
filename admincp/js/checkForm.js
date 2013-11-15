function checkinput(){
	if($(".txtname").val()==""){
	 	$(".txtname_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Chưa nhập đủ thông tin').fadeTo(900,1);
		});
	 	$(".txtname").focus();
	 	return false;
	}
    if($(".txtcode").val()=="")
	{
	 	$(".txtcode_err").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Chưa nhập đủ thông tin').fadeTo(900,1);
		});
	 	$(".txtcode").focus();
	 	return false;
	}
	if($(".yourname").val()==""){
	 	$(".yourname_label").fadeTo(200,0.1,function(){ 
		  $(this).html('Chưa nhập đủ thông tin').fadeTo(900,1);
		});
	 	$(".yourname").focus();
	 	return false;
	}
	return true;
}
//Kêt thúc hàm checkiput
$(document).ready(function(){
	$(".txtname").blur(function() {
		if( $(this).val()=='') {
			$(".txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Chưa nhập đủ thông tin').fadeTo(900,1);
			});
		}
		else {
			$(".txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('').fadeTo(900,1);
			});
		}
	})
})

$(document).ready(function() {
	$(".txtcode").blur(function(){
		if ($(".txtcode").val()=="") {
			$(".txtcode_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập mã sách').fadeTo(900,1);
			});
		}
	});	
});