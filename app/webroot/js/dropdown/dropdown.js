$(function(){

//アニメーション速度設定
	var Speed = "200";

//初期表示設定
	$("#dropdownmenu li ul").css("display","none");
	
//ホバーイベント
	$("#dropdownmenu li").hover(
		function(){
			$(">ul:not(:animated)",this).css("visibility","visible").fadeIn(Speed);
			$(">ul >li:not(:animated)",this).css("display","none").slideDown(Speed);
			$(">ul >li ul",this).css("visibility","hidden");
		},
		function(){
			$(">ul",this).fadeOut(Speed,function(){
				$("ul",this).css("visibility","hidden");
			});
			$(">ul >li",this).slideUp(Speed);
		}
	);

});
