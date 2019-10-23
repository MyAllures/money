var transaction = {
	
    SumbitSell:SumbitSell,//提交出售信息
	MySellList:MySellList,//获取我的出售记录
	MySellDetails:MySellDetails,//获取出售详情
	AuditSell:AuditSell,//审核对方上传的凭证.交易成功
	AuditSellOut:AuditSellOut,//审核失败对方上传的凭证.交易失败
	GetSellList:GetSellList,//获取所有出售记录
	SumbitBuySell:SumbitBuySell,//立即锁单
	GetToBank:GetToBank,//获取对方的收款码
	SumbitBankCode:SumbitBankCode,//新增我的微信或者支付宝收款码
	GetBankCode:GetBankCode,//获取我某个收款码
	GetSellquantity:GetSellquantity,//获取我的可出售数量
	SumbitOutSell:SumbitOutSell,//提交出售功能
	SumbitBuyCertificate:SumbitBuyCertificate,//提交购买付款凭证
	GetMyBuySellList:GetMyBuySellList,//获取我的购买出售记录
	GetMyBuySellDetails:GetMyBuySellDetails,//获取我的购买出售详情
	GetSellConfig:GetSellConfig,//获取我的出售配置信息
	SumbitOutBuySell:SumbitOutBuySell,//取消锁单信息
	AuditSellOut:AuditSellOut,//审核凭证拒绝
	
	GetHangqing:GetHangqing,//获取行情数据
	GetZoushitu:GetZoushitu,//获取走势图
	GetNowUnitPirce:GetNowUnitPirce,//获取当前价格
	GetNowUnitPirceSection:GetNowUnitPirceSection,//获取当前价格区间显示
	
	
	GetAllNeedBuyList:GetAllNeedBuyList,//获取所有求购记录
	LockQiugou:LockQiugou,//立即锁单
	GetMyToBuyList:GetMyToBuyList,//获取卖出记录/锁单记录
	GetNeedBuyDetailsBySend:GetNeedBuyDetailsBySend,//锁单者查看订单详情.卖出记录看记录详情
	SumbitAuditPay:SumbitAuditPay,//锁单者审核支付信息。交易成功
	
	SendQiugou:SendQiugou,//我要买入 提交求购信息
	GetMyNeedBuyList:GetMyNeedBuyList,//获取我的求购记录/买入记录
	SumbitOutQiugou:SumbitOutQiugou,//取消当前求购信息
	SumbitQiugouPay:SumbitQiugouPay,//提交支付凭证/上传凭证
	GetNeedBuyDetails:GetNeedBuyDetails,//买入详情,买入记录看记录详情
	GetinPayBank:GetinPayBank,//获取当前会员的收款银行信息
}


function GetNowUnitPirceSection(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetNowUnitPirceSection",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{user_id:0}
function GetinPayBank(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetinPayBank",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{buy_no:''}
function GetNeedBuyDetailsBySend(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetNeedBuyDetailsBySend",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{buy_no:''}
function GetNeedBuyDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetNeedBuyDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//data:{buy_no:''}
function LockQiugou(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/LockQiugou",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{page_index:1}
function GetAllNeedBuyList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetMyNeedBuyList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//status:88全部  0待处理 1待打款 2待审核 3交易成功  -1求购者取消 -2 平台取消
//data:{status:88,page_index:1}
function GetMyToBuyList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetMyToBuyList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//status:88全部  0待处理 1待打款 2待审核 3交易成功  -1求购者取消 -2 平台取消
//data:{status:88,page_index:1}
function GetMyNeedBuyList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetMyNeedBuyList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{buy_no:''}
function SumbitAuditPay(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SumbitAuditPay",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{buy_no:'',pay_certificate:''}
function SumbitQiugouPay(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SumbitQiugouPay",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{buy_no:''}
function SumbitOutQiugou(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SumbitOutQiugou",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{quantity:0,unit_price:0.00}
function SendQiugou(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SendQiugou",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetNowUnitPirce(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetNowUnitPirce",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetZoushitu(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetZoushitu",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


function GetHangqing(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetHangqing",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//data:{order_no:''}
function AuditSellOut(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/AuditSellOut",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//data:{order_no:''}
function SumbitOutBuySell(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SumbitOutBuySell",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetSellConfig(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetSellConfig",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{order_no:''}
function GetMyBuySellDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetMyBuySellDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//0待打款 1待审核 2审核成功 -1交易取消
//data:{status:0}
function GetMyBuySellList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetMyBuySellList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{order_no:'',pay_certificate:''}
function SumbitBuyCertificate(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SumbitBuyCertificate",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//data:{sell_no:''}
function SumbitOutSell(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SumbitOutSell",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
function GetSellquantity(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetSellquantity",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//pay_name:wx or ali
//data:{pay_name:''}
function GetBankCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetBankCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//pay_name:wx还是ali
//pay_img_url:收款码  
//number:微信号或者支付宝帐号
//data:{pay_name:'',pay_img_url:'',number:''}
function SumbitBankCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SumbitBankCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{p_user_id:0}
function GetToBank(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetToBank",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{sell_no:''}
function SumbitBuySell(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SumbitBuySell",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{page_index:1}
function GetSellList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/GetSellList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//order_no：出售订单里面的order_no
//如果有人锁单才进详情
//data:{order_no:''}
function AuditSellOut(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/AuditSellOut",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//order_no：出售订单里面的order_no
//如果有人锁单才进详情
//data:{order_no:''}
function AuditSell(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/AuditSell",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//order_no：出售订单里面的order_no
//如果有人锁单才进详情
//data:{order_no:''}
function MySellDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/MySellDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//0待出售 1待确认 2出售成功  -1出售取消 -2交易失败 
//data:{status:0,page_index:1}
function MySellList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/MySellList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//quantity：出售数量
//data:{quantity:0}
function SumbitSell(data, CallBack) {
    ajax({
        type: 'post',
        url: "/CurrencyTransaction/SumbitSell",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}