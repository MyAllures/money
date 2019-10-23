var account = {
    GetCurrencyList: AccountCurrencyList,//获取账户记录
    GetAccountCurrencyAmount:GetAccountCurrencyAmount,//获取账户信息
    GetJiangliList: JiangliList,//奖励记录
    GetJiangliAmount:GetJiangliAmount,//奖励金额
    GetBankList: GetBankList,//银行列表
    GetMyBankList: GetMyBankList,//我的银行列表
    GetMyBankDetails:GetMyBankDetails,//获取银行详情
    EnditUserBank: EnditUserBank,//编辑银行信息
    DelUserBank: DelUserBank,//删除银行卡
    SumbitWithdrawal: SumbitWithdrawal,//申请线下提现
	SumbitWechatWithdrawal:SumbitWechatWithdrawal,//申请线上提现
    GetWithdrawalSetting:GetWithdrawalSetting,//获取提现配置
    GetMyWithdrawalList: GetMyWithdrawalList,//获取提现记录
    GetMyExchangeList: GetMyExchangeList,//获取兑换记录
    GetMyExchangeListAmount:GetMyExchangeListAmount,//兑换总金额
    SumbitExchange: SumbitExchange,//发起兑换
    GetSumbitExchangeData:GetSumbitExchangeData,//兑换的页面
    GetMyGiveList: GetMyGiveList,//获取转帐记录
    GetGiveToMemberInfo: GetGiveToMemberInfo,//获取转帐对方的信息
    GetMyGiveAmount: GetMyGiveAmount,//获取可转帐金额
    SumbitGive:SumbitGive,//提交转帐
    GetMyRechargeList: GetMyRechargeList,//获取转帐记录
    GetMyGiveFriendList: GetMyGiveFriendList,//获取转帐的朋友
    ValidateUserID: ValidateUserID,//验证会员编号是否有效
    GetUserIDByMobile: GetUserIDByMobile,//通过手机号查询会员编号
    GetRechargeConfig: GetRechargeConfig,//获取充值配置
    SumbitRecharge: SumbitRecharge,//提交充值
    GetMyRechargeList: GetMyRechargeList,//充值记录
    GetRechargeAmount: GetRechargeAmount,//获取充值总额
    GetMyBankCode: GetMyBankCode,//获取平台收款信息
     GetSourceType:GetSourceType,//获取客户资金来源
    AccountCurrencyBySourceList:AccountCurrencyBySourceList,//根据资金来源获取数据
		GetTibiConfig:GetTibiConfig,//获取提现配置
	GetTibiQuantity:GetTibiQuantity,//获取可提数量
	SumbitTibi:SumbitTibi,//提交提币
	GetTibiList:GetTibiList,//提币记录
		GetMyPayCode:GetMyPayCode,//获取我的收款码
	SumbitPayCode:SumbitPayCode,//添加收款码
	DelPayCode:DelPayCode,//删除收款码
	UpdatePayCode:UpdatePayCode,//更新收款码
	GetPayCode:GetPayCode,//获取收款码
	GetPayMoney:GetPayMoney,//获取收款码可选额度
}


function GetPayMoney(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/GetPayMoney",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{ID:0}
function GetPayCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/GetPayCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{ID:0}
function DelPayCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/DelPayCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

/*
ID:0收款码ID
code_type:"支付宝" “微信”
code_url:收款码地址
account:帐号
name:名称
*/
//data:{ID:0,code_type:'',code_url:'',account:'',name:''}
function UpdatePayCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/SumbitPayCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

/*
code_type:"支付宝" “微信”
code_url:收款码地址
account:帐号
name:名称
*/

//data:{code_type:'',code_url:'',account:'',name:''}
function SumbitPayCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/SumbitPayCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}



//code_type:"支付宝" “微信”
//data:{code_type:''}
function GetMyPayCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/GetMyPayCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{price:0}
function SumbitWechatWithdrawal(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/SumbitWechatWithdrawal",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{page_index:1}
function GetTibiList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetTibiList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{quantity:0,t_path:''}
function SumbitTibi(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/SumbitTibi",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetTibiQuantity(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetTibiQuantity",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetTibiConfig(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetTibiConfig",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function AccountCurrencyBySourceList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/AccountCurrencyBySourceList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
function GetSourceType(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetSourceType",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//获取平台收款信息
function GetMyBankCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyBankCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetRechargeAmount(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetRechargeAmount",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//获取充值记录
function GetMyRechargeList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyRechargeList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{money:0,pay_certificate:'',remark:''}
function SumbitRecharge(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/SumbitRecharge",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
//
function GetRechargeConfig(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetRechargeConfig",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


function GetMyExchangeListAmount(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyExchangeListAmount",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}



function GetSumbitExchangeData(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetSumbitExchangeData",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{value:0}

function SumbitExchange(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/SumbitExchange",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}



//data:{to_user_id:0,give_price:0,remarks:''}

function SumbitGive(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/SumbitGive",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyGiveAmount(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyGiveAmount",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
//data:{to_user_id:0}
function GetGiveToMemberInfo(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetGiveToMemberInfo",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{mobile:''}
function GetUserIDByMobile(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetUserIDByMobile",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
//data:{to_user_id:0}
function ValidateUserID(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/ValidateUserID",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyGiveFriendList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyGiveFriendList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyBankDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyBankDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetWithdrawalSetting(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetWithdrawalSetting",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//获取奖励金额
//status:99全部 0冻结中 1己发放
//data:{status:99}
function GetJiangliAmount(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetJiangliAmount",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{currency_id:0}
function GetAccountCurrencyAmount(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetAccountCurrencyAmount",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyRechargeList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyRechargeList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyGiveList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyGiveList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyExchangeList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyExchangeList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyWithdrawalList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyWithdrawalList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{bank_id:0,price:0}
function SumbitWithdrawal(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/SumbitWithdrawal",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{ID:0}
function DelUserBank(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/DelUserBank",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{ID:0,bank_id:0,img_url:'',bank_card_number:'',bank_user_name:'',bank_name:'',bank_source_name:'',idcard:'',mobile:''}
function EnditUserBank(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/EnditUserBank",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyBankList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetMyBankList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
function GetBankList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/GetBankList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//status:99全部 0代表冻结中 1代表己发放 
//data:{status:99,page_index:1}
function JiangliList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/JiangliList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{currency_id:0,page_index:1}
function AccountCurrencyList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Account/AccountCurrencyList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
