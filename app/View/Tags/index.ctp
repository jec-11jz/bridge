<p><h1>タグ一覧</h1></p>
<table>
	<th>タグ名</th>
	<th>ユーザID</th>
	<th>作成日</th>
    <?php foreach($tags as $tag): ?>
       <!-- 配列のデータを取り出してechoで出力する、h()はエスケープ -->
        	<tr>
	        	<td><?php echo h($tag['Tag']['name']); ?></td>
	        	<td><?php echo h($tag['Tag']['user_id']); ?></td>
	        	<td><?php echo h($tag['Tag']['created']); ?></td>
	        </tr>
    <?php endforeach; ?>
</table>