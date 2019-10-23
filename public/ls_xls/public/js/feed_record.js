$(function(){
//	获取类型
	var you=GetQueryString("type");
	if(you != 2){
		you = 1;
	}
	var p=1;
	var pagesize=15;	
	function financial_list(p){
		var d={};
		d.token=token;
		d.pagesize=pagesize;
		d.p=p;
		d.type=you;
		$.ajax({
			type: "post",
			url:url + '/api.php/tool/suggestion_list',
			async: true,
			data:d,
			dataType: 'json',
			success: function(result) {
				if(result.code == '0000') {
					var data=result.data.list;
					var html='';
					for(var i in data){
						html += '<ul class="pad22" data="'+data[i].id+'"><li class="fl-l fs28 txtb text_title">'+data[i].title+'</li><li class="ext_name">('+data[i].status_name+')</li>';
						html += '<li class="fl-r fs24 txtg">'+data[i].create_time+'<img src="images/toright.png" /></li></ul>';
					}
					if (html == "" || data.length < pagesize) {
						$('.notMore').css('display',"block")
					}
					$("#fdback").append(html);
//					反馈详情
					$(".pad22").on("click",function(){
						location.href='feed_details.html?id='+$(this).attr("data")+"&type="+you;
					})
				} else {
					isErr(result);
				}
			},			
		})
	}
	financial_list(p);
	//	下拉加载更多
	$(window).scroll(function(){
		if ($(document).scrollTop() >= $(document).height() - $(window).height() - 70) {
			if ($('.notMore').css('display') != "block") {
				p++;
				financial_list(p);
			}
		}
	})
})


