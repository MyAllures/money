var lib = {
    GetLunbo: GetLunbo,//获取轮播图
    GetIndexType: GetIndexType,//首页推荐分类
    GetIndexShow: GetIndexShow,//首页广告图
    GetNotice: GetNotice,//最新公告
    GetNoticeList: GetNoticeList,//公告列表
    GetNoticeDetails: GetNoticeDetails,//公告详情
    GetConterMenu:GetConterMenu,//个人中心菜单
    GetLoginPageConfig: GetLoginPageConfig,//获取登录页面配置
    SumbitLogin: SumbitLogin,//提交登录
    SumbitReg: SumbitReg,//提交注册
    GetCustServiceConfig: GetCustServiceConfig,//获取客服配置
    GetPayType: GetPayType,//获取支付方式
    GetPayInfo: GetPayInfo,//获取支付信息
	GetNewsTypeList:GetNewsTypeList,//文章分类列表
	GetNewsListByType:GetNewsListByType,//根据分类获取文章列表
	GetNewsDetails:GetNewsDetails,//获取文章详情
	SumbitTousu:SumbitTousu,//提交投诉
	GetMyTousuList:GetMyTousuList,//投诉记录
	SendCode:SendCode,//短信验证码
	GetIsCode:GetIsCode,//判断是否开通验证码功能
	GetLosePassword:GetLosePassword,//通过验证码找回密码
	GetTuiguangConfig:GetTuiguangConfig,//获取推广信息
	SendAliAPI:SendAliAPI,//获取阿里API接口
	
	GetHelpNewsDetails:GetHelpNewsDetails,//获取帮助文章例：帮助中心 客服文章
	GetHelpTypeList:GetHelpTypeList,//获取问题类型
	SumbitHelp:SumbitHelp,//会员提交问题
	GetMySumbitHelpList:GetMySumbitHelpList,//我提交的问题列表
}


//返回信息：
/*
is_solve:0待处理 1己处理
reply_messgae：平台回复内容
*/
function GetMySumbitHelpList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetMySumbitHelpList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{describe:'',img_url:''，t_id:0}
function SumbitHelp(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/SumbitHelp",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetHelpTypeList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetHelpTypeList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetHelpNewsDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetHelpNewsDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//获取阿里API接口
function SendAliAPI(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/SendAliAPI",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetTuiguangConfig(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetTuiguangConfig",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{account:'',password:'',code:''}
function GetLosePassword(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetLosePassword",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetIsCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetIsCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//发送验证码
//data:{to_mobile:''}
function SendCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/SendCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//投诉记录
function GetMyTousuList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetMyTousuList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{to_user_or_mobile:'',content:'',img_urls:''}
function SumbitTousu(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/SumbitTousu",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetPayInfo(url,data, CallBack) {
    ajax({
        type: 'post',
        url: url,
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{news_id:0}
function GetNewsDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetNewsDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{news_type_id:0}
function GetNewsListByType(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetNewsListByType",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


function GetNewsTypeList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetNewsTypeList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


function GetPayType(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/GetPayType",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
function GetCustServiceConfig(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetCustServiceConfig",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetConterMenu(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetConterMenu",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{ID:0}
function GetNoticeDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetNoticeDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetNoticeList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetNoticeList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetNotice(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetNotice",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetIndexShow(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetIndexShow",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetIndexType(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetIndexType",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data={ mobile: '', password :'',parent_id:0,name:'',province:'',city:'',area:'',wechat:'',code:''}
function SumbitReg(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/SumbitReg",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data={ account: '', password :''}
function SumbitLogin(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/SumbitLogin",
        data: data,
        success: function (e) {
            if(e.code==1)
			{
				setCookie("yun_token", e.msg,function(){
			    CallBack(e);		
				});
			}
			else
			{
				CallBack(e);		
			}
			
        }
    });
}

function GetLoginPageConfig(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetLoginPageConfig",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetLunbo(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/GetLunbo",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}