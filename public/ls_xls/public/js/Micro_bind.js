$(function(){
//	获取个人资料
	personal_data(1);
	
	
//	修改微信号
	var prevent_repetition = true;
	$(".personal_b").on("click", function() {
		if(prevent_repetition) {
			prevent_repetition = false;
			var wx_account = $(".wx_account").val();
			var wx_account1 = $(".wx_account").attr("data");
			var d = {};
//			没修过不上传
			if(wx_account != wx_account1){
				d.wx_account=wx_account;
			}else{
				alert("未曾修改");
				prevent_repetition = true;
				return false;
			}
			d.token = token;
			$.ajax({
				type: "post",
				url: url + '/api.php/User/editWxAccount',
				data: d,
				dataType: 'json',
				success: function(result) {
					if(result.code == '0000') {
						alert(result.msg);
						location.href="my.html";
					} else {
						isErr(result);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert("请求失败：" + XMLHttpRequest.status);
				},
				complete: function() {
					prevent_repetition = true;
				}
			});
		}
	})
})
