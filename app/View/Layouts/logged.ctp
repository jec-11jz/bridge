
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
 
    <title>menu | Bridge</title>
      
    <meta name="description" content="" />
    <meta name="author" content="Bridge" />
      
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
    <!-- CSS -->
    <link rel="stylesheet" href="../../webroot/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../webroot/css/menu.css">
    <!-- Customize CSS -->
    <!-- MEMO: CSSフレームワークをカスタマイズ、独自CSSを記述or読み込み -->
    <style>
        body {
            padding-top: 40px;
        }
        /* MEMO: 例えばヘッダーのブランド部分を明るくしたい */
       .navbar .brand {
           color: #46A546;
           background-color: #FFFFFF;
       }
		.navbar-inverse .navbar-inner {
			background-image: none;
			background-color: #FFFFFF;
			border-bottom: 1px solid #46A546;
		}
    </style>
 
    <!-- MEMO: faviconとiOS系のホームに表示されるアイコンを設定する -->
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
  </head>
  <body>
    <header class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <div class="container">
              <a href="#" class="brand">Bridge</a>
              <nav>
              </nav>
          </div>
      </div>
    </header>
    <div id="main">
	<!-- MEMO: ここに本体となるHTMLを記述 -->
		<img src="./img/NoPhoto.jpg" alt="NoImage" class="navImg">
		<div class="nav">
			<ul class="nl">
				<li><a href="#">タプルの新規作成</a></li>
				<li><a href="#">Myタプルリスト</a></li>
				<li><a href="#">タプル検索</a></li>
				<li><a href="#">作品検索</a></li>
				<li><a href="#">リンク管理</a></li>
				<li><a href="#">設定</a></li>
				<li><a href="#">ログアウト</a></li>	
			</ul>
		</div>
    </div>
    <footer>
      <p>&copy; Copyright  by Bridge</p>
    </footer>
    <!-- JavaScript -->
    <script src="./public/assets/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  </body>
</html>
