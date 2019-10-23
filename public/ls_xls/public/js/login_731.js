$(function() {
//	清除缓存
	localStorage.clear();	
//	登录
	var prevent_repetition = true;
	$("#login_btn").on("click", function() {
		if(prevent_repetition) {
			prevent_repetition = false;
			var username = $("#username").val();
			var pwd = $("#pwd").val();
			var d = {};
			d.username = username;
			d.pwd = pwd;		
			if(!username) {
				alert("请输入号码");
				prevent_repetition = true;
				return false;
			}		
			if(!pwd) {
				alert("请输入登录密码");
				prevent_repetition = true;
				return false;
			}
			$.ajax({
				type: "post",
				url: url + '/api.php/User/login',
				data: d,
				dataType: 'json',
				success: function(result) {
					if(result.code == '0000') {
						alert(result.msg);
						localStorage.setItem("token",result.data.token);
						localStorage.setItem("repetition_index","1");
						location.href="index.html";
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