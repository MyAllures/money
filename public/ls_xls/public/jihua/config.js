var config = {
	url: function() {
		return "http://text.token2.com"
	},
	apiurl: function() {
		//return "http://text.token2.com/api";
		//return "http://api.weixingjt.com";
		return "http://shops.wxmobi.cn/api"
	},
	upload_url: function() {
		return "http://shops.wxmobi.cn/UploadImage/UploadBase64";
	},
	GetCustID: function(Callback) {
		Callback(10045);
	},
	GetToken: function(Callback) {
		console.log("当前yun_token:"+getCookie("yun_token"))
		if (getCookie("yun_token") == null || getCookie("yun_token") == "" ||getCookie("yun_token") == "null")
		{
			var that = this;
			this.GetCustID(function(cust_id) {
				//请求获取
				$.ajax({
					type: 'post',
					url: that.apiurl() + "/Token/GetToken",
					data: {
						cust_id: cust_id
					},
					success: function(e) {
						var token = e.msg;
						console.log('新获取');
						console.log(token);
						setCookie('yun_token', token,function(){
						    Callback(token);	
						});
						
					}
				});
			})
		} else {
			console.log("缓存中")
			Callback(getCookie("yun_token"));
		}
	},
	upload: function(base64, Callback) {
		var that = this
		$.showLoading("正在上传中");
		this.GetCustID(function(cust_id) {
			$.ajax({
				type: 'post',
				url: that.upload_url(),
				data: {
					cust_id: cust_id,
					base64str: base64
				},
				success: function(e) {
					$.hideLoading();
					Callback(e);
				}
			});
		})

	},
	is_open_id: function(callback) {
		//判断当前浏览器是否在微信里面打开
		var ua = navigator.userAgent.toLowerCase();
		var isWeixin = ua.indexOf('micromessenger') != -1;
		if (isWeixin) {
			callback(true);
		} else {
			callback(false);
		}
	},
	GetOpenID: function(url) {
		var _url = config.url() + "/WechatConter/GetOpenID";
		_url = _url + "?return_url=" + url;
		window.location.href = _url;
	}
}

function ajax(option) {
	$.showLoading();
	

	if (option.url.indexOf('http://') < 0)
		option.url = config.apiurl() + option.url;
	else
		option.url;

	//option.url = config.apiurl() + option.url;
	var data = option.data;
	config.GetCustID(function(cust_id) {
		config.GetToken(function(token) {
			
			data.yun_token = token;
			data.cust_id = cust_id;
			
			console.log(token)
			console.log("请求地址:" + option.url)
			console.log("请求对象:" + JSON.stringify(data))
			$.ajax({
				type: option.type,
				url: option.url,
				data: data,
				success: function(e) {
					if (e.code == -88) {
						var return_url = window.location.href;
						var url = "login.html";
						url += "?return_url=" + return_url;
						location.href = url;
					} else {
						$.hideLoading();
						option.success(e);
					}

				},
				error: function(e) {
					$.hideLoading();
					option.success({
						code: 0,
						msg: '请求异常'
					});
				}
			});
		});
	});


}


function ajax_NoLoading(option) {
	if (option.url.indexOf('http://') < 0)
		option.url = config.apiurl() + option.url;
	else
		option.url;

	//option.url = config.apiurl() + option.url;
	var data = option.data;
	config.GetCustID(function(cust_id) {
		config.GetToken(function(token) {
			data.yun_token = token;
			data.cust_id = cust_id;
			console.log("请求地址:" + option.url)
			console.log("请求对象:" + JSON.stringify(data))
			$.ajax({
				type: option.type,
				url: option.url,
				data: data,
				success: function(e) {
					if (e.code == -88) {
						var return_url = window.location.href;
						var url = "/weiliao/html/login.html";
						url += "?return_url=" + return_url;
						location.href = url;
					} else {
						option.success(e);
					}

				},
				error: function(e) {
					option.success({
						code: 0,
						msg: '请求异常'
					});
				}
			});
		});
	});


}

function setCookie(name, value, callback) {
	if(is_local())
	{
		 var storage=window.localStorage;            
         storage.name=value;
		 callback();	
            
	}
	else{
	var Days = 30;
	var exp = new Date();
	exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
	document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
	
	callback();	
	}
	

};


function getCookie(name) {
	if(is_local())
	{
		var storage=window.localStorage;
        return storage.name;
	}
	else{
		var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
		if (arr = document.cookie.match(reg))
			return unescape(arr[2]);
		else
			return null;
	}
	

}

function delCookie(name) {
	
	if(is_local())
	{
		 var storage=window.localStorage;
         //storage.removeItem(name);
		 storage.name="";
		 console.log('清除storage')
	}
	else{
		var exp = new Date();
		exp.setTime(exp.getTime() - 1);
		var cval = getCookie(name);
		if (cval != null)
			document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
	}
	
}

function is_local() {
	if (!window.localStorage) {
		return false;
	} else {
		//主逻辑业务
		console.log('支持')
		return true;
	}
}
