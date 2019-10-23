$(function() {
	//	修改密码
	var prevent_repetition = true;
	$(".login_bt3n").on("click", function() {
		if(prevent_repetition) {
			prevent_repetition = false;
			var old_pwd1 = $(".old_pwd1").val();
			var new_pwd1 = $(".new_pwd1").val();
			var d = {};
			if(!old_pwd1) {
				alert("请输入原密码");
				prevent_repetition = true;
				return false;
			}
			if(!new_pwd1) {
				alert("请输入新密码");
				prevent_repetition = true;
				return false;
			}
			d.old_pwd=old_pwd1;
			d.new_pwd=new_pwd1;
			d.token=token;
			$.ajax({
				type: "post",
				url: url + '/api.php/User/editPwd',
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