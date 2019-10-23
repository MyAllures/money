$(function(){
	var p=1;
	var pagesize=10;	
	function financial_list(p){
		var d={};
		d.token=token;
		d.pagesize=pagesize;
		d.p=p;
		$.ajax({
			type: "post",
			url:url + '/api.php/Common/getNotice',
			async: false,
			data:d,
			dataType: 'json',
			success: function(result) {
				if(result.code == '0000') {
					var data=result.data.list;
					var html='';
					for(var i in data){
						html += '<div class="pad22" data="'+data[i].id+'" style="padding-bottom: 0;padding-top: 0;">';
						html += '<div class="fs28 h74">'+data[i].name+'</div>';
						html += '<div class="fs24 txtg content">'+data[i].describe+'</div>';
						html += '<div class="txtz tar h60">'+data[i].time+'</div></div>';
					}
					if (html == "" || data.length < pagesize) {
						$('.notMore').css('display',"block")
					}
					$("#sys").append(html);
					$(".pad22").on("click",function(){
						location.href='wenzhang_details.html?id='+$(this).attr("data");
					})
				} else {
					isErr(result);
				}
			},			
		})
	}
	financial_list(p);
	//	下拉加载更多
	$(window).scroll(function() {
		if ($(document).scrollTop() >= $(document).height() - $(window).height() - 70) {			
		// console.log('我到底了');
			if ($('.notMore').css('display') != "block") {
				p++;
				financial_list(p);
			}
		}
	})
})
