var shops = {
    GetIndexTuijian: GetIndexTuijian,//获取首页推荐产品
    GetProductCatalogList: GetProductCatalogList,//获取分类 默认获取一级分类
    GetProductList: GetProductList,//产品列表
    GetProductDetails: GetProductDetails,//产品详情
    GetProductGoods: GetProductGoods,//获取产品属性
    GetProductEvaluate: GetProductEvaluate,//获取产品评价
    IsCollectionProduct: IsCollectionProduct,//是否收藏
	GetSpecialProductList:GetSpecialProductList,
}



function GetSpecialProductList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Shops/GetSpecialProductList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}
//data:{product_id:0}
function IsCollectionProduct(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Member/IsCollectionProduct",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{prodcut_no:'',page_index:1}
function GetProductEvaluate(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Shops/GetProductEvaluate",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{prodcut_no:''}
function GetProductGoods(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Shops/GetProductGoods",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{prodcut_no:''}
function GetProductDetails(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Shops/GetProductDetails",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{key:'',catalog_id:0,supplier_id:0,product_type_id:0,seller_user_id:0,sortname:'排序名称',orderby:'排序方式',page_index:1}
function GetProductList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Shops/GetProductList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}

//data:{parent_id:0}
function GetProductCatalogList(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Shops/GetProductCatalogList",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}


function GetIndexTuijian(data, CallBack) {
    ajax({
        type: 'post',
        url: "/Shops/GetIndexTuijian",
        data: data,
        success: function (e) {
            CallBack(e);
        }
    });
}