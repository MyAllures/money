$(function(){
	var token = localStorage.getItem("token");
	var you=GetQueryString("id");
	var d={};
	d.token=token;
	d.id=you;
	$.ajax({
		type: "post",
		url:url + '/api.php/common/article_detail',
		async: false,
		data:d,
		dataType: 'json',
		success: function(result) {
			if(result.code == '0000') {
				$("#name").html(result.data.name);
				$("#time").html(result.data.time);
				$("#content").html(result.data.content);
			} else {
				isErr(result);
			}
		},			
	})
})
