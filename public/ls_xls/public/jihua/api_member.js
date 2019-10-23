var member = {
    GetMemberConter:GetMemberConter,//获取会员个人中心
    SumbitProductShopsCart: SumbitProductShopsCart,//产品添加购物车
    GetMyShopsCart: GetMyShopsCart,//获取购物车
	DelShopsCart:DelShopsCart,//删除购物车
    SetShopsCartQuantity:SetShopsCartQuantity,//设置购物车数量
    GetMyDefaultAddress: GetMyDefaultAddress,//获取默认地址
    SumbitEnditAddress: SumbitEnditAddress,//编辑地址
    SetAddressDefault: SetAddressDefault,//设置地址为默认地址
    GetMyAddressList: GetMyAddressList,//获取地址列表
    GetAddressDetails: GetAddressDetails,//获取地址详情
    DelAddress:DelAddress,//删除地址
    GetSumbitOrderData: GetSumbitOrderData,//获取提交订单页面信息
    SumbitOrder: SumbitOrder,//提交订单
	IsOrderPay:IsOrderPay,//判断订单是否支付
    GetOrderList: GetOrderList,//获取订单列表
    GetOrderRefundType:GetOrderRefundType,//获取订单售后类型
    GetOrderDetailsByID:GetOrderDetailsByID,//获取单个订单详情
    SumbitOrderSuccess:SumbitOrderSuccess,//确认收货
    GetOrderDetails: GetOrderDetails,//订单详情
    EvaluateOrderList: EvaluateOrderList,//待评价订单列表
    GetOrderRefundList: GetOrderRefundList,//待售后列表
    GetOrderRefundDetails:GetOrderRefundDetails,//获取售后详情
    SumbitOrderRefund: SumbitOrderRefund,//提交售后
    GetEvaluateOrderList: GetEvaluateOrderList,//待评价订单列表
    SumbitProdcutEvaluate:SumbitProdcutEvaluate,//提交商品评价
    GetEvaluateOrderGoodsImg:GetEvaluateOrderGoodsImg,//获取需评价的商品列表
    GetMyTeam: GetMyTeam,//获取我的团队
	GetMyTeamAmount:GetMyTeamAmount,//我的团队概况
    GetCollectionProductList: GetCollectionProductList,//我的收藏
    SumbitCollectionProduct: SumbitCollectionProduct,//提交收藏
    DelCollectionProduct: DelCollectionProduct,//删除收藏
    SumbitUpPassword: SumbitUpPassword,//提交修改密码
    GetOrderPayMoney: GetOrderPayMoney,//获取订单需要支付的金额
	MyCode:MyCode,//我的推广二维码
	MyWecahtCode:MyWecahtCode,//我的微信推广二维码
    SumbitOutOrder:SumbitOutOrder,//提交取消订单
		SumbitVoucherPay:SumbitVoucherPay,//提交支付凭证
		GetMyMember:GetMyMember,//获取会员信息
		UpdataWechat:UpdataWechat,//修改微信号
		UpdataMobile:UpdataMobile,//修改手机号
		UpdataName:UpdataName,//修改会员名称
		UpdataImage:UpdataImage,//修改会员头像
		UpdateMemberInfo:UpdateMemberInfo,//修改会员信息
		UpdataPassword:UpdataPassword,//找回密码
		GetIsPayPassword:GetIsPayPassword,//判断是否设置支付密码
		SetPayPassword:SetPayPassword,//设置支付密码
		IsPayPassword:IsPayPassword,//验证支付密码
		UpdatePayPassword:UpdatePayPassword,//忘记支付密码
}


//team_type:t:伞下 p：直推
//data:{team_type:''}
function GetMyTeamAmount(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetMyTeamAmount",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
function MyWecahtCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/MyWecahtCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//在修改时先使用:GetMyMember接口获取会员信息
//data:{name:'',mobile:'',wechat:'',img_url:''}
function UpdateMemberInfo(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/UpdateMemberInfo",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{order_no:''}
function IsOrderPay(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/IsOrderPay",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//ids:'1,2,3,4'
//购物车ID。并用逗号隔开
//如果只有一条不用隔开:ids:'1'
//data:{ids:''}
function DelShopsCart(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/DelShopsCart",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{img_url:''}
function UpdataImage(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/UpdataImage",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{account:'',password:''}
function UpdatePayPassword(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/UpdatePayPassword",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{password:''}
function IsPayPassword(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/IsPayPassword",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{password:''}
function SetPayPassword(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/SetPayPassword",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetIsPayPassword(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/GetIsPayPassword",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//data:{account:'',password:'',old_password:'',code:''}
function UpdataPassword(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Public/UpdataPassword",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//data:{name:''}
function UpdataName(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/UpdataName",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{mobile:''}
function UpdataMobile(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/UpdataMobile",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{wechat:''}
function UpdataWechat(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/UpdataWechat",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyMember(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetMyMember",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{order_no:'',pay_certificate:''}
function SumbitVoucherPay(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Pay/SumbitVoucherPay",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//data:{order_no:''}
function SumbitOutOrder(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SumbitOutOrder",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
function MyCode(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/MyCode",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


function GetOrderPayMoney(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetOrderPayMoney",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{order_no:'',details_id:0,star:0,contents:'',img_url:''}
function SumbitProdcutEvaluate(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SumbitProdcutEvaluate",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//获取待评价列表
function GetEvaluateOrderGoodsImg(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetEvaluateOrderGoodsImg",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
//获取待评价列表
function GetEvaluateOrderList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetEvaluateOrderList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{refund_no:''}
function GetOrderRefundDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetOrderRefundDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
function GetOrderRefundList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetOrderRefundList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//提交售后
//data:{order_no:'',}
function SumbitOrderRefund(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SumbitOrderRefund",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


function GetOrderRefundType(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetOrderRefundType",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
//data:{order_no:'',detailsID:0}
function GetOrderDetailsByID(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetOrderDetailsByID",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
//data:{order_no:''}
function SumbitOrderSuccess(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SumbitOrderSuccess",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function EvaluateOrderList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/EvaluateOrderList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{old_password:'',new_password:''}
function SumbitUpPassword(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SumbitUpPassword",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//删除当前地址
//data:{ID=0}
function DelAddress(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/DelAddress",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}



function GetMemberConter(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetMemberConter",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{ID:0,quantity:0}
function SetShopsCartQuantity(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SetShopsCartQuantity",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//ID:返回的地址ID编号
//data:{ID=0}
function GetAddressDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetAddressDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//ID:返回的收藏ID编号
//data:{ID=0}
function DelCollectionProduct(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/DelCollectionProduct",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{product_id:0}
function SumbitCollectionProduct(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SumbitCollectionProduct",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetCollectionProductList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetCollectionProductList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//lay代表层级:1：下一级团队 2:下二级 3：下三级
//data:{lay:1,page_index:1}
function GetMyTeam(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetMyTeam",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{order_no:''}
function GetOrderDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetOrderDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//status:99 显示全部
//data;{status:0,page_index:1}
function GetOrderList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetOrderList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{cart_ids:'',coupon_id:0,remarks:''}
function SumbitOrder(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SumbitOrder",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


//data:{cart_ids:'',coupon_id:0}
function GetSumbitOrderData(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetSumbitOrderData",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyAddressList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetMyAddressList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{ID:0}
function SetAddressDefault(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SetAddressDefault",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{province_name:'',city_name:'',area_name:'',address:'',user_name:'',mobile:''}
function SumbitEnditAddress(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SumbitEnditAddress",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyDefaultAddress(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetMyDefaultAddress",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

function GetMyShopsCart(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/GetMyShopsCart",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
//data:{goods_id:0,quantity:0}
function SumbitProductShopsCart(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/SumbitProductShopsCart",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
