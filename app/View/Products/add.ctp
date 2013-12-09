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
	<label for="title">タイトル：</label>
		<input type="text" name="title" size="40" maxlength="20" id="title" style="display: block" />
		<div id="suggestTitle" class="suggest" style="display:none;"></div>
	<label for="originalTitle">原題：</label>
		<input type="text" name="originalTitle" size="40" maxlength="20" id="originalTitle" style="display: block" />
		<div id="suggestOriginalTitle" class="suggest" style="display:none;"></div>
	<label for="country">製作国：</label>
		<input type="text" name="country" size="40" maxlength="20" id="country" style="display: block" />
		<div id="suggestCountry" class="suggest" style="display:none;"></div>
	<label for="date">製作年：</label>
		<input type="text" name="date" size="40" maxlength="20" id="date" style="display: block" />
		<div id="suggestDate" class="suggest" style="display:none;"></div>
	<label for="time">上映時間：</label>
		<input type="text" name="time" size="40" maxlength="20" id="time" placeholder="分" style="display: block" />
		<div id="suggestTime" class="suggest" style="display:none;"></div>
	<label for="director">監督：</label>
		<input type="text" name="director" size="40" maxlength="20" id="director" placeholder="監督" style="display: block" />
		<div id="suggestDirector" class="suggest" style="display:none;"></div>
	<label for="cast">キャスト：</label>
		<input type="text" name="cast" size="40" maxlength="20" id="cast" placeholder="キャスト" style="display: block" />
		<div id="suggestCast" class="suggest" style="display:none;"></div>
	<label for="cast">あらすじ：</label>
		<textarea name="outline" cols=40 rows=4 id="outline" style="display: block" /></textarea>
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
			function startSuggest() {
				new Suggest.Local(
			        "title",    // 入力のエレメントID
			        "suggestTitle", // 補完候補を表示するエリアのID
			        JSON.parse(tags),      // 補完候補の検索対象となる配列
			        {dispMax: 10, interval: 1000}); // オプション
		        
		        new Suggest.Local(
			        "originalTitle",    // 入力のエレメントID
			        "suggestOriginalTitle", // 補完候補を表示するエリアのID
			        JSON.parse(tags),      // 補完候補の検索対象となる配列
			        {dispMax: 10, interval: 1000}); // オプション
		        
		        new Suggest.Local(
			        "country",    // 入力のエレメントID
			        "suggestCountry", // 補完候補を表示するエリアのID
			        JSON.parse(tags),      // 補完候補の検索対象となる配列
			        {dispMax: 10, interval: 1000}); // オプション
		        
		        new Suggest.Local(
			        "date",    // 入力のエレメントID
			        "suggestDate", // 補完候補を表示するエリアのID
			        JSON.parse(tags),      // 補完候補の検索対象となる配列
			        {dispMax: 10, interval: 1000}); // オプション
		        
		        new Suggest.Local(
			        "time",    // 入力のエレメントID
			        "suggestTime", // 補完候補を表示するエリアのID
			        JSON.parse(tags),      // 補完候補の検索対象となる配列
			        {dispMax: 10, interval: 1000}); // オプション
			        
		        new Suggest.LocalMulti(
			        "director",    // 入力のエレメントID
			        "suggestDirector", // 補完候補を表示するエリアのID
			        JSON.parse(tags),      // 補完候補の検索対象となる配列
			        {dispMax: 10, interval: 1000}); // オプション
			        
		        new Suggest.LocalMulti(
			        "cast",    // 入力のエレメントID
			        "suggestCast", // 補完候補を表示するエリアのID
			        JSON.parse(tags),      // 補完候補の検索対象となる配列
			        {dispMax: 10, interval: 1000}); // オプション
			}
			
			window.addEventListener ?
			window.addEventListener('load', startSuggest, false) :
			window.attachEvent('onload', startSuggest);
		},
		error: function(tags){
			console.log('error');
		}
	});
});
</script>
