// 接口地址
var url='http://www.pr175.cn/';//线上地址

//	获取地址栏参数
function GetQueryString(name){
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}

//	错误提示
function isErr(res) {
	alert(res.msg);
	if(res.code == "0020"){
		location.href="login.html";
	}
}

//title
$("title").html("有钱还");