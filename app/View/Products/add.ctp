<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('suggest');
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>
<style type="text/css">
#image {
    width: 200px;
    height: 200px;
    overflow: hidden;
    cursor: pointer;
    background: #000;
    color: #fff;
}
#image img {
    visibility: hidden;
}

.suggest {
    position: absolute;
    background-color: #FFFFFF;
    border: 1px solid #CCCCFF;
    font-size: 90%;
    width: 200px;
}
.suggest div {
    display: block;
    width: 200px;
    overflow: hidden;
    white-space: nowrap;
}
.suggest div.select{ /* キー上下で選択した場合のスタイル */
    color: #FFFFFF;
    background-color: #3366FF;
}
.suggest div.over{ /* マウスオーバ時のスタイル */
    background-color: #99CCFF;
}
</style>
<form type="post" action="/products/add">
	<div id="image" onclick="openKCFinder(this)"><div style="margin:5px">Click here to choose an image</div></div>
	<select name="selectTemplate">
		<option value="">-----テンプレート-----</option>
		<option value="movie">映画</option>
		<option value="novel">小説</option>
		<option value="anime">アニメ</option>
		<option value="other">その他</option>
	</select>
	<label for="movieTitle" style="display: block">タイトル：</label>
		<input type="text" name="movieTitle" size="40" maxlength="20" id="movieTitle" style="display: block" />
		<div id="suggestMovieTitle" class="suggest" style="display:none;"></div>
	<label for="originalMovieTitle">原題：</label>
		<input type="text" name="originalMovieTitle" size="40" maxlength="20" id="originalMovieTitle" style="display: block" />
		<div id="suggestOriginalMovieTitle" class="suggest" style="display:none;"></div>
	<label for="movieCountry">製作国：</label>
		<input type="text" name="movieCountry" size="40" maxlength="20" id="movieCountry" style="display: block" />
		<div id="suggestMovieCountry" class="suggest" style="display:none;"></div>
	<label for="movieDate">製作年：</label>
		<input type="text" name="movieDate" size="40" maxlength="20" id="movieDate" style="display: block" />
		<div id="suggestMovieDate" class="suggest" style="display:none;"></div>
	<label for="movieTime">上映時間：</label>
		<input type="text" name="movieTime" size="40" maxlength="20" id="movieTime" placeholder="分" style="display: block" />
		<div id="suggestMovieTime" class="suggest" style="display:none;"></div>
	<label for="movieDirector">監督：</label>
		<input type="text" name="movieDirector" size="40" maxlength="20" id="movieDirector" placeholder="監督" style="display: block" />
		<div id="suggestMovieDirector" class="suggest" style="display:none;"></div>
	<label for="movieCast">キャスト：</label>
		<input type="text" name="movieCast" size="40" maxlength="20" id="movieCast" placeholder="キャスト" style="display: block" />
		<div id="suggestMovieCast" class="suggest" style="display:none;"></div>
	<label for="movieOutline">あらすじ：</label>
		<textarea name="movieOutline" cols=40 rows=4 id="movieOutline" style="display: block" /></textarea>
	<label>最後の編集者 :</label><a style="display: block">iverson</a>
	<a>この作品を編集する</a>
	<input type="button" value="戻る" />
	<input type="button" value="登録" />
</form>

<!-- KCfinder読み込み -->
<script type="text/javascript">
function openKCFinder(div) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" src="' + url + '" />';
                var img = document.getElementById('img');
                var o_w = img.offsetWidth;
                var o_h = img.offsetHeight;
                var f_w = div.offsetWidth;
                var f_h = div.offsetHeight;
                if ((o_w > f_w) || (o_h > f_h)) {
                    if ((f_w / f_h) > (o_w / o_h))
                        f_w = parseInt((o_w * f_h) / o_h);
                    else if ((f_w / f_h) < (o_w / o_h))
                        f_h = parseInt((o_h * f_w) / o_w);
                    img.style.width = f_w + "px";
                    img.style.height = f_h + "px";
                } else {
                    f_w = o_w;
                    f_h = o_h;
                }
                img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                img.style.visibility = "visible";
            }
        }
    };
    window.open('/js/kcfinder/browse.php?type=images&dir=images/public',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}
</script>
<script>
$(function() {
	// DBからタグを取得
	var tag = [];
	$.ajax({
		type: 'GET',
		url: '/tags/get',
		success: function(tags){
			console.log('success');
			console.log(tags);
			lowercase : true
			new Suggest.Local(
		        "movieTitle",    // 入力のエレメントID
		        "suggestMovieTitle", // 補完候補を表示するエリアのID
		        JSON.parse(tags),      // 補完候補の検索対象となる配列
		        {dispMax: 10, interval: 1000, prefix: true}); // オプション
	        
	        new Suggest.Local(
		        "originalMovieTitle",    // 入力のエレメントID
		        "suggestOriginalMovieTitle", // 補完候補を表示するエリアのID
		        JSON.parse(tags),      // 補完候補の検索対象となる配列
		        {dispMax: 10, interval: 1000, prefix: true}); // オプション
	        
	        new Suggest.Local(
		        "movieCountry",    // 入力のエレメントID
		        "suggestMovieCountry", // 補完候補を表示するエリアのID
		        JSON.parse(tags),      // 補完候補の検索対象となる配列
		        {dispMax: 10, interval: 1000, prefix: true}); // オプション
	        
	        new Suggest.Local(
		        "movieDate",    // 入力のエレメントID
		        "suggestMovieDate", // 補完候補を表示するエリアのID
		        JSON.parse(tags),      // 補完候補の検索対象となる配列
		        {dispMax: 10, interval: 1000, prefix: true}); // オプション
	        
	        new Suggest.Local(
		        "movieTime",    // 入力のエレメントID
		        "suggestMovieTime", // 補完候補を表示するエリアのID
		        JSON.parse(tags),      // 補完候補の検索対象となる配列
		        {dispMax: 10, interval: 1000, prefix: true}); // オプション
		        
	        new Suggest.LocalMulti(
		        "movieDirector",    // 入力のエレメントID
		        "suggestMovieDirector", // 補完候補を表示するエリアのID
		        JSON.parse(tags),      // 補完候補の検索対象となる配列
		        {dispMax: 10, interval: 1000, prefix: true}); // オプション
		        
	        new Suggest.LocalMulti(
		        "movieCast",    // 入力のエレメントID
		        "suggestMovieCast", // 補完候補を表示するエリアのID
		        JSON.parse(tags),      // 補完候補の検索対象となる配列
		        {dispMax: 10, interval: 1000, prefix: true}); // オプション
		},
		error: function(tags){
			console.log('error');
		}
	});
});
</script>
