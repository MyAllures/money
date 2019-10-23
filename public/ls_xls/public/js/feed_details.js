$(function(){
	var you=GetQueryString("id");
	var you1=GetQueryString("type");
	if(you1 != "2"){
		$(".hele").attr("href","Feedback_record.html?type=1");
		$(".hetitle").html("反馈列表");
	}else{
		$(".hele").attr("href","Complaint_record.html?type=2");
		$(".hetitle").html("申诉列表");
	}
	var d={};
	d.token=token;
	d.id=you;
	$.ajax({
		type: "post",
		url:url + '/api.php/tool/suggestion_detils',
		async: false,
		data:d,
		dataType: 'json',
		success: function(result) {
			if(result.code == '0000') {
				$("#name").html(result.data.title);
				$("#time").html(result.data.create_time);
				$("#content").html(result.data.content);
				var html = '';
				var data=result.data.img_url;
				for(var i in data){
					html += '<img src="'+data[i]+'" class="img_img"/>';
				}
				$(".img_url").html(html);
			} else {
				isErr(result);
			}
		},			
	})
})
