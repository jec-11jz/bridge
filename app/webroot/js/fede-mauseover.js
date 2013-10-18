$(function() {
    var num = 1;
    $('#nav1 li')
    //マウスオーバー画像を配置
    .each(function(){
        $(this).css('background', 'url(img/nav0'+num+'.gif) no-repeat 0px -29px')
        num++;
    })
    .find('img').hover(
        function(){
            $(this).stop().animate({'opacity' : '0'}, 500); 
        },
        function(){
            $(this).stop().animate({'opacity' : '1'}, 1000);
        }
    );
});
