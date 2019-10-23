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
			url:url + '/api.php/sign_user/getLog',
			async: true,
			data:d,
			dataType: 'json',
			success: function(result) {
				if(result.code == '0000') {
					var data=result.data.list;
					var html='';
					for(var i in data){
						html += '<div class="rdiv fl-l"><div class="h77 fs24">';
						html += '<div class="fl-l fs24">'+data[i].note+'</div>';
						html += '<div class="fl-r fs24">'+data[i].score+'</div></div>';
						html += '<div class="h77 fs24"><div class="fl-l fs24">'+data[i].create_time+'</div>';
						html += '<div class="fl-r fs24" style="color:#1E88E5;">糖果</div></div></div>';
					}
					if (html == "" || data.length < pagesize) {
						$('.notMore').css('display',"block")
					}
					$("#mytk").append(html);
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


