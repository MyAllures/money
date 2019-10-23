// 接口地址
var url='http://www.pr175.cn/';//线上地址

//	获取地址栏参数
function GetQueryString(name){
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}

//title
$("title").html("有钱还");

//	错误提示
function isErr(res) {
	alert(res.msg);
	if(res.code == "0020"){
		location.href="login.html";
	}
}

//	获取token
var token=localStorage.getItem("token");
if(token == "" || token == null || token == undefined){
	location.href='login.html';
}

//	个人资料
function personal_data(type){
	$.ajax({
		type: "post",
		url: url + '/api.php/User/getProfile',
		data: {"token":token},
		dataType: 'json',
		success: function(result) {
			if(result.code == '0000') {
				var data=result.data;

				if(type == "1"){
//					1.帮助注册 2.微信绑定 3.个人资料
					$(".nickname").val(data.nickname).attr("data",data.nickname);
					$(".age1").val(data.age).attr("data",data.age);
					$(".profession1").val(data.profession).attr("data",data.profession);
					$(".username").val(data.username).attr("data",data.username);
					$(".code").val(data.code).attr("data",data.code);
					$(".code_1").val(data.code);
					$(".wx_account1").val(data.wx_account).attr("data",data.wx_account);					
					$(".sex1[name='check_inp'][value='"+data.sex+"']").attr("checked","checked");
					
				}else{
//					1.我的 2.首页 3.申请升级 4.正在申请
					$(".nickname").html(data.nickname);
					$(".username").html(data.username);
					$(".code").html(data.code);
					$(".can_reg").attr("data",data.can_reg);
					$(".level_name_1").html(data.level_name)
				}
				
				if(data.head_icon != ""){
					$(".head_icon").attr("src",data.head_icon);
				}
				if(data.wx_picture != ""){
					$(".wx_picture").attr("src",data.wx_picture);
				}
				
			}else{
				isErr(result);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("请求失败：" + XMLHttpRequest.status);
		}
	});
}