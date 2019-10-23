$(function(){
	function kkl(){
		$.ajax({
		    type:'post',
		    url:url+'/api.php/sign_user/getInfo',
		    data:{"token":token},
		    dataType:"json",
		    async:true,
		    success:function(result){
		        if(result.code == "0000"){
		        	var html = '';
		        	var data=result.data.info.day_list;
		        	$(".history_times").html(result.data.info.history_times);
		        	$(".back_score").html(result.data.info.back_score);
		        	for(var i in data){
		        		var day=data[i].sign_day;
		        		if(data[i].is_sign == 1){
		        			html += '<div class="jjk" data="'+data[i].sign_day+'" data1="1"><img src="images/bg_qd.png" class="jjk_img"/><span>'+day.substring(day.length-2)+'</span></div>';
		        		}else{
		        			html += '<div class="jjk" data="'+data[i].sign_day+'"><span>'+day.substring(day.length-2)+'</span></div>';
		        		}
		        	}
		        	html += '<div style="clear:both;"></div>';
		        	$(".jjk_div").html(html);
		        	if($(".jjk_div>.jjk").eq(6).attr("data1") == "1"){
		        		$(".qd_btn").prop("disabled",true).addClass("active");
		        	}
		        }else{
		            isErr(result);
		        }
		    }
		});
	}
	kkl();
//	签到按钮
	$(".qd_btn").on("click",function(){
		var day=$(".jjk:first").attr("data");
		$.ajax({
		    type:'post',
		    url:url+'/api.php/sign_user/sign',
		    data:{"token":token},
		    dataType:"json",
		    async:true,
		    success:function(result){
		        if(result.code == "0000"){
		        	$(".message").html(result.msg);
		        	kkl();
		        	$("#aaa").css("display","block");
					$("#ddd").css("display","block");
		        }else{
		            isErr(result);
		        }
		    }
		});
	})
//	取消弹框
	$(".qr_btn").on("click",function(){
		$("#aaa").css("display","none");
		$("#ddd").css("display","none");
	})
	$("#aaa").on("click",function(){
		$("#aaa").css("display","none");
		$("#ddd").css("display","none");
	})
})
