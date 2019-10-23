$(function() {
	//发送验证
	$(".get_btn").click(function() {
		$(".get_btn").prop("disabled",true);
		var phone = $("#user_phone").val();
		var d = {};
		d.phone = phone;
		d.type="collection";
		$.ajax({
			type: "post",
			url: url + '/api.php/sms/send.html',
			data: d,
			dataType: 'json',
			success: function(result) {
				if(result.code == '0000') {
					//倒计时
					var time = result.data.time;
					$(".get_btn").html(time + "秒后重发");
					setInterval(function() {
						time--;
						if(time === 0) {
							$(".get_btn").html("获取验证码");
							$(".get_btn").prop("disabled",false);
						} else if(time > 0) {
							$(".get_btn").html(time + "秒后重发");
						}
					}, 1000);

				} else {
					isErr(result);
					$(".get_btn").prop("disabled",false);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert("请求失败：" + XMLHttpRequest.status);
			}
		});

	});
	$('.submit_btn').click(function(){
		$.ajax({
			type:"post",
			url: baseUrl + "/api.php/User/saveUserCollection",
			async:true,
			data:{
				receivables_account:$('#phone').val(),
				code:$('#code').val(),
				receivables_img:$('#thubm').attr('src1'),
				token: localStorage.getItem("token"),
				phone:$("#user_phone").val()
			},
			dataType:"json",
			success:function(data){
				mui.toast(data.msg)
				if(data.code == 0){
					setTimeout(function(){
						window.location.href = "user.html"
					},2000)
				}
			}
		});
	})
})