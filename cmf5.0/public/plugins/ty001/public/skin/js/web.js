$(document).ready(function(){

	//导航下拉

	if($(".nav-toggle").css("display") == "none"){

		$(".nav li").mouseenter(function(){
			var th=$(this);
			stt=setTimeout(function(){
				th.children("dl").slideDown(200);
			},200)
		}).mouseleave(function(){
			clearTimeout(stt);
			$(this).children("dl").slideUp(200);
		});

	}else{

		$(".nav-toggle").click(function(){
			$(".nav").slideToggle("200");
		});

		$(".nav li").each(function(index){
			var navLi = $(this);
			if(navLi.find("dl").length == 1){
				//navLi.children("a").attr({"href":"javascript:void(0);"});
				navLi.click(function(){
					$(this).children("dl").slideToggle(200);
					$(this).siblings().children("dl").slideUp(200);
				});
			}
		});

		$(document).mouseup(function(e){
			var area = $(".nav-toggle,.nav")
			if(!area.is(e.target) && area.has(e.target).length === 0){
				$(".nav").fadeOut();
				$(".nav li dl").slideUp();
			}
		});
	}


	//代理品牌切换
	$(".agency-brand .brand-type li").each(function(index){
		$(this).click(function(){
			$(this).addClass("active").siblings().removeClass("active");
			$(".brand-body").eq(index).show().siblings(".brand-body").hide();
		});
	});


	//轮播
	function basicSlider(wrap,box,prev,next,or){

		var wrap=$(wrap);
		var box=$(box);
		var prev=$(prev);
		var next=$(next);
		var l=box.find("li").size();
		var w=box.find("li").outerWidth();

		box.css({"width":"9999px"});
		box.find("li").css({"width":w});

		prev.click(function(){
			box.find("li:last").prependTo(box);
			box.css({"margin-left":-w});
			box.stop().animate({"margin-left":"0px"});
		});

		next.click(function(){
			box.stop().animate({"margin-left":-w},function(){
				box.find("li").eq(0).appendTo(box);
				box.css({"margin-left":"0px"});
			});
			
		});

		if(or == true){
			var sdd=setInterval(function(){
				next.click();
			},3000);

			wrap.hover(function(){
				clearInterval(sdd)
			},function(){
				sdd=setInterval(function(){
					next.click();
				},3000);
			});
		}

	}
	//工程项目
	basicSlider(".project-body",".project-body ul",".project-body .prev",".project-body .next",true);

	//代理品牌
	function brandSlider(wrap,box,btn){

		var wrap = $(wrap);
		var box = $(box);
		var btn = $(btn);
		var w = $(window).width();
		var i = 0 ;
		var size = box.find(".item").size();

		$(".brand-body .group").css({"width":"99999px"});
		$(".brand-body .group .item").css({"width": w,"float":"left"});

		btn.click(function(){

			if($(this).hasClass("disabled")){

				return false

			}else{

				if($(this).hasClass("prev")){
					i--
				}else{
					i++
				}

				btn.removeClass("disabled");
				box.find(".group").animate({"margin-left":-i*w});
				if(i == 0){
					wrap.find(".action .prev").addClass("disabled");
				};

				if(i == size-1){
					wrap.find(".action .next").addClass("disabled");
				}

			}

		});

	}

	brandSlider(".brand-body1",".brand-body1 .box",".brand-body1 .action .btn");
	brandSlider(".brand-body2",".brand-body2 .box",".brand-body2 .action .btn");
	brandSlider(".brand-body3",".brand-body3 .box",".brand-body3 .action .btn");
	brandSlider(".brand-body4",".brand-body4 .box",".brand-body4 .action .btn");


	//返回顶部
	function DoTop(){

		$(window).scroll(function(){

			var scrollH=$(window).scrollTop();

			if(scrollH>300){
				$(".go-top").fadeIn();
			}else{
				$(".go-top").fadeOut();
			}
		});

		$(".go-top").click(function(){
			$("body,html").animate({
				"scrollTop":"0px"
			},300)
		});
		
	}

	DoTop();



	//招聘详情展开
	$(".recruitment li>a").click(function(){
		$(this).siblings(".recruitment-detail").slideToggle();
		$(this).parent("li").siblings().children(".recruitment-detail").slideUp();
	});


	//滚动到外埠经销商加盟
	$(".subnav .jm").click(function(){
		$("body,html").animate({"scrollTop":$(".bussiness-join").offset().top},300);
	});


	//品牌服务表单清空
	$(".fill-info .action .empty").click(function(){

		$('.fill-info input[type="text"]').val("");
		$('.fill-info input[type="radio"]').removeAttr("checked");

	});


	//资料下载切换
	$(".zlxz.brand-type li").each(function(index){
		$(this).click(function(){
			$(this).addClass("active").siblings().removeClass("active");
			$(".data-download").eq(index).show().siblings(".data-download").hide();
		});
	});


});